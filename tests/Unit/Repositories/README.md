# Repositories — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`RepositoriesTest`** (`tests/Unit/Repositories/RepositoriesTest.php`): Valida os cenários e fluxos correspondentes a RepositoriesTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Repositories
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Repositories --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Repositories --coverage
```