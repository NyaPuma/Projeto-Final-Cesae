<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Models\Ticket.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Ticket
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-c33313369e7564852a1b93c624172ca6db5b3e9101e606534dc43f48dd54aa37',
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
    'endLine' => 417,
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
      'PRIORITY_CRITICAL' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'PRIORITY_CRITICAL',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '\'crítica\'',
          'attributes' => 
          array (
            'startLine' => 38,
            'endLine' => 38,
            'startTokenPos' => 173,
            'startFilePos' => 942,
            'endTokenPos' => 173,
            'endFilePos' => 951,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 38,
        'endLine' => 38,
        'startColumn' => 5,
        'endColumn' => 48,
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
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 186,
            'startFilePos' => 1018,
            'endTokenPos' => 186,
            'endFilePos' => 1026,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
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
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 197,
            'startFilePos' => 1065,
            'endTokenPos' => 197,
            'endFilePos' => 1074,
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
            'startLine' => 45,
            'endLine' => 45,
            'startTokenPos' => 208,
            'startFilePos' => 1113,
            'endTokenPos' => 208,
            'endFilePos' => 1122,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 46,
      ),
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'App\\Models\\Ticket',
        'implementingClassName' => 'App\\Models\\Ticket',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'title\', \'description\', \'priority\', \'user_id\', \'assigned_to\', \'equipment_id\', \'room_id\', \'status_id\', \'opened_at\', \'in_progress_at\', \'closed_at\', \'reopened_at\', \'cost\', \'minutes_spent\', \'technical_report\', \'budget_requested\', \'budget_status\', \'budget_amount\', \'budget_requested_at\', \'budget_approved_by\', \'budget_decided_at\', \'budget_feedback\', \'budget_details\', \'scheduled_at\', \'scheduled_end\', \'scheduled\']',
          'attributes' => 
          array (
            'startLine' => 47,
            'endLine' => 74,
            'startTokenPos' => 217,
            'startFilePos' => 1152,
            'endTokenPos' => 297,
            'endFilePos' => 1775,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 74,
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
            'startLine' => 76,
            'endLine' => 90,
            'startTokenPos' => 306,
            'startFilePos' => 1802,
            'endTokenPos' => 405,
            'endFilePos' => 2481,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 76,
        'endLine' => 90,
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
        'startLine' => 110,
        'endLine' => 113,
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
        'startLine' => 126,
        'endLine' => 129,
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
        'startLine' => 134,
        'endLine' => 137,
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
        'startLine' => 142,
        'endLine' => 145,
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
        'startLine' => 147,
        'endLine' => 150,
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
        'startLine' => 152,
        'endLine' => 155,
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
        'startLine' => 159,
        'endLine' => 171,
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
            'startLine' => 173,
            'endLine' => 173,
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
        'startLine' => 173,
        'endLine' => 190,
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
        'startLine' => 192,
        'endLine' => 207,
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
            'startLine' => 213,
            'endLine' => 213,
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
            'startLine' => 213,
            'endLine' => 213,
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
        'startLine' => 213,
        'endLine' => 230,
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
            'startLine' => 235,
            'endLine' => 235,
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
                'startLine' => 235,
                'endLine' => 235,
                'startTokenPos' => 1142,
                'startFilePos' => 6186,
                'endTokenPos' => 1142,
                'endFilePos' => 6194,
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
            'startLine' => 235,
            'endLine' => 235,
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
                'startLine' => 235,
                'endLine' => 235,
                'startTokenPos' => 1152,
                'startFilePos' => 6217,
                'endTokenPos' => 1152,
                'endFilePos' => 6220,
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
            'startLine' => 235,
            'endLine' => 235,
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
        'startLine' => 235,
        'endLine' => 268,
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
        'startLine' => 273,
        'endLine' => 280,
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
        'startLine' => 288,
        'endLine' => 291,
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
        'startLine' => 297,
        'endLine' => 300,
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
        'startLine' => 305,
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
        'startLine' => 313,
        'endLine' => 337,
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
            'startLine' => 342,
            'endLine' => 342,
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
        'startLine' => 342,
        'endLine' => 359,
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
            'startLine' => 366,
            'endLine' => 366,
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
        'startLine' => 366,
        'endLine' => 369,
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
            'startLine' => 374,
            'endLine' => 374,
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
        'startLine' => 374,
        'endLine' => 383,
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
        'startLine' => 388,
        'endLine' => 401,
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
        'startLine' => 406,
        'endLine' => 416,
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