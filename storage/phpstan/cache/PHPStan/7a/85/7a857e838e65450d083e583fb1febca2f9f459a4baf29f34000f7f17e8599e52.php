<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Models\Ticket.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Ticket
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-e1e2827768bf7de5a795c518b0c6ac32065f08d1846c1dd44a1e257d3916bd90',
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
    'startLine' => 18,
    'endLine' => 196,
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
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 87,
            'startFilePos' => 664,
            'endTokenPos' => 87,
            'endFilePos' => 671,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::Open->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
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
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 100,
            'startFilePos' => 776,
            'endTokenPos' => 100,
            'endFilePos' => 785,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::InProgress->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
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
            'startLine' => 27,
            'endLine' => 27,
            'startTokenPos' => 113,
            'startFilePos' => 881,
            'endTokenPos' => 113,
            'endFilePos' => 889,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::Closed->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 27,
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
            'startLine' => 30,
            'endLine' => 30,
            'startTokenPos' => 126,
            'startFilePos' => 991,
            'endTokenPos' => 126,
            'endFilePos' => 1001,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::Cancelled->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
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
            'startLine' => 33,
            'endLine' => 33,
            'startTokenPos' => 139,
            'startFilePos' => 1112,
            'endTokenPos' => 139,
            'endFilePos' => 1132,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::PendingBudget->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 33,
        'endLine' => 33,
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
            'startLine' => 36,
            'endLine' => 36,
            'startTokenPos' => 152,
            'startFilePos' => 1232,
            'endTokenPos' => 152,
            'endFilePos' => 1241,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketStatusEnum::Rejected->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 36,
        'endLine' => 36,
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
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 165,
            'startFilePos' => 1335,
            'endTokenPos' => 165,
            'endFilePos' => 1341,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketPriorityEnum::Low->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
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
            'startLine' => 42,
            'endLine' => 42,
            'startTokenPos' => 178,
            'startFilePos' => 1441,
            'endTokenPos' => 178,
            'endFilePos' => 1448,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketPriorityEnum::Medium->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 42,
        'endLine' => 42,
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
            'startLine' => 45,
            'endLine' => 45,
            'startTokenPos' => 191,
            'startFilePos' => 1544,
            'endTokenPos' => 191,
            'endFilePos' => 1549,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketPriorityEnum::High->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 45,
        'endLine' => 45,
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
            'startLine' => 48,
            'endLine' => 48,
            'startTokenPos' => 204,
            'startFilePos' => 1653,
            'endTokenPos' => 204,
            'endFilePos' => 1662,
          ),
        ),
        'docComment' => '/** @deprecated Use TicketPriorityEnum::Critical->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
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
            'startLine' => 51,
            'endLine' => 51,
            'startTokenPos' => 217,
            'startFilePos' => 1760,
            'endTokenPos' => 217,
            'endFilePos' => 1768,
          ),
        ),
        'docComment' => '/** @deprecated Use BudgetStatusEnum::Pending->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 51,
        'endLine' => 51,
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
            'startLine' => 54,
            'endLine' => 54,
            'startTokenPos' => 230,
            'startFilePos' => 1868,
            'endTokenPos' => 230,
            'endFilePos' => 1877,
          ),
        ),
        'docComment' => '/** @deprecated Use BudgetStatusEnum::Approved->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 54,
        'endLine' => 54,
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
            'startLine' => 57,
            'endLine' => 57,
            'startTokenPos' => 243,
            'startFilePos' => 1977,
            'endTokenPos' => 243,
            'endFilePos' => 1986,
          ),
        ),
        'docComment' => '/** @deprecated Use BudgetStatusEnum::Rejected->value */',
        'attributes' => 
        array (
        ),
        'startLine' => 57,
        'endLine' => 57,
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
          'code' => '[\'title\', \'description\', \'priority\', \'user_id\', \'assigned_to\', \'equipment_id\', \'room_id\', \'status_id\', \'custo_estimado\', \'orcamento_aprovado\', \'opened_at\', \'in_progress_at\', \'closed_at\', \'reopened_at\', \'cost\', \'minutes_spent\', \'technical_report\', \'budget_requested\', \'budget_status\', \'budget_amount\', \'budget_requested_at\', \'budget_approved_by\', \'budget_decided_at\', \'budget_feedback\', \'budget_details\', \'scheduled_at\', \'scheduled_end\', \'scheduled\']',
          'attributes' => 
          array (
            'startLine' => 82,
            'endLine' => 91,
            'startTokenPos' => 378,
            'startFilePos' => 2716,
            'endTokenPos' => 464,
            'endFilePos' => 3235,
          ),
        ),
        'docComment' => '/** @var list<string> */',
        'attributes' => 
        array (
        ),
        'startLine' => 82,
        'endLine' => 91,
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
          'code' => '[\'opened_at\' => \'datetime\', \'in_progress_at\' => \'datetime\', \'closed_at\' => \'datetime\', \'reopened_at\' => \'datetime\', \'scheduled_at\' => \'datetime\', \'scheduled_end\' => \'datetime\', \'budget_requested_at\' => \'datetime\', \'budget_decided_at\' => \'datetime\', \'scheduled\' => \'boolean\', \'budget_requested\' => \'boolean\', \'orcamento_aprovado\' => \'boolean\', \'cost\' => \'decimal:2\', \'budget_amount\' => \'decimal:2\', \'custo_estimado\' => \'decimal:2\', \'budget_details\' => \'json\']',
          'attributes' => 
          array (
            'startLine' => 94,
            'endLine' => 110,
            'startTokenPos' => 475,
            'startFilePos' => 3300,
            'endTokenPos' => 582,
            'endFilePos' => 3884,
          ),
        ),
        'docComment' => '/** @var array<string, string> */',
        'attributes' => 
        array (
        ),
        'startLine' => 94,
        'endLine' => 110,
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
      'flushStatusCache' => 
      array (
        'name' => 'flushStatusCache',
        'parameters' => 
        array (
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
        'docComment' => '/** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */',
        'startLine' => 60,
        'endLine' => 63,
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
            'startLine' => 66,
            'endLine' => 66,
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
        'docComment' => '/** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */',
        'startLine' => 66,
        'endLine' => 75,
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
        'docComment' => NULL,
        'startLine' => 112,
        'endLine' => 115,
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
        'docComment' => NULL,
        'startLine' => 117,
        'endLine' => 120,
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
        'startLine' => 122,
        'endLine' => 125,
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
        'docComment' => NULL,
        'startLine' => 127,
        'endLine' => 130,
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
        'docComment' => NULL,
        'startLine' => 132,
        'endLine' => 135,
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
        'docComment' => NULL,
        'startLine' => 137,
        'endLine' => 140,
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
        'docComment' => NULL,
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
      'hasStatus' => 
      array (
        'name' => 'hasStatus',
        'parameters' => 
        array (
          'status' => 
          array (
            'name' => 'status',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Enums\\TicketStatusEnum',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 157,
            'endLine' => 157,
            'startColumn' => 31,
            'endColumn' => 54,
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
        'startLine' => 157,
        'endLine' => 160,
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
      'scopeOpen' => 
      array (
        'name' => 'scopeOpen',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 162,
            'endLine' => 162,
            'startColumn' => 31,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 162,
        'endLine' => 165,
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
      'scopeInProgress' => 
      array (
        'name' => 'scopeInProgress',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 167,
            'endLine' => 167,
            'startColumn' => 37,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 167,
        'endLine' => 170,
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
      'scopeClosed' => 
      array (
        'name' => 'scopeClosed',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 172,
            'endLine' => 172,
            'startColumn' => 33,
            'endColumn' => 38,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 172,
        'endLine' => 175,
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
      'scopeScheduled' => 
      array (
        'name' => 'scopeScheduled',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 177,
            'endLine' => 177,
            'startColumn' => 36,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 177,
        'endLine' => 180,
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
      'scopeByPriority' => 
      array (
        'name' => 'scopeByPriority',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 182,
            'endLine' => 182,
            'startColumn' => 37,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'priority' => 
          array (
            'name' => 'priority',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Enums\\TicketPriorityEnum',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 182,
            'endLine' => 182,
            'startColumn' => 45,
            'endColumn' => 72,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 182,
        'endLine' => 185,
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
      'scopeForTechnician' => 
      array (
        'name' => 'scopeForTechnician',
        'parameters' => 
        array (
          'query' => 
          array (
            'name' => 'query',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 187,
            'endLine' => 187,
            'startColumn' => 40,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'technicianId' => 
          array (
            'name' => 'technicianId',
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
            'startLine' => 187,
            'endLine' => 187,
            'startColumn' => 48,
            'endColumn' => 64,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 187,
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
        'docComment' => NULL,
        'startLine' => 192,
        'endLine' => 195,
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