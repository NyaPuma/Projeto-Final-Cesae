<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\RoomController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\RoomController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-d1f09af3e5a5703b15460196e7c3b02e565fda072b5a3db461274729e0e49012',
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
    'startLine' => 12,
    'endLine' => 172,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'App\\Traits\\ControllerHelpers',
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
            'startLine' => 26,
            'endLine' => 26,
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
                  'startLine' => 20,
                  'endLine' => 20,
                  'startTokenPos' => 65,
                  'startFilePos' => 372,
                  'endTokenPos' => 65,
                  'endFilePos' => 385,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 21,
                  'endLine' => 21,
                  'startTokenPos' => 71,
                  'startFilePos' => 402,
                  'endTokenPos' => 73,
                  'endFilePos' => 410,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar salas\'',
                'attributes' => 
                array (
                  'startLine' => 22,
                  'endLine' => 22,
                  'startTokenPos' => 79,
                  'startFilePos' => 430,
                  'endTokenPos' => 79,
                  'endFilePos' => 443,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 23,
                  'endLine' => 23,
                  'startTokenPos' => 85,
                  'startFilePos' => 464,
                  'endTokenPos' => 104,
                  'endFilePos' => 509,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de salas\')]',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 110,
                  'startFilePos' => 531,
                  'endTokenPos' => 126,
                  'endFilePos' => 593,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista todas as salas registadas.
 */',
        'startLine' => 19,
        'endLine' => 30,
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
        'startLine' => 35,
        'endLine' => 39,
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
            'startLine' => 54,
            'endLine' => 54,
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
                  'startLine' => 45,
                  'endLine' => 45,
                  'startTokenPos' => 209,
                  'startFilePos' => 1074,
                  'endTokenPos' => 209,
                  'endFilePos' => 1087,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 46,
                  'endLine' => 46,
                  'startTokenPos' => 215,
                  'startFilePos' => 1104,
                  'endTokenPos' => 217,
                  'endFilePos' => 1112,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar sala\'',
                'attributes' => 
                array (
                  'startLine' => 47,
                  'endLine' => 47,
                  'startTokenPos' => 223,
                  'startFilePos' => 1132,
                  'endTokenPos' => 223,
                  'endFilePos' => 1143,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 48,
                  'endLine' => 48,
                  'startTokenPos' => 229,
                  'startFilePos' => 1164,
                  'endTokenPos' => 248,
                  'endFilePos' => 1209,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Sala criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 49,
                  'endLine' => 52,
                  'startTokenPos' => 254,
                  'startFilePos' => 1231,
                  'endTokenPos' => 290,
                  'endFilePos' => 1393,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Cria uma nova sala de trabalho.
 */',
        'startLine' => 44,
        'endLine' => 77,
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
            'startLine' => 82,
            'endLine' => 82,
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
        'startLine' => 82,
        'endLine' => 86,
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
            'startLine' => 91,
            'endLine' => 91,
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
        'startLine' => 91,
        'endLine' => 95,
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
            'startLine' => 114,
            'endLine' => 114,
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
            'startLine' => 114,
            'endLine' => 114,
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
                  'startLine' => 101,
                  'endLine' => 101,
                  'startTokenPos' => 583,
                  'startFilePos' => 2703,
                  'endTokenPos' => 583,
                  'endFilePos' => 2721,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 102,
                  'endLine' => 102,
                  'startTokenPos' => 589,
                  'startFilePos' => 2738,
                  'endTokenPos' => 591,
                  'endFilePos' => 2746,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar sala\'',
                'attributes' => 
                array (
                  'startLine' => 103,
                  'endLine' => 103,
                  'startTokenPos' => 597,
                  'startFilePos' => 2766,
                  'endTokenPos' => 597,
                  'endFilePos' => 2781,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 104,
                  'endLine' => 104,
                  'startTokenPos' => 603,
                  'startFilePos' => 2802,
                  'endTokenPos' => 622,
                  'endFilePos' => 2847,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 105,
                  'endLine' => 107,
                  'startTokenPos' => 628,
                  'startFilePos' => 2870,
                  'endTokenPos' => 667,
                  'endFilePos' => 2990,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 108,
                  'endLine' => 112,
                  'startTokenPos' => 673,
                  'startFilePos' => 3012,
                  'endTokenPos' => 726,
                  'endFilePos' => 3259,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os detalhes de uma sala.
 */',
        'startLine' => 100,
        'endLine' => 138,
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
            'startLine' => 156,
            'endLine' => 156,
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
            'startLine' => 156,
            'endLine' => 156,
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
                  'startLine' => 144,
                  'endLine' => 144,
                  'startTokenPos' => 967,
                  'startFilePos' => 4262,
                  'endTokenPos' => 967,
                  'endFilePos' => 4289,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 145,
                  'endLine' => 145,
                  'startTokenPos' => 973,
                  'startFilePos' => 4306,
                  'endTokenPos' => 975,
                  'endFilePos' => 4314,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar sala\'',
                'attributes' => 
                array (
                  'startLine' => 146,
                  'endLine' => 146,
                  'startTokenPos' => 981,
                  'startFilePos' => 4334,
                  'endTokenPos' => 981,
                  'endFilePos' => 4348,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 147,
                  'endLine' => 147,
                  'startTokenPos' => 987,
                  'startFilePos' => 4369,
                  'endTokenPos' => 1006,
                  'endFilePos' => 4414,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 148,
                  'endLine' => 150,
                  'startTokenPos' => 1012,
                  'startFilePos' => 4437,
                  'endTokenPos' => 1051,
                  'endFilePos' => 4557,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala inativada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 151,
                  'endLine' => 154,
                  'startTokenPos' => 1057,
                  'startFilePos' => 4579,
                  'endTokenPos' => 1093,
                  'endFilePos' => 4745,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa uma sala (Gestão lógica / Soft management).
 */',
        'startLine' => 143,
        'endLine' => 171,
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