{{--
|--------------------------------------------------------------------------
| Page Actions Export Group
|--------------------------------------------------------------------------
|
| Export actions group for data export (CSV, PDF, Excel).
| • 100% free of inline CSS or JS.
| • Clean indentation free of invisible characters.
|
--}}

<x-ui.page-actions.group>
    <x-ui.page-actions.export-link
        id="btnExportCsv"
        href="/analytics/export/csv"
        data-async-export="csv"
        data-processing-label="A gerar CSV..."
        :label="__('common.Exportar CSV')"
    />
    <x-ui.page-actions.export-link
        id="btnExportPdf"
        href="/analytics/export/pdf"
        data-async-export="pdf"
        data-processing-label="A gerar PDF..."
        :label="__('common.Exportar PDF')"
    />
    <x-ui.page-actions.export-link
        id="btnExportExcel"
        href="/analytics/export/excel"
        data-async-export="excel"
        data-processing-label="A gerar Excel..."
        :label="__('common.Exportar Excel')"
        variant="accent"
    />
</x-ui.page-actions.group>
