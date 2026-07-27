<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\AnalyticsController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\AnalyticsController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-932734b7b23132882d64a43545ae91e0e2cb83cfaca715a21c4027f1ec69600a',
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
    'endLine' => 397,
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
        'endLine' => 231,
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
            'startLine' => 233,
            'endLine' => 233,
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
            'startLine' => 233,
            'endLine' => 233,
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
            'startLine' => 233,
            'endLine' => 233,
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
        'startLine' => 233,
        'endLine' => 284,
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
            'startLine' => 298,
            'endLine' => 298,
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
                  'startLine' => 290,
                  'endLine' => 290,
                  'startTokenPos' => 2168,
                  'startFilePos' => 12498,
                  'endTokenPos' => 2168,
                  'endFilePos' => 12520,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 291,
                  'endLine' => 291,
                  'startTokenPos' => 2174,
                  'startFilePos' => 12537,
                  'endTokenPos' => 2176,
                  'endFilePos' => 12549,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar CSV\'',
                'attributes' => 
                array (
                  'startLine' => 292,
                  'endLine' => 292,
                  'startTokenPos' => 2182,
                  'startFilePos' => 12569,
                  'endTokenPos' => 2182,
                  'endFilePos' => 12582,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 293,
                  'endLine' => 293,
                  'startTokenPos' => 2188,
                  'startFilePos' => 12603,
                  'endTokenPos' => 2207,
                  'endFilePos' => 12648,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro CSV descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 294,
                  'endLine' => 296,
                  'startTokenPos' => 2213,
                  'startFilePos' => 12670,
                  'endTokenPos' => 2232,
                  'endFilePos' => 12766,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
 */',
        'startLine' => 289,
        'endLine' => 341,
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
            'startLine' => 355,
            'endLine' => 355,
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
                  'startLine' => 347,
                  'endLine' => 347,
                  'startTokenPos' => 2571,
                  'startFilePos' => 14680,
                  'endTokenPos' => 2571,
                  'endFilePos' => 14702,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 348,
                  'endLine' => 348,
                  'startTokenPos' => 2577,
                  'startFilePos' => 14719,
                  'endTokenPos' => 2579,
                  'endFilePos' => 14731,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar PDF\'',
                'attributes' => 
                array (
                  'startLine' => 349,
                  'endLine' => 349,
                  'startTokenPos' => 2585,
                  'startFilePos' => 14751,
                  'endTokenPos' => 2585,
                  'endFilePos' => 14764,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 350,
                  'endLine' => 350,
                  'startTokenPos' => 2591,
                  'startFilePos' => 14785,
                  'endTokenPos' => 2610,
                  'endFilePos' => 14830,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro PDF descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 351,
                  'endLine' => 353,
                  'startTokenPos' => 2616,
                  'startFilePos' => 14852,
                  'endTokenPos' => 2635,
                  'endFilePos' => 14948,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato PDF via DOMPDF.
 */',
        'startLine' => 346,
        'endLine' => 371,
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
            'startLine' => 385,
            'endLine' => 385,
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
                  'startLine' => 377,
                  'endLine' => 377,
                  'startTokenPos' => 2778,
                  'startFilePos' => 15632,
                  'endTokenPos' => 2778,
                  'endFilePos' => 15656,
                ),
              ),
              'tags' => 
              array (
                'code' => '[\'Analytics\']',
                'attributes' => 
                array (
                  'startLine' => 378,
                  'endLine' => 378,
                  'startTokenPos' => 2784,
                  'startFilePos' => 15673,
                  'endTokenPos' => 2786,
                  'endFilePos' => 15685,
                ),
              ),
              'summary' => 
              array (
                'code' => '\'Exportar Excel\'',
                'attributes' => 
                array (
                  'startLine' => 379,
                  'endLine' => 379,
                  'startTokenPos' => 2792,
                  'startFilePos' => 15705,
                  'endTokenPos' => 2792,
                  'endFilePos' => 15720,
                ),
              ),
              'security' => 
              array (
                'code' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'attributes' => 
                array (
                  'startLine' => 380,
                  'endLine' => 380,
                  'startTokenPos' => 2798,
                  'startFilePos' => 15741,
                  'endTokenPos' => 2817,
                  'endFilePos' => 15786,
                ),
              ),
              'responses' => 
              array (
                'code' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro XLSX descarregado\')]',
                'attributes' => 
                array (
                  'startLine' => 381,
                  'endLine' => 383,
                  'startTokenPos' => 2823,
                  'startFilePos' => 15808,
                  'endTokenPos' => 2842,
                  'endFilePos' => 15905,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Exporta o relatório de tickets em formato Excel (.xlsx).
 */',
        'startLine' => 376,
        'endLine' => 396,
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