<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Realtime.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\Realtime
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-3c320e34c54f156e1a1a63bb1f15f2bf4660be82e02242c01d86322aa7a83ac4-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\Realtime',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/Realtime.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\Realtime',
    'shortName' => 'Realtime',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * @phpstan-import-type SessionType from SessionResponse
 * @phpstan-import-type TranscriptionSessionType from TranscriptionSessionResponse
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 17,
    'endLine' => 54,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\RealtimeContract',
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
      'token' => 
      array (
        'name' => 'token',
        'parameters' => 
        array (
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 28,
                'endLine' => 28,
                'startTokenPos' => 73,
                'startFilePos' => 812,
                'endTokenPos' => 74,
                'endFilePos' => 813,
              ),
            ),
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
            'startLine' => 28,
            'endLine' => 28,
            'startColumn' => 27,
            'endColumn' => 48,
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
            'name' => 'OpenAI\\Responses\\Realtime\\SessionResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an ephemeral API token for real time sessions.
 *
 * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 28,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\Realtime',
        'implementingClassName' => 'OpenAI\\Resources\\Realtime',
        'currentClassName' => 'OpenAI\\Resources\\Realtime',
        'aliasName' => NULL,
      ),
      'transcribeToken' => 
      array (
        'name' => 'transcribeToken',
        'parameters' => 
        array (
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 45,
                'endLine' => 45,
                'startTokenPos' => 143,
                'startFilePos' => 1400,
                'endTokenPos' => 144,
                'endFilePos' => 1401,
              ),
            ),
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
            'startLine' => 45,
            'endLine' => 45,
            'startColumn' => 37,
            'endColumn' => 58,
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
            'name' => 'OpenAI\\Responses\\Realtime\\TranscriptionSessionResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create an ephemeral API token for real time transcription sessions.
 *
 * @see https://platform.openai.com/docs/api-reference/realtime-sessions/create-transcription
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 45,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\Realtime',
        'implementingClassName' => 'OpenAI\\Resources\\Realtime',
        'currentClassName' => 'OpenAI\\Resources\\Realtime',
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