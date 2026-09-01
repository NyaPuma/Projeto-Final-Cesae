# Broadcasting — Testes

## Descrição da Pasta
Testes de integração entre subsistemas: broadcasting em tempo real, filas assíncronas (queues), base de dados e envio de e-mails via Mailables.

### Módulos e Ficheiros de Teste

- **`BroadcastAndQueueTest`** (`tests/Integration/Broadcasting/BroadcastAndQueueTest.php`): Valida os cenários e fluxos correspondentes a BroadcastAndQueueTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Integration/Broadcasting
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Integration/Broadcasting --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Integration/Broadcasting --coverage
```