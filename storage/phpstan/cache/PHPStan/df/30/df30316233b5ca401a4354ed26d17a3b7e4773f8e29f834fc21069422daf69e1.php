<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Response.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\Response
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-e016e789f02fea430ae945e5239bf7c6ba37c6de9c08b466122b49bc56d9f72c-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\Response',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Response.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\Response',
    'shortName' => 'Response',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Describes a single response from an API Operation, including design-time,
 * static links to operations based on the response.
 *
 * @see [Response Object](https://spec.openapis.org/oas/v3.1.1.html#response-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 129,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'OpenApi\\Annotations\\AbstractAnnotation',
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
      'ref' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'ref',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 46,
            'startFilePos' => 660,
            'endTokenPos' => 48,
            'endFilePos' => 679,
          ),
        ),
        'docComment' => '/**
 * The relative or absolute path to a response.
 *
 * @see [Reference Object](https://spec.openapis.org/oas/v3.1.1.html#reference-object)
 *
 * @var string|class-string|object
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'response' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'response',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 38,
            'endLine' => 38,
            'startTokenPos' => 59,
            'startFilePos' => 859,
            'endTokenPos' => 61,
            'endFilePos' => 878,
          ),
        ),
        'docComment' => '/**
 * The key into Operations->responses array.
 *
 * A HTTP status code or <code>default</code>.
 *
 * @var string|int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 38,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'description',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 47,
            'startTokenPos' => 72,
            'startFilePos' => 1068,
            'endTokenPos' => 74,
            'endFilePos' => 1087,
          ),
        ),
        'docComment' => '/**
 * A short description of the response.
 *
 * CommonMark syntax may be used for rich text representation.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'headers' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'headers',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 60,
            'endLine' => 60,
            'startTokenPos' => 85,
            'startFilePos' => 1441,
            'endTokenPos' => 87,
            'endFilePos' => 1460,
          ),
        ),
        'docComment' => '/**
 * Maps a header name to its definition.
 *
 * RFC7230 states header names are case-insensitive.
 *
 * If a response header is defined with the name "Content-Type", it shall be ignored.
 *
 * @see [RFC7230](https://tools.ietf.org/html/rfc7230#page-22)
 *
 * @var list<Header>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 60,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'content' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'content',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 72,
            'endLine' => 72,
            'startTokenPos' => 98,
            'startFilePos' => 1934,
            'endTokenPos' => 100,
            'endFilePos' => 1953,
          ),
        ),
        'docComment' => '/**
 * A map containing descriptions of potential response payloads.
 *
 * The key is a media type or media type range and the value describes it.
 *
 * For responses that match multiple keys, only the most specific key is applicable;
 * e.g. <code>text/plain</code> overrides <code>text/*</code>.
 *
 * @var MediaType|JsonContent|XmlContent|Attachable|array<MediaType|JsonContent|XmlContent|Attachable>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 72,
        'endLine' => 72,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'links' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => 'links',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 82,
            'endLine' => 82,
            'startTokenPos' => 111,
            'startFilePos' => 2235,
            'endTokenPos' => 113,
            'endFilePos' => 2254,
          ),
        ),
        'docComment' => '/**
 * A map of operations links that can be followed from the response.
 *
 * The key of the map is a short name for the link, following the naming constraints of the names for Component
 * Objects.
 *
 * @var list<Link>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 82,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'description\' => \'string\']',
          'attributes' => 
          array (
            'startLine' => 87,
            'endLine' => 89,
            'startTokenPos' => 126,
            'startFilePos' => 2321,
            'endTokenPos' => 135,
            'endFilePos' => 2362,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 87,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_nested' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\MediaType::class => [\'content\', \'mediaType\'], \\OpenApi\\Annotations\\Header::class => [\'headers\', \'header\'], \\OpenApi\\Annotations\\Link::class => [\'links\', \'link\'], \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 94,
            'endLine' => 99,
            'startTokenPos' => 148,
            'startFilePos' => 2430,
            'endTokenPos' => 203,
            'endFilePos' => 2626,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 94,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_parents' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Components::class, \\OpenApi\\Annotations\\Operation::class, \\OpenApi\\Annotations\\Get::class, \\OpenApi\\Annotations\\Post::class, \\OpenApi\\Annotations\\Put::class, \\OpenApi\\Annotations\\Patch::class, \\OpenApi\\Annotations\\Delete::class, \\OpenApi\\Annotations\\Head::class, \\OpenApi\\Annotations\\Options::class, \\OpenApi\\Annotations\\Trace::class]',
          'attributes' => 
          array (
            'startLine' => 104,
            'endLine' => 115,
            'startTokenPos' => 216,
            'startFilePos' => 2695,
            'endTokenPos' => 268,
            'endFilePos' => 2927,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 104,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'validate' => 
      array (
        'name' => 'validate',
        'parameters' => 
        array (
          'analysis' => 
          array (
            'name' => 'analysis',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 118,
                'endLine' => 118,
                'startTokenPos' => 288,
                'startFilePos' => 2999,
                'endTokenPos' => 288,
                'endFilePos' => 3002,
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
                      'name' => 'OpenApi\\Analysis',
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
            'startLine' => 118,
            'endLine' => 118,
            'startColumn' => 30,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'version' => 
          array (
            'name' => 'version',
            'default' => 
            array (
              'code' => '\\OpenApi\\Annotations\\OpenApi::DEFAULT_VERSION',
              'attributes' => 
              array (
                'startLine' => 118,
                'endLine' => 118,
                'startTokenPos' => 297,
                'startFilePos' => 3023,
                'endTokenPos' => 299,
                'endFilePos' => 3046,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 118,
            'endLine' => 118,
            'startColumn' => 58,
            'endColumn' => 99,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'context' => 
          array (
            'name' => 'context',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 118,
                'endLine' => 118,
                'startTokenPos' => 309,
                'startFilePos' => 3068,
                'endTokenPos' => 309,
                'endFilePos' => 3071,
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
                      'name' => 'object',
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
            'startLine' => 118,
            'endLine' => 118,
            'startColumn' => 102,
            'endColumn' => 124,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'Override',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 117,
        'endLine' => 128,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Response',
        'implementingClassName' => 'OpenApi\\Annotations\\Response',
        'currentClassName' => 'OpenApi\\Annotations\\Response',
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