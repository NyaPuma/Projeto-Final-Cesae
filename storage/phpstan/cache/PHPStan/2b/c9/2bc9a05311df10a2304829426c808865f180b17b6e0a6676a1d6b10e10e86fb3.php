<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\NotificationController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\NotificationController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-f8a3e71f32de4f913525b17f0e2e71d98faa170facb2c087f0082846a2159b54',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\NotificationController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/NotificationController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\NotificationController',
    'shortName' => 'NotificationController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 90,
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
      'index' => 
      array (
        'name' => 'index',
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
            'startLine' => 22,
            'endLine' => 22,
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
            'name' => 'OpenApi\\Attributes\\Get',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/notifications\'',
                'attributes' => 
                array (
                  'startLine' => 14,
                  'endLine' => 14,
                  'startTokenPos' => 53,
                  'startFilePos' => 274,
                  'endTokenPos' => 53,
                  'endFilePos' => 289,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 15,
                  'endLine' => 15,
                  'startTokenPos' => 59,
                  'startFilePos' => 306,
                  'endTokenPos' => 61,
                  'endFilePos' => 322,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar notificações do utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 16,
                  'endLine' => 16,
                  'startTokenPos' => 67,
                  'startFilePos' => 342,
                  'endTokenPos' => 67,
                  'endFilePos' => 378,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 73,
                  'startFilePos' => 399,
                  'endTokenPos' => 92,
                  'endFilePos' => 444,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista paginada de notificações\')]',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 20,
                  'startTokenPos' => 98,
                  'startFilePos' => 466,
                  'endTokenPos' => 117,
                  'endFilePos' => 569,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 13,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\NotificationController',
        'implementingClassName' => 'App\\Http\\Controllers\\NotificationController',
        'currentClassName' => 'App\\Http\\Controllers\\NotificationController',
        'aliasName' => NULL,
      ),
      'markAsRead' => 
      array (
        'name' => 'markAsRead',
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
            'startColumn' => 32,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'id' => 
          array (
            'name' => 'id',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
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
            'startColumn' => 50,
            'endColumn' => 56,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'OpenApi\\Attributes\\Patch',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/notifications/{id}\'',
                'attributes' => 
                array (
                  'startLine' => 42,
                  'endLine' => 42,
                  'startTokenPos' => 277,
                  'startFilePos' => 1248,
                  'endTokenPos' => 277,
                  'endFilePos' => 1268,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 43,
                  'endLine' => 43,
                  'startTokenPos' => 283,
                  'startFilePos' => 1285,
                  'endTokenPos' => 285,
                  'endFilePos' => 1301,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Marcar notificação como lida\'',
                'attributes' => 
                array (
                  'startLine' => 44,
                  'endLine' => 44,
                  'startTokenPos' => 291,
                  'startFilePos' => 1321,
                  'endTokenPos' => 291,
                  'endFilePos' => 1352,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 45,
                  'endLine' => 45,
                  'startTokenPos' => 297,
                  'startFilePos' => 1373,
                  'endTokenPos' => 316,
                  'endFilePos' => 1418,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 46,
                  'endLine' => 48,
                  'startTokenPos' => 322,
                  'startFilePos' => 1441,
                  'endTokenPos' => 361,
                  'endFilePos' => 1561,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Notificação atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Notificação não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 49,
                  'endLine' => 52,
                  'startTokenPos' => 367,
                  'startFilePos' => 1583,
                  'endTokenPos' => 403,
                  'endFilePos' => 1768,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 41,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\NotificationController',
        'implementingClassName' => 'App\\Http\\Controllers\\NotificationController',
        'currentClassName' => 'App\\Http\\Controllers\\NotificationController',
        'aliasName' => NULL,
      ),
      'sendTestEmail' => 
      array (
        'name' => 'sendTestEmail',
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
            'startLine' => 79,
            'endLine' => 79,
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
          0 => 
          array (
            'name' => 'OpenApi\\Attributes\\Post',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/notifications/test-email\'',
                'attributes' => 
                array (
                  'startLine' => 71,
                  'endLine' => 71,
                  'startTokenPos' => 538,
                  'startFilePos' => 2369,
                  'endTokenPos' => 538,
                  'endFilePos' => 2395,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 72,
                  'endLine' => 72,
                  'startTokenPos' => 544,
                  'startFilePos' => 2412,
                  'endTokenPos' => 546,
                  'endFilePos' => 2428,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Enviar email de teste via Mailgun\'',
                'attributes' => 
                array (
                  'startLine' => 73,
                  'endLine' => 73,
                  'startTokenPos' => 552,
                  'startFilePos' => 2448,
                  'endTokenPos' => 552,
                  'endFilePos' => 2482,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 74,
                  'endLine' => 74,
                  'startTokenPos' => 558,
                  'startFilePos' => 2503,
                  'endTokenPos' => 577,
                  'endFilePos' => 2548,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Email de teste enviado\')]',
                'attributes' => 
                array (
                  'startLine' => 75,
                  'endLine' => 77,
                  'startTokenPos' => 583,
                  'startFilePos' => 2570,
                  'endTokenPos' => 602,
                  'endFilePos' => 2663,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 70,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\NotificationController',
        'implementingClassName' => 'App\\Http\\Controllers\\NotificationController',
        'currentClassName' => 'App\\Http\\Controllers\\NotificationController',
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