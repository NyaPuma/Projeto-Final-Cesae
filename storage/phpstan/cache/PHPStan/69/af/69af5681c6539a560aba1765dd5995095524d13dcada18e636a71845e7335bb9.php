<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/VectorStores.php-PHPStan\BetterReflection\Reflection\ReflectionClass-OpenAI\Resources\VectorStores
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-75ee2d4a7ce37ca5b555c36dd0e1dfdab3cb57bdcdb6ccf9682dbb49577a9562-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'OpenAI\\Resources\\VectorStores',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../openai-php/client/src/Resources/VectorStores.php',
      ),
    ),
    'namespace' => 'OpenAI\\Resources',
    'name' => 'OpenAI\\Resources\\VectorStores',
    'shortName' => 'VectorStores',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 17,
    'endLine' => 138,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'OpenAI\\Contracts\\Resources\\VectorStoresContract',
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
            'startLine' => 28,
            'endLine' => 28,
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
            'name' => 'OpenAI\\Responses\\VectorStores\\VectorStoreResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a vector store
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores/create
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
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'list' => 
      array (
        'name' => 'list',
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
                'startTokenPos' => 163,
                'startFilePos' => 1767,
                'endTokenPos' => 164,
                'endFilePos' => 1768,
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
            'startColumn' => 26,
            'endColumn' => 47,
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
            'name' => 'OpenAI\\Responses\\VectorStores\\VectorStoreListResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Returns a list of vector stores.
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores/list
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
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'retrieve' => 
      array (
        'name' => 'retrieve',
        'parameters' => 
        array (
          'vectorStoreId' => 
          array (
            'name' => 'vectorStoreId',
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
            'startLine' => 60,
            'endLine' => 60,
            'startColumn' => 30,
            'endColumn' => 50,
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
            'name' => 'OpenAI\\Responses\\VectorStores\\VectorStoreResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retrieves a vector store.
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores/retrieve
 */',
        'startLine' => 60,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'modify' => 
      array (
        'name' => 'modify',
        'parameters' => 
        array (
          'vectorStoreId' => 
          array (
            'name' => 'vectorStoreId',
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
            'startLine' => 77,
            'endLine' => 77,
            'startColumn' => 28,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
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
            'startLine' => 77,
            'endLine' => 77,
            'startColumn' => 51,
            'endColumn' => 67,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'OpenAI\\Responses\\VectorStores\\VectorStoreResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Modify a vector store
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores/modify
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 77,
        'endLine' => 85,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'delete' => 
      array (
        'name' => 'delete',
        'parameters' => 
        array (
          'vectorStoreId' => 
          array (
            'name' => 'vectorStoreId',
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
            'startLine' => 92,
            'endLine' => 92,
            'startColumn' => 28,
            'endColumn' => 48,
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
            'name' => 'OpenAI\\Responses\\VectorStores\\VectorStoreDeleteResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Delete a vector store.
 *
 * https://platform.openai.com/docs/api-reference/vector-stores/delete
 */',
        'startLine' => 92,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'files' => 
      array (
        'name' => 'files',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'OpenAI\\Contracts\\Resources\\VectorStoresFilesContract',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Manage the files related to the vector store
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores-files
 */',
        'startLine' => 107,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'batches' => 
      array (
        'name' => 'batches',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'OpenAI\\Contracts\\Resources\\VectorStoresFileBatchesContract',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Manage the file batches related to the vector store
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches
 */',
        'startLine' => 117,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
        'aliasName' => NULL,
      ),
      'search' => 
      array (
        'name' => 'search',
        'parameters' => 
        array (
          'vectorStoreId' => 
          array (
            'name' => 'vectorStoreId',
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
            'startLine' => 129,
            'endLine' => 129,
            'startColumn' => 28,
            'endColumn' => 48,
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
                'startLine' => 129,
                'endLine' => 129,
                'startTokenPos' => 527,
                'startFilePos' => 5660,
                'endTokenPos' => 528,
                'endFilePos' => 5661,
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
            'startLine' => 129,
            'endLine' => 129,
            'startColumn' => 51,
            'endColumn' => 72,
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
            'name' => 'OpenAI\\Responses\\VectorStores\\Search\\VectorStoreSearchResponse',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Search a vector store for relevant chunks based on a query and file attributes filter.
 *
 * @see https://platform.openai.com/docs/api-reference/vector-stores/search
 *
 * @param  array<string, mixed>  $parameters
 */',
        'startLine' => 129,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'OpenAI\\Resources',
        'declaringClassName' => 'OpenAI\\Resources\\VectorStores',
        'implementingClassName' => 'OpenAI\\Resources\\VectorStores',
        'currentClassName' => 'OpenAI\\Resources\\VectorStores',
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