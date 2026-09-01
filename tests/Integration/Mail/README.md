# Mail — Testes

## Descrição da Pasta
Testes de integração entre subsistemas: broadcasting em tempo real, filas assíncronas (queues), base de dados e envio de e-mails via Mailables.

### Módulos e Ficheiros de Teste

- **`MailgunTestEmailTest`** (`tests/Integration/Mail/MailgunTestEmailTest.php`): Valida os cenários e fluxos correspondentes a MailgunTestEmailTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Integration/Mail
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Integration/Mail --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Integration/Mail --coverage
```