<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Jobs\ExportCsvJob;
use App\Jobs\ExportPdfJob;
use App\Models\User;
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnalyticsService $analyticsService,
    ) {}

    public function stats(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        return response()->json($this->analyticsService->getDashboardPayload());
    }

    public function exportCsv(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        ExportCsvJob::dispatch($user->id);

        return response()->json(['message' => 'Exportação CSV em processamento. Receberá uma notificação quando estiver pronta.']);
    }

    public function exportPdf(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        ExportPdfJob::dispatch($user->id);

        return response()->json(['message' => 'Exportação PDF em processamento. Receberá uma notificação quando estiver pronta.']);
    }

    public function exportExcel(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $filename = 'tickets_report_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new TicketsExport, $filename);
    }
}
