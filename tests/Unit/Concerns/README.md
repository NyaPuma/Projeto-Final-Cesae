# Concerns — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`BroadcastsTicketStatusTest`** (`tests/Unit/Concerns/BroadcastsTicketStatusTest.php`): Valida os cenários e fluxos correspondentes a BroadcastsTicketStatusTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Concerns
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Concerns --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Concerns --coverage
```