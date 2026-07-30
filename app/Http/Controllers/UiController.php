<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Services\EquipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class UiController extends Controller
{
    public function __construct(
        private readonly EquipmentService $equipmentService,
    ) {}

    /**
     * Renderiza a página principal (dashboard) da aplicação.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('ui.index', ['user' => $user]);
    }

    /**
     * Renderiza a vista de gestão de tickets.
     */
    public function tickets(Request $request): View
    {
        $user = $request->user();

        return view('ui.tickets', ['user' => $user]);
    }

    /**
     * Renderiza o formulário de criação de tickets.
     */
    public function ticketCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.ticket-create', ['user' => $user]);
    }

    /**
     * Renderiza a vista de gestão de equipamentos.
     */
    public function equipments(Request $request): View
    {
        $user = $request->user();

        return view('ui.equipments', ['user' => $user]);
    }

    /**
     * Renderiza a vista de gestão de utilizadores.
     */
    public function users(Request $request): View
    {
        $user = $request->user();

        return view('ui.users', ['user' => $user]);
    }

    /**
     * Renderiza o formulário de criação de utilizadores.
     */
    public function userCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.users-create', ['user' => $user]);
    }

    /**
     * Renderiza o formulário de edição de um utilizador específico.
     */
    public function userEdit(Request $request, User $targetUser): View
    {
        $user = $request->user();
        $targetUser->loadMissing('profile');

        return view('ui.users-edit', [
            'user' => $user,
            'targetUser' => $targetUser,
        ]);
    }

    /**
     * Renderiza a vista de gestão de salas.
     */
    public function rooms(Request $request): View
    {
        $user = $request->user();

        return view('ui.rooms', ['user' => $user]);
    }

    /**
     * Renderiza o formulário de criação de salas.
     */
    public function roomCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.rooms.create', ['user' => $user]);
    }

    /**
     * Renderiza o detalhe de uma sala específica.
     */
    public function roomDetail(Request $request, Room $room): View
    {
        $user = $request->user();

        return view('ui.rooms.show', [
            'room' => $room,
            'user' => $user,
        ]);
    }

    /**
     * Renderiza o formulário de edição de uma sala específica.
     */
    public function roomEdit(Request $request, Room $room): View
    {
        $user = $request->user();

        return view('ui.rooms.edit', [
            'room' => $room,
            'user' => $user,
        ]);
    }

    /**
     * Renderiza a vista de registos de auditoria do sistema.
     */
    public function audits(Request $request): View
    {
        $user = $request->user();

        return view('ui.audits', ['user' => $user]);
    }

    /**
     * Renderiza a vista de detalhe de um ticket específico.
     */
    public function ticketDetail(Request $request, int $id): View
    {
        $user = $request->user();

        return view('ui.ticket-detail', [
            'ticketId' => $id,
            'user' => $user,
        ]);
    }

    /**
     * Endpoint JSON auxiliar para listagem paginada de equipamentos na interface.
     */
    public function getEquipments(Request $request): JsonResponse
    {
        $request->user();

        $equipments = $this->equipmentService->listPaginated(
            $request->query('q'),
            $request->query('status'),
        );

        return response()->json([
            'equipments' => $equipments,
        ]);
    }

    /**
     * Renderiza a vista de relatórios e análises estatísticas.
     */
    public function analytics(Request $request): View
    {
        $user = $request->user();

        return view('ui.analytics', ['user' => $user]);
    }

    /**
     * Renderiza a vista de perfil do utilizador autenticado.
     */
    public function profile(Request $request): View
    {
        $user = $request->user();

        return view('ui.profile', ['user' => $user]);
    }
}
