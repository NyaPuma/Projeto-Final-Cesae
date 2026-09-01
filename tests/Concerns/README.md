# Concerns — Testes

## Descrição da Pasta
Traits reutilizáveis para criação de entidades de teste (Users, Tickets, Equipments) e mocks de serviços auxiliares.

### Conteúdo da Pasta

- Utilitários, configurações base e recursos de suporte para a suite de testes.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Concerns
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Concerns --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Concerns --coverage
```