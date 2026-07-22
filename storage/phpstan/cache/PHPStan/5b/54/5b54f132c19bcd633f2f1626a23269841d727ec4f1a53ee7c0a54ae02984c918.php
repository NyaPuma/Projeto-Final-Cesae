<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Completions.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\Completions
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-1aebcbf75f50e234378da0e0d7c543550ff6068780a1efa8d2f6ebe80b55f91a-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\Completions',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Completions.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\Completions',
    'shortName' => 'Completions',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 56,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\CompletionsContract',
    ),
    'traitClassNames' => 
    array (
      0 => 'OpenAI\\Resources\\Concerns\\Streamable',
      1 => 'OpenAI\\Resources\\Concerns\\Transportable',
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
            'name' => 'OpenAI\\Responses\\Completions\\CreateResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a completion for the provided prompt and parameters
 *
 * @see https://platform.openai.com/docs/api-reference/completions/create-completion
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 26,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\Completions',
        'implementingClassName' => 'OpenAI\\Resources\\Completions',
        'currentClassName' => 'OpenAI\\Resources\\Completions',
        'aliasName' => NULL,
      ),
      'createStreamed' => 
      array (
        'name' => 'createStreamed',
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
            'startLine' => 46,
            'endLine' => 46,
            'startColumn' => 36,
            'endColumn' => 52,
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
            'name' => 'OpenAI\\Responses\\StreamResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a streamed completion for the provided prompt and parameters
 *
 * @see https://platform.openai.com/docs/api-reference/completions/create-completion
 *
 * @param  array<string, mixed>  $parameters
 * @return StreamResponse<CreateStreamedResponse>
 */',
        'startLine' => 46,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\Completions',
        'implementingClassName' => 'OpenAI\\Resources\\Completions',
        'currentClassName' => 'OpenAI\\Resources\\Completions',
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