<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\ExportStockCostsPdfJob;
use App\Models\Part;
use App\Services\LocalizationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class StockReportController extends Controller
{
    public function __construct(
        private readonly LocalizationService $localization,
    ) {}

    /**
     * Exports the low-stock parts list as CSV.
     */
    #[OA\Get(
        path: '/stock/reports/low-stock.csv',
        tags: ['Stock'],
        summary: 'Exportar CSV de stock baixo',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro CSV de peças com stock baixo'),
        ]
    )]
    public function lowStockCsv(): StreamedResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                __('exports.csv_sku'),
                __('exports.csv_name'),
                __('exports.csv_brand'),
                __('exports.csv_category'),
                __('exports.csv_stock_current'),
                __('exports.csv_stock_min'),
                __('exports.csv_location'),
            ], ';');

            Part::query()
                ->select(['id', 'sku', 'name', 'brand', 'category_id', 'current_stock', 'min_stock', 'location'])
                ->with('category')
                ->lowStock()
                ->orderBy('name')
                ->lazy()
                ->each(function (Part $part) use ($handle): void {
                    fputcsv($handle, [
                        $part->sku,
                        $part->name,
                        $part->brand,
                        $part->category?->name,
                        $part->current_stock,
                        $part->min_stock,
                        $part->location,
                    ], ';');
                });

            fclose($handle);
        }, __('exports.csv_low_stock'), ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Exports the complete inventory as CSV.
     */
    #[OA\Get(
        path: '/stock/reports/inventory.csv',
        tags: ['Stock'],
        summary: 'Exportar CSV do inventário',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Ficheiro CSV do inventário completo'),
        ]
    )]
    public function inventoryCsv(): StreamedResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                __('exports.csv_sku'),
                __('exports.csv_name'),
                __('exports.csv_brand'),
                __('exports.csv_category'),
                __('exports.csv_stock_current'),
                __('exports.csv_price_cost'),
                __('exports.csv_tax'),
                __('exports.csv_price_with_tax'),
                __('exports.csv_stock_value'),
                __('exports.csv_location'),
            ], ';');

            Part::query()
                ->select(['id', 'sku', 'name', 'brand', 'category_id', 'current_stock', 'cost_price', 'tax_rate_id', 'location'])
                ->with(['category', 'taxRate'])
                ->orderBy('name')
                ->lazy()
                ->each(function (Part $part) use ($handle): void {
                    fputcsv($handle, [
                        $part->sku,
                        $part->name,
                        $part->brand,
                        $part->category?->name,
                        $part->current_stock,
                        $this->localization->formatDecimal((float) $part->cost_price),
                        $part->taxRate?->percent . '%',
                        $this->localization->formatDecimal((float) $part->priceWithVat()),
                        $this->localization->formatDecimal((float) $part->stockValue()),
                        $part->location,
                    ], ';');
                });

            fclose($handle);
        }, __('exports.csv_inventory'), ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Dispatches asynchronous generation of the cost-by-equipment report (PDF).
     */
    #[OA\Get(
        path: '/stock/reports/costs-by-equipment.pdf',
        tags: ['Stock'],
        summary: 'Exportar PDF de custos por equipamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Processamento do PDF iniciado (notificação quando pronto)'),
        ]
    )]
    public function costsByEquipmentPdf(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        $user = $request->user();

        ExportStockCostsPdfJob::dispatch(
            userId: $user->id,
            from: $request->query('from'),
            to: $request->query('to'),
        );

        return response()->json([
            'message' => __('common.Exportação PDF em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }
}
