# Providers — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`ProvidersTest`** (`tests/Unit/Providers/ProvidersTest.php`): Valida os cenários e fluxos correspondentes a ProvidersTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Providers
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Providers --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Providers --coverage
```