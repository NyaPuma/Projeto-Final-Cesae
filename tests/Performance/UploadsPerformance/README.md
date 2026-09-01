# UploadsPerformance — Testes

## Descrição da Pasta
Testes de carga, performance, latência de endpoints, volumetria de queries, mitigação de consultas N+1 e eficiência de memória e cache.

### Módulos e Ficheiros de Teste

- **`UploadPerformanceTest`** (`tests/Performance/UploadsPerformance/UploadPerformanceTest.php`): Valida os cenários e fluxos correspondentes a UploadPerformanceTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Performance/UploadsPerformance
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Performance/UploadsPerformance --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Performance/UploadsPerformance --coverage
```