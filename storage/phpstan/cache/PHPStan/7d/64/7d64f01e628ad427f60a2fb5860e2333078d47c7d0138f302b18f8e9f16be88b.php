<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\OpenApi\OpenApiSpec.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\OpenApi\OpenApiSpec
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-ec44841cea6ac5139c773ef6d92c9a23278006984fc466a2dcf0488d3303415f',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\OpenApi\\OpenApiSpec',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/OpenApi/OpenApiSpec.php',
      ),
    ),
    'namespace' => 'App\\OpenApi',
    'name' => 'App\\OpenApi\\OpenApiSpec',
    'shortName' => 'OpenApiSpec',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
      0 => 
      array (
        'name' => 'OpenApi\\Attributes\\Info',
        'isRepeated' => false,
        'arguments' => 
        array (
          'title' => 
          array (
            'code' => '\'Gestão de Avarias API\'',
            'attributes' => 
            array (
              'startLine' => 8,
              'endLine' => 8,
              'startTokenPos' => 23,
              'startFilePos' => 84,
              'endTokenPos' => 23,
              'endFilePos' => 107,
            ),
          ),
          'version' => 
          array (
            'code' => '\'1.0.0\'',
            'attributes' => 
            array (
              'startLine' => 9,
              'endLine' => 9,
              'startTokenPos' => 29,
              'startFilePos' => 123,
              'endTokenPos' => 29,
              'endFilePos' => 129,
            ),
          ),
          'description' => 
          array (
            'code' => '\'Documentação OpenAPI da aplicação de gestão de tickets, equipamentos, auditoria e relatórios.\'',
            'attributes' => 
            array (
              'startLine' => 10,
              'endLine' => 10,
              'startTokenPos' => 35,
              'startFilePos' => 149,
              'endTokenPos' => 35,
              'endFilePos' => 249,
            ),
          ),
        ),
      ),
      1 => 
      array (
        'name' => 'OpenApi\\Attributes\\Server',
        'isRepeated' => false,
        'arguments' => 
        array (
          'url' => 
          array (
            'code' => '\'/\'',
            'attributes' => 
            array (
              'startLine' => 12,
              'endLine' => 12,
              'startTokenPos' => 46,
              'startFilePos' => 271,
              'endTokenPos' => 46,
              'endFilePos' => 273,
            ),
          ),
        ),
      ),
      2 => 
      array (
        'name' => 'OpenApi\\Attributes\\SecurityScheme',
        'isRepeated' => true,
        'arguments' => 
        array (
          'securityScheme' => 
          array (
            'code' => '\'X-Auth-Token\'',
            'attributes' => 
            array (
              'startLine' => 14,
              'endLine' => 14,
              'startTokenPos' => 57,
              'startFilePos' => 318,
              'endTokenPos' => 57,
              'endFilePos' => 331,
            ),
          ),
          'type' => 
          array (
            'code' => '\'apiKey\'',
            'attributes' => 
            array (
              'startLine' => 15,
              'endLine' => 15,
              'startTokenPos' => 63,
              'startFilePos' => 344,
              'endTokenPos' => 63,
              'endFilePos' => 351,
            ),
          ),
          'in' => 
          array (
            'code' => '\'header\'',
            'attributes' => 
            array (
              'startLine' => 16,
              'endLine' => 16,
              'startTokenPos' => 69,
              'startFilePos' => 362,
              'endTokenPos' => 69,
              'endFilePos' => 369,
            ),
          ),
          'name' => 
          array (
            'code' => '\'X-Auth-Token\'',
            'attributes' => 
            array (
              'startLine' => 17,
              'endLine' => 17,
              'startTokenPos' => 75,
              'startFilePos' => 382,
              'endTokenPos' => 75,
              'endFilePos' => 395,
            ),
          ),
        ),
      ),
      3 => 
      array (
        'name' => 'OpenApi\\Attributes\\SecurityScheme',
        'isRepeated' => true,
        'arguments' => 
        array (
          'securityScheme' => 
          array (
            'code' => '\'BearerAuth\'',
            'attributes' => 
            array (
              'startLine' => 20,
              'endLine' => 20,
              'startTokenPos' => 87,
              'startFilePos' => 441,
              'endTokenPos' => 87,
              'endFilePos' => 452,
            ),
          ),
          'type' => 
          array (
            'code' => '\'http\'',
            'attributes' => 
            array (
              'startLine' => 21,
              'endLine' => 21,
              'startTokenPos' => 93,
              'startFilePos' => 465,
              'endTokenPos' => 93,
              'endFilePos' => 470,
            ),
          ),
          'scheme' => 
          array (
            'code' => '\'bearer\'',
            'attributes' => 
            array (
              'startLine' => 22,
              'endLine' => 22,
              'startTokenPos' => 99,
              'startFilePos' => 485,
              'endTokenPos' => 99,
              'endFilePos' => 492,
            ),
          ),
          'bearerFormat' => 
          array (
            'code' => '\'JWT\'',
            'attributes' => 
            array (
              'startLine' => 23,
              'endLine' => 23,
              'startTokenPos' => 105,
              'startFilePos' => 513,
              'endTokenPos' => 105,
              'endFilePos' => 517,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 7,
    'endLine' => 27,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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