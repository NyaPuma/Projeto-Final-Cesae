# Http — Testes

## Descrição da Pasta
Testes unitários isolados para validação atómica de componentes, classes de domínio, Actions, DTOs, Enums, Models, Services e Jobs sem dependências externas.

### Módulos e Ficheiros de Teste

- **`ResourcesTest`** (`tests/Unit/Http/Resources/ResourcesTest.php`): Valida os cenários e fluxos correspondentes a ResourcesTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Unit/Http
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Unit/Http --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Unit/Http --coverage
```