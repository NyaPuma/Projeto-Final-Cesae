<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\RoomController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\RoomController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-d19b9f1eacbaf93b5dd98e58b4442ca6ccf3b51bcf3dfde7bf7f28aa1ee08bc7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\RoomController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/RoomController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\RoomController',
    'shortName' => 'RoomController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 167,
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
      'indexRoom' => 
      array (
        'name' => 'indexRoom',
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
            'startColumn' => 31,
            'endColumn' => 46,
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
                'code' => '\'/admin/rooms\'',
                'attributes' => 
                array (
                  'startLine' => 16,
                  'endLine' => 16,
                  'startTokenPos' => 50,
                  'startFilePos' => 290,
                  'endTokenPos' => 50,
                  'endFilePos' => 303,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 56,
                  'startFilePos' => 320,
                  'endTokenPos' => 58,
                  'endFilePos' => 328,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar salas\'',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 64,
                  'startFilePos' => 348,
                  'endTokenPos' => 64,
                  'endFilePos' => 361,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 19,
                  'endLine' => 19,
                  'startTokenPos' => 70,
                  'startFilePos' => 382,
                  'endTokenPos' => 89,
                  'endFilePos' => 427,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de salas\')]',
                'attributes' => 
                array (
                  'startLine' => 20,
                  'endLine' => 20,
                  'startTokenPos' => 95,
                  'startFilePos' => 449,
                  'endTokenPos' => 111,
                  'endFilePos' => 511,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista todas as salas registadas.
 */',
        'startLine' => 15,
        'endLine' => 26,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'createRoom' => 
      array (
        'name' => 'createRoom',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Show the form for creating a new resource.
 */',
        'startLine' => 31,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'storeRoom' => 
      array (
        'name' => 'storeRoom',
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
            'startColumn' => 31,
            'endColumn' => 46,
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
                'code' => '\'/admin/rooms\'',
                'attributes' => 
                array (
                  'startLine' => 41,
                  'endLine' => 41,
                  'startTokenPos' => 194,
                  'startFilePos' => 992,
                  'endTokenPos' => 194,
                  'endFilePos' => 1005,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 42,
                  'endLine' => 42,
                  'startTokenPos' => 200,
                  'startFilePos' => 1022,
                  'endTokenPos' => 202,
                  'endFilePos' => 1030,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar sala\'',
                'attributes' => 
                array (
                  'startLine' => 43,
                  'endLine' => 43,
                  'startTokenPos' => 208,
                  'startFilePos' => 1050,
                  'endTokenPos' => 208,
                  'endFilePos' => 1061,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 44,
                  'endLine' => 44,
                  'startTokenPos' => 214,
                  'startFilePos' => 1082,
                  'endTokenPos' => 233,
                  'endFilePos' => 1127,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Sala criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 45,
                  'endLine' => 48,
                  'startTokenPos' => 239,
                  'startFilePos' => 1149,
                  'endTokenPos' => 274,
                  'endFilePos' => 1310,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Cria uma nova sala de trabalho.
 */',
        'startLine' => 40,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'showRoom' => 
      array (
        'name' => 'showRoom',
        'parameters' => 
        array (
          'room' => 
          array (
            'name' => 'room',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Room',
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
            'startColumn' => 30,
            'endColumn' => 39,
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
 * Display the specified resource.
 */',
        'startLine' => 75,
        'endLine' => 79,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'editRoom' => 
      array (
        'name' => 'editRoom',
        'parameters' => 
        array (
          'room' => 
          array (
            'name' => 'room',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Room',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 84,
            'endLine' => 84,
            'startColumn' => 30,
            'endColumn' => 39,
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
 * Show the form for editing the specified resource.
 */',
        'startLine' => 84,
        'endLine' => 88,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'updateRoom' => 
      array (
        'name' => 'updateRoom',
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
            'startLine' => 107,
            'endLine' => 107,
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
            'startLine' => 107,
            'endLine' => 107,
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
                'code' => '\'/admin/rooms/{id}\'',
                'attributes' => 
                array (
                  'startLine' => 94,
                  'endLine' => 94,
                  'startTokenPos' => 540,
                  'startFilePos' => 2509,
                  'endTokenPos' => 540,
                  'endFilePos' => 2527,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 95,
                  'endLine' => 95,
                  'startTokenPos' => 546,
                  'startFilePos' => 2544,
                  'endTokenPos' => 548,
                  'endFilePos' => 2552,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar sala\'',
                'attributes' => 
                array (
                  'startLine' => 96,
                  'endLine' => 96,
                  'startTokenPos' => 554,
                  'startFilePos' => 2572,
                  'endTokenPos' => 554,
                  'endFilePos' => 2587,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 97,
                  'endLine' => 97,
                  'startTokenPos' => 560,
                  'startFilePos' => 2608,
                  'endTokenPos' => 579,
                  'endFilePos' => 2653,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 98,
                  'endLine' => 100,
                  'startTokenPos' => 585,
                  'startFilePos' => 2676,
                  'endTokenPos' => 623,
                  'endFilePos' => 2795,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 101,
                  'endLine' => 105,
                  'startTokenPos' => 629,
                  'startFilePos' => 2817,
                  'endTokenPos' => 681,
                  'endFilePos' => 3063,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os detalhes de uma sala.
 */',
        'startLine' => 93,
        'endLine' => 128,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
        'aliasName' => NULL,
      ),
      'inactivateRoom' => 
      array (
        'name' => 'inactivateRoom',
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
            'startLine' => 146,
            'endLine' => 146,
            'startColumn' => 36,
            'endColumn' => 51,
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
            'startLine' => 146,
            'endLine' => 146,
            'startColumn' => 54,
            'endColumn' => 60,
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
                'code' => '\'/admin/rooms/{id}/inactive\'',
                'attributes' => 
                array (
                  'startLine' => 134,
                  'endLine' => 134,
                  'startTokenPos' => 894,
                  'startFilePos' => 3954,
                  'endTokenPos' => 894,
                  'endFilePos' => 3981,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 135,
                  'endLine' => 135,
                  'startTokenPos' => 900,
                  'startFilePos' => 3998,
                  'endTokenPos' => 902,
                  'endFilePos' => 4006,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar sala\'',
                'attributes' => 
                array (
                  'startLine' => 136,
                  'endLine' => 136,
                  'startTokenPos' => 908,
                  'startFilePos' => 4026,
                  'endTokenPos' => 908,
                  'endFilePos' => 4040,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 137,
                  'endLine' => 137,
                  'startTokenPos' => 914,
                  'startFilePos' => 4061,
                  'endTokenPos' => 933,
                  'endFilePos' => 4106,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 138,
                  'endLine' => 140,
                  'startTokenPos' => 939,
                  'startFilePos' => 4129,
                  'endTokenPos' => 977,
                  'endFilePos' => 4248,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala inativada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 141,
                  'endLine' => 144,
                  'startTokenPos' => 983,
                  'startFilePos' => 4270,
                  'endTokenPos' => 1018,
                  'endFilePos' => 4435,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa uma sala (Gestão lógica / Soft management).
 */',
        'startLine' => 133,
        'endLine' => 158,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\RoomController',
        'implementingClassName' => 'App\\Http\\Controllers\\RoomController',
        'currentClassName' => 'App\\Http\\Controllers\\RoomController',
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