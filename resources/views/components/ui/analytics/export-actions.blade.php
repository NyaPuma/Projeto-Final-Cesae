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
        :label="__('Exportar CSV')"
    />
    <x-ui.page-actions.export-link
        id="btnExportPdf"
        href="/analytics/export/pdf"
        :label="__('Exportar PDF')"
    />
    <x-ui.page-actions.export-link
        id="btnExportExcel"
        href="/analytics/export/excel"
        :label="__('Exportar Excel')"
        variant="accent"
    />
</x-ui.page-actions.group>
