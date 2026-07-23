<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AuthController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AuthController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-ed9222bb0dc8a488d0ce4233c75004d723b60f1fd6f322d6fe7301d284c4e4a6',
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
    'startLine' => 14,
    'endLine' => 361,
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
            'startLine' => 49,
            'endLine' => 49,
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
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 68,
                  'startFilePos' => 362,
                  'endTokenPos' => 68,
                  'endFilePos' => 372,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 74,
                  'startFilePos' => 389,
                  'endTokenPos' => 76,
                  'endFilePos' => 396,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Registar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 19,
                  'endLine' => 19,
                  'startTokenPos' => 82,
                  'startFilePos' => 416,
                  'endTokenPos' => 82,
                  'endFilePos' => 436,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'name\', \'email\', \'password\', \'password_confirmation\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'name\', type: \'string\', example: \'João Silva\'), new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'password_confirmation\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'profile_id\', type: \'integer\', nullable: true, example: 1)]))',
                'attributes' => 
                array (
                  'startLine' => 20,
                  'endLine' => 33,
                  'startTokenPos' => 88,
                  'startFilePos' => 460,
                  'endTokenPos' => 278,
                  'endFilePos' => 1303,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Utilizador criado\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 34,
                  'endLine' => 47,
                  'startTokenPos' => 284,
                  'startFilePos' => 1325,
                  'endTokenPos' => 386,
                  'endFilePos' => 1865,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 16,
        'endLine' => 94,
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
            'startLine' => 126,
            'endLine' => 126,
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
                  'startLine' => 97,
                  'endLine' => 97,
                  'startTokenPos' => 834,
                  'startFilePos' => 3705,
                  'endTokenPos' => 834,
                  'endFilePos' => 3712,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Auth\']',
                'attributes' => 
                array (
                  'startLine' => 98,
                  'endLine' => 98,
                  'startTokenPos' => 840,
                  'startFilePos' => 3729,
                  'endTokenPos' => 842,
                  'endFilePos' => 3736,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Autenticar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 99,
                  'endLine' => 99,
                  'startTokenPos' => 848,
                  'startFilePos' => 3756,
                  'endTokenPos' => 848,
                  'endFilePos' => 3778,
                ),
              ),
              'requestBody' => 
              array (
                'code' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'email\', \'password\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\')]))',
                'attributes' => 
                array (
                  'startLine' => 100,
                  'endLine' => 110,
                  'startTokenPos' => 854,
                  'startFilePos' => 3802,
                  'endTokenPos' => 957,
                  'endFilePos' => 4279,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Autenticado com sucesso\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 401, description: \'Credenciais inválidas\')]',
                'attributes' => 
                array (
                  'startLine' => 111,
                  'endLine' => 124,
                  'startTokenPos' => 963,
                  'startFilePos' => 4301,
                  'endTokenPos' => 1065,
                  'endFilePos' => 4850,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 96,
        'endLine' => 182,
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
            'startLine' => 184,
            'endLine' => 184,
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
        'startLine' => 184,
        'endLine' => 195,
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
            'startLine' => 197,
            'endLine' => 197,
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
        'startLine' => 197,
        'endLine' => 230,
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
            'startLine' => 232,
            'endLine' => 232,
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
        'startLine' => 232,
        'endLine' => 274,
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
            'startLine' => 280,
            'endLine' => 280,
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
        'startLine' => 280,
        'endLine' => 311,
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
            'startLine' => 317,
            'endLine' => 317,
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
        'startLine' => 317,
        'endLine' => 360,
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