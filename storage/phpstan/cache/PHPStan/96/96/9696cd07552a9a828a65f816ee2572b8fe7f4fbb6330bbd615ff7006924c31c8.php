<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Http\Controllers\Controller.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Controller
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-f6f2245fadd19ed865c5c1107ec935122d3e16311eec3f69dfd0049a55b1f805',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Controller',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Http/Controllers/Controller.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers',
    'name' => 'App\\Http\\Controllers\\Controller',
    'shortName' => 'Controller',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 60,
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
    ),
    'immediateMethods' => 
    array (
      'authenticatedUser' => 
      array (
        'name' => 'authenticatedUser',
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
            'startLine' => 19,
            'endLine' => 19,
            'startColumn' => 42,
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
            'name' => 'App\\Models\\User',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Resolve e valida o utilizador atualmente autenticado com base no token fornecido.
 * Procura o token prioritariamente no cabeçalho customizado \'X-Auth-Token\'
 * ou, em alternativa, no cabeçalho padrão \'Authorization\' (Bearer Token).
 *
 * @param  \\Illuminate\\Http\\Request  $request
 * @return \\App\\Models\\User
 * * @throws \\Symfony\\Component\\HttpKernel\\Exception\\HttpException
 */',
        'startLine' => 19,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\Controller',
        'implementingClassName' => 'App\\Http\\Controllers\\Controller',
        'currentClassName' => 'App\\Http\\Controllers\\Controller',
        'aliasName' => NULL,
      ),
      'requireRole' => 
      array (
        'name' => 'requireRole',
        'parameters' => 
        array (
          'user' => 
          array (
            'name' => 'user',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\User',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 36,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'roles' => 
          array (
            'name' => 'roles',
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
            'startLine' => 53,
            'endLine' => 53,
            'startColumn' => 48,
            'endColumn' => 59,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Garante programaticamente que o utilizador possui um dos perfis/papéis permitidos.
 * Caso o perfil não corresponda, lança uma exceção HTTP 403 (Acesso Proibido).
 *
 * @param  \\App\\Models\\User  $user
 * @param  array  $roles
 * @return void
 * @throws \\Symfony\\Component\\HttpKernel\\Exception\\HttpException
 */',
        'startLine' => 53,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Controllers',
        'declaringClassName' => 'App\\Http\\Controllers\\Controller',
        'implementingClassName' => 'App\\Http\\Controllers\\Controller',
        'currentClassName' => 'App\\Http\\Controllers\\Controller',
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