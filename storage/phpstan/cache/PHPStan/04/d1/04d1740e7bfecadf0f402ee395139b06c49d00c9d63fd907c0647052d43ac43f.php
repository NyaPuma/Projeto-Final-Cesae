<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/FineTunes.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\FineTunes
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-05e2319a3cca4d49c4c52617a6f8585e8c661554a0f26ae50fed330c7d76a967-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\FineTunes',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/FineTunes.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\FineTunes',
    'shortName' => 'FineTunes',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 16,
    'endLine' => 114,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\FineTunesContract',
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
            'startLine' => 29,
            'endLine' => 29,
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
            'name' => 'OpenAI\\Responses\\FineTunes\\RetrieveResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Creates a job that fine-tunes a specified model from a given dataset.
 *
 * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/create
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 29,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
        'aliasName' => NULL,
      ),
      'list' => 
      array (
        'name' => 'list',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'OpenAI\\Responses\\FineTunes\\ListResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * List your organization\'s fine-tuning jobs.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/list
 */',
        'startLine' => 44,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
        'aliasName' => NULL,
      ),
      'retrieve' => 
      array (
        'name' => 'retrieve',
        'parameters' => 
        array (
          'fineTuneId' => 
          array (
            'name' => 'fineTuneId',
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
            'startLine' => 59,
            'endLine' => 59,
            'startColumn' => 30,
            'endColumn' => 47,
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
            'name' => 'OpenAI\\Responses\\FineTunes\\RetrieveResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gets info about the fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/list
 */',
        'startLine' => 59,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
        'aliasName' => NULL,
      ),
      'cancel' => 
      array (
        'name' => 'cancel',
        'parameters' => 
        array (
          'fineTuneId' => 
          array (
            'name' => 'fineTuneId',
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
            'startLine' => 74,
            'endLine' => 74,
            'startColumn' => 28,
            'endColumn' => 45,
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
            'name' => 'OpenAI\\Responses\\FineTunes\\RetrieveResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Immediately cancel a fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/cancel
 */',
        'startLine' => 74,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
        'aliasName' => NULL,
      ),
      'listEvents' => 
      array (
        'name' => 'listEvents',
        'parameters' => 
        array (
          'fineTuneId' => 
          array (
            'name' => 'fineTuneId',
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
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 32,
            'endColumn' => 49,
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
            'name' => 'OpenAI\\Responses\\FineTunes\\ListEventsResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get fine-grained status updates for a fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/events
 */',
        'startLine' => 89,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
        'aliasName' => NULL,
      ),
      'listEventsStreamed' => 
      array (
        'name' => 'listEventsStreamed',
        'parameters' => 
        array (
          'fineTuneId' => 
          array (
            'name' => 'fineTuneId',
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
            'startLine' => 106,
            'endLine' => 106,
            'startColumn' => 40,
            'endColumn' => 57,
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
 * Get streamed fine-grained status updates for a fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tunes/events
 *
 * @return StreamResponse<RetrieveStreamedResponseEvent>
 */',
        'startLine' => 106,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTunes',
        'implementingClassName' => 'OpenAI\\Resources\\FineTunes',
        'currentClassName' => 'OpenAI\\Resources\\FineTunes',
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