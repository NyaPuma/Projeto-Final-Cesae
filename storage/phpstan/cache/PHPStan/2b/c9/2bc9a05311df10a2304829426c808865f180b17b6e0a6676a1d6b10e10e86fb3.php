<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\NotificationController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\NotificationController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-83f1199c663599bc0bc2ba1c328e75b929319f7cc6d413d35455c8226279d136',
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
    'endLine' => 93,
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
                  'endTokenPos' => 122,
                  'endFilePos' => 598,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 14,
        'endLine' => 40,
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
            'startLine' => 55,
            'endLine' => 55,
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
            'startLine' => 55,
            'endLine' => 55,
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
                  'startLine' => 43,
                  'endLine' => 43,
                  'startTokenPos' => 282,
                  'startFilePos' => 1277,
                  'endTokenPos' => 282,
                  'endFilePos' => 1297,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 44,
                  'endLine' => 44,
                  'startTokenPos' => 288,
                  'startFilePos' => 1314,
                  'endTokenPos' => 290,
                  'endFilePos' => 1330,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Marcar notificação como lida\'',
                'attributes' => 
                array (
                  'startLine' => 45,
                  'endLine' => 45,
                  'startTokenPos' => 296,
                  'startFilePos' => 1350,
                  'endTokenPos' => 296,
                  'endFilePos' => 1381,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 46,
                  'endLine' => 46,
                  'startTokenPos' => 302,
                  'startFilePos' => 1402,
                  'endTokenPos' => 321,
                  'endFilePos' => 1447,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 47,
                  'endLine' => 49,
                  'startTokenPos' => 327,
                  'startFilePos' => 1470,
                  'endTokenPos' => 366,
                  'endFilePos' => 1590,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Notificação atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Notificação não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 50,
                  'endLine' => 53,
                  'startTokenPos' => 372,
                  'startFilePos' => 1612,
                  'endTokenPos' => 408,
                  'endFilePos' => 1797,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 42,
        'endLine' => 69,
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
            'startLine' => 80,
            'endLine' => 80,
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
                  'startLine' => 72,
                  'endLine' => 72,
                  'startTokenPos' => 543,
                  'startFilePos' => 2398,
                  'endTokenPos' => 543,
                  'endFilePos' => 2424,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Notifications\']',
                'attributes' => 
                array (
                  'startLine' => 73,
                  'endLine' => 73,
                  'startTokenPos' => 549,
                  'startFilePos' => 2441,
                  'endTokenPos' => 551,
                  'endFilePos' => 2457,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Enviar email de teste via Mailgun\'',
                'attributes' => 
                array (
                  'startLine' => 74,
                  'endLine' => 74,
                  'startTokenPos' => 557,
                  'startFilePos' => 2477,
                  'endTokenPos' => 557,
                  'endFilePos' => 2511,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 75,
                  'endLine' => 75,
                  'startTokenPos' => 563,
                  'startFilePos' => 2532,
                  'endTokenPos' => 582,
                  'endFilePos' => 2577,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Email de teste enviado\')]',
                'attributes' => 
                array (
                  'startLine' => 76,
                  'endLine' => 78,
                  'startTokenPos' => 588,
                  'startFilePos' => 2599,
                  'endTokenPos' => 607,
                  'endFilePos' => 2692,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 71,
        'endLine' => 92,
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