# Security — Testes

## Descrição da Pasta
Testes dedicados à garantia de segurança da informação (OWASP Top 10), incluindo proteção contra XSS, SQL Injection, CSRF, IDOR, Privilege Escalation, Rate Limiting e força bruta.

### Módulos e Ficheiros de Teste

- **`APITokenSecurityTest`** (`tests/Security/APITokens/APITokenSecurityTest.php`): Valida os cenários e fluxos correspondentes a APITokenSecurityTest.
- **`AuthenticationSecurityTest`** (`tests/Security/Authentication/AuthenticationSecurityTest.php`): Valida os cenários e fluxos correspondentes a AuthenticationSecurityTest.
- **`SecurityActiveTest`** (`tests/Security/Authentication/SecurityActiveTest.php`): Valida os cenários e fluxos correspondentes a SecurityActiveTest.
- **`SecurityAuthTest`** (`tests/Security/Authentication/SecurityAuthTest.php`): Valida os cenários e fluxos correspondentes a SecurityAuthTest.
- **`AuthorizationSecurityTest`** (`tests/Security/Authorization/AuthorizationSecurityTest.php`): Valida os cenários e fluxos correspondentes a AuthorizationSecurityTest.
- **`CsrfProtectionTest`** (`tests/Security/CSRF/CsrfProtectionTest.php`): Valida os cenários e fluxos correspondentes a CsrfProtectionTest.
- **`SecurityCsrfTest`** (`tests/Security/CSRF/SecurityCsrfTest.php`): Valida os cenários e fluxos correspondentes a SecurityCsrfTest.
- **`FileUploadSecurityTest`** (`tests/Security/FileUpload/FileUploadSecurityTest.php`): Valida os cenários e fluxos correspondentes a FileUploadSecurityTest.
- **`SecurityHeadersTest`** (`tests/Security/Headers/SecurityHeadersTest.php`): Valida os cenários e fluxos correspondentes a SecurityHeadersTest.
- **`IDORTest`** (`tests/Security/IDOR/IDORTest.php`): Valida os cenários e fluxos correspondentes a IDORTest.
- **`MassAssignmentTest`** (`tests/Security/MassAssignment/MassAssignmentTest.php`): Valida os cenários e fluxos correspondentes a MassAssignmentTest.
- **`PasswordSecurityTest`** (`tests/Security/Password/PasswordSecurityTest.php`): Valida os cenários e fluxos correspondentes a PasswordSecurityTest.
- **`SecurityPasswordPolicyTest`** (`tests/Security/Password/SecurityPasswordPolicyTest.php`): Valida os cenários e fluxos correspondentes a SecurityPasswordPolicyTest.
- **`PathTraversalTest`** (`tests/Security/PathTraversal/PathTraversalTest.php`): Valida os cenários e fluxos correspondentes a PathTraversalTest.
- **`PrivilegeEscalationTest`** (`tests/Security/PrivilegeEscalation/PrivilegeEscalationTest.php`): Valida os cenários e fluxos correspondentes a PrivilegeEscalationTest.
- **`RateLimitingTest`** (`tests/Security/RateLimiting/RateLimitingTest.php`): Valida os cenários e fluxos correspondentes a RateLimitingTest.
- **`SecurityBruteForceTest`** (`tests/Security/RateLimiting/SecurityBruteForceTest.php`): Valida os cenários e fluxos correspondentes a SecurityBruteForceTest.
- **`SecurityRateLimitTest`** (`tests/Security/RateLimiting/SecurityRateLimitTest.php`): Valida os cenários e fluxos correspondentes a SecurityRateLimitTest.
- **`SecuritySessionTest`** (`tests/Security/Session/SecuritySessionTest.php`): Valida os cenários e fluxos correspondentes a SecuritySessionTest.
- **`SessionSecurityTest`** (`tests/Security/Session/SessionSecurityTest.php`): Valida os cenários e fluxos correspondentes a SessionSecurityTest.
- **`SecurityVulnerabilitiesTest`** (`tests/Security/SQLInjection/SecurityVulnerabilitiesTest.php`): Valida os cenários e fluxos correspondentes a SecurityVulnerabilitiesTest.
- **`SqlInjectionTest`** (`tests/Security/SQLInjection/SqlInjectionTest.php`): Valida os cenários e fluxos correspondentes a SqlInjectionTest.
- **`SecurityTokenTest`** (`tests/Security/Tokens/SecurityTokenTest.php`): Valida os cenários e fluxos correspondentes a SecurityTokenTest.
- **`TokenSecurityTest`** (`tests/Security/Tokens/TokenSecurityTest.php`): Valida os cenários e fluxos correspondentes a TokenSecurityTest.
- **`UserEnumerationTest`** (`tests/Security/UserEnumeration/UserEnumerationTest.php`): Valida os cenários e fluxos correspondentes a UserEnumerationTest.
- **`SecurityInputValidationTest`** (`tests/Security/XSS/SecurityInputValidationTest.php`): Valida os cenários e fluxos correspondentes a SecurityInputValidationTest.
- **`XSSProtectionTest`** (`tests/Security/XSS/XSSProtectionTest.php`): Valida os cenários e fluxos correspondentes a XSSProtectionTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Security
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Security --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Security --coverage
```