# Authentication — Testes

## Descrição da Pasta
Testes do ciclo de vida de autenticação, login, logout, recuperação de palavra-passe e validação de tokens de utilizador.

### Módulos e Ficheiros de Teste

- **`AuthEdgeCasesTest`** (`tests/Authentication/AuthEdgeCasesTest.php`): Valida os cenários e fluxos correspondentes a AuthEdgeCasesTest.
- **`AuthenticationTest`** (`tests/Authentication/AuthenticationTest.php`): Valida os cenários e fluxos correspondentes a AuthenticationTest.
- **`AuthFlowTest`** (`tests/Authentication/AuthFlowTest.php`): Valida os cenários e fluxos correspondentes a AuthFlowTest.
- **`LoginFlowTest`** (`tests/Authentication/LoginFlowTest.php`): Valida os cenários e fluxos correspondentes a LoginFlowTest.
- **`PasswordResetFlowTest`** (`tests/Authentication/PasswordResetFlowTest.php`): Valida os cenários e fluxos correspondentes a PasswordResetFlowTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Authentication
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Authentication --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Authentication --coverage
```