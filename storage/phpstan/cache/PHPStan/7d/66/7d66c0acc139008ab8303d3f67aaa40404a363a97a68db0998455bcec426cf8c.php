<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Operation.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\Operation
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-1a729fc908935b93f6276d8e2aa867aa470d6fc0cd641be8a4405d80a20bb17e-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\Operation',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Operation.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\Operation',
    'shortName' => 'Operation',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Base class for <code>@OA\\Get</code>,  <code>@OA\\Post</code>,  <code>@OA\\Put</code>,  etc.
 *
 * Describes a single API operation on a path.
 *
 * @see [Operation Object](https://spec.openapis.org/oas/v3.1.1.html#operation-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 22,
    'endLine' => 240,
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
      'path' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'path',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 57,
            'startFilePos' => 608,
            'endTokenPos' => 59,
            'endFilePos' => 627,
          ),
        ),
        'docComment' => '/**
 * Key in the OpenApi "Paths Object" for this operation.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'tags' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'tags',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 38,
            'endLine' => 38,
            'startTokenPos' => 70,
            'startFilePos' => 854,
            'endTokenPos' => 72,
            'endFilePos' => 873,
          ),
        ),
        'docComment' => '/**
 * A list of tags for API documentation control.
 *
 * Tags can be used for logical grouping of operations by resources or any other qualifier.
 *
 * @var list<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 38,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'method' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'method',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 47,
            'startTokenPos' => 83,
            'startFilePos' => 1106,
            'endTokenPos' => 85,
            'endFilePos' => 1125,
          ),
        ),
        'docComment' => '/**
 * Key in the OpenApi "Path Item Object" for this operation.
 *
 * Allowed values: \'get\', \'post\', put\', \'patch\', \'delete\', \'options\', \'head\' and \'trace\'.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'summary' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'summary',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 54,
            'endLine' => 54,
            'startTokenPos' => 96,
            'startFilePos' => 1244,
            'endTokenPos' => 98,
            'endFilePos' => 1263,
          ),
        ),
        'docComment' => '/**
 * A short summary of what the operation does.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 54,
        'endLine' => 54,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'description',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 63,
            'endLine' => 63,
            'startTokenPos' => 109,
            'startFilePos' => 1465,
            'endTokenPos' => 111,
            'endFilePos' => 1484,
          ),
        ),
        'docComment' => '/**
 * A verbose explanation of the operation behavior.
 *
 * CommonMark syntax MAY be used for rich text representation.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 63,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'externalDocs' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'externalDocs',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 70,
            'endLine' => 70,
            'startTokenPos' => 122,
            'startFilePos' => 1633,
            'endTokenPos' => 124,
            'endFilePos' => 1652,
          ),
        ),
        'docComment' => '/**
 * Additional external documentation for this operation.
 *
 * @var ExternalDocumentation
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 70,
        'endLine' => 70,
        'startColumn' => 5,
        'endColumn' => 48,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'operationId' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'operationId',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 81,
            'endLine' => 81,
            'startTokenPos' => 135,
            'startFilePos' => 2027,
            'endTokenPos' => 137,
            'endFilePos' => 2046,
          ),
        ),
        'docComment' => '/**
 * Unique string used to identify the operation.
 *
 * The id must be unique among all operations described in the API.
 * Tools and libraries may use the operationId to uniquely identify an operation, therefore, it is recommended to
 * follow common programming naming conventions.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 81,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'parameters' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'parameters',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 96,
            'endLine' => 96,
            'startTokenPos' => 148,
            'startFilePos' => 2607,
            'endTokenPos' => 150,
            'endFilePos' => 2626,
          ),
        ),
        'docComment' => '/**
 * A list of parameters that are applicable for this operation.
 *
 * If a parameter is already defined at the Path Item, the new definition will override it but can never remove it.
 * The list must not include duplicated parameters.
 *
 * A unique parameter is defined by a combination of a name and location.
 *
 * The list can use the Reference Object to link to parameters that are defined at the OpenAPI Object\'s
 * components/parameters.
 *
 * @var list<Parameter>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 96,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'requestBody' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'requestBody',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 107,
            'endLine' => 107,
            'startTokenPos' => 161,
            'startFilePos' => 3018,
            'endTokenPos' => 163,
            'endFilePos' => 3037,
          ),
        ),
        'docComment' => '/**
 * The request body applicable for this operation.
 *
 * The requestBody is only supported in HTTP methods where the HTTP 1.1 specification RFC7231 has explicitly
 * defined semantics for request bodies. In other cases where the HTTP spec is vague, requestBody shall be ignored
 * by consumers.
 *
 * @var RequestBody
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 107,
        'endLine' => 107,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'responses' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'responses',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 114,
            'endLine' => 114,
            'startTokenPos' => 174,
            'startFilePos' => 3205,
            'endTokenPos' => 176,
            'endFilePos' => 3224,
          ),
        ),
        'docComment' => '/**
 * The list of possible responses as they are returned from executing this operation.
 *
 * @var list<Response>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 114,
        'endLine' => 114,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'callbacks' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'callbacks',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 127,
            'endLine' => 127,
            'startTokenPos' => 187,
            'startFilePos' => 3757,
            'endTokenPos' => 189,
            'endFilePos' => 3776,
          ),
        ),
        'docComment' => '/**
 * A map of possible out-of band callbacks related to the parent operation.
 *
 * The key is a unique identifier for the Callback Object.
 *
 * Each value in the map is a Callback Object that describes a request that may be initiated by the API provider
 * and the expected responses. The key value used to identify the callback object is an expression, evaluated at
 * runtime, that identifies a URL to use for the callback operation.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 127,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'deprecated' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'deprecated',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 138,
            'endLine' => 138,
            'startTokenPos' => 200,
            'startFilePos' => 4009,
            'endTokenPos' => 202,
            'endFilePos' => 4028,
          ),
        ),
        'docComment' => '/**
 * Declares this operation to be deprecated.
 *
 * Consumers should refrain from usage of the declared operation.
 *
 * Default value is false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 138,
        'endLine' => 138,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'security' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'security',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 152,
            'endLine' => 152,
            'startTokenPos' => 213,
            'startFilePos' => 4535,
            'endTokenPos' => 215,
            'endFilePos' => 4554,
          ),
        ),
        'docComment' => '/**
 * A declaration of which security mechanisms can be used for this operation.
 *
 * The list of values includes alternative security requirement objects that can be used.
 *
 * Only one of the security requirement objects need to be satisfied to authorize a request.
 *
 * This definition overrides any declared top-level security.
 * To remove a top-level security declaration, an empty array can be used.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 152,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'servers' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => 'servers',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 162,
            'endLine' => 162,
            'startTokenPos' => 226,
            'startFilePos' => 4832,
            'endTokenPos' => 228,
            'endFilePos' => 4851,
          ),
        ),
        'docComment' => '/**
 * An alternative server array to service this operation.
 *
 * If an alternative server object is specified at the Path Item Object or Root level, it will be overridden by
 * this value.
 *
 * @var list<Server>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 162,
        'endLine' => 162,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_required' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => '_required',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'responses\']',
          'attributes' => 
          array (
            'startLine' => 167,
            'endLine' => 167,
            'startTokenPos' => 241,
            'startFilePos' => 4921,
            'endTokenPos' => 243,
            'endFilePos' => 4933,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 167,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'path\' => \'string\', \'method\' => \'string\', \'tags\' => \'[string]\', \'summary\' => \'string\', \'description\' => \'string\', \'deprecated\' => \'boolean\']',
          'attributes' => 
          array (
            'startLine' => 172,
            'endLine' => 179,
            'startTokenPos' => 256,
            'startFilePos' => 5000,
            'endTokenPos' => 300,
            'endFilePos' => 5195,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 172,
        'endLine' => 179,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Parameter::class => [\'parameters\'], \\OpenApi\\Annotations\\PathParameter::class => [\'parameters\'], \\OpenApi\\Annotations\\Response::class => [\'responses\', \'response\'], \\OpenApi\\Annotations\\ExternalDocumentation::class => \'externalDocs\', \\OpenApi\\Annotations\\Server::class => [\'servers\'], \\OpenApi\\Annotations\\RequestBody::class => \'requestBody\', \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 184,
            'endLine' => 192,
            'startTokenPos' => 313,
            'startFilePos' => 5263,
            'endTokenPos' => 391,
            'endFilePos' => 5600,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 184,
        'endLine' => 192,
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
        'startLine' => 194,
        'endLine' => 209,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'currentClassName' => 'OpenApi\\Annotations\\Operation',
        'aliasName' => NULL,
      ),
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
                'startLine' => 212,
                'endLine' => 212,
                'startTokenPos' => 518,
                'startFilePos' => 6111,
                'endTokenPos' => 518,
                'endFilePos' => 6114,
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
            'startLine' => 212,
            'endLine' => 212,
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
                'startLine' => 212,
                'endLine' => 212,
                'startTokenPos' => 527,
                'startFilePos' => 6135,
                'endTokenPos' => 529,
                'endFilePos' => 6158,
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
            'startLine' => 212,
            'endLine' => 212,
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
                'startLine' => 212,
                'endLine' => 212,
                'startTokenPos' => 539,
                'startFilePos' => 6180,
                'endTokenPos' => 539,
                'endFilePos' => 6183,
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
            'startLine' => 212,
            'endLine' => 212,
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
        'startLine' => 211,
        'endLine' => 239,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Operation',
        'implementingClassName' => 'OpenApi\\Annotations\\Operation',
        'currentClassName' => 'OpenApi\\Annotations\\Operation',
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