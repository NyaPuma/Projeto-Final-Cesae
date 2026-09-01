# Base — Testes

## Descrição da Pasta
Classes base de teste (`UnitTestCase`, `DatabaseTestCase`, `FeatureTestCase`) configurando ambiente limpo e seeds necessárias.

### Conteúdo da Pasta

- Utilitários, configurações base e recursos de suporte para a suite de testes.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Base
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Base --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Base --coverage
```