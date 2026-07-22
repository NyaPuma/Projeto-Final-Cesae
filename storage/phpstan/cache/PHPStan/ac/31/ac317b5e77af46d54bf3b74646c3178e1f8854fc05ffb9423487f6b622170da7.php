<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Edits.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\Edits
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-0bbc35b3c5a02a8c46f19933e55000055013e5af74e6a020b376a84f9604ca61-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\Edits',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Edits.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\Edits',
    'shortName' => 'Edits',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 35,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\EditsContract',
    ),
    'traitClassNames' => 
    array (
      0 => 'OpenAI\\Resources\\Concerns\\Transportable',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'create' => 
      array (
        'name' => 'create',
        'parameters' => 
        array (
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
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
            'startColumn' => 28,
            'endColumn' => 44,
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
            'name' => 'OpenAI\\Responses\\Edits\\CreateResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a new edit for the provided input, instruction, and parameters.
 *
 * @see https://platform.openai.com/docs/api-reference/edits/create
 *
 * @param  array<string, mixed>  $parameters
 *
 * @deprecated OpenAI has deprecated this endpoint and will stop working by January 4, 2024.
 * https://openai.com/blog/gpt-4-api-general-availability#deprecation-of-the-edits-api
 */',
        'startLine' => 26,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\Edits',
        'implementingClassName' => 'OpenAI\\Resources\\Edits',
        'currentClassName' => 'OpenAI\\Resources\\Edits',
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