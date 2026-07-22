<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/RequestBody.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\RequestBody
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-b81b9171e57eef61ed25e13795ded9e933bcafa084d2813167a0fce570998463-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\RequestBody',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/RequestBody.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\RequestBody',
    'shortName' => 'RequestBody',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Describes a single request body.
 *
 * @see [Request Body Object](https://spec.openapis.org/oas/v3.1.1.html#request-body-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 107,
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
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
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
            'startTokenPos' => 51,
            'startFilePos' => 630,
            'endTokenPos' => 53,
            'endFilePos' => 649,
          ),
        ),
        'docComment' => '/**
 * The relative or absolute path to a request body.
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
      'request' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => 'request',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 64,
            'startFilePos' => 770,
            'endTokenPos' => 66,
            'endFilePos' => 789,
          ),
        ),
        'docComment' => '/**
 * The key into Components->requestBodies array.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
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
            'startTokenPos' => 77,
            'startFilePos' => 1030,
            'endTokenPos' => 79,
            'endFilePos' => 1049,
          ),
        ),
        'docComment' => '/**
 * A brief description of the parameter.
 *
 * This could contain examples of use.
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
      'required' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => 'required',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 57,
            'endLine' => 57,
            'startTokenPos' => 90,
            'startFilePos' => 1355,
            'endTokenPos' => 92,
            'endFilePos' => 1374,
          ),
        ),
        'docComment' => '/**
 * Determines whether this parameter is mandatory.
 *
 * If the parameter location is "path", this property is required and its value must be true.
 * Otherwise, the property may be included and its default value is false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 57,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'content' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => 'content',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 67,
            'endLine' => 67,
            'startTokenPos' => 103,
            'startFilePos' => 1767,
            'endTokenPos' => 105,
            'endFilePos' => 1786,
          ),
        ),
        'docComment' => '/**
 * The content of the request body.
 *
 * The key is a media type or media type range and the value describes it. For requests that match multiple keys,
 * only the most specific key is applicable. e.g. text/plain overrides text/*.
 *
 * @var array<MediaType|JsonContent|XmlContent>|MediaType|JsonContent|XmlContent|Attachable
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 67,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'description\' => \'string\', \'required\' => \'boolean\', \'request\' => \'string\']',
          'attributes' => 
          array (
            'startLine' => 72,
            'endLine' => 76,
            'startTokenPos' => 118,
            'startFilePos' => 1853,
            'endTokenPos' => 141,
            'endFilePos' => 1958,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 72,
        'endLine' => 76,
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
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Components::class, \\OpenApi\\Annotations\\Delete::class, \\OpenApi\\Annotations\\Get::class, \\OpenApi\\Annotations\\Head::class, \\OpenApi\\Annotations\\Operation::class, \\OpenApi\\Annotations\\Options::class, \\OpenApi\\Annotations\\Patch::class, \\OpenApi\\Annotations\\Post::class, \\OpenApi\\Annotations\\Trace::class, \\OpenApi\\Annotations\\Put::class]',
          'attributes' => 
          array (
            'startLine' => 78,
            'endLine' => 89,
            'startTokenPos' => 152,
            'startFilePos' => 1992,
            'endTokenPos' => 204,
            'endFilePos' => 2224,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 78,
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
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\MediaType::class => [\'content\', \'mediaType\'], \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 94,
            'endLine' => 97,
            'startTokenPos' => 217,
            'startFilePos' => 2292,
            'endTokenPos' => 244,
            'endFilePos' => 2398,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 94,
        'endLine' => 97,
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
      'jsonSerialize' => 
      array (
        'name' => 'jsonSerialize',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'stdClass',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 99,
        'endLine' => 106,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\RequestBody',
        'implementingClassName' => 'OpenApi\\Annotations\\RequestBody',
        'currentClassName' => 'OpenApi\\Annotations\\RequestBody',
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