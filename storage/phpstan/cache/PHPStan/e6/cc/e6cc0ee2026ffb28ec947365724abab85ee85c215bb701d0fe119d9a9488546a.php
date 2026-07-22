<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Schema.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\Schema
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-0363aab7a52226d7a86ca8870c9093cb5ee02de33b1c89602009a2d99f773b2b-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\Schema',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Schema.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\Schema',
    'shortName' => 'Schema',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * The definition of input and output data types.
 *
 * These types can be objects, but also primitives and arrays.
 *
 * This object is based on the [JSON Schema Specification](http://json-schema.org) and uses a predefined subset of it.
 * On top of this subset, there are extensions provided by this specification to allow for more complete documentation.
 *
 * @see [Schema Object](https://spec.openapis.org/oas/v3.1.1.html#schema-object)
 * @see [JSON Schema](http://json-schema.org/)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 25,
    'endLine' => 399,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'OpenApi\\Annotations\\AbstractAnnotation',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'OpenApi\\Annotations\\JsonSchemaTrait',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'ref' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'ref',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 51,
            'startFilePos' => 957,
            'endTokenPos' => 53,
            'endFilePos' => 976,
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
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'schema' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'schema',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 64,
            'startFilePos' => 1090,
            'endTokenPos' => 66,
            'endFilePos' => 1109,
          ),
        ),
        'docComment' => '/**
 * The key into Components->schemas array.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'title' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'title',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 52,
            'endLine' => 52,
            'startTokenPos' => 77,
            'startFilePos' => 1367,
            'endTokenPos' => 79,
            'endFilePos' => 1386,
          ),
        ),
        'docComment' => '/**
 * Can be used to decorate a user interface with information about the data produced by this user interface.
 *
 * Preferably short; use <code>description</code> for more details.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'description',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 59,
            'endLine' => 59,
            'startTokenPos' => 90,
            'startFilePos' => 1564,
            'endTokenPos' => 92,
            'endFilePos' => 1583,
          ),
        ),
        'docComment' => '/**
 * A description will provide explanation about the purpose of the instance described by this schema.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 59,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'maxProperties' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'maxProperties',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 68,
            'endLine' => 68,
            'startTokenPos' => 103,
            'startFilePos' => 1873,
            'endTokenPos' => 105,
            'endFilePos' => 1892,
          ),
        ),
        'docComment' => '/**
 * The maximum number of properties allowed in an object instance.
 * An object instance is valid against this property if its number of properties is less than, or equal to, the
 * value of this attribute.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 68,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'minProperties' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'minProperties',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 77,
            'endLine' => 77,
            'startTokenPos' => 116,
            'startFilePos' => 2185,
            'endTokenPos' => 118,
            'endFilePos' => 2204,
          ),
        ),
        'docComment' => '/**
 * The minimum number of properties allowed in an object instance.
 * An object instance is valid against this property if its number of properties is greater than, or equal to, the
 * value of this attribute.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 77,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'required' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'required',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 85,
            'endLine' => 85,
            'startTokenPos' => 129,
            'startFilePos' => 2417,
            'endTokenPos' => 131,
            'endFilePos' => 2436,
          ),
        ),
        'docComment' => '/**
 * An object instance is valid against this property if its property set contains all elements in this property\'s
 * array value.
 *
 * @var list<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 85,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'properties' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'properties',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 94,
            'endLine' => 94,
            'startTokenPos' => 142,
            'startFilePos' => 2679,
            'endTokenPos' => 144,
            'endFilePos' => 2698,
          ),
        ),
        'docComment' => '/**
 * A collection of properties to define for an object.
 *
 * Each property is represented as an instance of the <a href="#property">Property</a> class.
 *
 * @var list<Property>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 94,
        'endLine' => 94,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'type' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'type',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 105,
            'endLine' => 105,
            'startTokenPos' => 155,
            'startFilePos' => 3007,
            'endTokenPos' => 157,
            'endFilePos' => 3026,
          ),
        ),
        'docComment' => '/**
 * The type of the schema/property.
 *
 * OpenApi v3.0: The value MUST be one of "string", "number", "integer", "boolean", "array" or "object".
 *
 * Since OpenApi v3.1 an array of types may be used.
 *
 * @var string|non-empty-array<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 105,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'format' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'format',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 114,
            'endLine' => 114,
            'startTokenPos' => 168,
            'startFilePos' => 3242,
            'endTokenPos' => 170,
            'endFilePos' => 3261,
          ),
        ),
        'docComment' => '/**
 * The extending format for the previously mentioned type.
 *
 * @see [Data Types](https://spec.openapis.org/oas/v3.1.1.html#data-types)
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 114,
        'endLine' => 114,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'items' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'items',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 121,
            'endLine' => 121,
            'startTokenPos' => 181,
            'startFilePos' => 3404,
            'endTokenPos' => 183,
            'endFilePos' => 3423,
          ),
        ),
        'docComment' => '/**
 * Required if type is "array". Describes the type of items in the array.
 *
 * @var Items
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 121,
        'endLine' => 121,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'collectionFormat' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'collectionFormat',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 137,
            'endLine' => 137,
            'startTokenPos' => 194,
            'startFilePos' => 4033,
            'endTokenPos' => 196,
            'endFilePos' => 4052,
          ),
        ),
        'docComment' => '/**
 * Determines the format of the array if type array is used.
 *
 * Possible values are:
 * - csv: comma separated values foo,bar.
 * - ssv: space separated values foo bar.
 * - tsv: tab separated values foo\\tbar.
 * - pipes: pipe separated values foo|bar.
 * - multi: corresponds to multiple parameter instances instead of multiple values for a single instance
 * foo=bar&foo=baz. This is valid only for parameters of type <code>query</code> or <code>formData</code>. Default
 * value is csv.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 137,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 52,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pattern' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'pattern',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 144,
            'endLine' => 144,
            'startTokenPos' => 207,
            'startFilePos' => 4226,
            'endTokenPos' => 209,
            'endFilePos' => 4245,
          ),
        ),
        'docComment' => '/**
 * A string instance is considered valid if the regular expression matches the instance successfully.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 144,
        'endLine' => 144,
        'startColumn' => 5,
        'endColumn' => 43,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'multipleOf' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'multipleOf',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 152,
            'endLine' => 152,
            'startTokenPos' => 220,
            'startFilePos' => 4468,
            'endTokenPos' => 222,
            'endFilePos' => 4487,
          ),
        ),
        'docComment' => '/**
 * A numeric instance is valid against "multipleOf" if the result of the division of the instance by this
 * property\'s value is an integer.
 *
 * @var int|float
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 152,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'discriminator' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'discriminator',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 162,
            'endLine' => 162,
            'startTokenPos' => 233,
            'startFilePos' => 4808,
            'endTokenPos' => 235,
            'endFilePos' => 4827,
          ),
        ),
        'docComment' => '/**
 * Adds support for polymorphism.
 *
 * The discriminator is an object name that is used to differentiate between other schemas which may satisfy the
 * payload description. See Composition and Inheritance for more details.
 *
 * @var Discriminator
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 162,
        'endLine' => 162,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'readOnly' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'readOnly',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 176,
            'endLine' => 176,
            'startTokenPos' => 246,
            'startFilePos' => 5366,
            'endTokenPos' => 248,
            'endFilePos' => 5385,
          ),
        ),
        'docComment' => '/**
 * Declares the property as "read only".
 *
 * Relevant only for Schema "properties" definitions.
 *
 * This means that it may be sent as part of a response but should not be sent as part of the request.
 * If the property is marked as readOnly being true and is in the required list, the required will take effect on
 * the response only. A property must not be marked as both readOnly and writeOnly being true. Default value is
 * false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 176,
        'endLine' => 176,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'writeOnly' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'writeOnly',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 189,
            'endLine' => 189,
            'startTokenPos' => 259,
            'startFilePos' => 5914,
            'endTokenPos' => 261,
            'endFilePos' => 5933,
          ),
        ),
        'docComment' => '/**
 * Declares the property as "write only".
 *
 * Relevant only for Schema "properties" definitions.
 * Therefore, it may be sent as part of a request but should not be sent as part of the response.
 * If the property is marked as writeOnly being true and is in the required list, the required will take effect on
 * the request only. A property must not be marked as both readOnly and writeOnly being true. Default value is
 * false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 189,
        'endLine' => 189,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'xml' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'xml',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 199,
            'endLine' => 199,
            'startTokenPos' => 272,
            'startFilePos' => 6179,
            'endTokenPos' => 274,
            'endFilePos' => 6198,
          ),
        ),
        'docComment' => '/**
 * This may be used only on properties schemas.
 *
 * It has no effect on root schemas.
 * Adds additional metadata to describe the XML representation of this property.
 *
 * @var Xml
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 199,
        'endLine' => 199,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'externalDocs' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'externalDocs',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 206,
            'endLine' => 206,
            'startTokenPos' => 285,
            'startFilePos' => 6344,
            'endTokenPos' => 287,
            'endFilePos' => 6363,
          ),
        ),
        'docComment' => '/**
 * Additional external documentation for this schema.
 *
 * @var ExternalDocumentation
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 206,
        'endLine' => 206,
        'startColumn' => 5,
        'endColumn' => 48,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'example' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'example',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 216,
            'endLine' => 216,
            'startTokenPos' => 298,
            'startFilePos' => 6690,
            'endTokenPos' => 300,
            'endFilePos' => 6709,
          ),
        ),
        'docComment' => '/**
 * A free-form property to include an example of an instance for this schema.
 *
 * To represent examples that cannot naturally be represented in JSON or YAML, a string value can be used to
 * contain the example with escaping where necessary.
 *
 * @var mixed
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 216,
        'endLine' => 216,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'examples',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 228,
            'endLine' => 228,
            'startTokenPos' => 311,
            'startFilePos' => 7171,
            'endTokenPos' => 313,
            'endFilePos' => 7190,
          ),
        ),
        'docComment' => '/**
 * Examples of the schema.
 *
 * Each example should contain a value in the correct format as specified in the parameter encoding.
 * The examples object is mutually exclusive of the example object.
 * Furthermore, if referencing a schema which contains an example, the examples value shall override the example provided by the schema.
 *
 * @since OpenAPI 3.1.0
 * @var array<Examples>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 228,
        'endLine' => 228,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'nullable' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'nullable',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 241,
            'endLine' => 241,
            'startTokenPos' => 324,
            'startFilePos' => 7595,
            'endTokenPos' => 326,
            'endFilePos' => 7614,
          ),
        ),
        'docComment' => '/**
 * Allows sending a null value for the defined schema.
 * Default value is false.
 *
 * This must not be used when using OpenApi version 3.1,
 * instead make the "type" property an array and add "null" as a possible type.
 *
 * @var bool
 *
 * @see https://www.openapis.org/blog/2021/02/16/migrating-from-openapi-3-0-to-3-1-0
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 241,
        'endLine' => 241,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'deprecated',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 249,
            'endLine' => 249,
            'startTokenPos' => 337,
            'startFilePos' => 7800,
            'endTokenPos' => 339,
            'endFilePos' => 7819,
          ),
        ),
        'docComment' => '/**
 * Specifies that a schema is deprecated and should be transitioned out of usage.
 * Default value is false.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 249,
        'endLine' => 249,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'allOf' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'allOf',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 257,
            'endLine' => 257,
            'startTokenPos' => 350,
            'startFilePos' => 8073,
            'endTokenPos' => 352,
            'endFilePos' => 8092,
          ),
        ),
        'docComment' => '/**
 * An instance validates successfully against this property if it validates successfully against all schemas
 * defined by this property\'s value.
 *
 * @var array<Schema|\\OpenApi\\Attributes\\Schema>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 257,
        'endLine' => 257,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'anyOf' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'anyOf',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 265,
            'endLine' => 265,
            'startTokenPos' => 363,
            'startFilePos' => 8354,
            'endTokenPos' => 365,
            'endFilePos' => 8373,
          ),
        ),
        'docComment' => '/**
 * An instance validates successfully against this property if it validates successfully against at least one
 * schema defined by this property\'s value.
 *
 * @var array<Schema|\\OpenApi\\Attributes\\Schema>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 265,
        'endLine' => 265,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'oneOf' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'oneOf',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 273,
            'endLine' => 273,
            'startTokenPos' => 376,
            'startFilePos' => 8634,
            'endTokenPos' => 378,
            'endFilePos' => 8653,
          ),
        ),
        'docComment' => '/**
 * An instance validates successfully against this property if it validates successfully against exactly one schema
 * defined by this property\'s value.
 *
 * @var array<Schema|\\OpenApi\\Attributes\\Schema>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 273,
        'endLine' => 273,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'contentEncoding' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'contentEncoding',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 281,
            'endLine' => 281,
            'startTokenPos' => 389,
            'startFilePos' => 8912,
            'endTokenPos' => 391,
            'endFilePos' => 8931,
          ),
        ),
        'docComment' => '/**
 * https://spec.openapis.org/oas/v3.1.0.html#considerations-for-file-uploads
 * https://json-schema.org/draft/2020-12/draft-bhutton-json-schema-validation-00#rfc.section.8.3.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 281,
        'endLine' => 281,
        'startColumn' => 5,
        'endColumn' => 51,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'contentMediaType' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => 'contentMediaType',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 289,
            'endLine' => 289,
            'startTokenPos' => 402,
            'startFilePos' => 9191,
            'endTokenPos' => 404,
            'endFilePos' => 9210,
          ),
        ),
        'docComment' => '/**
 * https://spec.openapis.org/oas/v3.1.0.html#considerations-for-file-uploads
 * https://json-schema.org/draft/2020-12/draft-bhutton-json-schema-validation-00#rfc.section.8.4.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 289,
        'endLine' => 289,
        'startColumn' => 5,
        'endColumn' => 52,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'title\' => \'string\', \'description\' => \'string\', \'required\' => \'[string]\', \'format\' => \'string\', \'collectionFormat\' => [\'csv\', \'ssv\', \'tsv\', \'pipes\', \'multi\'], \'maximum\' => \'number\', \'exclusiveMaximum\' => \'boolean|number\', \'minimum\' => \'number\', \'exclusiveMinimum\' => \'boolean|number\', \'maxLength\' => \'integer\', \'minLength\' => \'integer\', \'pattern\' => \'string\', \'maxItems\' => \'integer\', \'minItems\' => \'integer\', \'uniqueItems\' => \'boolean\', \'multipleOf\' => \'integer\', \'allOf\' => \'[\' . \\OpenApi\\Annotations\\Schema::class . \']\', \'oneOf\' => \'[\' . \\OpenApi\\Annotations\\Schema::class . \']\', \'anyOf\' => \'[\' . \\OpenApi\\Annotations\\Schema::class . \']\', \'contentEncoding\' => \'string\', \'contentMediaType\' => \'string\']',
          'attributes' => 
          array (
            'startLine' => 294,
            'endLine' => 316,
            'startTokenPos' => 417,
            'startFilePos' => 9277,
            'endTokenPos' => 610,
            'endFilePos' => 10093,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 294,
        'endLine' => 316,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Discriminator::class => \'discriminator\', \\OpenApi\\Annotations\\Items::class => \'items\', \\OpenApi\\Annotations\\Property::class => [\'properties\', \'property\'], \\OpenApi\\Annotations\\ExternalDocumentation::class => \'externalDocs\', \\OpenApi\\Annotations\\Examples::class => [\'examples\', \'example\'], \\OpenApi\\Annotations\\Xml::class => \'xml\', \\OpenApi\\Annotations\\AdditionalProperties::class => \'additionalProperties\', \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 321,
            'endLine' => 330,
            'startTokenPos' => 623,
            'startFilePos' => 10161,
            'endTokenPos' => 709,
            'endFilePos' => 10550,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 321,
        'endLine' => 330,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\Components::class, \\OpenApi\\Annotations\\Parameter::class, \\OpenApi\\Annotations\\PathParameter::class, \\OpenApi\\Annotations\\MediaType::class, \\OpenApi\\Annotations\\Header::class]',
          'attributes' => 
          array (
            'startLine' => 335,
            'endLine' => 341,
            'startTokenPos' => 722,
            'startFilePos' => 10619,
            'endTokenPos' => 749,
            'endFilePos' => 10757,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 335,
        'endLine' => 341,
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
      'isNullable' => 
      array (
        'name' => 'isNullable',
        'parameters' => 
        array (
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
        ),
        'docComment' => '/**
 * Type safe nullable check.
 *
 * Defaults to `false` when nullable is not set.
 */',
        'startLine' => 348,
        'endLine' => 351,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'currentClassName' => 'OpenApi\\Annotations\\Schema',
        'aliasName' => NULL,
      ),
      'hasType' => 
      array (
        'name' => 'hasType',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
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
            'startLine' => 356,
            'endLine' => 356,
            'startColumn' => 29,
            'endColumn' => 40,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Check if the given type is valid for this schema.
 */',
        'startLine' => 356,
        'endLine' => 359,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'currentClassName' => 'OpenApi\\Annotations\\Schema',
        'aliasName' => NULL,
      ),
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
        'startLine' => 361,
        'endLine' => 377,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'currentClassName' => 'OpenApi\\Annotations\\Schema',
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
                'startLine' => 380,
                'endLine' => 380,
                'startTokenPos' => 996,
                'startFilePos' => 11803,
                'endTokenPos' => 996,
                'endFilePos' => 11806,
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
            'startLine' => 380,
            'endLine' => 380,
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
                'startLine' => 380,
                'endLine' => 380,
                'startTokenPos' => 1005,
                'startFilePos' => 11827,
                'endTokenPos' => 1007,
                'endFilePos' => 11850,
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
            'startLine' => 380,
            'endLine' => 380,
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
                'startLine' => 380,
                'endLine' => 380,
                'startTokenPos' => 1017,
                'startFilePos' => 11872,
                'endTokenPos' => 1017,
                'endFilePos' => 11875,
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
            'startLine' => 380,
            'endLine' => 380,
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
        'startLine' => 379,
        'endLine' => 398,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenApi\\Annotations',
        'declaringClassName' => 'OpenApi\\Annotations\\Schema',
        'implementingClassName' => 'OpenApi\\Annotations\\Schema',
        'currentClassName' => 'OpenApi\\Annotations\\Schema',
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