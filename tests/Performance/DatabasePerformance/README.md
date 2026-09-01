# DatabasePerformance — Testes

## Descrição da Pasta
Testes de carga, performance, latência de endpoints, volumetria de queries, mitigação de consultas N+1 e eficiência de memória e cache.

### Módulos e Ficheiros de Teste

- **`DatabasePerformanceTest`** (`tests/Performance/DatabasePerformance/DatabasePerformanceTest.php`): Valida os cenários e fluxos correspondentes a DatabasePerformanceTest.
- **`LazyLoadingTest`** (`tests/Performance/DatabasePerformance/LazyLoadingTest.php`): Valida os cenários e fluxos correspondentes a LazyLoadingTest.
- **`NPlusOneQueryTest`** (`tests/Performance/DatabasePerformance/NPlusOneQueryTest.php`): Valida os cenários e fluxos correspondentes a NPlusOneQueryTest.
- **`PerformanceAndNPlusOneTest`** (`tests/Performance/DatabasePerformance/PerformanceAndNPlusOneTest.php`): Valida os cenários e fluxos correspondentes a PerformanceAndNPlusOneTest.
- **`QueryCountTest`** (`tests/Performance/DatabasePerformance/QueryCountTest.php`): Valida os cenários e fluxos correspondentes a QueryCountTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Performance/DatabasePerformance
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Performance/DatabasePerformance --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Performance/DatabasePerformance --coverage
```