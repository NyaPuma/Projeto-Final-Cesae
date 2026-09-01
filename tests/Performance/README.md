# Performance — Testes

## Descrição da Pasta
Testes de carga, performance, latência de endpoints, volumetria de queries, mitigação de consultas N+1 e eficiência de memória e cache.

### Módulos e Ficheiros de Teste

- **`TicketEndpointPerformanceTest`** (`tests/Performance/APIPerformance/TicketEndpointPerformanceTest.php`): Valida os cenários e fluxos correspondentes a TicketEndpointPerformanceTest.
- **`AuthPerformanceTest`** (`tests/Performance/Authentication/AuthPerformanceTest.php`): Valida os cenários e fluxos correspondentes a AuthPerformanceTest.
- **`CachePerformanceTest`** (`tests/Performance/CachePerformance/CachePerformanceTest.php`): Valida os cenários e fluxos correspondentes a CachePerformanceTest.
- **`DashboardPerformanceTest`** (`tests/Performance/Dashboard/DashboardPerformanceTest.php`): Valida os cenários e fluxos correspondentes a DashboardPerformanceTest.
- **`DatabasePerformanceTest`** (`tests/Performance/DatabasePerformance/DatabasePerformanceTest.php`): Valida os cenários e fluxos correspondentes a DatabasePerformanceTest.
- **`LazyLoadingTest`** (`tests/Performance/DatabasePerformance/LazyLoadingTest.php`): Valida os cenários e fluxos correspondentes a LazyLoadingTest.
- **`NPlusOneQueryTest`** (`tests/Performance/DatabasePerformance/NPlusOneQueryTest.php`): Valida os cenários e fluxos correspondentes a NPlusOneQueryTest.
- **`PerformanceAndNPlusOneTest`** (`tests/Performance/DatabasePerformance/PerformanceAndNPlusOneTest.php`): Valida os cenários e fluxos correspondentes a PerformanceAndNPlusOneTest.
- **`QueryCountTest`** (`tests/Performance/DatabasePerformance/QueryCountTest.php`): Valida os cenários e fluxos correspondentes a QueryCountTest.
- **`MemoryPerformanceTest`** (`tests/Performance/MemoryPerformance/MemoryPerformanceTest.php`): Valida os cenários e fluxos correspondentes a MemoryPerformanceTest.
- **`MemoryUsageTest`** (`tests/Performance/MemoryPerformance/MemoryUsageTest.php`): Valida os cenários e fluxos correspondentes a MemoryUsageTest.
- **`ReportPerformanceTest`** (`tests/Performance/ReportsPerformance/ReportPerformanceTest.php`): Valida os cenários e fluxos correspondentes a ReportPerformanceTest.
- **`ScalabilityPerformanceTest`** (`tests/Performance/ScalabilityPerformance/ScalabilityPerformanceTest.php`): Valida os cenários e fluxos correspondentes a ScalabilityPerformanceTest.
- **`SearchPerformanceTest`** (`tests/Performance/SearchPerformance/SearchPerformanceTest.php`): Valida os cenários e fluxos correspondentes a SearchPerformanceTest.
- **`UploadPerformanceTest`** (`tests/Performance/UploadsPerformance/UploadPerformanceTest.php`): Valida os cenários e fluxos correspondentes a UploadPerformanceTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Performance
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Performance --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Performance --coverage
```