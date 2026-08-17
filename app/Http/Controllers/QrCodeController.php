<?php

namespace App\Http\Controllers;

use App\Jobs\ExportEquipmentQrPdfJob;
use App\Models\Equipment;
use App\Services\QrCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

final class QrCodeController extends Controller
{
    public function __construct(
        private readonly QrCodeService $qrCodeService,
    ) {}

    /**
     * Página com o QR Code de um equipamento (pronto para imprimir).
     */
    public function show(Equipment $equipment): View
    {
        return view('ui.equipments.qr', [
            'equipment' => $equipment,
            'qrDataUri' => $this->qrCodeService->pngDataUri($equipment),
            'ticketUrl' => $this->qrCodeService->urlFor($equipment),
        ]);
    }

    /**
     * Download do QR Code de um equipamento em PNG.
     */
    public function download(Equipment $equipment): Response
    {
        $filename = 'qr-' . ($equipment->asset_tag ?? $equipment->id) . '.png';

        return response($this->qrCodeService->png($equipment), 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Dispara a geração assíncrona dos QR Codes de todos os equipamentos ativos (PDF).
     */
    public function exportPdf(Request $request): JsonResponse
    {
        $user = $request->user();

        ExportEquipmentQrPdfJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação PDF em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }
}
