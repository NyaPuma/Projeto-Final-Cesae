<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\NotificationController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\NotificationController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-1acbc873bcfd6d29d8926d7d5a624edb17cb3e7f51197046ef25ce81238af45c',
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
    'startLine' => 12,
    'endLine' => 88,
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
            'startLine' => 23,
            'endLine' => 23,
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
                  'startLine' => 15,
                  'endLine' => 15,
                  'startTokenPos' => 58,
                  'startFilePos' => 303,
                  'endTokenPos' => 58,
                  'endFilePos' => 318,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 16,
                  'endLine' => 16,
                  'startTokenPos' => 64,
                  'startFilePos' => 335,
                  'endTokenPos' => 66,
                  'endFilePos' => 351,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar notificações do utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 72,
                  'startFilePos' => 371,
                  'endTokenPos' => 72,
                  'endFilePos' => 407,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 78,
                  'startFilePos' => 428,
                  'endTokenPos' => 97,
                  'endFilePos' => 473,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista paginada de notificações\')]',
                'attributes' => 
                array (
                  'startLine' => 19,
                  'endLine' => 21,
                  'startTokenPos' => 103,
                  'startFilePos' => 495,
                  'endTokenPos' => 121,
                  'endFilePos' => 597,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 14,
        'endLine' => 35,
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
            'startLine' => 50,
            'endLine' => 50,
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
            'startLine' => 50,
            'endLine' => 50,
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
                  'startLine' => 38,
                  'endLine' => 38,
                  'startTokenPos' => 216,
                  'startFilePos' => 1151,
                  'endTokenPos' => 216,
                  'endFilePos' => 1171,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 39,
                  'endLine' => 39,
                  'startTokenPos' => 222,
                  'startFilePos' => 1188,
                  'endTokenPos' => 224,
                  'endFilePos' => 1204,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Marcar notificação como lida\'',
                'attributes' => 
                array (
                  'startLine' => 40,
                  'endLine' => 40,
                  'startTokenPos' => 230,
                  'startFilePos' => 1224,
                  'endTokenPos' => 230,
                  'endFilePos' => 1255,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 41,
                  'endLine' => 41,
                  'startTokenPos' => 236,
                  'startFilePos' => 1276,
                  'endTokenPos' => 255,
                  'endFilePos' => 1321,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 42,
                  'endLine' => 44,
                  'startTokenPos' => 261,
                  'startFilePos' => 1344,
                  'endTokenPos' => 299,
                  'endFilePos' => 1463,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Notificação atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Notificação não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 45,
                  'endLine' => 48,
                  'startTokenPos' => 305,
                  'startFilePos' => 1485,
                  'endTokenPos' => 340,
                  'endFilePos' => 1669,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 37,
        'endLine' => 64,
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
            'startLine' => 75,
            'endLine' => 75,
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
                  'startLine' => 67,
                  'endLine' => 67,
                  'startTokenPos' => 474,
                  'startFilePos' => 2269,
                  'endTokenPos' => 474,
                  'endFilePos' => 2295,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 68,
                  'endLine' => 68,
                  'startTokenPos' => 480,
                  'startFilePos' => 2312,
                  'endTokenPos' => 482,
                  'endFilePos' => 2328,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Enviar email de teste via Mailgun\'',
                'attributes' => 
                array (
                  'startLine' => 69,
                  'endLine' => 69,
                  'startTokenPos' => 488,
                  'startFilePos' => 2348,
                  'endTokenPos' => 488,
                  'endFilePos' => 2382,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 70,
                  'endLine' => 70,
                  'startTokenPos' => 494,
                  'startFilePos' => 2403,
                  'endTokenPos' => 513,
                  'endFilePos' => 2448,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Email de teste enviado\')]',
                'attributes' => 
                array (
                  'startLine' => 71,
                  'endLine' => 73,
                  'startTokenPos' => 519,
                  'startFilePos' => 2470,
                  'endTokenPos' => 537,
                  'endFilePos' => 2562,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 66,
        'endLine' => 87,
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