<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    /**
     * Lista todos os equipamentos com as respetivas salas, categorias e estado operacional calculado.
     */
    public function index(Request $request)
    {
        // Estados finais/encerrados que já não tornam o equipamento inoperacional
        $closedStatuses = [
            'fechada', 'fechado', 'fechadas', 'fechados', 'closed',
            'cancelada', 'cancelado', 'canceladas', 'cancelados', 'cancelled',
            'recusada', 'recusado', 'recusadas', 'recusados', 'rejected'
        ];

        // Relação e contagem de tickets ativos (avarias pendentes/em curso)
        $query = Equipment::with(['room', 'category'])
            ->withCount(['tickets as active_tickets_count' => function ($q) use ($closedStatuses) {
                $q->where(function ($sub) use ($closedStatuses) {
                    $sub->whereHas('status', function ($sq) use ($closedStatuses) {
                        $sq->whereNotIn(DB::raw('LOWER(name)'), $closedStatuses);
                    })
                    ->orWhere(function ($sq) use ($closedStatuses) {
                        if (Schema::hasColumn('tickets', 'status')) {
                            $sq->whereNotIn(DB::raw('LOWER(status)'), $closedStatuses);
                        }
                    });
                })
                ->whereNull('closed_at');
            }]);

        // 1. Pesquisa por texto (aceita ?q= ou ?query=)
        $searchTerm = $request->input('q') ?? $request->input('query');
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');

                if (Schema::hasColumn('equipments', 'serial_number')) {
                    $q->orWhere('serial_number', 'like', '%' . $searchTerm . '%');
                }
                if (Schema::hasColumn('equipments', 'serial')) {
                    $q->orWhere('serial', 'like', '%' . $searchTerm . '%');
                }
                if (Schema::hasColumn('equipments', 'code')) {
                    $q->orWhere('code', 'like', '%' . $searchTerm . '%');
                }
            });
        }

        // 2. Filtro de Estado Operacional Dinâmico
        // '1' = Operacional (sem tickets de avaria abertos e active != 0)
        // '0' = Fora de Serviço (possui tickets em aberto ou active == 0)
        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            $rawStatus = strtolower((string) $request->status);

            if (in_array($rawStatus, ['1', 'true', 'active', 'operational'], true)) {
                $query->whereDoesntHave('tickets', function ($q) use ($closedStatuses) {
                    $q->where(function ($sub) use ($closedStatuses) {
                        $sub->whereHas('status', function ($sq) use ($closedStatuses) {
                            $sq->whereNotIn(DB::raw('LOWER(name)'), $closedStatuses);
                        })->orWhere(function ($sq) use ($closedStatuses) {
                            if (Schema::hasColumn('tickets', 'status')) {
                                $sq->whereNotIn(DB::raw('LOWER(status)'), $closedStatuses);
                            }
                        });
                    })->whereNull('closed_at');
                });

                if (Schema::hasColumn('equipments', 'active')) {
                    $query->where('active', 1);
                }
            } elseif (in_array($rawStatus, ['0', 'false', 'inactive', 'out_of_service'], true)) {
                $query->where(function ($q) use ($closedStatuses) {
                    $q->whereHas('tickets', function ($sub) use ($closedStatuses) {
                        $sub->where(function ($sub2) use ($closedStatuses) {
                            $sub2->whereHas('status', function ($sq) use ($closedStatuses) {
                                $sq->whereNotIn(DB::raw('LOWER(name)'), $closedStatuses);
                            })->orWhere(function ($sq) use ($closedStatuses) {
                                if (Schema::hasColumn('tickets', 'status')) {
                                    $sq->whereNotIn(DB::raw('LOWER(status)'), $closedStatuses);
                                }
                            });
                        })->whereNull('closed_at');
                    });

                    if (Schema::hasColumn('equipments', 'active')) {
                        $q->orWhere('active', 0);
                    }
                });
            }
        }

        // 3. Paginação e mapeamento dinâmico
        $perPage = $request->input('per_page', 15);
        $equipments = $query->orderBy('name')->paginate($perPage);

        $equipments->getCollection()->transform(function ($eq) {
            $hasActiveTickets = ($eq->active_tickets_count ?? 0) > 0;
            $isExplicitlyInactive = isset($eq->active) && (int)$eq->active === 0;

            // É considerado operacional apenas se não estiver desativado manualmente E não tiver avarias pendentes
            $eq->is_operational = !$hasActiveTickets && !$isExplicitlyInactive;
            return $eq;
        });

        return response()->json([
            'equipments' => $equipments,
            'data'       => $equipments->items(),
            'total'      => $equipments->total(),
            'last_page'  => $equipments->lastPage(),
        ]);
    }

    /**
     * Guarda um novo equipamento com associação de sala.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'serial'        => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'room_id'       => ['nullable', 'exists:rooms,id'],
            'category_id'   => ['nullable', 'exists:equipment_categories,id'],
            'active'        => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // Normalização de serial / serial_number
        if (!empty($data['serial_number']) && empty($data['serial']) && Schema::hasColumn('equipments', 'serial')) {
            $data['serial'] = $data['serial_number'];
        } elseif (!empty($data['serial']) && empty($data['serial_number']) && Schema::hasColumn('equipments', 'serial_number')) {
            $data['serial_number'] = $data['serial'];
        }

        // Normalização do estado booleano
        $data['active'] = filter_var($request->input('active', true), FILTER_VALIDATE_BOOLEAN);

        if (Schema::hasColumn('equipments', 'status')) {
            $data['status'] = $data['active'] ? 'active' : 'inactive';
        }

        $equipment = Equipment::create($data);
        $equipment->load(['room', 'category']);

        return response()->json(['equipment' => $equipment], 201);
    }

    /**
     * Exibe um equipamento específico.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load(['room', 'category']);
        return response()->json(['equipment' => $equipment]);
    }

    /**
     * Atualiza os dados de um equipamento e a sua sala/localização.
     */
    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'          => ['sometimes', 'required', 'string', 'max:255'],
            'serial'        => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'room_id'       => ['nullable', 'exists:rooms,id'],
            'category_id'   => ['nullable', 'exists:equipment_categories,id'],
            'active'        => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // Normalização de serial / serial_number
        if (isset($data['serial_number']) && Schema::hasColumn('equipments', 'serial')) {
            $data['serial'] = $data['serial_number'];
        }
        if (isset($data['serial']) && Schema::hasColumn('equipments', 'serial_number')) {
            $data['serial_number'] = $data['serial'];
        }

        // Atualização do status ativo
        if ($request->has('active')) {
            $data['active'] = filter_var($request->input('active'), FILTER_VALIDATE_BOOLEAN);
            if (Schema::hasColumn('equipments', 'status')) {
                $data['status'] = $data['active'] ? 'active' : 'inactive';
            }
        }

        $equipment->update($data);
        $equipment->load(['room', 'category']);

        return response()->json(['equipment' => $equipment]);
    }

    /**
     * Elimina um equipamento.
     */
    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $equipment->delete();
        return response()->json(['message' => 'Equipamento eliminado com sucesso']);
    }
}