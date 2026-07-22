<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AnalyticsController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AnalyticsController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-a6c0b73ef0eaabf670e1c2ce6229f3a367f569a62156d2d372796f780555a2f0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\AnalyticsController',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/AnalyticsController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\AnalyticsController',
    'shortName' => 'AnalyticsController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 18,
    'endLine' => 365,
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
      'stats' => 
      array (
        'name' => 'stats',
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
            'startLine' => 32,
            'endLine' => 32,
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
                'code' => '\'/analytics/stats\'',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 94,
                  'startFilePos' => 599,
                  'endTokenPos' => 94,
                  'endFilePos' => 616,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 25,
                  'endLine' => 25,
                  'startTokenPos' => 100,
                  'startFilePos' => 633,
                  'endTokenPos' => 102,
                  'endFilePos' => 645,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Métricas gerais\'',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 108,
                  'startFilePos' => 665,
                  'endTokenPos' => 108,
                  'endFilePos' => 682,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 27,
                  'endLine' => 27,
                  'startTokenPos' => 114,
                  'startFilePos' => 703,
                  'endTokenPos' => 133,
                  'endFilePos' => 748,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'KPIs agregados\')]',
                'attributes' => 
                array (
                  'startLine' => 28,
                  'endLine' => 30,
                  'startTokenPos' => 139,
                  'startFilePos' => 770,
                  'endTokenPos' => 157,
                  'endFilePos' => 854,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Obtém o payload completo do dashboard analítico para a interface web.
 */',
        'startLine' => 23,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'charts' => 
      array (
        'name' => 'charts',
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
            'startColumn' => 28,
            'endColumn' => 43,
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
                'code' => '\'/analytics/charts\'',
                'attributes' => 
                array (
                  'startLine' => 47,
                  'endLine' => 47,
                  'startTokenPos' => 237,
                  'startFilePos' => 1253,
                  'endTokenPos' => 237,
                  'endFilePos' => 1271,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 48,
                  'endLine' => 48,
                  'startTokenPos' => 243,
                  'startFilePos' => 1288,
                  'endTokenPos' => 245,
                  'endFilePos' => 1300,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Dados para dashboards\'',
                'attributes' => 
                array (
                  'startLine' => 49,
                  'endLine' => 49,
                  'startTokenPos' => 251,
                  'startFilePos' => 1320,
                  'endTokenPos' => 251,
                  'endFilePos' => 1342,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 50,
                  'endLine' => 50,
                  'startTokenPos' => 257,
                  'startFilePos' => 1363,
                  'endTokenPos' => 276,
                  'endFilePos' => 1408,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Séries para gráficos\')]',
                'attributes' => 
                array (
                  'startLine' => 51,
                  'endLine' => 53,
                  'startTokenPos' => 282,
                  'startFilePos' => 1430,
                  'endTokenPos' => 300,
                  'endFilePos' => 1522,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Fornece os dados para os gráficos do dashboard analítico.
 */',
        'startLine' => 46,
        'endLine' => 64,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'buildPayload' => 
      array (
        'name' => 'buildPayload',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 66,
        'endLine' => 204,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'buildMonthlySeries' => 
      array (
        'name' => 'buildMonthlySeries',
        'parameters' => 
        array (
          'tickets' => 
          array (
            'name' => 'tickets',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Support\\Collection',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 41,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'openStatusId' => 
          array (
            'name' => 'openStatusId',
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
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 62,
            'endColumn' => 78,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'inProgressStatusId' => 
          array (
            'name' => 'inProgressStatusId',
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
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 81,
            'endColumn' => 103,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
          'closedStatusId' => 
          array (
            'name' => 'closedStatusId',
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
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 106,
            'endColumn' => 124,
            'parameterIndex' => 3,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 206,
        'endLine' => 259,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'exportCsv' => 
      array (
        'name' => 'exportCsv',
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
            'startLine' => 273,
            'endLine' => 273,
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
                'code' => '\'/analytics/export/csv\'',
                'attributes' => 
                array (
                  'startLine' => 265,
                  'endLine' => 265,
                  'startTokenPos' => 2229,
                  'startFilePos' => 10086,
                  'endTokenPos' => 2229,
                  'endFilePos' => 10108,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 266,
                  'endLine' => 266,
                  'startTokenPos' => 2235,
                  'startFilePos' => 10125,
                  'endTokenPos' => 2237,
                  'endFilePos' => 10137,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar CSV\'',
                'attributes' => 
                array (
                  'startLine' => 267,
                  'endLine' => 267,
                  'startTokenPos' => 2243,
                  'startFilePos' => 10157,
                  'endTokenPos' => 2243,
                  'endFilePos' => 10170,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 268,
                  'endLine' => 268,
                  'startTokenPos' => 2249,
                  'startFilePos' => 10191,
                  'endTokenPos' => 2268,
                  'endFilePos' => 10236,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro CSV descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 269,
                  'endLine' => 271,
                  'startTokenPos' => 2274,
                  'startFilePos' => 10258,
                  'endTokenPos' => 2292,
                  'endFilePos' => 10353,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
 */',
        'startLine' => 264,
        'endLine' => 309,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'exportPdf' => 
      array (
        'name' => 'exportPdf',
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
            'startLine' => 323,
            'endLine' => 323,
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
                'code' => '\'/analytics/export/pdf\'',
                'attributes' => 
                array (
                  'startLine' => 315,
                  'endLine' => 315,
                  'startTokenPos' => 2566,
                  'startFilePos' => 11821,
                  'endTokenPos' => 2566,
                  'endFilePos' => 11843,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 316,
                  'endLine' => 316,
                  'startTokenPos' => 2572,
                  'startFilePos' => 11860,
                  'endTokenPos' => 2574,
                  'endFilePos' => 11872,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar PDF\'',
                'attributes' => 
                array (
                  'startLine' => 317,
                  'endLine' => 317,
                  'startTokenPos' => 2580,
                  'startFilePos' => 11892,
                  'endTokenPos' => 2580,
                  'endFilePos' => 11905,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 318,
                  'endLine' => 318,
                  'startTokenPos' => 2586,
                  'startFilePos' => 11926,
                  'endTokenPos' => 2605,
                  'endFilePos' => 11971,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro PDF descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 319,
                  'endLine' => 321,
                  'startTokenPos' => 2611,
                  'startFilePos' => 11993,
                  'endTokenPos' => 2629,
                  'endFilePos' => 12088,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato PDF via DOMPDF.
 */',
        'startLine' => 314,
        'endLine' => 339,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'aliasName' => NULL,
      ),
      'exportExcel' => 
      array (
        'name' => 'exportExcel',
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
            'startLine' => 353,
            'endLine' => 353,
            'startColumn' => 33,
            'endColumn' => 48,
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
                'code' => '\'/analytics/export/excel\'',
                'attributes' => 
                array (
                  'startLine' => 345,
                  'endLine' => 345,
                  'startTokenPos' => 2771,
                  'startFilePos' => 12771,
                  'endTokenPos' => 2771,
                  'endFilePos' => 12795,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 346,
                  'endLine' => 346,
                  'startTokenPos' => 2777,
                  'startFilePos' => 12812,
                  'endTokenPos' => 2779,
                  'endFilePos' => 12824,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar Excel\'',
                'attributes' => 
                array (
                  'startLine' => 347,
                  'endLine' => 347,
                  'startTokenPos' => 2785,
                  'startFilePos' => 12844,
                  'endTokenPos' => 2785,
                  'endFilePos' => 12859,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 348,
                  'endLine' => 348,
                  'startTokenPos' => 2791,
                  'startFilePos' => 12880,
                  'endTokenPos' => 2810,
                  'endFilePos' => 12925,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro XLSX descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 349,
                  'endLine' => 351,
                  'startTokenPos' => 2816,
                  'startFilePos' => 12947,
                  'endTokenPos' => 2834,
                  'endFilePos' => 13043,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato Excel (.xlsx).
 */',
        'startLine' => 344,
        'endLine' => 364,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'implementingClassName' => 'App\\Http\\Controllers\\AnalyticsController',
        'currentClassName' => 'App\\Http\\Controllers\\AnalyticsController',
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