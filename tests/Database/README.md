# Database — Testes

## Descrição da Pasta
Testes de integridade da base de dados: validação de schema, migrations, constraints de integridade referencial, foreign keys, triggers e seeders.

### Módulos e Ficheiros de Teste

- **`AttachmentPersistenceTest`** (`tests/Database/Constraints/AttachmentPersistenceTest.php`): Valida os cenários e fluxos correspondentes a AttachmentPersistenceTest.
- **`AuditTrailTest`** (`tests/Database/Constraints/AuditTrailTest.php`): Valida os cenários e fluxos correspondentes a AuditTrailTest.
- **`BudgetCalculationTest`** (`tests/Database/Constraints/BudgetCalculationTest.php`): Valida os cenários e fluxos correspondentes a BudgetCalculationTest.
- **`CastIntegrityTest`** (`tests/Database/Constraints/CastIntegrityTest.php`): Valida os cenários e fluxos correspondentes a CastIntegrityTest.
- **`ConcurrencyTest`** (`tests/Database/Constraints/ConcurrencyTest.php`): Valida os cenários e fluxos correspondentes a ConcurrencyTest.
- **`DatabaseIntegrityTest`** (`tests/Database/Constraints/DatabaseIntegrityTest.php`): Valida os cenários e fluxos correspondentes a DatabaseIntegrityTest.
- **`DatabaseOptimizationTest`** (`tests/Database/Constraints/DatabaseOptimizationTest.php`): Valida os cenários e fluxos correspondentes a DatabaseOptimizationTest.
- **`ModelLifecycleTest`** (`tests/Database/Constraints/ModelLifecycleTest.php`): Valida os cenários e fluxos correspondentes a ModelLifecycleTest.
- **`NotificationPersistenceTest`** (`tests/Database/Constraints/NotificationPersistenceTest.php`): Valida os cenários e fluxos correspondentes a NotificationPersistenceTest.
- **`RelationshipIntegrityTest`** (`tests/Database/Constraints/RelationshipIntegrityTest.php`): Valida os cenários e fluxos correspondentes a RelationshipIntegrityTest.
- **`TokenIntegrityTest`** (`tests/Database/Constraints/TokenIntegrityTest.php`): Valida os cenários e fluxos correspondentes a TokenIntegrityTest.
- **`WorkflowPersistenceTest`** (`tests/Database/Constraints/WorkflowPersistenceTest.php`): Valida os cenários e fluxos correspondentes a WorkflowPersistenceTest.
- **`DatabaseSchemaValidationTest`** (`tests/Database/Migrations/DatabaseSchemaValidationTest.php`): Valida os cenários e fluxos correspondentes a DatabaseSchemaValidationTest.
- **`ComplianceSeedersTest`** (`tests/Database/Seeders/ComplianceSeedersTest.php`): Valida os cenários e fluxos correspondentes a ComplianceSeedersTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Database
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Database --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Database --coverage
```