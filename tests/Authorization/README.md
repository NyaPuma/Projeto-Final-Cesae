# Authorization — Testes

## Descrição da Pasta
Testes de políticas de controlo de acesso baseado em papéis (RBAC - Admin, Técnico, Utilizador) em interfaces e APIs.

### Módulos e Ficheiros de Teste

- **`UiAuthorizationTest`** (`tests/Authorization/UiAuthorizationTest.php`): Valida os cenários e fluxos correspondentes a UiAuthorizationTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Authorization
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Authorization --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Authorization --coverage
```