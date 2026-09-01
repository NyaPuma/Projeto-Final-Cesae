# Migrations — Testes

## Descrição da Pasta
Testes de integridade da base de dados: validação de schema, migrations, constraints de integridade referencial, foreign keys, triggers e seeders.

### Módulos e Ficheiros de Teste

- **`DatabaseSchemaValidationTest`** (`tests/Database/Migrations/DatabaseSchemaValidationTest.php`): Valida os cenários e fluxos correspondentes a DatabaseSchemaValidationTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Database/Migrations
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Database/Migrations --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Database/Migrations --coverage
```