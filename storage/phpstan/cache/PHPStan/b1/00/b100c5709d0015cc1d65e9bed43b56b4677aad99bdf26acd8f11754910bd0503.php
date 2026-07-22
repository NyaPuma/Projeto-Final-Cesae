<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AdminController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AdminController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-2d27adf315424e2697c0991592a1bde520e4249ce5d3c90c9343140cc4079d15',
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
    'startLine' => 14,
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
            'startLine' => 26,
            'endLine' => 26,
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
                  'startLine' => 20,
                  'endLine' => 20,
                  'startTokenPos' => 70,
                  'startFilePos' => 417,
                  'endTokenPos' => 70,
                  'endFilePos' => 430,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 21,
                  'endLine' => 21,
                  'startTokenPos' => 76,
                  'startFilePos' => 447,
                  'endTokenPos' => 78,
                  'endFilePos' => 455,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar utilizadores\'',
                'attributes' => 
                array (
                  'startLine' => 22,
                  'endLine' => 22,
                  'startTokenPos' => 84,
                  'startFilePos' => 475,
                  'endTokenPos' => 84,
                  'endFilePos' => 495,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 23,
                  'endLine' => 23,
                  'startTokenPos' => 90,
                  'startFilePos' => 516,
                  'endTokenPos' => 109,
                  'endFilePos' => 561,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de utilizadores\')]',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 115,
                  'startFilePos' => 583,
                  'endTokenPos' => 131,
                  'endFilePos' => 652,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Retorna todos os utilizadores (Apenas para Administradores).
 */',
        'startLine' => 19,
        'endLine' => 52,
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
            'startLine' => 71,
            'endLine' => 71,
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
            'startLine' => 71,
            'endLine' => 71,
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
                  'startLine' => 58,
                  'endLine' => 58,
                  'startTokenPos' => 389,
                  'startFilePos' => 1569,
                  'endTokenPos' => 389,
                  'endFilePos' => 1596,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 59,
                  'endLine' => 59,
                  'startTokenPos' => 395,
                  'startFilePos' => 1613,
                  'endTokenPos' => 397,
                  'endFilePos' => 1621,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Inativar utilizador\'',
                'attributes' => 
                array (
                  'startLine' => 60,
                  'endLine' => 60,
                  'startTokenPos' => 403,
                  'startFilePos' => 1641,
                  'endTokenPos' => 403,
                  'endFilePos' => 1661,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 61,
                  'endLine' => 61,
                  'startTokenPos' => 409,
                  'startFilePos' => 1682,
                  'endTokenPos' => 428,
                  'endFilePos' => 1727,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 62,
                  'endLine' => 64,
                  'startTokenPos' => 434,
                  'startFilePos' => 1750,
                  'endTokenPos' => 472,
                  'endFilePos' => 1869,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Utilizador inativado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Utilizador não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Operação inválida\')]',
                'attributes' => 
                array (
                  'startLine' => 65,
                  'endLine' => 69,
                  'startTokenPos' => 478,
                  'startFilePos' => 1891,
                  'endTokenPos' => 530,
                  'endFilePos' => 2149,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Inativa um utilizador do sistema.
 */',
        'startLine' => 57,
        'endLine' => 88,
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
            'startLine' => 93,
            'endLine' => 93,
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
        'startLine' => 93,
        'endLine' => 118,
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
            'startLine' => 123,
            'endLine' => 123,
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
            'startLine' => 123,
            'endLine' => 123,
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
        'startLine' => 123,
        'endLine' => 153,
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
        'startLine' => 158,
        'endLine' => 161,
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
            'startLine' => 173,
            'endLine' => 173,
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
                  'startLine' => 167,
                  'endLine' => 167,
                  'startTokenPos' => 1319,
                  'startFilePos' => 5593,
                  'endTokenPos' => 1319,
                  'endFilePos' => 5610,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 168,
                  'endLine' => 168,
                  'startTokenPos' => 1325,
                  'startFilePos' => 5627,
                  'endTokenPos' => 1327,
                  'endFilePos' => 5635,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar equipamentos\'',
                'attributes' => 
                array (
                  'startLine' => 169,
                  'endLine' => 169,
                  'startTokenPos' => 1333,
                  'startFilePos' => 5655,
                  'endTokenPos' => 1333,
                  'endFilePos' => 5675,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 170,
                  'endLine' => 170,
                  'startTokenPos' => 1339,
                  'startFilePos' => 5696,
                  'endTokenPos' => 1358,
                  'endFilePos' => 5741,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de equipamentos\')]',
                'attributes' => 
                array (
                  'startLine' => 171,
                  'endLine' => 171,
                  'startTokenPos' => 1364,
                  'startFilePos' => 5763,
                  'endTokenPos' => 1380,
                  'endFilePos' => 5832,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista equipamentos com a respetiva sala associada.
 */',
        'startLine' => 166,
        'endLine' => 177,
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
            'startLine' => 192,
            'endLine' => 192,
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
                  'startLine' => 183,
                  'endLine' => 183,
                  'startTokenPos' => 1444,
                  'startFilePos' => 6189,
                  'endTokenPos' => 1444,
                  'endFilePos' => 6206,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 184,
                  'endLine' => 184,
                  'startTokenPos' => 1450,
                  'startFilePos' => 6223,
                  'endTokenPos' => 1452,
                  'endFilePos' => 6231,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 185,
                  'endLine' => 185,
                  'startTokenPos' => 1458,
                  'startFilePos' => 6251,
                  'endTokenPos' => 1458,
                  'endFilePos' => 6269,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 186,
                  'endLine' => 186,
                  'startTokenPos' => 1464,
                  'startFilePos' => 6290,
                  'endTokenPos' => 1483,
                  'endFilePos' => 6335,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Equipamento criado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 187,
                  'endLine' => 190,
                  'startTokenPos' => 1489,
                  'startFilePos' => 6357,
                  'endTokenPos' => 1524,
                  'endFilePos' => 6525,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Regista um novo equipamento no sistema.
 */',
        'startLine' => 182,
        'endLine' => 214,
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
            'startLine' => 233,
            'endLine' => 233,
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
            'startLine' => 233,
            'endLine' => 233,
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
                  'startLine' => 220,
                  'endLine' => 220,
                  'startTokenPos' => 1755,
                  'startFilePos' => 7528,
                  'endTokenPos' => 1755,
                  'endFilePos' => 7550,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 221,
                  'endLine' => 221,
                  'startTokenPos' => 1761,
                  'startFilePos' => 7567,
                  'endTokenPos' => 1763,
                  'endFilePos' => 7575,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Atualizar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 222,
                  'endLine' => 222,
                  'startTokenPos' => 1769,
                  'startFilePos' => 7595,
                  'endTokenPos' => 1769,
                  'endFilePos' => 7617,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 223,
                  'endLine' => 223,
                  'startTokenPos' => 1775,
                  'startFilePos' => 7638,
                  'endTokenPos' => 1794,
                  'endFilePos' => 7683,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 224,
                  'endLine' => 226,
                  'startTokenPos' => 1800,
                  'startFilePos' => 7706,
                  'endTokenPos' => 1838,
                  'endFilePos' => 7825,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento atualizado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 227,
                  'endLine' => 231,
                  'startTokenPos' => 1844,
                  'startFilePos' => 7847,
                  'endTokenPos' => 1896,
                  'endFilePos' => 8107,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Atualiza os dados de um equipamento existente.
 */',
        'startLine' => 219,
        'endLine' => 256,
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
            'startLine' => 274,
            'endLine' => 274,
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
            'startLine' => 274,
            'endLine' => 274,
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
                  'startLine' => 262,
                  'endLine' => 262,
                  'startTokenPos' => 2147,
                  'startFilePos' => 9203,
                  'endTokenPos' => 2147,
                  'endFilePos' => 9225,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 263,
                  'endLine' => 263,
                  'startTokenPos' => 2153,
                  'startFilePos' => 9242,
                  'endTokenPos' => 2155,
                  'endFilePos' => 9250,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Eliminar equipamento\'',
                'attributes' => 
                array (
                  'startLine' => 264,
                  'endLine' => 264,
                  'startTokenPos' => 2161,
                  'startFilePos' => 9270,
                  'endTokenPos' => 2161,
                  'endFilePos' => 9291,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 265,
                  'endLine' => 265,
                  'startTokenPos' => 2167,
                  'startFilePos' => 9312,
                  'endTokenPos' => 2186,
                  'endFilePos' => 9357,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 266,
                  'endLine' => 268,
                  'startTokenPos' => 2192,
                  'startFilePos' => 9380,
                  'endTokenPos' => 2230,
                  'endFilePos' => 9499,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento eliminado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\')]',
                'attributes' => 
                array (
                  'startLine' => 269,
                  'endLine' => 272,
                  'startTokenPos' => 2236,
                  'startFilePos' => 9521,
                  'endTokenPos' => 2271,
                  'endFilePos' => 9700,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Remove fisicamente um equipamento do sistema.
 */',
        'startLine' => 261,
        'endLine' => 285,
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
                  'startTokenPos' => 2376,
                  'startFilePos' => 10280,
                  'endTokenPos' => 2376,
                  'endFilePos' => 10315,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 294,
                  'endLine' => 294,
                  'startTokenPos' => 2382,
                  'startFilePos' => 10332,
                  'endTokenPos' => 2384,
                  'endFilePos' => 10340,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Aprovar orçamento\'',
                'attributes' => 
                array (
                  'startLine' => 295,
                  'endLine' => 295,
                  'startTokenPos' => 2390,
                  'startFilePos' => 10360,
                  'endTokenPos' => 2390,
                  'endFilePos' => 10379,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 296,
                  'endLine' => 296,
                  'startTokenPos' => 2396,
                  'startFilePos' => 10400,
                  'endTokenPos' => 2415,
                  'endFilePos' => 10445,
                ),
              ),
              'parameters' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'attributes' => 
                array (
                  'startLine' => 297,
                  'endLine' => 299,
                  'startTokenPos' => 2421,
                  'startFilePos' => 10468,
                  'endTokenPos' => 2459,
                  'endFilePos' => 10587,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Orçamento aprovado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Pedido inválido\')]',
                'attributes' => 
                array (
                  'startLine' => 300,
                  'endLine' => 303,
                  'startTokenPos' => 2465,
                  'startFilePos' => 10609,
                  'endTokenPos' => 2500,
                  'endFilePos' => 10775,
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
                  'startTokenPos' => 2512,
                  'startFilePos' => 10813,
                  'endTokenPos' => 2512,
                  'endFilePos' => 10831,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 307,
                  'endLine' => 307,
                  'startTokenPos' => 2518,
                  'startFilePos' => 10848,
                  'endTokenPos' => 2520,
                  'endFilePos' => 10856,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Criar manutenção preventiva\'',
                'attributes' => 
                array (
                  'startLine' => 308,
                  'endLine' => 308,
                  'startTokenPos' => 2526,
                  'startFilePos' => 10876,
                  'endTokenPos' => 2526,
                  'endFilePos' => 10906,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 309,
                  'endLine' => 309,
                  'startTokenPos' => 2532,
                  'startFilePos' => 10927,
                  'endTokenPos' => 2551,
                  'endFilePos' => 10972,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Manutenção preventiva criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
                'attributes' => 
                array (
                  'startLine' => 310,
                  'endLine' => 313,
                  'startTokenPos' => 2557,
                  'startFilePos' => 10994,
                  'endTokenPos' => 2592,
                  'endFilePos' => 11174,
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