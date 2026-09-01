# Views — Testes

## Descrição da Pasta
Testes funcionais e de integração de ponta a ponta (Feature/API/Web) cobrindo ciclo de vida de requisições HTTP, autenticação, autorização, validação de formulários e respostas JSON/Blade.

### Módulos e Ficheiros de Teste

- **`AssetPipelineTest`** (`tests/Feature/Web/Views/AssetPipelineTest.php`): Valida os cenários e fluxos correspondentes a AssetPipelineTest.
- **`DesignSystemComponentsTest`** (`tests/Feature/Web/Views/DesignSystemComponentsTest.php`): Valida os cenários e fluxos correspondentes a DesignSystemComponentsTest.
- **`DesignSystemViewsTest`** (`tests/Feature/Web/Views/DesignSystemViewsTest.php`): Valida os cenários e fluxos correspondentes a DesignSystemViewsTest.
- **`UiUsabilityTest`** (`tests/Feature/Web/Views/UiUsabilityTest.php`): Valida os cenários e fluxos correspondentes a UiUsabilityTest.


## Comandos de Execução

Para executar isoladamente todos os testes desta pasta:

```bash
php artisan test tests/Feature/Web/Views
```

Para filtrar por um teste ou método específico:

```bash
php artisan test tests/Feature/Web/Views --filter=NomeDoTeste
```

Para executar com cobertura de código (se suportado pelo ambiente):

```bash
php artisan test tests/Feature/Web/Views --coverage
```