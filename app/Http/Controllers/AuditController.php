<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditResource;
use App\Models\Audit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

final class AuditController extends Controller
{
    /**
     * Lista os registos de auditoria do sistema.
     * Protegido globalmente via middleware e verificado via Policy.
     */
    #[OA\Get(
        path: '/admin/audits',
        tags: ['Admin'],
        summary: 'Listar auditoria',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Lista paginada de registos de auditoria'
            ),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', Audit::class);

        // 2. Procura paginada com Eager Loading da relação com o utilizador
        $perPage = config('services.custom.pagination.admin_per_page', 15);

        $audits = Audit::with('user')
            ->latest()
            ->paginate($perPage);

        // 3. Retorno padronizado usando API Resource
        return response()->json([
            'audits' => AuditResource::collection($audits)->response()->getData(true),
        ]);
    }
}
