<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AdminController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AdminController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-7506d48e481bc9b8b583ed19170be8eba0f6d037f4b9105a0f5dadfbeae3c379',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\AdminController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/AdminController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\AdminController',
    'shortName' => 'AdminController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 449,
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
      'users' => 
      array (
        'name' => 'users',
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
            'startLine' => 28,
            'endLine' => 28,
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
                'code' => '\'/admin/users\'',
                'attributes' => 
                array (
                  'startLine' => 22,
                  'endLine' => 22,
                  'startTokenPos' => 80,
                  'startFilePos' => 489,
                  'endTokenPos' => 80,
                  'endFilePos' => 502,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 23,
                  'endLine' => 23,
                  'startTokenPos' => 86,
                  'startFilePos' => 519,
                  'endTokenPos' => 88,
                  'endFilePos' => 527,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar utilizadores\'',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 94,
                  'startFilePos' => 547,
                  'endTokenPos' => 94,
                  'endFilePos' => 567,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 25,
                  'endLine' => 25,
                  'startTokenPos' => 100,
                  'startFilePos' => 588,
                  'endTokenPos' => 119,
                  'endFilePos' => 633,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de utilizadores\')]',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 125,
                  'startFilePos' => 655,
                  'endTokenPos' => 141,
                  'endFilePos' => 724,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Retorna todos os utilizadores (Apenas para Administradores).
 */',
        'startLine' => 21,
        'endLine' => 54,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'inactivateUser' => 
      array (
        'name' => 'inactivateUser',
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
            'startLine' => 73,
            'endLine' => 73,
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
            'startLine' => 73,
            'endLine' => 73,
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
                'code' => '\'/admin/users/{id}/inactive\'',
                'attributes' => 
                array (
                  'startLine' => 60,
                  'endLine' => 60,
                  'startTokenPos' => 401,
                  'startFilePos' => 1643,
                  'endTokenPos' => 401,
                  'endFilePos' => 1670,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 61,
                  'endLine' => 61,
                  'startTokenPos' => 407,
                  'startFilePos' => 1687,
                  'endTokenPos' => 409,
                  'endFilePos' => 1695,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 62,
                  'endLine' => 62,
                  'startTokenPos' => 415,
                  'startFilePos' => 1715,
                  'endTokenPos' => 415,
                  'endFilePos' => 1735,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 63,
                  'endLine' => 63,
                  'startTokenPos' => 421,
                  'startFilePos' => 1756,
                  'endTokenPos' => 440,
                  'endFilePos' => 1801,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 64,
                  'endLine' => 66,
                  'startTokenPos' => 446,
                  'startFilePos' => 1824,
                  'endTokenPos' => 485,
                  'endFilePos' => 1944,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Utilizador inativado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Utilizador não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Operação inválida\')]',
                'attributes' => 
                array (
                  'startLine' => 67,
                  'endLine' => 71,
                  'startTokenPos' => 491,
                  'startFilePos' => 1966,
                  'endTokenPos' => 544,
                  'endFilePos' => 2225,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa um utilizador do sistema.
 */',
        'startLine' => 59,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'storeUser' => 
      array (
        'name' => 'storeUser',
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
            'startLine' => 95,
            'endLine' => 95,
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
        ),
        'docComment' => '/**
 * Regista um novo utilizador no sistema.
 */',
        'startLine' => 95,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'updateUser' => 
      array (
        'name' => 'updateUser',
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
            'startLine' => 125,
            'endLine' => 125,
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
            'startLine' => 125,
            'endLine' => 125,
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
        ),
        'docComment' => '/**
 * Atualiza um utilizador existente.
 */',
        'startLine' => 125,
        'endLine' => 155,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'profiles' => 
      array (
        'name' => 'profiles',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retorna os perfis de utilizador disponíveis.
 */',
        'startLine' => 160,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'equipments' => 
      array (
        'name' => 'equipments',
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
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 32,
            'endColumn' => 47,
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
                'code' => '\'/admin/equipment\'',
                'attributes' => 
                array (
                  'startLine' => 169,
                  'endLine' => 169,
                  'startTokenPos' => 1336,
                  'startFilePos' => 5584,
                  'endTokenPos' => 1336,
                  'endFilePos' => 5601,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 170,
                  'endLine' => 170,
                  'startTokenPos' => 1342,
                  'startFilePos' => 5618,
                  'endTokenPos' => 1344,
                  'endFilePos' => 5626,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar equipamentos\'',
                'attributes' => 
                array (
                  'startLine' => 171,
                  'endLine' => 171,
                  'startTokenPos' => 1350,
                  'startFilePos' => 5646,
                  'endTokenPos' => 1350,
                  'endFilePos' => 5666,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 172,
                  'endLine' => 172,
                  'startTokenPos' => 1356,
                  'startFilePos' => 5687,
                  'endTokenPos' => 1375,
                  'endFilePos' => 5732,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de equipamentos\')]',
                'attributes' => 
                array (
                  'startLine' => 173,
                  'endLine' => 173,
                  'startTokenPos' => 1381,
                  'startFilePos' => 5754,
                  'endTokenPos' => 1397,
                  'endFilePos' => 5823,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista equipamentos com a respetiva sala associada.
 */',
        'startLine' => 168,
        'endLine' => 179,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'storeEquipment' => 
      array (
        'name' => 'storeEquipment',
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
            'startLine' => 194,
            'endLine' => 194,
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
          0 => 
          array (
            'name' => 'OpenApi\\Attributes\\Post',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/admin/equipment\'',
                'attributes' => 
                array (
                  'startLine' => 185,
                  'endLine' => 185,
                  'startTokenPos' => 1461,
                  'startFilePos' => 6180,
                  'endTokenPos' => 1461,
                  'endFilePos' => 6197,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 186,
                  'endLine' => 186,
                  'startTokenPos' => 1467,
                  'startFilePos' => 6214,
                  'endTokenPos' => 1469,
                  'endFilePos' => 6222,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 187,
                  'endLine' => 187,
                  'startTokenPos' => 1475,
                  'startFilePos' => 6242,
                  'endTokenPos' => 1475,
                  'endFilePos' => 6260,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 188,
                  'endLine' => 188,
                  'startTokenPos' => 1481,
                  'startFilePos' => 6281,
                  'endTokenPos' => 1500,
                  'endFilePos' => 6326,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Equipamento criado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 189,
                  'endLine' => 192,
                  'startTokenPos' => 1506,
                  'startFilePos' => 6348,
                  'endTokenPos' => 1542,
                  'endFilePos' => 6517,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Regista um novo equipamento no sistema.
 */',
        'startLine' => 184,
        'endLine' => 216,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'updateEquipment' => 
      array (
        'name' => 'updateEquipment',
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
            'startLine' => 235,
            'endLine' => 235,
            'startColumn' => 37,
            'endColumn' => 52,
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
            'startLine' => 235,
            'endLine' => 235,
            'startColumn' => 55,
            'endColumn' => 61,
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
                'code' => '\'/admin/equipment/{id}\'',
                'attributes' => 
                array (
                  'startLine' => 222,
                  'endLine' => 222,
                  'startTokenPos' => 1773,
                  'startFilePos' => 7520,
                  'endTokenPos' => 1773,
                  'endFilePos' => 7542,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 223,
                  'endLine' => 223,
                  'startTokenPos' => 1779,
                  'startFilePos' => 7559,
                  'endTokenPos' => 1781,
                  'endFilePos' => 7567,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 224,
                  'endLine' => 224,
                  'startTokenPos' => 1787,
                  'startFilePos' => 7587,
                  'endTokenPos' => 1787,
                  'endFilePos' => 7609,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 225,
                  'endLine' => 225,
                  'startTokenPos' => 1793,
                  'startFilePos' => 7630,
                  'endTokenPos' => 1812,
                  'endFilePos' => 7675,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 226,
                  'endLine' => 228,
                  'startTokenPos' => 1818,
                  'startFilePos' => 7698,
                  'endTokenPos' => 1857,
                  'endFilePos' => 7818,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento atualizado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 229,
                  'endLine' => 233,
                  'startTokenPos' => 1863,
                  'startFilePos' => 7840,
                  'endTokenPos' => 1916,
                  'endFilePos' => 8101,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os dados de um equipamento existente.
 */',
        'startLine' => 221,
        'endLine' => 258,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'destroyEquipment' => 
      array (
        'name' => 'destroyEquipment',
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
            'startLine' => 276,
            'endLine' => 276,
            'startColumn' => 38,
            'endColumn' => 53,
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
            'startLine' => 276,
            'endLine' => 276,
            'startColumn' => 56,
            'endColumn' => 62,
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
            'name' => 'OpenApi\\Attributes\\Delete',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/admin/equipment/{id}\'',
                'attributes' => 
                array (
                  'startLine' => 264,
                  'endLine' => 264,
                  'startTokenPos' => 2168,
                  'startFilePos' => 9198,
                  'endTokenPos' => 2168,
                  'endFilePos' => 9220,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 265,
                  'endLine' => 265,
                  'startTokenPos' => 2174,
                  'startFilePos' => 9237,
                  'endTokenPos' => 2176,
                  'endFilePos' => 9245,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Eliminar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 266,
                  'endLine' => 266,
                  'startTokenPos' => 2182,
                  'startFilePos' => 9265,
                  'endTokenPos' => 2182,
                  'endFilePos' => 9286,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 267,
                  'endLine' => 267,
                  'startTokenPos' => 2188,
                  'startFilePos' => 9307,
                  'endTokenPos' => 2207,
                  'endFilePos' => 9352,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 268,
                  'endLine' => 270,
                  'startTokenPos' => 2213,
                  'startFilePos' => 9375,
                  'endTokenPos' => 2252,
                  'endFilePos' => 9495,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento eliminado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\')]',
                'attributes' => 
                array (
                  'startLine' => 271,
                  'endLine' => 274,
                  'startTokenPos' => 2258,
                  'startFilePos' => 9517,
                  'endTokenPos' => 2294,
                  'endFilePos' => 9697,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Remove fisicamente um equipamento do sistema.
 */',
        'startLine' => 263,
        'endLine' => 287,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'storePreventive' => 
      array (
        'name' => 'storePreventive',
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
            'startLine' => 315,
            'endLine' => 315,
            'startColumn' => 37,
            'endColumn' => 52,
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
            'name' => 'OpenApi\\Attributes\\Patch',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/admin/tickets/{id}/approve-budget\'',
                'attributes' => 
                array (
                  'startLine' => 293,
                  'endLine' => 293,
                  'startTokenPos' => 2400,
                  'startFilePos' => 10276,
                  'endTokenPos' => 2400,
                  'endFilePos' => 10311,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 294,
                  'endLine' => 294,
                  'startTokenPos' => 2406,
                  'startFilePos' => 10328,
                  'endTokenPos' => 2408,
                  'endFilePos' => 10336,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Aprovar orçamento\'',
                'attributes' => 
                array (
                  'startLine' => 295,
                  'endLine' => 295,
                  'startTokenPos' => 2414,
                  'startFilePos' => 10356,
                  'endTokenPos' => 2414,
                  'endFilePos' => 10375,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 296,
                  'endLine' => 296,
                  'startTokenPos' => 2420,
                  'startFilePos' => 10396,
                  'endTokenPos' => 2439,
                  'endFilePos' => 10441,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 297,
                  'endLine' => 299,
                  'startTokenPos' => 2445,
                  'startFilePos' => 10464,
                  'endTokenPos' => 2484,
                  'endFilePos' => 10584,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Orçamento aprovado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Pedido inválido\')]',
                'attributes' => 
                array (
                  'startLine' => 300,
                  'endLine' => 303,
                  'startTokenPos' => 2490,
                  'startFilePos' => 10606,
                  'endTokenPos' => 2526,
                  'endFilePos' => 10773,
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'OpenApi\\Attributes\\Post',
            'isRepeated' => false,
            'arguments' => 
            array (
              'path' => 
              array (
                'code' => '\'/admin/preventive\'',
                'attributes' => 
                array (
                  'startLine' => 306,
                  'endLine' => 306,
                  'startTokenPos' => 2538,
                  'startFilePos' => 10811,
                  'endTokenPos' => 2538,
                  'endFilePos' => 10829,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 307,
                  'endLine' => 307,
                  'startTokenPos' => 2544,
                  'startFilePos' => 10846,
                  'endTokenPos' => 2546,
                  'endFilePos' => 10854,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar manutenção preventiva\'',
                'attributes' => 
                array (
                  'startLine' => 308,
                  'endLine' => 308,
                  'startTokenPos' => 2552,
                  'startFilePos' => 10874,
                  'endTokenPos' => 2552,
                  'endFilePos' => 10904,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 309,
                  'endLine' => 309,
                  'startTokenPos' => 2558,
                  'startFilePos' => 10925,
                  'endTokenPos' => 2577,
                  'endFilePos' => 10970,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Manutenção preventiva criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 310,
                  'endLine' => 313,
                  'startTokenPos' => 2583,
                  'startFilePos' => 10992,
                  'endTokenPos' => 2619,
                  'endFilePos' => 11173,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Aprova um pedido de orçamento associado a um ticket de avaria.
 */',
        'startLine' => 292,
        'endLine' => 354,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
        'aliasName' => NULL,
      ),
      'approveBudget' => 
      array (
        'name' => 'approveBudget',
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
            'startLine' => 362,
            'endLine' => 362,
            'startColumn' => 35,
            'endColumn' => 50,
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
            'startLine' => 362,
            'endLine' => 362,
            'startColumn' => 53,
            'endColumn' => 59,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Processa a decisão orçamental do Administrador (aprovar ou recusar).
 * Suporta tanto o formato PATCH original como o POST do frontend (action + feedback).
 * Rota: PATCH /admin/tickets/{id}/approve-budget
 * Rota: POST /admin/tickets/{id}/budget-decision (compatibilidade frontend)
 */',
        'startLine' => 362,
        'endLine' => 448,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'currentClassName' => 'App\\Http\\Controllers\\AdminController',
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