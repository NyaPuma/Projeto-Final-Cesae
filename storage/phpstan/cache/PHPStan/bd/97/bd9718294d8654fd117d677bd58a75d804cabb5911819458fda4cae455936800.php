<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/FineTuning.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\FineTuning
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-1e1f07464373e7d77fbea25f76846ea578fb8eb73eb804e3de21bae2a080578f-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\FineTuning',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/FineTuning.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\FineTuning',
    'shortName' => 'FineTuning',
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
    'endLine' => 100,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\FineTuningContract',
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
      'createJob' => 
      array (
        'name' => 'createJob',
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
            'startLine' => 27,
            'endLine' => 27,
            'startColumn' => 31,
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
            'name' => 'OpenAI\\Responses\\FineTuning\\RetrieveJobResponse',
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
 * @see https://platform.openai.com/docs/api-reference/fine-tuning/create
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 27,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTuning',
        'implementingClassName' => 'OpenAI\\Resources\\FineTuning',
        'currentClassName' => 'OpenAI\\Resources\\FineTuning',
        'aliasName' => NULL,
      ),
      'listJobs' => 
      array (
        'name' => 'listJobs',
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
                'startLine' => 44,
                'endLine' => 44,
                'startTokenPos' => 148,
                'startFilePos' => 1857,
                'endTokenPos' => 149,
                'endFilePos' => 1858,
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
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 30,
            'endColumn' => 51,
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
            'name' => 'OpenAI\\Responses\\FineTuning\\ListJobsResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * List your organization\'s fine-tuning jobs.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tuning/undefined
 *
 * @param  array<string, mixed>  $parameters
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
        'declaringClassName' => 'OpenAI\\Resources\\FineTuning',
        'implementingClassName' => 'OpenAI\\Resources\\FineTuning',
        'currentClassName' => 'OpenAI\\Resources\\FineTuning',
        'aliasName' => NULL,
      ),
      'retrieveJob' => 
      array (
        'name' => 'retrieveJob',
        'parameters' => 
        array (
          'jobId' => 
          array (
            'name' => 'jobId',
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
            'startColumn' => 33,
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
            'name' => 'OpenAI\\Responses\\FineTuning\\RetrieveJobResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gets info about the fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tuning/retrieve
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
        'declaringClassName' => 'OpenAI\\Resources\\FineTuning',
        'implementingClassName' => 'OpenAI\\Resources\\FineTuning',
        'currentClassName' => 'OpenAI\\Resources\\FineTuning',
        'aliasName' => NULL,
      ),
      'cancelJob' => 
      array (
        'name' => 'cancelJob',
        'parameters' => 
        array (
          'jobId' => 
          array (
            'name' => 'jobId',
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
            'startColumn' => 31,
            'endColumn' => 43,
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
            'name' => 'OpenAI\\Responses\\FineTuning\\RetrieveJobResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Immediately cancel a fine-tune job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tuning/cancel
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
        'declaringClassName' => 'OpenAI\\Resources\\FineTuning',
        'implementingClassName' => 'OpenAI\\Resources\\FineTuning',
        'currentClassName' => 'OpenAI\\Resources\\FineTuning',
        'aliasName' => NULL,
      ),
      'listJobEvents' => 
      array (
        'name' => 'listJobEvents',
        'parameters' => 
        array (
          'jobId' => 
          array (
            'name' => 'jobId',
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
            'startLine' => 91,
            'endLine' => 91,
            'startColumn' => 35,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 91,
                'endLine' => 91,
                'startTokenPos' => 374,
                'startFilePos' => 4753,
                'endTokenPos' => 375,
                'endFilePos' => 4754,
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
            'startLine' => 91,
            'endLine' => 91,
            'startColumn' => 50,
            'endColumn' => 71,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'OpenAI\\Responses\\FineTuning\\ListJobEventsResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get status updates for a fine-tuning job.
 *
 * @see https://platform.openai.com/docs/api-reference/fine-tuning/list-events
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 91,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\FineTuning',
        'implementingClassName' => 'OpenAI\\Resources\\FineTuning',
        'currentClassName' => 'OpenAI\\Resources\\FineTuning',
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