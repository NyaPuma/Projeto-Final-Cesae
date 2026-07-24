<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AdminController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AdminController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-cee4f3d8f3d194af6d384b4c1b4650e6d108e8fec1cece55438eab78723397ba',
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
    'startLine' => 17,
    'endLine' => 475,
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
            'startLine' => 31,
            'endLine' => 31,
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
                  'startLine' => 25,
                  'endLine' => 25,
                  'startTokenPos' => 90,
                  'startFilePos' => 551,
                  'endTokenPos' => 90,
                  'endFilePos' => 564,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 96,
                  'startFilePos' => 581,
                  'endTokenPos' => 98,
                  'endFilePos' => 589,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar utilizadores\'',
                'attributes' => 
                array (
                  'startLine' => 27,
                  'endLine' => 27,
                  'startTokenPos' => 104,
                  'startFilePos' => 609,
                  'endTokenPos' => 104,
                  'endFilePos' => 629,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 28,
                  'endLine' => 28,
                  'startTokenPos' => 110,
                  'startFilePos' => 650,
                  'endTokenPos' => 129,
                  'endFilePos' => 695,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de utilizadores\')]',
                'attributes' => 
                array (
                  'startLine' => 29,
                  'endLine' => 29,
                  'startTokenPos' => 135,
                  'startFilePos' => 717,
                  'endTokenPos' => 151,
                  'endFilePos' => 786,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Retorna todos os utilizadores (Apenas para Administradores).
 */',
        'startLine' => 24,
        'endLine' => 58,
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
            'startLine' => 77,
            'endLine' => 77,
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
            'startLine' => 77,
            'endLine' => 77,
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
                  'startLine' => 64,
                  'endLine' => 64,
                  'startTokenPos' => 437,
                  'startFilePos' => 1781,
                  'endTokenPos' => 437,
                  'endFilePos' => 1808,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 65,
                  'endLine' => 65,
                  'startTokenPos' => 443,
                  'startFilePos' => 1825,
                  'endTokenPos' => 445,
                  'endFilePos' => 1833,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 66,
                  'endLine' => 66,
                  'startTokenPos' => 451,
                  'startFilePos' => 1853,
                  'endTokenPos' => 451,
                  'endFilePos' => 1873,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 67,
                  'endLine' => 67,
                  'startTokenPos' => 457,
                  'startFilePos' => 1894,
                  'endTokenPos' => 476,
                  'endFilePos' => 1939,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 68,
                  'endLine' => 70,
                  'startTokenPos' => 482,
                  'startFilePos' => 1962,
                  'endTokenPos' => 521,
                  'endFilePos' => 2082,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Utilizador inativado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Utilizador não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Operação inválida\')]',
                'attributes' => 
                array (
                  'startLine' => 71,
                  'endLine' => 75,
                  'startTokenPos' => 527,
                  'startFilePos' => 2104,
                  'endTokenPos' => 580,
                  'endFilePos' => 2363,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa um utilizador do sistema.
 */',
        'startLine' => 63,
        'endLine' => 97,
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
            'startLine' => 102,
            'endLine' => 102,
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
        'startLine' => 102,
        'endLine' => 132,
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
            'startLine' => 137,
            'endLine' => 137,
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
            'startLine' => 137,
            'endLine' => 137,
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
        'startLine' => 137,
        'endLine' => 175,
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
        'startLine' => 180,
        'endLine' => 183,
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
            'startLine' => 195,
            'endLine' => 195,
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
                  'startLine' => 189,
                  'endLine' => 189,
                  'startTokenPos' => 1521,
                  'startFilePos' => 6400,
                  'endTokenPos' => 1521,
                  'endFilePos' => 6417,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 190,
                  'endLine' => 190,
                  'startTokenPos' => 1527,
                  'startFilePos' => 6434,
                  'endTokenPos' => 1529,
                  'endFilePos' => 6442,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar equipamentos\'',
                'attributes' => 
                array (
                  'startLine' => 191,
                  'endLine' => 191,
                  'startTokenPos' => 1535,
                  'startFilePos' => 6462,
                  'endTokenPos' => 1535,
                  'endFilePos' => 6482,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 192,
                  'endLine' => 192,
                  'startTokenPos' => 1541,
                  'startFilePos' => 6503,
                  'endTokenPos' => 1560,
                  'endFilePos' => 6548,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de equipamentos\')]',
                'attributes' => 
                array (
                  'startLine' => 193,
                  'endLine' => 193,
                  'startTokenPos' => 1566,
                  'startFilePos' => 6570,
                  'endTokenPos' => 1582,
                  'endFilePos' => 6639,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista equipamentos com a respetiva sala associada.
 */',
        'startLine' => 188,
        'endLine' => 199,
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
            'startLine' => 214,
            'endLine' => 214,
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
                  'startLine' => 205,
                  'endLine' => 205,
                  'startTokenPos' => 1646,
                  'startFilePos' => 6996,
                  'endTokenPos' => 1646,
                  'endFilePos' => 7013,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 206,
                  'endLine' => 206,
                  'startTokenPos' => 1652,
                  'startFilePos' => 7030,
                  'endTokenPos' => 1654,
                  'endFilePos' => 7038,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 207,
                  'endLine' => 207,
                  'startTokenPos' => 1660,
                  'startFilePos' => 7058,
                  'endTokenPos' => 1660,
                  'endFilePos' => 7076,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 208,
                  'endLine' => 208,
                  'startTokenPos' => 1666,
                  'startFilePos' => 7097,
                  'endTokenPos' => 1685,
                  'endFilePos' => 7142,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Equipamento criado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 209,
                  'endLine' => 212,
                  'startTokenPos' => 1691,
                  'startFilePos' => 7164,
                  'endTokenPos' => 1727,
                  'endFilePos' => 7333,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Regista um novo equipamento no sistema.
 */',
        'startLine' => 204,
        'endLine' => 236,
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
            'startLine' => 255,
            'endLine' => 255,
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
            'startLine' => 255,
            'endLine' => 255,
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
                  'startLine' => 242,
                  'endLine' => 242,
                  'startTokenPos' => 1958,
                  'startFilePos' => 8336,
                  'endTokenPos' => 1958,
                  'endFilePos' => 8358,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 243,
                  'endLine' => 243,
                  'startTokenPos' => 1964,
                  'startFilePos' => 8375,
                  'endTokenPos' => 1966,
                  'endFilePos' => 8383,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 244,
                  'endLine' => 244,
                  'startTokenPos' => 1972,
                  'startFilePos' => 8403,
                  'endTokenPos' => 1972,
                  'endFilePos' => 8425,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 245,
                  'endLine' => 245,
                  'startTokenPos' => 1978,
                  'startFilePos' => 8446,
                  'endTokenPos' => 1997,
                  'endFilePos' => 8491,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 246,
                  'endLine' => 248,
                  'startTokenPos' => 2003,
                  'startFilePos' => 8514,
                  'endTokenPos' => 2042,
                  'endFilePos' => 8634,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento atualizado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 249,
                  'endLine' => 253,
                  'startTokenPos' => 2048,
                  'startFilePos' => 8656,
                  'endTokenPos' => 2101,
                  'endFilePos' => 8917,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os dados de um equipamento existente.
 */',
        'startLine' => 241,
        'endLine' => 281,
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
            'startLine' => 299,
            'endLine' => 299,
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
            'startLine' => 299,
            'endLine' => 299,
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
                  'startLine' => 287,
                  'endLine' => 287,
                  'startTokenPos' => 2380,
                  'startFilePos' => 10124,
                  'endTokenPos' => 2380,
                  'endFilePos' => 10146,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 288,
                  'endLine' => 288,
                  'startTokenPos' => 2386,
                  'startFilePos' => 10163,
                  'endTokenPos' => 2388,
                  'endFilePos' => 10171,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Eliminar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 289,
                  'endLine' => 289,
                  'startTokenPos' => 2394,
                  'startFilePos' => 10191,
                  'endTokenPos' => 2394,
                  'endFilePos' => 10212,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 290,
                  'endLine' => 290,
                  'startTokenPos' => 2400,
                  'startFilePos' => 10233,
                  'endTokenPos' => 2419,
                  'endFilePos' => 10278,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 291,
                  'endLine' => 293,
                  'startTokenPos' => 2425,
                  'startFilePos' => 10301,
                  'endTokenPos' => 2464,
                  'endFilePos' => 10421,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento eliminado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\')]',
                'attributes' => 
                array (
                  'startLine' => 294,
                  'endLine' => 297,
                  'startTokenPos' => 2470,
                  'startFilePos' => 10443,
                  'endTokenPos' => 2506,
                  'endFilePos' => 10623,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Remove fisicamente um equipamento do sistema.
 */',
        'startLine' => 286,
        'endLine' => 313,
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
            'startLine' => 341,
            'endLine' => 341,
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
                  'startLine' => 319,
                  'endLine' => 319,
                  'startTokenPos' => 2639,
                  'startFilePos' => 11312,
                  'endTokenPos' => 2639,
                  'endFilePos' => 11347,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 320,
                  'endLine' => 320,
                  'startTokenPos' => 2645,
                  'startFilePos' => 11364,
                  'endTokenPos' => 2647,
                  'endFilePos' => 11372,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Aprovar orçamento\'',
                'attributes' => 
                array (
                  'startLine' => 321,
                  'endLine' => 321,
                  'startTokenPos' => 2653,
                  'startFilePos' => 11392,
                  'endTokenPos' => 2653,
                  'endFilePos' => 11411,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 322,
                  'endLine' => 322,
                  'startTokenPos' => 2659,
                  'startFilePos' => 11432,
                  'endTokenPos' => 2678,
                  'endFilePos' => 11477,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 323,
                  'endLine' => 325,
                  'startTokenPos' => 2684,
                  'startFilePos' => 11500,
                  'endTokenPos' => 2723,
                  'endFilePos' => 11620,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Orçamento aprovado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Pedido inválido\')]',
                'attributes' => 
                array (
                  'startLine' => 326,
                  'endLine' => 329,
                  'startTokenPos' => 2729,
                  'startFilePos' => 11642,
                  'endTokenPos' => 2765,
                  'endFilePos' => 11809,
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
                  'startLine' => 332,
                  'endLine' => 332,
                  'startTokenPos' => 2777,
                  'startFilePos' => 11847,
                  'endTokenPos' => 2777,
                  'endFilePos' => 11865,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 333,
                  'endLine' => 333,
                  'startTokenPos' => 2783,
                  'startFilePos' => 11882,
                  'endTokenPos' => 2785,
                  'endFilePos' => 11890,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar manutenção preventiva\'',
                'attributes' => 
                array (
                  'startLine' => 334,
                  'endLine' => 334,
                  'startTokenPos' => 2791,
                  'startFilePos' => 11910,
                  'endTokenPos' => 2791,
                  'endFilePos' => 11940,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 335,
                  'endLine' => 335,
                  'startTokenPos' => 2797,
                  'startFilePos' => 11961,
                  'endTokenPos' => 2816,
                  'endFilePos' => 12006,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Manutenção preventiva criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 336,
                  'endLine' => 339,
                  'startTokenPos' => 2822,
                  'startFilePos' => 12028,
                  'endTokenPos' => 2858,
                  'endFilePos' => 12209,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Aprova um pedido de orçamento associado a um ticket de avaria.
 */',
        'startLine' => 318,
        'endLine' => 380,
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
            'startLine' => 388,
            'endLine' => 388,
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
            'startLine' => 388,
            'endLine' => 388,
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
        'startLine' => 388,
        'endLine' => 474,
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