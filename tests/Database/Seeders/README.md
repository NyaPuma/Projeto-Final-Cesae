# Seeders — Testes

## Descrição da Pasta
Testes de integridade da base de dados: validação de schema, migrations, constraints de integridade referencial, foreign keys, triggers e seeders.

### Módulos e Ficheiros de Teste

- **`ComplianceSeedersTest`** (`tests/Database/Seeders/ComplianceSeedersTest.php`): Valida os cenários e fluxos correspondentes a ComplianceSeedersTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Database/Seeders
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Database/Seeders --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Database/Seeders --coverage
```