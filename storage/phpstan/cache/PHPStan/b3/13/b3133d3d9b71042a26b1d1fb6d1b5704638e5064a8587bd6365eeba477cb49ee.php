<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../kkomelin/laravel-translatable-string-exporter/src/Console/ExportCommand.php-PHPStan\BetterReflection\Reflection\ReflectionClass-KKomelin\TranslatableStringExporter\Console\ExportCommand
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-f5c2dc34ddd9c2c6fb710ecb09a802a5b4961878de802ff6b007c45e85f069fd-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../kkomelin/laravel-translatable-string-exporter/src/Console/ExportCommand.php',
      ),
    ),
    'namespace' => 'KKomelin\\TranslatableStringExporter\\Console',
    'name' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
    'shortName' => 'ExportCommand',
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
    'endLine' => 69,
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
      'name' => 
      array (
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'name' => 'name',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'translatable:export\'',
          'attributes' => 
          array (
            'startLine' => 16,
            'endLine' => 16,
            'startTokenPos' => 40,
            'startFilePos' => 337,
            'endTokenPos' => 40,
            'endFilePos' => 357,
          ),
        ),
        'docComment' => '/**
 * The console command name.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 16,
        'endLine' => 16,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Export translatable strings for a language to a JSON file.\'',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 51,
            'startFilePos' => 472,
            'endTokenPos' => 51,
            'endFilePos' => 531,
          ),
        ),
        'docComment' => '/**
 * The console command description.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 90,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'exporter' => 
      array (
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'name' => 'exporter',
        'modifiers' => 2,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'KKomelin\\TranslatableStringExporter\\Core\\Exporter',
            'isIdentifier' => false,
          ),
        ),
        'default' => NULL,
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 31,
        'endLine' => 31,
        'startColumn' => 33,
        'endColumn' => 60,
        'isPromoted' => true,
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
          'exporter' => 
          array (
            'name' => 'exporter',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'KKomelin\\TranslatableStringExporter\\Core\\Exporter',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => true,
            'attributes' => 
            array (
            ),
            'startLine' => 31,
            'endLine' => 31,
            'startColumn' => 33,
            'endColumn' => 60,
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
 * ExportCommand constructor.
 *
 * @param  \\KKomelin\\TranslatableStringExporter\\Core\\Exporter  $exporter
 * @return void
 */',
        'startLine' => 31,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'KKomelin\\TranslatableStringExporter\\Console',
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'currentClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'aliasName' => NULL,
      ),
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute the console command.
 *
 * @return int
 */',
        'startLine' => 41,
        'endLine' => 52,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'KKomelin\\TranslatableStringExporter\\Console',
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'currentClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'aliasName' => NULL,
      ),
      'getArguments' => 
      array (
        'name' => 'getArguments',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the console command arguments.
 *
 * @return array
 */',
        'startLine' => 59,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'KKomelin\\TranslatableStringExporter\\Console',
        'declaringClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'implementingClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
        'currentClassName' => 'KKomelin\\TranslatableStringExporter\\Console\\ExportCommand',
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