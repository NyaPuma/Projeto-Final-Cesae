# OpenAPI Documentation

The API contract is generated from the OpenAPI attributes in `app/OpenApi` and the HTTP controllers.

Generate both JSON and YAML documents with:

```bash
composer docs:generate
```

The generated files are written to `storage/api-docs/api-docs.json` and `storage/api-docs/api-docs.yaml`. They are build artifacts and are intentionally not committed. The interactive documentation is available at `/docs/openapi` for authorized administrators.

The generator scans the application source and uses OpenAPI 3.0 by default. Keep endpoint summaries, descriptions, schemas, and security requirements in English when adding or changing API attributes.
