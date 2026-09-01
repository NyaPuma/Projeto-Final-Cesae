# ValueObjects — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`BudgetPauseMinutesTest`** (`tests/Unit/ValueObjects/BudgetPauseMinutesTest.php`): Valida os cenários e fluxos correspondentes a BudgetPauseMinutesTest.
- **`EmailTest`** (`tests/Unit/ValueObjects/EmailTest.php`): Valida os cenários e fluxos correspondentes a EmailTest.
- **`MoneyTest`** (`tests/Unit/ValueObjects/MoneyTest.php`): Valida os cenários e fluxos correspondentes a MoneyTest.
- **`SerialNumberTest`** (`tests/Unit/ValueObjects/SerialNumberTest.php`): Valida os cenários e fluxos correspondentes a SerialNumberTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/ValueObjects
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/ValueObjects --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/ValueObjects --coverage
```