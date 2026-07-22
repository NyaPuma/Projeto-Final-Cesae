<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Server.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenApi\Annotations\Server
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-10e526db147dbf33b004cb15facff91564217784718da0bb03ef1abdc724c688-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenApi\\Annotations\\Server',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../zircote/swagger-php/src/Annotations/Server.php',
      ),
    ),
    'namespace' => 'OpenApi\\Annotations',
    'name' => 'OpenApi\\Annotations\\Server',
    'shortName' => 'Server',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * An object representing a server.
 *
 * @see [Server Object](https://spec.openapis.org/oas/v3.1.1.html#server-object)
 *
 * @Annotation
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 18,
    'endLine' => 87,
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
      'url' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => 'url',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 41,
            'startFilePos' => 669,
            'endTokenPos' => 43,
            'endFilePos' => 688,
          ),
        ),
        'docComment' => '/**
 * An URL to the target host.
 *
 * This URL supports Server Variables and may be relative,
 * to indicate that the host location is relative to the location where the OpenAPI document is being served.
 * Variable substitutions will be made when a variable is named in {brackets}.
 *
 * @var string
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
      'description' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => 'description',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\\OpenApi\\Undefined::UNDEFINED',
          'attributes' => 
          array (
            'startLine' => 38,
            'endLine' => 38,
            'startTokenPos' => 54,
            'startFilePos' => 903,
            'endTokenPos' => 56,
            'endFilePos' => 922,
          ),
        ),
        'docComment' => '/**
 * An optional string describing the host designated by the URL.
 *
 * CommonMark syntax may be used for rich text representation.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 38,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 47,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'variables' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => 'variables',
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
            'startFilePos' => 1137,
            'endTokenPos' => 69,
            'endFilePos' => 1156,
          ),
        ),
        'docComment' => '/**
 * A map between a variable name and its value.
 *
 * The value is used for substitution in the server\'s URL template.
 *
 * @var list<ServerVariable>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 45,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_parents' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => '_parents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\OpenApi::class, \\OpenApi\\Annotations\\PathItem::class, \\OpenApi\\Annotations\\Operation::class, \\OpenApi\\Annotations\\Get::class, \\OpenApi\\Annotations\\Post::class, \\OpenApi\\Annotations\\Put::class, \\OpenApi\\Annotations\\Delete::class, \\OpenApi\\Annotations\\Patch::class, \\OpenApi\\Annotations\\Head::class, \\OpenApi\\Annotations\\Options::class, \\OpenApi\\Annotations\\Trace::class, \\OpenApi\\Annotations\\Link::class]',
          'attributes' => 
          array (
            'startLine' => 52,
            'endLine' => 65,
            'startTokenPos' => 82,
            'startFilePos' => 1225,
            'endTokenPos' => 144,
            'endFilePos' => 1500,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 52,
        'endLine' => 65,
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
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => '_nested',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\\OpenApi\\Annotations\\ServerVariable::class => [\'variables\', \'serverVariable\'], \\OpenApi\\Annotations\\Attachable::class => [\'attachables\']]',
          'attributes' => 
          array (
            'startLine' => 70,
            'endLine' => 73,
            'startTokenPos' => 157,
            'startFilePos' => 1568,
            'endTokenPos' => 184,
            'endFilePos' => 1686,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 70,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_required' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => '_required',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'url\']',
          'attributes' => 
          array (
            'startLine' => 78,
            'endLine' => 78,
            'startTokenPos' => 197,
            'startFilePos' => 1756,
            'endTokenPos' => 199,
            'endFilePos' => 1762,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 78,
        'endLine' => 78,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      '_types' => 
      array (
        'declaringClassName' => 'OpenApi\\Annotations\\Server',
        'implementingClassName' => 'OpenApi\\Annotations\\Server',
        'name' => '_types',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'url\' => \'string\', \'description\' => \'string\']',
          'attributes' => 
          array (
            'startLine' => 83,
            'endLine' => 86,
            'startTokenPos' => 212,
            'startFilePos' => 1829,
            'endTokenPos' => 228,
            'endFilePos' => 1897,
          ),
        ),
        'docComment' => '/**
 * @inheritdoc
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 83,
        'endLine' => 86,
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