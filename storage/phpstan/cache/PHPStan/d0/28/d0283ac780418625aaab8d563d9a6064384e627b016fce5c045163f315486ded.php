<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Exports\TicketsExport.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Exports\TicketsExport
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-9629631b126f272fcfaa98b476b34fdaf127ad3d0b4012ce5805995729a1c13e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Exports\\TicketsExport',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Exports/TicketsExport.php',
      ),
    ),
    'namespace' => 'App\\Exports',
    'name' => 'App\\Exports\\TicketsExport',
    'shortName' => 'TicketsExport',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Classe de exportação para ficheiro Excel utilizando o pacote Maatwebsite/Excel.
 * Implementa FromQuery para processar os dados em modo streaming,
 * evitando problemas de memória com grandes volumes de registos.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 98,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
      1 => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
      2 => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
      3 => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
      4 => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
      5 => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
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
      'query' => 
      array (
        'name' => 'query',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Builder',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Query base para a exportação. Utiliza cursor-friendly eager loading mínimo.
 */',
        'startLine' => 25,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exports',
        'declaringClassName' => 'App\\Exports\\TicketsExport',
        'implementingClassName' => 'App\\Exports\\TicketsExport',
        'currentClassName' => 'App\\Exports\\TicketsExport',
        'aliasName' => NULL,
      ),
      'headings' => 
      array (
        'name' => 'headings',
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
        'docComment' => '/**
 * Define o cabeçalho da folha de cálculo.
 */',
        'startLine' => 40,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exports',
        'declaringClassName' => 'App\\Exports\\TicketsExport',
        'implementingClassName' => 'App\\Exports\\TicketsExport',
        'currentClassName' => 'App\\Exports\\TicketsExport',
        'aliasName' => NULL,
      ),
      'map' => 
      array (
        'name' => 'map',
        'parameters' => 
        array (
          'ticket' => 
          array (
            'name' => 'ticket',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 60,
            'endLine' => 60,
            'startColumn' => 25,
            'endColumn' => 31,
            'parameterIndex' => 0,
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
        'docComment' => '/**
 * Mapeia cada registo Eloquent para uma linha da folha de cálculo.
 */',
        'startLine' => 60,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exports',
        'declaringClassName' => 'App\\Exports\\TicketsExport',
        'implementingClassName' => 'App\\Exports\\TicketsExport',
        'currentClassName' => 'App\\Exports\\TicketsExport',
        'aliasName' => NULL,
      ),
      'title' => 
      array (
        'name' => 'title',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Título da folha no ficheiro Excel.
 */',
        'startLine' => 80,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exports',
        'declaringClassName' => 'App\\Exports\\TicketsExport',
        'implementingClassName' => 'App\\Exports\\TicketsExport',
        'currentClassName' => 'App\\Exports\\TicketsExport',
        'aliasName' => NULL,
      ),
      'styles' => 
      array (
        'name' => 'styles',
        'parameters' => 
        array (
          'sheet' => 
          array (
            'name' => 'sheet',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 88,
            'endLine' => 88,
            'startColumn' => 28,
            'endColumn' => 43,
            'parameterIndex' => 0,
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
        'docComment' => '/**
 * Aplica estilos à folha – cabeçalho em negrito com fundo azul escuro.
 */',
        'startLine' => 88,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Exports',
        'declaringClassName' => 'App\\Exports\\TicketsExport',
        'implementingClassName' => 'App\\Exports\\TicketsExport',
        'currentClassName' => 'App\\Exports\\TicketsExport',
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