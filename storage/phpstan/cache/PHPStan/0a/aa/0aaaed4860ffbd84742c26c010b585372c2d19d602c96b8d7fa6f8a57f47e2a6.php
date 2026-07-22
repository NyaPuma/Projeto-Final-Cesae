<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AuditController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AuditController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-529b58deb294e5a3f3b5bd36bdee3941b710c9ff25f2436fc010f1d4778e4f9a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\AuditController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/AuditController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\AuditController',
    'shortName' => 'AuditController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 33,
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
            'startLine' => 24,
            'endLine' => 24,
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
                'code' => '\'/admin/audits\'',
                'attributes' => 
                array (
                  'startLine' => 16,
                  'endLine' => 16,
                  'startTokenPos' => 45,
                  'startFilePos' => 345,
                  'endTokenPos' => 45,
                  'endFilePos' => 359,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Admin\']',
                'attributes' => 
                array (
                  'startLine' => 17,
                  'endLine' => 17,
                  'startTokenPos' => 51,
                  'startFilePos' => 376,
                  'endTokenPos' => 53,
                  'endFilePos' => 384,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Listar auditoria\'',
                'attributes' => 
                array (
                  'startLine' => 18,
                  'endLine' => 18,
                  'startTokenPos' => 59,
                  'startFilePos' => 404,
                  'endTokenPos' => 59,
                  'endFilePos' => 421,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 19,
                  'endLine' => 19,
                  'startTokenPos' => 65,
                  'startFilePos' => 442,
                  'endTokenPos' => 84,
                  'endFilePos' => 487,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de auditoria\')]',
                'attributes' => 
                array (
                  'startLine' => 20,
                  'endLine' => 22,
                  'startTokenPos' => 90,
                  'startFilePos' => 509,
                  'endTokenPos' => 108,
                  'endFilePos' => 597,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Lista os registos de auditoria do sistema.
 * Protegido globalmente via web.php com os middlewares custom.auth e role:admin.
 */',
        'startLine' => 15,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AuditController',
        'implementingClassName' => 'App\\Http\\Controllers\\AuditController',
        'currentClassName' => 'App\\Http\\Controllers\\AuditController',
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