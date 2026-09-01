# SearchPerformance — Testes

## Descrição da Pasta
Testes de carga, performance, latência de endpoints, volumetria de queries, mitigação de consultas N+1 e eficiência de memória e cache.

### Módulos e Ficheiros de Teste

- **`SearchPerformanceTest`** (`tests/Performance/SearchPerformance/SearchPerformanceTest.php`): Valida os cenários e fluxos correspondentes a SearchPerformanceTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Performance/SearchPerformance
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Performance/SearchPerformance --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Performance/SearchPerformance --coverage
```