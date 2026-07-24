<?php declare(strict_types = 1);

// osfsl-C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../laravel/sail/src/Console/Concerns/InteractsWithDockerComposeServices.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Sail\Console\Concerns\InteractsWithDockerComposeServices
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-61df23880a63bb68c9d9e975a2633d1d04b30faac1ffc016c99a71d8d6db1f38-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'filename' => 'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/../laravel/sail/src/Console/Concerns/InteractsWithDockerComposeServices.php',
      ),
    ),
    'namespace' => 'Laravel\\Sail\\Console\\Concerns',
    'name' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
    'shortName' => 'InteractsWithDockerComposeServices',
    'isInterface' => false,
    'isTrait' => true,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 344,
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
      'composePaths' => 
      array (
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'name' => 'composePaths',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'compose.yaml\', \'compose.yml\', \'docker-compose.yaml\', \'docker-compose.yml\']',
          'attributes' => 
          array (
            'startLine' => 15,
            'endLine' => 20,
            'startTokenPos' => 31,
            'startFilePos' => 310,
            'endTokenPos' => 45,
            'endFilePos' => 424,
          ),
        ),
        'docComment' => '/**
 * Possible names for the compose file according to the spec.
 *
 * @var array<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 15,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'services' => 
      array (
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'name' => 'services',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'mysql\', \'pgsql\', \'mariadb\', \'mongodb\', \'redis\', \'valkey\', \'memcached\', \'meilisearch\', \'typesense\', \'minio\', \'rustfs\', \'mailpit\', \'rabbitmq\', \'selenium\', \'soketi\']',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 43,
            'startTokenPos' => 56,
            'startFilePos' => 556,
            'endTokenPos' => 103,
            'endFilePos' => 846,
          ),
        ),
        'docComment' => '/**
 * The available services that may be installed.
 *
 * @var array<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'defaultServices' => 
      array (
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'name' => 'defaultServices',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'mysql\', \'redis\', \'selenium\', \'mailpit\']',
          'attributes' => 
          array (
            'startLine' => 50,
            'endLine' => 50,
            'startTokenPos' => 114,
            'startFilePos' => 1004,
            'endTokenPos' => 125,
            'endFilePos' => 1044,
          ),
        ),
        'docComment' => '/**
 * The default services used when the user chooses non-interactive mode.
 *
 * @var string[]
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 50,
        'endLine' => 50,
        'startColumn' => 5,
        'endColumn' => 75,
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
      'gatherServicesInteractively' => 
      array (
        'name' => 'gatherServicesInteractively',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gather the desired Sail services using an interactive prompt.
 *
 * @return array
 */',
        'startLine' => 57,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'buildDockerCompose' => 
      array (
        'name' => 'buildDockerCompose',
        'parameters' => 
        array (
          'services' => 
          array (
            'name' => 'services',
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
            'startLine' => 76,
            'endLine' => 76,
            'startColumn' => 43,
            'endColumn' => 57,
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
 * Build the Docker Compose file.
 *
 * @param  array  $services
 * @return void
 */',
        'startLine' => 76,
        'endLine' => 132,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'replaceEnvVariables' => 
      array (
        'name' => 'replaceEnvVariables',
        'parameters' => 
        array (
          'services' => 
          array (
            'name' => 'services',
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
            'startLine' => 140,
            'endLine' => 140,
            'startColumn' => 44,
            'endColumn' => 58,
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
 * Replace the Host environment variables in the app\'s .env file.
 *
 * @param  array  $services
 * @return void
 */',
        'startLine' => 140,
        'endLine' => 233,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'configurePhpUnit' => 
      array (
        'name' => 'configurePhpUnit',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Configure PHPUnit to use the dedicated testing database.
 *
 * @return void
 */',
        'startLine' => 240,
        'endLine' => 260,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'installDevContainer' => 
      array (
        'name' => 'installDevContainer',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Install the devcontainer.json configuration file.
 *
 * @return void
 */',
        'startLine' => 267,
        'endLine' => 284,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'prepareInstallation' => 
      array (
        'name' => 'prepareInstallation',
        'parameters' => 
        array (
          'services' => 
          array (
            'name' => 'services',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 292,
            'endLine' => 292,
            'startColumn' => 44,
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
 * Prepare the installation by pulling and building any necessary images.
 *
 * @param  array  $services
 * @return void
 */',
        'startLine' => 292,
        'endLine' => 308,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'runCommands' => 
      array (
        'name' => 'runCommands',
        'parameters' => 
        array (
          'commands' => 
          array (
            'name' => 'commands',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 316,
            'endLine' => 316,
            'startColumn' => 36,
            'endColumn' => 44,
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
 * Run the given commands.
 *
 * @param  array  $commands
 * @return int
 */',
        'startLine' => 316,
        'endLine' => 331,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'aliasName' => NULL,
      ),
      'composePath' => 
      array (
        'name' => 'composePath',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the path to an existing Compose file or fall back to a default of `compose.yaml`.
 *
 * @return string
 */',
        'startLine' => 338,
        'endLine' => 343,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Laravel\\Sail\\Console\\Concerns',
        'declaringClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'implementingClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
        'currentClassName' => 'Laravel\\Sail\\Console\\Concerns\\InteractsWithDockerComposeServices',
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