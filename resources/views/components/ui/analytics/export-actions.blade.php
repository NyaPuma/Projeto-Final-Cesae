{{--
|--------------------------------------------------------------------------
| Page Actions Export Group
|--------------------------------------------------------------------------
|
| Grupo de ações para exportação de dados (CSV, PDF, Excel).
| • 100% livre de CSS ou JS inline.
| • Indentação limpa e livre de carateres invisíveis.
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
