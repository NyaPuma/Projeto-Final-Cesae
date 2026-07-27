<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AnalyticsController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AnalyticsController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-7143abd9e3f23154e42c67565def70a90980414fd0120c1e226502bc3fbc8052',
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
    'endLine' => 394,
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
                  'startFilePos' => 571,
                  'endTokenPos' => 89,
                  'endFilePos' => 588,
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
                  'startFilePos' => 605,
                  'endTokenPos' => 97,
                  'endFilePos' => 617,
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
                  'startFilePos' => 637,
                  'endTokenPos' => 103,
                  'endFilePos' => 654,
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
                  'startFilePos' => 675,
                  'endTokenPos' => 128,
                  'endFilePos' => 720,
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
                  'startFilePos' => 742,
                  'endTokenPos' => 153,
                  'endFilePos' => 827,
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
                  'startFilePos' => 1226,
                  'endTokenPos' => 233,
                  'endFilePos' => 1244,
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
                  'startFilePos' => 1261,
                  'endTokenPos' => 241,
                  'endFilePos' => 1273,
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
                  'startFilePos' => 1293,
                  'endTokenPos' => 247,
                  'endFilePos' => 1315,
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
                  'startFilePos' => 1336,
                  'endTokenPos' => 272,
                  'endFilePos' => 1381,
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
                  'startFilePos' => 1403,
                  'endTokenPos' => 297,
                  'endFilePos' => 1496,
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
        'endLine' => 228,
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
      'buildMonthlySeriesFromDb' => 
      array (
        'name' => 'buildMonthlySeriesFromDb',
        'parameters' => 
        array (
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
            'startLine' => 230,
            'endLine' => 230,
            'startColumn' => 47,
            'endColumn' => 63,
            'parameterIndex' => 0,
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
            'startLine' => 230,
            'endLine' => 230,
            'startColumn' => 66,
            'endColumn' => 88,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'closedStatusId' => 
          array (
            'name' => 'closedStatusId',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'int',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'null',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 230,
            'endLine' => 230,
            'startColumn' => 91,
            'endColumn' => 110,
            'parameterIndex' => 2,
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
        'startLine' => 230,
        'endLine' => 281,
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
            'startLine' => 295,
            'endLine' => 295,
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
                  'startLine' => 287,
                  'endLine' => 287,
                  'startTokenPos' => 2135,
                  'startFilePos' => 12423,
                  'endTokenPos' => 2135,
                  'endFilePos' => 12445,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 288,
                  'endLine' => 288,
                  'startTokenPos' => 2141,
                  'startFilePos' => 12462,
                  'endTokenPos' => 2143,
                  'endFilePos' => 12474,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar CSV\'',
                'attributes' => 
                array (
                  'startLine' => 289,
                  'endLine' => 289,
                  'startTokenPos' => 2149,
                  'startFilePos' => 12494,
                  'endTokenPos' => 2149,
                  'endFilePos' => 12507,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 290,
                  'endLine' => 290,
                  'startTokenPos' => 2155,
                  'startFilePos' => 12528,
                  'endTokenPos' => 2174,
                  'endFilePos' => 12573,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro CSV descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 291,
                  'endLine' => 293,
                  'startTokenPos' => 2180,
                  'startFilePos' => 12595,
                  'endTokenPos' => 2199,
                  'endFilePos' => 12691,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
 */',
        'startLine' => 286,
        'endLine' => 338,
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
            'startLine' => 352,
            'endLine' => 352,
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
                  'startLine' => 344,
                  'endLine' => 344,
                  'startTokenPos' => 2538,
                  'startFilePos' => 14605,
                  'endTokenPos' => 2538,
                  'endFilePos' => 14627,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 345,
                  'endLine' => 345,
                  'startTokenPos' => 2544,
                  'startFilePos' => 14644,
                  'endTokenPos' => 2546,
                  'endFilePos' => 14656,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar PDF\'',
                'attributes' => 
                array (
                  'startLine' => 346,
                  'endLine' => 346,
                  'startTokenPos' => 2552,
                  'startFilePos' => 14676,
                  'endTokenPos' => 2552,
                  'endFilePos' => 14689,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 347,
                  'endLine' => 347,
                  'startTokenPos' => 2558,
                  'startFilePos' => 14710,
                  'endTokenPos' => 2577,
                  'endFilePos' => 14755,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro PDF descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 348,
                  'endLine' => 350,
                  'startTokenPos' => 2583,
                  'startFilePos' => 14777,
                  'endTokenPos' => 2602,
                  'endFilePos' => 14873,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato PDF via DOMPDF.
 */',
        'startLine' => 343,
        'endLine' => 368,
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
            'startLine' => 382,
            'endLine' => 382,
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
                  'startLine' => 374,
                  'endLine' => 374,
                  'startTokenPos' => 2745,
                  'startFilePos' => 15557,
                  'endTokenPos' => 2745,
                  'endFilePos' => 15581,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 375,
                  'endLine' => 375,
                  'startTokenPos' => 2751,
                  'startFilePos' => 15598,
                  'endTokenPos' => 2753,
                  'endFilePos' => 15610,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar Excel\'',
                'attributes' => 
                array (
                  'startLine' => 376,
                  'endLine' => 376,
                  'startTokenPos' => 2759,
                  'startFilePos' => 15630,
                  'endTokenPos' => 2759,
                  'endFilePos' => 15645,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 377,
                  'endLine' => 377,
                  'startTokenPos' => 2765,
                  'startFilePos' => 15666,
                  'endTokenPos' => 2784,
                  'endFilePos' => 15711,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro XLSX descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 378,
                  'endLine' => 380,
                  'startTokenPos' => 2790,
                  'startFilePos' => 15733,
                  'endTokenPos' => 2809,
                  'endFilePos' => 15830,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato Excel (.xlsx).
 */',
        'startLine' => 373,
        'endLine' => 393,
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