<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Parameter.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\Parameter
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-707d82c959bd052f12012b6a9b01430f1f0897431ec22e67d2dbb7267c79a806-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\Parameter',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Parameter.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\Parameter',
    'shortName' => 'Parameter',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Describes a single operation parameter.
 *
 * A unique parameter is defined by a combination of a name and location.
 *
 * @see [Parameter Object](https://spec.openapis.org/oas/v3.1.1.html#parameter-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 302,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'ref',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 30,
            'startTokenPos' => 46,
            'startFilePos' => 655,
            'endTokenPos' => 48,
            'endFilePos' => 674,
          ),
        ),
        'docComment' => '/**
 * The relative or absolute path to the endpoint.
 *
 * @see [Reference Object](https://spec.openapis.org/oas/v3.1.1.html#reference-object)
 *
 * @var string|class-string|object
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'parameter' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'parameter',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 37,
            'endLine' => 37,
            'startTokenPos' => 59,
            'startFilePos' => 844,
            'endTokenPos' => 61,
            'endFilePos' => 863,
          ),
        ),
        'docComment' => '/**
 * The key into <code>Components::parameters</code> or <code>PathItem::parameters</code> array.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 37,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'name' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'name',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 49,
            'endLine' => 49,
            'startTokenPos' => 72,
            'startFilePos' => 1351,
            'endTokenPos' => 74,
            'endFilePos' => 1370,
          ),
        ),
        'docComment' => '/**
 * The (case-sensitive) name of the parameter.
 *
 * If in is "path", the name field must correspond to the associated path segment from the path field in the Paths Object.
 *
 * If in is "header" and the name field is "Accept", "Content-Type" or "Authorization", the parameter definition shall be ignored.
 * For all other cases, the name corresponds to the parameter name used by the in property.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 49,
        'endLine' => 49,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'in' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'in',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 58,
            'endLine' => 58,
            'startTokenPos' => 85,
            'startFilePos' => 1544,
            'endTokenPos' => 87,
            'endFilePos' => 1563,
          ),
        ),
        'docComment' => '/**
 * The location of the parameter.
 *
 * Possible values are "query", "header", "path" or "cookie".
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 58,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 38,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'description',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 69,
            'endLine' => 69,
            'startTokenPos' => 98,
            'startFilePos' => 1804,
            'endTokenPos' => 100,
            'endFilePos' => 1823,
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
        'startLine' => 69,
        'endLine' => 69,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'required',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 79,
            'endLine' => 79,
            'startTokenPos' => 111,
            'startFilePos' => 2129,
            'endTokenPos' => 113,
            'endFilePos' => 2148,
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
        'startLine' => 79,
        'endLine' => 79,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'deprecated' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'deprecated',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 86,
            'endLine' => 86,
            'startTokenPos' => 124,
            'startFilePos' => 2306,
            'endTokenPos' => 126,
            'endFilePos' => 2325,
          ),
        ),
        'docComment' => '/**
 * Specifies that a parameter is deprecated and should be transitioned out of usage.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 86,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'allowEmptyValue' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'allowEmptyValue',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 99,
            'endLine' => 99,
            'startTokenPos' => 137,
            'startFilePos' => 2726,
            'endTokenPos' => 139,
            'endFilePos' => 2745,
          ),
        ),
        'docComment' => '/**
 * Sets the ability to pass empty-valued parameters.
 *
 * This is valid only for query parameters and allows sending a parameter with an empty value.
 *
 * Default value is false.
 *
 * If style is used, and if behavior is n/a (cannot be serialized), the value of allowEmptyValue shall be ignored.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 99,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 51,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'style' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'style',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 108,
            'endLine' => 108,
            'startTokenPos' => 150,
            'startFilePos' => 3047,
            'endTokenPos' => 152,
            'endFilePos' => 3066,
          ),
        ),
        'docComment' => '/**
 * Describes how the parameter value will be serialized depending on the type of the parameter value.
 *
 * Default values (based on value of in): for query - form; for path - simple; for header - simple; for cookie - form.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 108,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'explode' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'explode',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 120,
            'endLine' => 120,
            'startTokenPos' => 163,
            'startFilePos' => 3477,
            'endTokenPos' => 165,
            'endFilePos' => 3496,
          ),
        ),
        'docComment' => '/**
 * When this is true, parameter values of type array or object generate separate parameters for each value of the array or key-value pair of the map.
 *
 * For other types of parameters this property has no effect.
 *
 * When style is form, the default value is true.
 * For all other styles, the default value is false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 120,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'allowReserved' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'allowReserved',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 131,
            'endLine' => 131,
            'startTokenPos' => 176,
            'startFilePos' => 3854,
            'endTokenPos' => 178,
            'endFilePos' => 3873,
          ),
        ),
        'docComment' => '/**
 * Determines whether the parameter value should allow reserved characters, as defined by RFC3986 :/?#[]@!$&\'()*+,;= to be included without percent-encoding.
 *
 * This property only applies to parameters with an in value of query.
 *
 * The default value is false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 131,
        'endLine' => 131,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'schema' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'schema',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 138,
            'endLine' => 138,
            'startTokenPos' => 189,
            'startFilePos' => 4000,
            'endTokenPos' => 191,
            'endFilePos' => 4019,
          ),
        ),
        'docComment' => '/**
 * The schema defining the type used for the parameter.
 *
 * @var Schema
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 138,
        'endLine' => 138,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'example',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 150,
            'endLine' => 150,
            'startTokenPos' => 202,
            'startFilePos' => 4596,
            'endTokenPos' => 204,
            'endFilePos' => 4615,
          ),
        ),
        'docComment' => '/**
 * Example of the media type.
 *
 * The example should match the specified schema and encoding properties if present.
 * The example object is mutually exclusive of the examples object.
 * Furthermore, if referencing a schema which contains an example, the example value shall override the example provided by the schema.
 * To represent examples of media types that cannot naturally be represented in JSON or YAML, a string value can contain the example with escaping where necessary.
 *
 * @var mixed
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 150,
        'endLine' => 150,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'examples',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 161,
            'endLine' => 161,
            'startTokenPos' => 215,
            'startFilePos' => 5052,
            'endTokenPos' => 217,
            'endFilePos' => 5071,
          ),
        ),
        'docComment' => '/**
 * Examples of the parameter.
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
        'startLine' => 161,
        'endLine' => 161,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'content',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 171,
            'endLine' => 171,
            'startTokenPos' => 228,
            'startFilePos' => 5358,
            'endTokenPos' => 230,
            'endFilePos' => 5377,
          ),
        ),
        'docComment' => '/**
 * A map containing the representations for the parameter.
 *
 * The key is the media type and the value describes it.
 * The map must only contain one entry.
 *
 * @var array<MediaType>|JsonContent|XmlContent|Attachable
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 171,
        'endLine' => 171,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'matrix' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'matrix',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 180,
            'endLine' => 180,
            'startTokenPos' => 241,
            'startFilePos' => 5573,
            'endTokenPos' => 243,
            'endFilePos' => 5592,
          ),
        ),
        'docComment' => '/**
 * Path-style parameters defined by RFC6570.
 *
 * @see [RFC6570](https://tools.ietf.org/html/rfc6570#section-3.2.7)
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 180,
        'endLine' => 180,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'label' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'label',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 189,
            'endLine' => 189,
            'startTokenPos' => 254,
            'startFilePos' => 5788,
            'endTokenPos' => 256,
            'endFilePos' => 5807,
          ),
        ),
        'docComment' => '/**
 * Label style parameters defined by RFC6570.
 *
 * @see [RFC6570](https://tools.ietf.org/html/rfc6570#section-3.2.5)
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 189,
        'endLine' => 189,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'form' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'form',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 200,
            'endLine' => 200,
            'startTokenPos' => 267,
            'startFilePos' => 6143,
            'endTokenPos' => 269,
            'endFilePos' => 6162,
          ),
        ),
        'docComment' => '/**
 * Form style parameters defined by RFC6570.
 *
 * This option replaces collectionFormat with a csv (when explode is false) or multi (when explode is true) value from OpenAPI 2.0.
 *
 * @see [RFC6570](https://tools.ietf.org/html/rfc6570#section-3.2.8)
 *
 * @var mixed
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 200,
        'endLine' => 200,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'simple' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'simple',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 211,
            'endLine' => 211,
            'startTokenPos' => 280,
            'startFilePos' => 6446,
            'endTokenPos' => 282,
            'endFilePos' => 6465,
          ),
        ),
        'docComment' => '/**
 * Simple style parameters defined by RFC6570.
 *
 * This option replaces collectionFormat with a csv value from OpenAPI 2.0.
 *
 * @see [RFC6570](https://tools.ietf.org/html/rfc6570#section-3.2.2)
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 211,
        'endLine' => 211,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'spaceDelimited' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'spaceDelimited',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 220,
            'endLine' => 220,
            'startTokenPos' => 293,
            'startFilePos' => 6659,
            'endTokenPos' => 295,
            'endFilePos' => 6678,
          ),
        ),
        'docComment' => '/**
 * Space separated array values.
 *
 * This option replaces collectionFormat equal to ssv from OpenAPI 2.0.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 220,
        'endLine' => 220,
        'startColumn' => 5,
        'endColumn' => 50,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pipeDelimited' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'pipeDelimited',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 229,
            'endLine' => 229,
            'startTokenPos' => 306,
            'startFilePos' => 6872,
            'endTokenPos' => 308,
            'endFilePos' => 6891,
          ),
        ),
        'docComment' => '/**
 * Pipe separated array values.
 *
 * This option replaces collectionFormat equal to pipes from OpenAPI 2.0.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 229,
        'endLine' => 229,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'deepObject' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => 'deepObject',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 236,
            'endLine' => 236,
            'startTokenPos' => 319,
            'startFilePos' => 7041,
            'endTokenPos' => 321,
            'endFilePos' => 7060,
          ),
        ),
        'docComment' => '/**
 * Provides a simple way of rendering nested objects using form parameters.
 *
 * @var mixed
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 236,
        'endLine' => 236,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_required' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => '_required',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'name\', \'in\']',
          'attributes' => 
          array (
            'startLine' => 241,
            'endLine' => 241,
            'startTokenPos' => 334,
            'startFilePos' => 7130,
            'endTokenPos' => 339,
            'endFilePos' => 7143,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 241,
        'endLine' => 241,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'name\' => \'string\', \'in\' => [\'query\', \'header\', \'path\', \'cookie\'], \'description\' => \'string\', \'style\' => [\'matrix\', \'label\', \'form\', \'simple\', \'spaceDelimited\', \'pipeDelimited\', \'deepObject\'], \'required\' => \'boolean\']',
          'attributes' => 
          array (
            'startLine' => 246,
            'endLine' => 252,
            'startTokenPos' => 352,
            'startFilePos' => 7210,
            'endTokenPos' => 420,
            'endFilePos' => 7474,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 246,
        'endLine' => 252,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Schema::class => \'schema\', \\OpenApi\\Annotations\\Examples::class => [\'examples\', \'example\'], \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 257,
            'endLine' => 261,
            'startTokenPos' => 433,
            'startFilePos' => 7542,
            'endTokenPos' => 469,
            'endFilePos' => 7681,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 257,
        'endLine' => 261,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Components::class, \\OpenApi\\Annotations\\PathItem::class, \\OpenApi\\Annotations\\Operation::class, \\OpenApi\\Annotations\\Get::class, \\OpenApi\\Annotations\\Post::class, \\OpenApi\\Annotations\\Put::class, \\OpenApi\\Annotations\\Delete::class, \\OpenApi\\Annotations\\Patch::class, \\OpenApi\\Annotations\\Head::class, \\OpenApi\\Annotations\\Options::class, \\OpenApi\\Annotations\\Trace::class]',
          'attributes' => 
          array (
            'startLine' => 266,
            'endLine' => 278,
            'startTokenPos' => 482,
            'startFilePos' => 7750,
            'endTokenPos' => 539,
            'endFilePos' => 8007,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 266,
        'endLine' => 278,
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
                'startLine' => 281,
                'endLine' => 281,
                'startTokenPos' => 559,
                'startFilePos' => 8079,
                'endTokenPos' => 559,
                'endFilePos' => 8082,
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
            'startLine' => 281,
            'endLine' => 281,
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
                'startLine' => 281,
                'endLine' => 281,
                'startTokenPos' => 568,
                'startFilePos' => 8103,
                'endTokenPos' => 570,
                'endFilePos' => 8126,
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
            'startLine' => 281,
            'endLine' => 281,
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
                'startLine' => 281,
                'endLine' => 281,
                'startTokenPos' => 580,
                'startFilePos' => 8148,
                'endTokenPos' => 580,
                'endFilePos' => 8151,
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
            'startLine' => 281,
            'endLine' => 281,
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
        'startLine' => 280,
        'endLine' => 295,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'currentClassName' => 'OpenApi\\Annotations\\Parameter',
        'aliasName' => NULL,
      ),
      'identity' => 
      array (
        'name' => 'identity',
        'parameters' => 
        array (
          'properties' => 
          array (
            'name' => 'properties',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 298,
                'endLine' => 298,
                'startTokenPos' => 727,
                'startFilePos' => 8725,
                'endTokenPos' => 728,
                'endFilePos' => 8726,
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
            'startLine' => 298,
            'endLine' => 298,
            'startColumn' => 30,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
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
        'startLine' => 297,
        'endLine' => 301,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Parameter',
        'implementingClassName' => 'OpenApi\\Annotations\\Parameter',
        'currentClassName' => 'OpenApi\\Annotations\\Parameter',
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