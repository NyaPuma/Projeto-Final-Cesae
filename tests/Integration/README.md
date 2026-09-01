# Integration — Testes

## Descrição da Pasta
Testes de integração entre subsistemas: broadcasting em tempo real, filas assíncronas (queues), base de dados e envio de e-mails via Mailables.

### Módulos e Ficheiros de Teste

- **`BroadcastAndQueueTest`** (`tests/Integration/Broadcasting/BroadcastAndQueueTest.php`): Valida os cenários e fluxos correspondentes a BroadcastAndQueueTest.
- **`ForeignKeyIntegrityTest`** (`tests/Integration/Database/ForeignKeyIntegrityTest.php`): Valida os cenários e fluxos correspondentes a ForeignKeyIntegrityTest.
- **`MassAssignmentProtectionTest`** (`tests/Integration/Database/MassAssignmentProtectionTest.php`): Valida os cenários e fluxos correspondentes a MassAssignmentProtectionTest.
- **`ModelLifecycleTest`** (`tests/Integration/Database/ModelLifecycleTest.php`): Valida os cenários e fluxos correspondentes a ModelLifecycleTest.
- **`RelationshipIntegrityTest`** (`tests/Integration/Database/RelationshipIntegrityTest.php`): Valida os cenários e fluxos correspondentes a RelationshipIntegrityTest.
- **`SoftDeleteTest`** (`tests/Integration/Database/SoftDeleteTest.php`): Valida os cenários e fluxos correspondentes a SoftDeleteTest.
- **`MailgunTestEmailTest`** (`tests/Integration/Mail/MailgunTestEmailTest.php`): Valida os cenários e fluxos correspondentes a MailgunTestEmailTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Integration
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Integration --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Integration --coverage
```