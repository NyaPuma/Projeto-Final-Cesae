<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AdminController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AdminController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-6ad0e1d3698fafdd4d6027092c5980a1aa5bcf052ba9cd9a20c1e6c230e905ca',
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
    'endLine' => 480,
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
      'PASSWORD_COMPLEXITY_RULES' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\AdminController',
        'implementingClassName' => 'App\\Http\\Controllers\\AdminController',
        'name' => 'PASSWORD_COMPLEXITY_RULES',
        'modifiers' => 4,
        'type' => NULL,
        'value' => 
        array (
          'code' => '[\'string\', \'min:8\', \'regex:/[A-Z]/\', \'regex:/[a-z]/\', \'regex:/[0-9]/\', \'regex:/[^A-Za-z0-9]/\']',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 23,
            'startTokenPos' => 89,
            'startFilePos' => 485,
            'endTokenPos' => 109,
            'endFilePos' => 593,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 6,
      ),
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
            'startLine' => 35,
            'endLine' => 35,
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
                  'startLine' => 29,
                  'endLine' => 29,
                  'startTokenPos' => 121,
                  'startFilePos' => 709,
                  'endTokenPos' => 121,
                  'endFilePos' => 722,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 30,
                  'endLine' => 30,
                  'startTokenPos' => 127,
                  'startFilePos' => 739,
                  'endTokenPos' => 129,
                  'endFilePos' => 747,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar utilizadores\'',
                'attributes' => 
                array (
                  'startLine' => 31,
                  'endLine' => 31,
                  'startTokenPos' => 135,
                  'startFilePos' => 767,
                  'endTokenPos' => 135,
                  'endFilePos' => 787,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 32,
                  'endLine' => 32,
                  'startTokenPos' => 141,
                  'startFilePos' => 808,
                  'endTokenPos' => 160,
                  'endFilePos' => 853,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de utilizadores\')]',
                'attributes' => 
                array (
                  'startLine' => 33,
                  'endLine' => 33,
                  'startTokenPos' => 166,
                  'startFilePos' => 875,
                  'endTokenPos' => 182,
                  'endFilePos' => 944,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Retorna todos os utilizadores (Apenas para Administradores).
 */',
        'startLine' => 28,
        'endLine' => 62,
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
            'startLine' => 81,
            'endLine' => 81,
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
            'startLine' => 81,
            'endLine' => 81,
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
                  'startLine' => 68,
                  'endLine' => 68,
                  'startTokenPos' => 468,
                  'startFilePos' => 1939,
                  'endTokenPos' => 468,
                  'endFilePos' => 1966,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 69,
                  'endLine' => 69,
                  'startTokenPos' => 474,
                  'startFilePos' => 1983,
                  'endTokenPos' => 476,
                  'endFilePos' => 1991,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 70,
                  'endLine' => 70,
                  'startTokenPos' => 482,
                  'startFilePos' => 2011,
                  'endTokenPos' => 482,
                  'endFilePos' => 2031,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 71,
                  'endLine' => 71,
                  'startTokenPos' => 488,
                  'startFilePos' => 2052,
                  'endTokenPos' => 507,
                  'endFilePos' => 2097,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 72,
                  'endLine' => 74,
                  'startTokenPos' => 513,
                  'startFilePos' => 2120,
                  'endTokenPos' => 552,
                  'endFilePos' => 2240,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Utilizador inativado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Utilizador não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Operação inválida\')]',
                'attributes' => 
                array (
                  'startLine' => 75,
                  'endLine' => 79,
                  'startTokenPos' => 558,
                  'startFilePos' => 2262,
                  'endTokenPos' => 611,
                  'endFilePos' => 2521,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa um utilizador do sistema.
 */',
        'startLine' => 67,
        'endLine' => 101,
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
            'startLine' => 106,
            'endLine' => 106,
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
        'startLine' => 106,
        'endLine' => 136,
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
            'startLine' => 141,
            'endLine' => 141,
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
            'startLine' => 141,
            'endLine' => 141,
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
        'startLine' => 141,
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
        'startLine' => 184,
        'endLine' => 187,
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
            'startLine' => 199,
            'endLine' => 199,
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
                  'startLine' => 193,
                  'endLine' => 193,
                  'startTokenPos' => 1556,
                  'startFilePos' => 6612,
                  'endTokenPos' => 1556,
                  'endFilePos' => 6629,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 194,
                  'endLine' => 194,
                  'startTokenPos' => 1562,
                  'startFilePos' => 6646,
                  'endTokenPos' => 1564,
                  'endFilePos' => 6654,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar equipamentos\'',
                'attributes' => 
                array (
                  'startLine' => 195,
                  'endLine' => 195,
                  'startTokenPos' => 1570,
                  'startFilePos' => 6674,
                  'endTokenPos' => 1570,
                  'endFilePos' => 6694,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 196,
                  'endLine' => 196,
                  'startTokenPos' => 1576,
                  'startFilePos' => 6715,
                  'endTokenPos' => 1595,
                  'endFilePos' => 6760,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de equipamentos\')]',
                'attributes' => 
                array (
                  'startLine' => 197,
                  'endLine' => 197,
                  'startTokenPos' => 1601,
                  'startFilePos' => 6782,
                  'endTokenPos' => 1617,
                  'endFilePos' => 6851,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista equipamentos com a respetiva sala associada.
 */',
        'startLine' => 192,
        'endLine' => 203,
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
            'startLine' => 218,
            'endLine' => 218,
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
                  'startLine' => 209,
                  'endLine' => 209,
                  'startTokenPos' => 1681,
                  'startFilePos' => 7208,
                  'endTokenPos' => 1681,
                  'endFilePos' => 7225,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 210,
                  'endLine' => 210,
                  'startTokenPos' => 1687,
                  'startFilePos' => 7242,
                  'endTokenPos' => 1689,
                  'endFilePos' => 7250,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 211,
                  'endLine' => 211,
                  'startTokenPos' => 1695,
                  'startFilePos' => 7270,
                  'endTokenPos' => 1695,
                  'endFilePos' => 7288,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 212,
                  'endLine' => 212,
                  'startTokenPos' => 1701,
                  'startFilePos' => 7309,
                  'endTokenPos' => 1720,
                  'endFilePos' => 7354,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Equipamento criado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 213,
                  'endLine' => 216,
                  'startTokenPos' => 1726,
                  'startFilePos' => 7376,
                  'endTokenPos' => 1762,
                  'endFilePos' => 7545,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Regista um novo equipamento no sistema.
 */',
        'startLine' => 208,
        'endLine' => 241,
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
            'startLine' => 260,
            'endLine' => 260,
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
            'startLine' => 260,
            'endLine' => 260,
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
                  'startLine' => 247,
                  'endLine' => 247,
                  'startTokenPos' => 2023,
                  'startFilePos' => 8621,
                  'endTokenPos' => 2023,
                  'endFilePos' => 8643,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 248,
                  'endLine' => 248,
                  'startTokenPos' => 2029,
                  'startFilePos' => 8660,
                  'endTokenPos' => 2031,
                  'endFilePos' => 8668,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 249,
                  'endLine' => 249,
                  'startTokenPos' => 2037,
                  'startFilePos' => 8688,
                  'endTokenPos' => 2037,
                  'endFilePos' => 8710,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 250,
                  'endLine' => 250,
                  'startTokenPos' => 2043,
                  'startFilePos' => 8731,
                  'endTokenPos' => 2062,
                  'endFilePos' => 8776,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 251,
                  'endLine' => 253,
                  'startTokenPos' => 2068,
                  'startFilePos' => 8799,
                  'endTokenPos' => 2107,
                  'endFilePos' => 8919,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento atualizado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 254,
                  'endLine' => 258,
                  'startTokenPos' => 2113,
                  'startFilePos' => 8941,
                  'endTokenPos' => 2166,
                  'endFilePos' => 9202,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os dados de um equipamento existente.
 */',
        'startLine' => 246,
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
            'startLine' => 305,
            'endLine' => 305,
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
            'startLine' => 305,
            'endLine' => 305,
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
                  'startLine' => 293,
                  'endLine' => 293,
                  'startTokenPos' => 2463,
                  'startFilePos' => 10512,
                  'endTokenPos' => 2463,
                  'endFilePos' => 10534,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 294,
                  'endLine' => 294,
                  'startTokenPos' => 2469,
                  'startFilePos' => 10551,
                  'endTokenPos' => 2471,
                  'endFilePos' => 10559,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Eliminar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 295,
                  'endLine' => 295,
                  'startTokenPos' => 2477,
                  'startFilePos' => 10579,
                  'endTokenPos' => 2477,
                  'endFilePos' => 10600,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 296,
                  'endLine' => 296,
                  'startTokenPos' => 2483,
                  'startFilePos' => 10621,
                  'endTokenPos' => 2502,
                  'endFilePos' => 10666,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 297,
                  'endLine' => 299,
                  'startTokenPos' => 2508,
                  'startFilePos' => 10689,
                  'endTokenPos' => 2547,
                  'endFilePos' => 10809,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento eliminado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\')]',
                'attributes' => 
                array (
                  'startLine' => 300,
                  'endLine' => 303,
                  'startTokenPos' => 2553,
                  'startFilePos' => 10831,
                  'endTokenPos' => 2589,
                  'endFilePos' => 11011,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Remove fisicamente um equipamento do sistema.
 */',
        'startLine' => 292,
        'endLine' => 318,
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
            'startLine' => 346,
            'endLine' => 346,
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
                  'startLine' => 324,
                  'endLine' => 324,
                  'startTokenPos' => 2720,
                  'startFilePos' => 11598,
                  'endTokenPos' => 2720,
                  'endFilePos' => 11633,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 325,
                  'endLine' => 325,
                  'startTokenPos' => 2726,
                  'startFilePos' => 11650,
                  'endTokenPos' => 2728,
                  'endFilePos' => 11658,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Aprovar orçamento\'',
                'attributes' => 
                array (
                  'startLine' => 326,
                  'endLine' => 326,
                  'startTokenPos' => 2734,
                  'startFilePos' => 11678,
                  'endTokenPos' => 2734,
                  'endFilePos' => 11697,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 327,
                  'endLine' => 327,
                  'startTokenPos' => 2740,
                  'startFilePos' => 11718,
                  'endTokenPos' => 2759,
                  'endFilePos' => 11763,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 328,
                  'endLine' => 330,
                  'startTokenPos' => 2765,
                  'startFilePos' => 11786,
                  'endTokenPos' => 2804,
                  'endFilePos' => 11906,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Orçamento aprovado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Pedido inválido\')]',
                'attributes' => 
                array (
                  'startLine' => 331,
                  'endLine' => 334,
                  'startTokenPos' => 2810,
                  'startFilePos' => 11928,
                  'endTokenPos' => 2846,
                  'endFilePos' => 12095,
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
                  'startLine' => 337,
                  'endLine' => 337,
                  'startTokenPos' => 2858,
                  'startFilePos' => 12133,
                  'endTokenPos' => 2858,
                  'endFilePos' => 12151,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 338,
                  'endLine' => 338,
                  'startTokenPos' => 2864,
                  'startFilePos' => 12168,
                  'endTokenPos' => 2866,
                  'endFilePos' => 12176,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar manutenção preventiva\'',
                'attributes' => 
                array (
                  'startLine' => 339,
                  'endLine' => 339,
                  'startTokenPos' => 2872,
                  'startFilePos' => 12196,
                  'endTokenPos' => 2872,
                  'endFilePos' => 12226,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 340,
                  'endLine' => 340,
                  'startTokenPos' => 2878,
                  'startFilePos' => 12247,
                  'endTokenPos' => 2897,
                  'endFilePos' => 12292,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Manutenção preventiva criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 341,
                  'endLine' => 344,
                  'startTokenPos' => 2903,
                  'startFilePos' => 12314,
                  'endTokenPos' => 2939,
                  'endFilePos' => 12495,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Aprova um pedido de orçamento associado a um ticket de avaria.
 */',
        'startLine' => 323,
        'endLine' => 385,
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
            'startLine' => 393,
            'endLine' => 393,
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
            'startLine' => 393,
            'endLine' => 393,
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
        'startLine' => 393,
        'endLine' => 479,
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