# Jobs — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`ExportJobsTest`** (`tests/Unit/Jobs/ExportJobsTest.php`): Valida os cenários e fluxos correspondentes a ExportJobsTest.
- **`ExportReportPdfJobsTest`** (`tests/Unit/Jobs/ExportReportPdfJobsTest.php`): Valida os cenários e fluxos correspondentes a ExportReportPdfJobsTest.
- **`GenerateAiRecommendationJobTest`** (`tests/Unit/Jobs/GenerateAiRecommendationJobTest.php`): Valida os cenários e fluxos correspondentes a GenerateAiRecommendationJobTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Jobs
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Jobs --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Jobs --coverage
```