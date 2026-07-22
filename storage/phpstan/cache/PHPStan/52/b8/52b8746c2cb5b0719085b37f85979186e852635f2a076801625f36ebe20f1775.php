<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Traits\ControllerHelpers.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Traits\ControllerHelpers
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-1e7c6325a52c4a2c94c612fbe66243860367dea2397e0db2ae6428e838cc82d7',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Traits\\ControllerHelpers',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Traits/ControllerHelpers.php',
      ),
    ),
    'namespace' => 'App\\Traits',
    'name' => 'App\\Traits\\ControllerHelpers',
    'shortName' => 'ControllerHelpers',
    'isInterface' => false,
    'isTrait' => true,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Trait ControllerHelpers
 * @package App\\Traits
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 36,
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
 * Resolve e valida o utilizador atualmente autenticado.
 * * @param Request $request
 * @return User
 */',
        'startLine' => 19,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Traits',
        'declaringClassName' => 'App\\Traits\\ControllerHelpers',
        'implementingClassName' => 'App\\Traits\\ControllerHelpers',
        'currentClassName' => 'App\\Traits\\ControllerHelpers',
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
            'startLine' => 30,
            'endLine' => 30,
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
            'startLine' => 30,
            'endLine' => 30,
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
 * Garante que o utilizador possui um dos perfis/papéis permitidos.
 * * @param User $user
 * @param array $roles
 * @return void
 */',
        'startLine' => 30,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Traits',
        'declaringClassName' => 'App\\Traits\\ControllerHelpers',
        'implementingClassName' => 'App\\Traits\\ControllerHelpers',
        'currentClassName' => 'App\\Traits\\ControllerHelpers',
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