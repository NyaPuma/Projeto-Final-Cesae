<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/MediaType.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\MediaType
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-a2f0af791528d1e224b9468d6eefcc07a5212a05185bf2dabed75ce9003f13eb-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\MediaType',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/MediaType.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\MediaType',
    'shortName' => 'MediaType',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Each Media Type object provides schema and examples for the media type identified by its key.
 *
 * Parameter encodings can be set either here, or on nested `Property` annotations directly.
 *
 * @see [Media Type Object](https://spec.openapis.org/oas/v3.1.1.html#media-type-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 103,
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
      'mediaType' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => 'mediaType',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 27,
            'startTokenPos' => 41,
            'startFilePos' => 588,
            'endTokenPos' => 43,
            'endFilePos' => 607,
          ),
        ),
        'docComment' => '/**
 * The key into Operation->content array.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'schema' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => 'schema',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 54,
            'startFilePos' => 737,
            'endTokenPos' => 56,
            'endFilePos' => 756,
          ),
        ),
        'docComment' => '/**
 * The schema defining the type used for the request body.
 *
 * @var Schema
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'example' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => 'example',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 47,
            'startTokenPos' => 67,
            'startFilePos' => 1180,
            'endTokenPos' => 69,
            'endFilePos' => 1199,
          ),
        ),
        'docComment' => '/**
 * Example of the media type.
 *
 * The example object should be in the correct format as specified by the media type.
 * The example object is mutually exclusive of the examples object.
 *
 * Furthermore, if referencing a schema which contains an example,
 * the example value shall override the example provided by the schema.
 *
 * @var mixed
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'examples' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => 'examples',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 58,
            'endLine' => 58,
            'startTokenPos' => 80,
            'startFilePos' => 1637,
            'endTokenPos' => 82,
            'endFilePos' => 1656,
          ),
        ),
        'docComment' => '/**
 * Examples of the media type.
 *
 * Each example should contain a value in the correct format as specified in the parameter encoding.
 * The examples object is mutually exclusive of the example object.
 * Furthermore, if referencing a schema which contains an example, the examples value shall override the example provided by the schema.
 *
 * @var array<Examples>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 58,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'encoding' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => 'encoding',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 70,
            'endLine' => 70,
            'startTokenPos' => 93,
            'startFilePos' => 2040,
            'endTokenPos' => 95,
            'endFilePos' => 2059,
          ),
        ),
        'docComment' => '/**
 * A map between a property name and its encoding information.
 *
 * The key, being the property name, must exist in the schema as a property.
 *
 * The encoding object shall only apply to requestBody objects when the media type is multipart or
 * application/x-www-form-urlencoded.
 *
 * @var list<Encoding>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 70,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_nested' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Schema::class => \'schema\', \\OpenApi\\Annotations\\Examples::class => [\'examples\', \'example\'], \\OpenApi\\Annotations\\Encoding::class => [\'encoding\', \'property\'], \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 75,
            'endLine' => 80,
            'startTokenPos' => 108,
            'startFilePos' => 2127,
            'endTokenPos' => 158,
            'endFilePos' => 2319,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 75,
        'endLine' => 80,
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
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Response::class, \\OpenApi\\Annotations\\RequestBody::class]',
          'attributes' => 
          array (
            'startLine' => 85,
            'endLine' => 88,
            'startTokenPos' => 171,
            'startFilePos' => 2388,
            'endTokenPos' => 183,
            'endFilePos' => 2447,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 85,
        'endLine' => 88,
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
      'encodingCompat' => 
      array (
        'name' => 'encodingCompat',
        'parameters' => 
        array (
          'encoding' => 
          array (
            'name' => 'encoding',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 39,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'factory' => 
          array (
            'name' => 'factory',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'callable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 90,
            'endLine' => 90,
            'startColumn' => 50,
            'endColumn' => 66,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 90,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\MediaType',
        'implementingClassName' => 'OpenApi\\Annotations\\MediaType',
        'currentClassName' => 'OpenApi\\Annotations\\MediaType',
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