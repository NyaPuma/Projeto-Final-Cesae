# Exports — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`TicketsExportTest`** (`tests/Unit/Exports/TicketsExportTest.php`): Valida os cenários e fluxos correspondentes a TicketsExportTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Exports
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Exports --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Exports --coverage
```