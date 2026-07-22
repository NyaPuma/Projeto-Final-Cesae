<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Models\Ticket.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Ticket
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-f6e2e8510e1139b76955648efeb11ec531399b14e2fc3fb7a7459b994b6c9d04',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Ticket',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Models/Ticket.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\Ticket',
    'shortName' => 'Ticket',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 388,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'App\\Traits\\Auditable',
      1 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
    ),
    'immediateConstants' => 
    array (
      'STATUS_OPEN' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_OPEN',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'aberta\'',
          'attributes' => 
          array (
            'startLine' => 19,
            'endLine' => 19,
            'startTokenPos' => 72,
            'startFilePos' => 476,
            'endTokenPos' => 72,
            'endFilePos' => 483,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 19,
        'endLine' => 19,
        'startColumn' => 5,
        'endColumn' => 40,
      ),
      'STATUS_IN_PROGRESS' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_IN_PROGRESS',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'em curso\'',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 83,
            'startFilePos' => 525,
            'endTokenPos' => 83,
            'endFilePos' => 534,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 5,
        'endColumn' => 49,
      ),
      'STATUS_CLOSED' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_CLOSED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'fechada\'',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 94,
            'startFilePos' => 571,
            'endTokenPos' => 94,
            'endFilePos' => 579,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 43,
      ),
      'STATUS_CANCELLED' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_CANCELLED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'cancelada\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 105,
            'startFilePos' => 619,
            'endTokenPos' => 105,
            'endFilePos' => 629,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 48,
      ),
      'STATUS_PENDING_BUDGET' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_PENDING_BUDGET',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'pendente orçamento\'',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 27,
            'startTokenPos' => 116,
            'startFilePos' => 674,
            'endTokenPos' => 116,
            'endFilePos' => 694,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 63,
      ),
      'STATUS_REJECTED' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'STATUS_REJECTED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'recusada\'',
          'attributes' => 
          array (
            'startLine' => 29,
            'endLine' => 29,
            'startTokenPos' => 127,
            'startFilePos' => 733,
            'endTokenPos' => 127,
            'endFilePos' => 742,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 29,
        'endLine' => 29,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
      'PRIORITY_LOW' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'PRIORITY_LOW',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'baixa\'',
          'attributes' => 
          array (
            'startLine' => 32,
            'endLine' => 32,
            'startTokenPos' => 140,
            'startFilePos' => 807,
            'endTokenPos' => 140,
            'endFilePos' => 813,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 40,
      ),
      'PRIORITY_MEDIUM' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'PRIORITY_MEDIUM',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'média\'',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 151,
            'startFilePos' => 852,
            'endTokenPos' => 151,
            'endFilePos' => 859,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 44,
      ),
      'PRIORITY_HIGH' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'PRIORITY_HIGH',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'alta\'',
          'attributes' => 
          array (
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 162,
            'startFilePos' => 896,
            'endTokenPos' => 162,
            'endFilePos' => 901,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
        'startColumn' => 5,
        'endColumn' => 40,
      ),
      'BUDGET_PENDING' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'BUDGET_PENDING',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'pending\'',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 175,
            'startFilePos' => 968,
            'endTokenPos' => 175,
            'endFilePos' => 976,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 44,
      ),
      'BUDGET_APPROVED' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'BUDGET_APPROVED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'approved\'',
          'attributes' => 
          array (
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 186,
            'startFilePos' => 1015,
            'endTokenPos' => 186,
            'endFilePos' => 1024,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
      'BUDGET_REJECTED' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'BUDGET_REJECTED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'rejected\'',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 197,
            'startFilePos' => 1063,
            'endTokenPos' => 197,
            'endFilePos' => 1072,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
      'guarded' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'guarded',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 45,
            'endLine' => 45,
            'startTokenPos' => 206,
            'startFilePos' => 1101,
            'endTokenPos' => 207,
            'endFilePos' => 1102,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 28,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'casts' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'casts',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[
    \'opened_at\' => \'datetime\',
    \'in_progress_at\' => \'datetime\',
    \'closed_at\' => \'datetime\',
    \'reopened_at\' => \'datetime\',
    \'scheduled_at\' => \'datetime\',
    \'scheduled_end\' => \'datetime\',
    \'budget_requested_at\' => \'datetime\',
    // 🟢 CORRIGIDO: Garante uso de objetos Carbon/DateTime para o SLA
    \'budget_decided_at\' => \'datetime\',
    // 🟢 CORRIGIDO: Garante uso de objetos Carbon/DateTime para o SLA
    \'scheduled\' => \'boolean\',
    \'budget_requested\' => \'boolean\',
    \'cost\' => \'decimal:2\',
    \'budget_amount\' => \'decimal:2\',
    \'budget_details\' => \'json\',
]',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 61,
            'startTokenPos' => 216,
            'startFilePos' => 1129,
            'endTokenPos' => 315,
            'endFilePos' => 1808,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 61,
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
      'status' => 
      array (
        'name' => 'status',
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
        'docComment' => '/**
 * @return BelongsTo<TicketStatus, $this>
 */',
        'startLine' => 68,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'budgetApprovedBy' => 
      array (
        'name' => 'budgetApprovedBy',
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
        'docComment' => '/**
 * @return BelongsTo<User, $this>
 */',
        'startLine' => 76,
        'endLine' => 79,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'workflowHistory' => 
      array (
        'name' => 'workflowHistory',
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
        'startLine' => 81,
        'endLine' => 84,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'user' => 
      array (
        'name' => 'user',
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
        'docComment' => '/**
 * @return BelongsTo<User, $this>
 */',
        'startLine' => 89,
        'endLine' => 92,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
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
        'docComment' => '/**
 * @return BelongsTo<User, $this>
 */',
        'startLine' => 97,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'equipment' => 
      array (
        'name' => 'equipment',
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
        'docComment' => '/**
 * @return BelongsTo<Equipment, $this>
 */',
        'startLine' => 105,
        'endLine' => 108,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
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
        'docComment' => '/**
 * @return BelongsTo<Room, $this>
 */',
        'startLine' => 113,
        'endLine' => 116,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'comments' => 
      array (
        'name' => 'comments',
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
        'startLine' => 118,
        'endLine' => 121,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'attachments' => 
      array (
        'name' => 'attachments',
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
        'startLine' => 123,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'startRepair' => 
      array (
        'name' => 'startRepair',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 130,
        'endLine' => 142,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'checkAutoClose' => 
      array (
        'name' => 'checkAutoClose',
        'parameters' => 
        array (
          'threshold' => 
          array (
            'name' => 'threshold',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'float',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 144,
            'endLine' => 144,
            'startColumn' => 36,
            'endColumn' => 51,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 144,
        'endLine' => 161,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'reopen' => 
      array (
        'name' => 'reopen',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 163,
        'endLine' => 178,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'requestBudgetAuthorization' => 
      array (
        'name' => 'requestBudgetAuthorization',
        'parameters' => 
        array (
          'estimatedBudget' => 
          array (
            'name' => 'estimatedBudget',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'float',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 184,
            'endLine' => 184,
            'startColumn' => 48,
            'endColumn' => 69,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'threshold' => 
          array (
            'name' => 'threshold',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'float',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 184,
            'endLine' => 184,
            'startColumn' => 72,
            'endColumn' => 87,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Solicitado pelo Técnico quando avalia que o custo estimado supera o limiar da empresa.
 * Congela/Regista o timestamp para permitir a pausa do SLA nos relatórios de Analytics.
 */',
        'startLine' => 184,
        'endLine' => 201,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'approveBudget' => 
      array (
        'name' => 'approveBudget',
        'parameters' => 
        array (
          'admin' => 
          array (
            'name' => 'admin',
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
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 35,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'decision' => 
          array (
            'name' => 'decision',
            'default' => 
            array (
              'code' => '\'approve\'',
              'attributes' => 
              array (
                'startLine' => 206,
                'endLine' => 206,
                'startTokenPos' => 1052,
                'startFilePos' => 5513,
                'endTokenPos' => 1052,
                'endFilePos' => 5521,
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
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 48,
            'endColumn' => 75,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'feedback' => 
          array (
            'name' => 'feedback',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 206,
                'endLine' => 206,
                'startTokenPos' => 1062,
                'startFilePos' => 5544,
                'endTokenPos' => 1062,
                'endFilePos' => 5547,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'string',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'null',
                      'isIdentifier' => true,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 206,
            'endLine' => 206,
            'startColumn' => 78,
            'endColumn' => 101,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Executado exclusivamente pelo Administrador para aprovar ou rejeitar o orçamento.
 */',
        'startLine' => 206,
        'endLine' => 239,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getBudgetPauseMinutesAttribute' => 
      array (
        'name' => 'getBudgetPauseMinutesAttribute',
        'parameters' => 
        array (
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
 * Helper de Negócio: Calcula o tempo morto (em minutos) em que o ticket esteve parado a aguardar decisão orçamental.
 */',
        'startLine' => 244,
        'endLine' => 251,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getTotalMaterialCostAttribute' => 
      array (
        'name' => 'getTotalMaterialCostAttribute',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'float',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calcula o custo total de materiais a partir do budget_details (JSON).
 * Material: quantity × unit_price
 */',
        'startLine' => 259,
        'endLine' => 262,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getTotalLaborCostAttribute' => 
      array (
        'name' => 'getTotalLaborCostAttribute',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'float',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calcula o custo total de mão de obra a partir do budget_details (JSON).
 * Labor: hours × hourly_rate
 */',
        'startLine' => 268,
        'endLine' => 271,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getBudgetTotalAttribute' => 
      array (
        'name' => 'getBudgetTotalAttribute',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'float',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calcula o custo total do orçamento (materiais + mão de obra).
 */',
        'startLine' => 276,
        'endLine' => 279,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getBudgetBreakdownAttribute' => 
      array (
        'name' => 'getBudgetBreakdownAttribute',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Retorna um array com breakdown material vs labor.
 */',
        'startLine' => 284,
        'endLine' => 308,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'calculateBudgetTotalByType' => 
      array (
        'name' => 'calculateBudgetTotalByType',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
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
            'startLine' => 313,
            'endLine' => 313,
            'startColumn' => 49,
            'endColumn' => 60,
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
            'name' => 'float',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Método privado auxiliar para calcular total por tipo.
 */',
        'startLine' => 313,
        'endLine' => 330,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getStatusIdByName' => 
      array (
        'name' => 'getStatusIdByName',
        'parameters' => 
        array (
          'statusName' => 
          array (
            'name' => 'statusName',
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
            'startLine' => 337,
            'endLine' => 337,
            'startColumn' => 46,
            'endColumn' => 63,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'int',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Obtém o ID do status pelo nome na tabela `ticket_statuses`.
 */',
        'startLine' => 337,
        'endLine' => 340,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'hasStatus' => 
      array (
        'name' => 'hasStatus',
        'parameters' => 
        array (
          'statusName' => 
          array (
            'name' => 'statusName',
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
            'startLine' => 345,
            'endLine' => 345,
            'startColumn' => 31,
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
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Verifica se o ticket está num determinado estado pelo nome.
 */',
        'startLine' => 345,
        'endLine' => 354,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getLeastBusyTechnician' => 
      array (
        'name' => 'getLeastBusyTechnician',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
          'data' => 
          array (
            'types' => 
            array (
              0 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'App\\Models\\User',
                  'isIdentifier' => false,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Obtém o técnico com menos tickets atribuídos no momento.
 */',
        'startLine' => 359,
        'endLine' => 372,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
        'aliasName' => NULL,
      ),
      'getScheduledEvents' => 
      array (
        'name' => 'getScheduledEvents',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Atalho de segurança para recolher eventos agendados para o FullCalendar.
 */',
        'startLine' => 377,
        'endLine' => 387,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'currentClassName' => 'App\\Models\\Ticket',
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