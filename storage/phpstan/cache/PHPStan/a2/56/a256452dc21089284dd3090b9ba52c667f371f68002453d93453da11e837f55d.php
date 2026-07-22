<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Models\TicketWorkflowHistory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\TicketWorkflowHistory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-8fd6009876c7f3d1bc87bb5a7bd6486d120e446e4238cbfe012cb1fd38586c24',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\TicketWorkflowHistory',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Models/TicketWorkflowHistory.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\TicketWorkflowHistory',
    'shortName' => 'TicketWorkflowHistory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 43,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'table' => 
      array (
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'name' => 'table',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'ticket_workflow_history\'',
          'attributes' => 
          array (
            'startLine' => 14,
            'endLine' => 14,
            'startTokenPos' => 45,
            'startFilePos' => 342,
            'endTokenPos' => 45,
            'endFilePos' => 366,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 14,
        'endLine' => 14,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'fillable' => 
      array (
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'ticket_id\', \'origin_status_id\', \'destination_status_id\', \'technician_id\', \'comment\']',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 22,
            'startTokenPos' => 54,
            'startFilePos' => 396,
            'endTokenPos' => 70,
            'endFilePos' => 527,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 22,
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
      'ticket' => 
      array (
        'name' => 'ticket',
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
        'startLine' => 24,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'currentClassName' => 'App\\Models\\TicketWorkflowHistory',
        'aliasName' => NULL,
      ),
      'originStatus' => 
      array (
        'name' => 'originStatus',
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
        'startLine' => 29,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'currentClassName' => 'App\\Models\\TicketWorkflowHistory',
        'aliasName' => NULL,
      ),
      'destinationStatus' => 
      array (
        'name' => 'destinationStatus',
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
        'startLine' => 34,
        'endLine' => 37,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'currentClassName' => 'App\\Models\\TicketWorkflowHistory',
        'aliasName' => NULL,
      ),
      'technician' => 
      array (
        'name' => 'technician',
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
        'startLine' => 39,
        'endLine' => 42,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\TicketWorkflowHistory',
        'implementingClassName' => 'App\\Models\\TicketWorkflowHistory',
        'currentClassName' => 'App\\Models\\TicketWorkflowHistory',
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