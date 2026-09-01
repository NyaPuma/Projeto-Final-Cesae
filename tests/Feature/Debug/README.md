# Debug — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Conteúdo da Pasta

- Utilitários, configurações base e recursos de suporte para a suite de testes.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Debug
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Debug --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Debug --coverage
```