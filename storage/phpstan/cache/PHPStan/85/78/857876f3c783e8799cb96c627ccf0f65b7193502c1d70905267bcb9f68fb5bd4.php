<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AuthController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AuthController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-0ae243816ea2c9700ebc10b050f836c71b327d96fbeec0bd12a382c711de2f3a',
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
    'startLine' => 15,
    'endLine' => 379,
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
      'PASSWORD_COMPLEXITY_RULES' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\AuthController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuthController',
        'name' => 'PASSWORD_COMPLEXITY_RULES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'string\', \'min:8\', \'regex:/[A-Z]/\', \'regex:/[a-z]/\', \'regex:/[0-9]/\', \'regex:/[^A-Za-z0-9]/\']',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 19,
            'startTokenPos' => 74,
            'startFilePos' => 417,
            'endTokenPos' => 94,
            'endFilePos' => 525,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
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
            'startLine' => 54,
            'endLine' => 54,
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
                  'startLine' => 22,
                  'endLine' => 22,
                  'startTokenPos' => 104,
                  'startFilePos' => 558,
                  'endTokenPos' => 104,
                  'endFilePos' => 568,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 23,
                  'endLine' => 23,
                  'startTokenPos' => 110,
                  'startFilePos' => 585,
                  'endTokenPos' => 112,
                  'endFilePos' => 592,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Registar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 118,
                  'startFilePos' => 612,
                  'endTokenPos' => 118,
                  'endFilePos' => 632,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'name\', \'email\', \'password\', \'password_confirmation\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'name\', type: \'string\', example: \'João Silva\'), new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'password_confirmation\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'profile_id\', type: \'integer\', nullable: true, example: 1)]))',
                'attributes' => 
                array (
                  'startLine' => 25,
                  'endLine' => 38,
                  'startTokenPos' => 124,
                  'startFilePos' => 656,
                  'endTokenPos' => 314,
                  'endFilePos' => 1499,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Utilizador criado\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 39,
                  'endLine' => 52,
                  'startTokenPos' => 320,
                  'startFilePos' => 1521,
                  'endTokenPos' => 422,
                  'endFilePos' => 2061,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 21,
        'endLine' => 97,
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
            'startLine' => 129,
            'endLine' => 129,
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
                  'startLine' => 100,
                  'endLine' => 100,
                  'startTokenPos' => 883,
                  'startFilePos' => 3988,
                  'endTokenPos' => 883,
                  'endFilePos' => 3995,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 101,
                  'endLine' => 101,
                  'startTokenPos' => 889,
                  'startFilePos' => 4012,
                  'endTokenPos' => 891,
                  'endFilePos' => 4019,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Autenticar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 102,
                  'endLine' => 102,
                  'startTokenPos' => 897,
                  'startFilePos' => 4039,
                  'endTokenPos' => 897,
                  'endFilePos' => 4061,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'email\', \'password\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\')]))',
                'attributes' => 
                array (
                  'startLine' => 103,
                  'endLine' => 113,
                  'startTokenPos' => 903,
                  'startFilePos' => 4085,
                  'endTokenPos' => 1006,
                  'endFilePos' => 4562,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Autenticado com sucesso\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 401, description: \'Credenciais inválidas\')]',
                'attributes' => 
                array (
                  'startLine' => 114,
                  'endLine' => 127,
                  'startTokenPos' => 1012,
                  'startFilePos' => 4584,
                  'endTokenPos' => 1114,
                  'endFilePos' => 5133,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 99,
        'endLine' => 199,
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
            'startLine' => 201,
            'endLine' => 201,
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
        'startLine' => 201,
        'endLine' => 213,
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
            'startLine' => 215,
            'endLine' => 215,
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
        'startLine' => 215,
        'endLine' => 248,
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
            'startLine' => 250,
            'endLine' => 250,
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
        'startLine' => 250,
        'endLine' => 292,
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
      'sendResetLink' => 
      array (
        'name' => 'sendResetLink',
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
            'startLine' => 298,
            'endLine' => 298,
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
        'docComment' => '/**
 * Envia email com link de reset de password.
 * Rota: POST /api/password/email
 */',
        'startLine' => 298,
        'endLine' => 329,
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
      'resetPassword' => 
      array (
        'name' => 'resetPassword',
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
            'startLine' => 335,
            'endLine' => 335,
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
        'docComment' => '/**
 * Repõe a password do utilizador usando o token de reset.
 * Rota: POST /api/password/reset
 */',
        'startLine' => 335,
        'endLine' => 378,
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