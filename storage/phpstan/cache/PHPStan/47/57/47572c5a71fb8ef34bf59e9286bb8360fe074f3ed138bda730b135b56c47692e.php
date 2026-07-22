<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Attributes/MediaType.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Attributes\MediaType
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-a4e3f92b82eeef6501b387b2c19113d7f88c33ec54c1aa339cddc45489c075e8-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Attributes\\MediaType',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Attributes/MediaType.php',
      ),
    ),
    'namespace' => 'OpenApi\\Attributes',
    'name' => 'OpenApi\\Attributes\\MediaType',
    'shortName' => 'MediaType',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
      0 => 
      array (
        'name' => 'Attribute',
        'isRepeated' => false,
        'arguments' => 
        array (
          0 => 
          array (
            'code' => '\\Attribute::TARGET_CLASS',
            'attributes' => 
            array (
              'startLine' => 12,
              'endLine' => 12,
              'startTokenPos' => 33,
              'startFilePos' => 163,
              'endTokenPos' => 35,
              'endFilePos' => 186,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 12,
    'endLine' => 40,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'OpenApi\\Annotations\\MediaType',
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'mediaType' => 
          array (
            'name' => 'mediaType',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 22,
                'endLine' => 22,
                'startTokenPos' => 65,
                'startFilePos' => 499,
                'endTokenPos' => 65,
                'endFilePos' => 502,
              ),
            ),
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
                      'name' => 'string',
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
            'startLine' => 22,
            'endLine' => 22,
            'startColumn' => 9,
            'endColumn' => 33,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'schema' => 
          array (
            'name' => 'schema',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 23,
                'endLine' => 23,
                'startTokenPos' => 75,
                'startFilePos' => 531,
                'endTokenPos' => 75,
                'endFilePos' => 534,
              ),
            ),
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
                      'name' => 'OpenApi\\Attributes\\Schema',
                      'isIdentifier' => false,
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
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 9,
            'endColumn' => 30,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'example' => 
          array (
            'name' => 'example',
            'default' => 
            array (
              'code' => '\\OpenApi\\Undefined::UNDEFINED',
              'attributes' => 
              array (
                'startLine' => 24,
                'endLine' => 24,
                'startTokenPos' => 84,
                'startFilePos' => 562,
                'endTokenPos' => 86,
                'endFilePos' => 581,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
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
            'startColumn' => 9,
            'endColumn' => 45,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'examples' => 
          array (
            'name' => 'examples',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 25,
                'endLine' => 25,
                'startTokenPos' => 96,
                'startFilePos' => 611,
                'endTokenPos' => 96,
                'endFilePos' => 614,
              ),
            ),
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
                      'name' => 'array',
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
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'encoding' => 
          array (
            'name' => 'encoding',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 26,
                'endLine' => 26,
                'startTokenPos' => 106,
                'startFilePos' => 644,
                'endTokenPos' => 106,
                'endFilePos' => 647,
              ),
            ),
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
                      'name' => 'array',
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
            'startLine' => 26,
            'endLine' => 26,
            'startColumn' => 9,
            'endColumn' => 31,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'x' => 
          array (
            'name' => 'x',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 29,
                'endLine' => 29,
                'startTokenPos' => 118,
                'startFilePos' => 702,
                'endTokenPos' => 118,
                'endFilePos' => 705,
              ),
            ),
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
                      'name' => 'array',
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
            'startLine' => 29,
            'endLine' => 29,
            'startColumn' => 9,
            'endColumn' => 24,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
          'attachables' => 
          array (
            'name' => 'attachables',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 30,
                'endLine' => 30,
                'startTokenPos' => 128,
                'startFilePos' => 738,
                'endTokenPos' => 128,
                'endFilePos' => 741,
              ),
            ),
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
                      'name' => 'array',
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
            'startLine' => 30,
            'endLine' => 30,
            'startColumn' => 9,
            'endColumn' => 34,
            'parameterIndex' => 6,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param array<Examples>          $examples
 * @param list<Encoding>           $encoding
 * @param array<string,mixed>|null $x
 * @param list<Attachable>|null    $attachables
 */',
        'startLine' => 21,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Attributes',
        'declaringClassName' => 'OpenApi\\Attributes\\MediaType',
        'implementingClassName' => 'OpenApi\\Attributes\\MediaType',
        'currentClassName' => 'OpenApi\\Attributes\\MediaType',
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