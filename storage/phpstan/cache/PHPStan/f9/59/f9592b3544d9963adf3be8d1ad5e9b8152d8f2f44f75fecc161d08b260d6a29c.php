<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Middleware\RateLimitMiddleware.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Middleware\RateLimitMiddleware
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-d58267c3179009e63c69a302219b0759458de00ff12b4348b430afd7d0323bfe',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Middleware/RateLimitMiddleware.php',
      ),
    ),
    'namespace' => 'App\\Http\\Middleware',
    'name' => 'App\\Http\\Middleware\\RateLimitMiddleware',
    'shortName' => 'RateLimitMiddleware',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 10,
    'endLine' => 98,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
      'limiter' => 
      array (
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'name' => 'limiter',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The rate limiter instance.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 15,
        'endLine' => 15,
        'startColumn' => 5,
        'endColumn' => 23,
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'limiter' => 
          array (
            'name' => 'limiter',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Cache\\RateLimiter',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 20,
            'endLine' => 20,
            'startColumn' => 33,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new middleware instance.
 */',
        'startLine' => 20,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'aliasName' => NULL,
      ),
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 28,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'next' => 
          array (
            'name' => 'next',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 46,
            'endColumn' => 58,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'maxAttempts' => 
          array (
            'name' => 'maxAttempts',
            'default' => 
            array (
              'code' => '\'60\'',
              'attributes' => 
              array (
                'startLine' => 34,
                'endLine' => 34,
                'startTokenPos' => 90,
                'startFilePos' => 737,
                'endTokenPos' => 90,
                'endFilePos' => 740,
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
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 61,
            'endColumn' => 86,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'decayMinutes' => 
          array (
            'name' => 'decayMinutes',
            'default' => 
            array (
              'code' => '1',
              'attributes' => 
              array (
                'startLine' => 34,
                'endLine' => 34,
                'startTokenPos' => 99,
                'startFilePos' => 763,
                'endTokenPos' => 99,
                'endFilePos' => 763,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 34,
            'endLine' => 34,
            'startColumn' => 89,
            'endColumn' => 109,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Handle an incoming request.
 *
 * @param  \\Illuminate\\Http\\Request  $request
 * @param  \\Closure  $next
 * @param  string  $maxAttempts
 * @param  int  $decayMinutes
 * @return mixed
 */',
        'startLine' => 34,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'aliasName' => NULL,
      ),
      'resolveRequestSignature' => 
      array (
        'name' => 'resolveRequestSignature',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 48,
            'endColumn' => 63,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Resolve request signature.
 */',
        'startLine' => 52,
        'endLine' => 63,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'aliasName' => NULL,
      ),
      'addHeaders' => 
      array (
        'name' => 'addHeaders',
        'parameters' => 
        array (
          'response' => 
          array (
            'name' => 'response',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Symfony\\Component\\HttpFoundation\\Response',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 68,
            'endLine' => 68,
            'startColumn' => 35,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'maxAttempts' => 
          array (
            'name' => 'maxAttempts',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 68,
            'endLine' => 68,
            'startColumn' => 55,
            'endColumn' => 70,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'remainingAttempts' => 
          array (
            'name' => 'remainingAttempts',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 68,
            'endLine' => 68,
            'startColumn' => 73,
            'endColumn' => 94,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Symfony\\Component\\HttpFoundation\\Response',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Add the limit header information to the response.
 */',
        'startLine' => 68,
        'endLine' => 76,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'aliasName' => NULL,
      ),
      'calculateRemainingAttempts' => 
      array (
        'name' => 'calculateRemainingAttempts',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
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
            'startLine' => 81,
            'endLine' => 81,
            'startColumn' => 51,
            'endColumn' => 61,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'maxAttempts' => 
          array (
            'name' => 'maxAttempts',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 81,
            'endLine' => 81,
            'startColumn' => 64,
            'endColumn' => 79,
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
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calculate the number of remaining attempts.
 */',
        'startLine' => 81,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'aliasName' => NULL,
      ),
      'buildResponse' => 
      array (
        'name' => 'buildResponse',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
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
            'startColumn' => 38,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'maxAttempts' => 
          array (
            'name' => 'maxAttempts',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
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
            'startColumn' => 51,
            'endColumn' => 66,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'decayMinutes' => 
          array (
            'name' => 'decayMinutes',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
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
            'startColumn' => 69,
            'endColumn' => 85,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Symfony\\Component\\HttpFoundation\\Response',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Build the response when rate limit is exceeded.
 */',
        'startLine' => 89,
        'endLine' => 97,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Middleware',
        'declaringClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'implementingClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
        'currentClassName' => 'App\\Http\\Middleware\\RateLimitMiddleware',
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