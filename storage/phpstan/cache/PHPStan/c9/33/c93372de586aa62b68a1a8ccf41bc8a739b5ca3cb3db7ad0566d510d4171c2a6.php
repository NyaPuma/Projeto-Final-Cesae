<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\RoomController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\RoomController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-bad90e0a6f72a25aaf047fbfd2e093b87ca59d7d3bdcb5ca9ebce802bd9f8486',
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
    'endLine' => 159,
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
                  'startFilePos' => 289,
                  'endTokenPos' => 50,
                  'endFilePos' => 302,
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
                  'startFilePos' => 319,
                  'endTokenPos' => 58,
                  'endFilePos' => 327,
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
                  'startFilePos' => 347,
                  'endTokenPos' => 64,
                  'endFilePos' => 360,
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
                  'startFilePos' => 381,
                  'endTokenPos' => 89,
                  'endFilePos' => 426,
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
                  'startFilePos' => 448,
                  'endTokenPos' => 111,
                  'endFilePos' => 510,
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
                  'startFilePos' => 991,
                  'endTokenPos' => 194,
                  'endFilePos' => 1004,
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
                  'startFilePos' => 1021,
                  'endTokenPos' => 202,
                  'endFilePos' => 1029,
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
                  'startFilePos' => 1049,
                  'endTokenPos' => 208,
                  'endFilePos' => 1060,
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
                  'startFilePos' => 1081,
                  'endTokenPos' => 233,
                  'endFilePos' => 1126,
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
                  'startFilePos' => 1148,
                  'endTokenPos' => 275,
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
                  'startTokenPos' => 541,
                  'startFilePos' => 2510,
                  'endTokenPos' => 541,
                  'endFilePos' => 2528,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 95,
                  'endLine' => 95,
                  'startTokenPos' => 547,
                  'startFilePos' => 2545,
                  'endTokenPos' => 549,
                  'endFilePos' => 2553,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar sala\'',
                'attributes' => 
                array (
                  'startLine' => 96,
                  'endLine' => 96,
                  'startTokenPos' => 555,
                  'startFilePos' => 2573,
                  'endTokenPos' => 555,
                  'endFilePos' => 2588,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 97,
                  'endLine' => 97,
                  'startTokenPos' => 561,
                  'startFilePos' => 2609,
                  'endTokenPos' => 580,
                  'endFilePos' => 2654,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 98,
                  'endLine' => 100,
                  'startTokenPos' => 586,
                  'startFilePos' => 2677,
                  'endTokenPos' => 625,
                  'endFilePos' => 2797,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 101,
                  'endLine' => 105,
                  'startTokenPos' => 631,
                  'startFilePos' => 2819,
                  'endTokenPos' => 684,
                  'endFilePos' => 3066,
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
                  'startTokenPos' => 898,
                  'startFilePos' => 3959,
                  'endTokenPos' => 898,
                  'endFilePos' => 3986,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 135,
                  'endLine' => 135,
                  'startTokenPos' => 904,
                  'startFilePos' => 4003,
                  'endTokenPos' => 906,
                  'endFilePos' => 4011,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar sala\'',
                'attributes' => 
                array (
                  'startLine' => 136,
                  'endLine' => 136,
                  'startTokenPos' => 912,
                  'startFilePos' => 4031,
                  'endTokenPos' => 912,
                  'endFilePos' => 4045,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 137,
                  'endLine' => 137,
                  'startTokenPos' => 918,
                  'startFilePos' => 4066,
                  'endTokenPos' => 937,
                  'endFilePos' => 4111,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 138,
                  'endLine' => 140,
                  'startTokenPos' => 943,
                  'startFilePos' => 4134,
                  'endTokenPos' => 982,
                  'endFilePos' => 4254,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala inativada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\')]',
                'attributes' => 
                array (
                  'startLine' => 141,
                  'endLine' => 144,
                  'startTokenPos' => 988,
                  'startFilePos' => 4276,
                  'endTokenPos' => 1024,
                  'endFilePos' => 4442,
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