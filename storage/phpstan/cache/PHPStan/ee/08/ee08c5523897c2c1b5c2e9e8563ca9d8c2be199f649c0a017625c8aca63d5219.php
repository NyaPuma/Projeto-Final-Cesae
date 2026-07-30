<?php declare(strict_types = 1);

// odsl-C:\laravel\Projeto Final Cesae\Projeto-Final-Cesae\app\Console\Commands\SimulateTelemetry.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Console\Commands\SimulateTelemetry
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-eecc1bc5071d7f4a6c6903b3e02440443a02e5b3d72ccb1e54a4041abb7214d9',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Console\\Commands\\SimulateTelemetry',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/app/Console/Commands/SimulateTelemetry.php',
      ),
    ),
    'namespace' => 'App\\Console\\Commands',
    'name' => 'App\\Console\\Commands\\SimulateTelemetry',
    'shortName' => 'SimulateTelemetry',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Comando de simulação de telemetria para manutenção preventiva.
 * Gera tickets de avaria automáticos com base em anomalias aleatórias nos equipamentos.
 * Deve ser agendado via `routes/console.php` para execução periódica.
 *
 * Uso: php artisan telemetry:simulate
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 142,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Console\\Command',
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
      'signature' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'implementingClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'name' => 'signature',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'telemetry:simulate
                            {--equipments=3 : Número máximo de equipamentos a verificar por execução}
                            {--probability=30 : Percentagem de probabilidade de anomalia (0-100)}\'',
          'attributes' => 
          array (
            'startLine' => 26,
            'endLine' => 28,
            'startTokenPos' => 67,
            'startFilePos' => 699,
            'endTokenPos' => 67,
            'endFilePos' => 922,
          ),
        ),
        'docComment' => '/**
 * A assinatura e descrição do comando Artisan.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 26,
        'endLine' => 28,
        'startColumn' => 5,
        'endColumn' => 99,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'implementingClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Simula telemetria de equipamentos e gera tickets de manutenção preventiva automaticamente quando são detetadas anomalias.\'',
          'attributes' => 
          array (
            'startLine' => 30,
            'endLine' => 30,
            'startTokenPos' => 76,
            'startFilePos' => 955,
            'endTokenPos' => 76,
            'endFilePos' => 1080,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 30,
        'endLine' => 30,
        'startColumn' => 5,
        'endColumn' => 156,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'anomalyTypes' => 
      array (
        'declaringClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'implementingClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'name' => 'anomalyTypes',
        'modifiers' => 4,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'default' => 
        array (
          'code' => '[[\'title\' => \'Temperatura acima do limite operacional\', \'description\' => \'O sensor de temperatura do equipamento registou valores acima dos 85°C durante um período prolongado. Recomenda-se inspeção do sistema de arrefecimento.\', \'priority\' => \\App\\Enums\\TicketPriorityEnum::High->value], [\'title\' => \'Vibração anormal detetada\', \'description\' => \'O acelerómetro registou padrões de vibração fora dos parâmetros normais. Poderá indicar desgaste em rolamentos ou desalinhamento mecânico.\', \'priority\' => \\App\\Enums\\TicketPriorityEnum::Medium->value], [\'title\' => \'Consumo energético elevado\', \'description\' => \'O sistema de monitorização registou consumo elétrico 40% acima do esperado nas últimas 6 horas. Possível avaria no motor ou sobreaquecimento.\', \'priority\' => \\App\\Enums\\TicketPriorityEnum::Medium->value], [\'title\' => \'Pressão fora dos limites de segurança\', \'description\' => \'O sensor de pressão reportou valores anómalos. É necessária verificação imediata para evitar riscos operacionais.\', \'priority\' => \\App\\Enums\\TicketPriorityEnum::High->value], [\'title\' => \'Alerta de manutenção preventiva programada\', \'description\' => \'O equipamento atingiu o intervalo de manutenção preventiva recomendado pelo fabricante (500 horas de operação). Realizar inspeção de rotina.\', \'priority\' => \\App\\Enums\\TicketPriorityEnum::Low->value]]',
          'attributes' => 
          array (
            'startLine' => 35,
            'endLine' => 61,
            'startTokenPos' => 89,
            'startFilePos' => 1224,
            'endTokenPos' => 241,
            'endFilePos' => 2821,
          ),
        ),
        'docComment' => '/**
 * Tipos de anomalia possíveis e as respetivas descrições geradas automaticamente.
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 35,
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
      'handle' => 
      array (
        'name' => 'handle',
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
 * Execução principal do comando de simulação.
 */',
        'startLine' => 66,
        'endLine' => 141,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Console\\Commands',
        'declaringClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'implementingClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
        'currentClassName' => 'App\\Console\\Commands\\SimulateTelemetry',
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