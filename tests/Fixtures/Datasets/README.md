# Datasets — Testes

## Descrição da Pasta
Fixtures, Data Builders, Fakes e Helpers utilitários para suporte à execução dos testes automatizados.

### Conteúdo da Pasta

- Utilitários, configurações base e recursos de suporte para a suite de testes.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Fixtures/Datasets
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Fixtures/Datasets --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Fixtures/Datasets --coverage
```