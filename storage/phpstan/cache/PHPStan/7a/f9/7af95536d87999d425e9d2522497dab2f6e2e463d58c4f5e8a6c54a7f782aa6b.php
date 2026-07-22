<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AnalyticsController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AnalyticsController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-bb307b8974813042c7fe743bf6821809c75cfb0ba1ff40c1e5ae5649818fea3f',
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
    'startLine' => 17,
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
                'code' => '\'/analytics/stats\'',
                'attributes' => 
                array (
                  'startLine' => 23,
                  'endLine' => 23,
                  'startTokenPos' => 89,
                  'startFilePos' => 564,
                  'endTokenPos' => 89,
                  'endFilePos' => 581,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 24,
                  'endLine' => 24,
                  'startTokenPos' => 95,
                  'startFilePos' => 598,
                  'endTokenPos' => 97,
                  'endFilePos' => 610,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Métricas gerais\'',
                'attributes' => 
                array (
                  'startLine' => 25,
                  'endLine' => 25,
                  'startTokenPos' => 103,
                  'startFilePos' => 630,
                  'endTokenPos' => 103,
                  'endFilePos' => 647,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 109,
                  'startFilePos' => 668,
                  'endTokenPos' => 128,
                  'endFilePos' => 713,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'KPIs agregados\')]',
                'attributes' => 
                array (
                  'startLine' => 27,
                  'endLine' => 29,
                  'startTokenPos' => 134,
                  'startFilePos' => 735,
                  'endTokenPos' => 153,
                  'endFilePos' => 820,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Obtém o payload completo do dashboard analítico para a interface web.
 */',
        'startLine' => 22,
        'endLine' => 40,
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
            'startLine' => 54,
            'endLine' => 54,
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
                  'startLine' => 46,
                  'endLine' => 46,
                  'startTokenPos' => 233,
                  'startFilePos' => 1219,
                  'endTokenPos' => 233,
                  'endFilePos' => 1237,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 47,
                  'endLine' => 47,
                  'startTokenPos' => 239,
                  'startFilePos' => 1254,
                  'endTokenPos' => 241,
                  'endFilePos' => 1266,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Dados para dashboards\'',
                'attributes' => 
                array (
                  'startLine' => 48,
                  'endLine' => 48,
                  'startTokenPos' => 247,
                  'startFilePos' => 1286,
                  'endTokenPos' => 247,
                  'endFilePos' => 1308,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 49,
                  'endLine' => 49,
                  'startTokenPos' => 253,
                  'startFilePos' => 1329,
                  'endTokenPos' => 272,
                  'endFilePos' => 1374,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Séries para gráficos\')]',
                'attributes' => 
                array (
                  'startLine' => 50,
                  'endLine' => 52,
                  'startTokenPos' => 278,
                  'startFilePos' => 1396,
                  'endTokenPos' => 297,
                  'endFilePos' => 1489,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Fornece os dados para os gráficos do dashboard analítico.
 */',
        'startLine' => 45,
        'endLine' => 63,
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
        'startLine' => 65,
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
                  'startTokenPos' => 2240,
                  'startFilePos' => 10083,
                  'endTokenPos' => 2240,
                  'endFilePos' => 10105,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 266,
                  'endLine' => 266,
                  'startTokenPos' => 2246,
                  'startFilePos' => 10122,
                  'endTokenPos' => 2248,
                  'endFilePos' => 10134,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar CSV\'',
                'attributes' => 
                array (
                  'startLine' => 267,
                  'endLine' => 267,
                  'startTokenPos' => 2254,
                  'startFilePos' => 10154,
                  'endTokenPos' => 2254,
                  'endFilePos' => 10167,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 268,
                  'endLine' => 268,
                  'startTokenPos' => 2260,
                  'startFilePos' => 10188,
                  'endTokenPos' => 2279,
                  'endFilePos' => 10233,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro CSV descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 269,
                  'endLine' => 271,
                  'startTokenPos' => 2285,
                  'startFilePos' => 10255,
                  'endTokenPos' => 2304,
                  'endFilePos' => 10351,
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
                  'startTokenPos' => 2578,
                  'startFilePos' => 11819,
                  'endTokenPos' => 2578,
                  'endFilePos' => 11841,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 316,
                  'endLine' => 316,
                  'startTokenPos' => 2584,
                  'startFilePos' => 11858,
                  'endTokenPos' => 2586,
                  'endFilePos' => 11870,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar PDF\'',
                'attributes' => 
                array (
                  'startLine' => 317,
                  'endLine' => 317,
                  'startTokenPos' => 2592,
                  'startFilePos' => 11890,
                  'endTokenPos' => 2592,
                  'endFilePos' => 11903,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 318,
                  'endLine' => 318,
                  'startTokenPos' => 2598,
                  'startFilePos' => 11924,
                  'endTokenPos' => 2617,
                  'endFilePos' => 11969,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro PDF descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 319,
                  'endLine' => 321,
                  'startTokenPos' => 2623,
                  'startFilePos' => 11991,
                  'endTokenPos' => 2642,
                  'endFilePos' => 12087,
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
                  'startTokenPos' => 2785,
                  'startFilePos' => 12771,
                  'endTokenPos' => 2785,
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
                  'startTokenPos' => 2791,
                  'startFilePos' => 12812,
                  'endTokenPos' => 2793,
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
                  'startTokenPos' => 2799,
                  'startFilePos' => 12844,
                  'endTokenPos' => 2799,
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
                  'startTokenPos' => 2805,
                  'startFilePos' => 12880,
                  'endTokenPos' => 2824,
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
                  'startTokenPos' => 2830,
                  'startFilePos' => 12947,
                  'endTokenPos' => 2849,
                  'endFilePos' => 13044,
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