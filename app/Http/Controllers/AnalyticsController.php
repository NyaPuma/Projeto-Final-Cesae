<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Models\Ticket;
use App\Models\User;
use App\Services\AnalyticsService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function charts(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        return response()->json($this->analyticsService->getDashboardPayload());
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $callback = fn () => $this->analyticsService->exportCsv();

        return new StreamedResponse($callback, 200, [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tickets_report.csv"',
        ]);
    }

    public function exportPdf(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $tickets = Ticket::select([
            'id', 'title', 'status_id', 'opened_at', 'in_progress_at',
            'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount',
        ])->get();

        $pdf = PDF::loadView('reports.tickets', ['tickets' => $tickets]);

        return $pdf->download('tickets_report.pdf');
    }

    public function exportExcel(Request $request)
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $filename = 'tickets_report_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new TicketsExport, $filename);
    }
}
