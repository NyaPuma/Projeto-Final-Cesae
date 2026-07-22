<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AuthController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AuthController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-f03ff9babaa120f948659b69b49876d9e3efc7878518d75e1dfe76c7bcb0d1e3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\AuthController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/AuthController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\AuthController',
    'shortName' => 'AuthController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 13,
    'endLine' => 242,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'register' => 
      array (
        'name' => 'register',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 30,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'OpenApi\\Attributes\\Post',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/register\'',
                'attributes' => 
                array (
                  'startLine' => 16,
                  'endLine' => 16,
                  'startTokenPos' => 63,
                  'startFilePos' => 327,
                  'endTokenPos' => 63,
                  'endFilePos' => 337,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 69,
                  'startFilePos' => 354,
                  'endTokenPos' => 71,
                  'endFilePos' => 361,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Registar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 77,
                  'startFilePos' => 381,
                  'endTokenPos' => 77,
                  'endFilePos' => 401,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'name\', \'email\', \'password\', \'password_confirmation\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'name\', type: \'string\', example: \'João Silva\'), new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'password_confirmation\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'profile_id\', type: \'integer\', nullable: true, example: 1)]))',
                'attributes' => 
                array (
                  'startLine' => 19,
                  'endLine' => 32,
                  'startTokenPos' => 83,
                  'startFilePos' => 425,
                  'endTokenPos' => 273,
                  'endFilePos' => 1268,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Utilizador criado\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 33,
                  'endLine' => 46,
                  'startTokenPos' => 279,
                  'startFilePos' => 1290,
                  'endTokenPos' => 380,
                  'endFilePos' => 1829,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 15,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'currentClassName' => 'App\\Http\\Controllers\\AuthController',
        'aliasName' => NULL,
      ),
      'login' => 
      array (
        'name' => 'login',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 122,
            'endLine' => 122,
            'startColumn' => 27,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'OpenApi\\Attributes\\Post',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/login\'',
                'attributes' => 
                array (
                  'startLine' => 93,
                  'endLine' => 93,
                  'startTokenPos' => 806,
                  'startFilePos' => 3577,
                  'endTokenPos' => 806,
                  'endFilePos' => 3584,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 94,
                  'endLine' => 94,
                  'startTokenPos' => 812,
                  'startFilePos' => 3601,
                  'endTokenPos' => 814,
                  'endFilePos' => 3608,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Autenticar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 95,
                  'endLine' => 95,
                  'startTokenPos' => 820,
                  'startFilePos' => 3628,
                  'endTokenPos' => 820,
                  'endFilePos' => 3650,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'email\', \'password\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\')]))',
                'attributes' => 
                array (
                  'startLine' => 96,
                  'endLine' => 106,
                  'startTokenPos' => 826,
                  'startFilePos' => 3674,
                  'endTokenPos' => 929,
                  'endFilePos' => 4151,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Autenticado com sucesso\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 401, description: \'Credenciais inválidas\')]',
                'attributes' => 
                array (
                  'startLine' => 107,
                  'endLine' => 120,
                  'startTokenPos' => 935,
                  'startFilePos' => 4173,
                  'endTokenPos' => 1036,
                  'endFilePos' => 4721,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 92,
        'endLine' => 161,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'currentClassName' => 'App\\Http\\Controllers\\AuthController',
        'aliasName' => NULL,
      ),
      'logout' => 
      array (
        'name' => 'logout',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 163,
            'endLine' => 163,
            'startColumn' => 28,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 163,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'currentClassName' => 'App\\Http\\Controllers\\AuthController',
        'aliasName' => NULL,
      ),
      'changePassword' => 
      array (
        'name' => 'changePassword',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 176,
            'endLine' => 176,
            'startColumn' => 36,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 176,
        'endLine' => 203,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'currentClassName' => 'App\\Http\\Controllers\\AuthController',
        'aliasName' => NULL,
      ),
      'updateProfile' => 
      array (
        'name' => 'updateProfile',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 205,
            'endLine' => 205,
            'startColumn' => 35,
            'endColumn' => 50,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 205,
        'endLine' => 241,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'currentClassName' => 'App\\Http\\Controllers\\AuthController',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));