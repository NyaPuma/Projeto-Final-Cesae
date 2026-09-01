# MemoryPerformance — Testes

## Descrição da Pasta
Testes de carga, performance, latência de endpoints, volumetria de queries, mitigação de consultas N+1 e eficiência de memória e cache.

### Módulos e Ficheiros de Teste

- **`MemoryPerformanceTest`** (`tests/Performance/MemoryPerformance/MemoryPerformanceTest.php`): Valida os cenários e fluxos correspondentes a MemoryPerformanceTest.
- **`MemoryUsageTest`** (`tests/Performance/MemoryPerformance/MemoryUsageTest.php`): Valida os cenários e fluxos correspondentes a MemoryUsageTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Performance/MemoryPerformance
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Performance/MemoryPerformance --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Performance/MemoryPerformance --coverage
```