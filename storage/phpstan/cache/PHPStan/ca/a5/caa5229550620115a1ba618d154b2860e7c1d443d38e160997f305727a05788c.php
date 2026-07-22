<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Models\Equipment.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Equipment
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-3f053fcb3b91c1596ad7ec55a47a18f6021121c3e5de646952f2842094fdba33',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Equipment',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Models/Equipment.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\Equipment',
    'shortName' => 'Equipment',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 49,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      1 => 'App\\Traits\\Auditable',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'table' => 
      array (
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'name' => 'table',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'equipments\'',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 75,
            'startFilePos' => 459,
            'endTokenPos' => 75,
            'endFilePos' => 470,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'fillable' => 
      array (
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[
    \'name\',
    \'serial\',
    \'room_id\',
    \'category_id\',
    // 2. Garante que está no fillable
    \'active\',
]',
          'attributes' => 
          array (
            'startLine' => 22,
            'endLine' => 28,
            'startTokenPos' => 84,
            'startFilePos' => 500,
            'endTokenPos' => 103,
            'endFilePos' => 636,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 22,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'casts' => 
      array (
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'name' => 'casts',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'active\' => \'boolean\']',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 32,
            'startTokenPos' => 112,
            'startFilePos' => 663,
            'endTokenPos' => 121,
            'endFilePos' => 700,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 32,
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
      'category' => 
      array (
        'name' => 'category',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 35,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'currentClassName' => 'App\\Models\\Equipment',
        'aliasName' => NULL,
      ),
      'room' => 
      array (
        'name' => 'room',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 40,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'currentClassName' => 'App\\Models\\Equipment',
        'aliasName' => NULL,
      ),
      'tickets' => 
      array (
        'name' => 'tickets',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 45,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Equipment',
        'implementingClassName' => 'App\\Models\\Equipment',
        'currentClassName' => 'App\\Models\\Equipment',
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