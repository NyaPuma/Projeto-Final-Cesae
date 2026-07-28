<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1785141032,
	'meta' => array (
  'cacheVersion' => 'v13-packageDependencies',
  'phpstanVersion' => '2.2.5',
  'fnsr' => false,
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80212,
  'projectConfig' => '{conditionalTags: {Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule: {phpstan.rules.rule: %noEnvCallsOutsideOfConfig%}, Larastan\\Larastan\\Rules\\NoModelMakeRule: {phpstan.rules.rule: %noModelMake%}, Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule: {phpstan.rules.rule: %noUnnecessaryCollectionCall%}, Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule: {phpstan.rules.rule: %noUnnecessaryEnumerableToArrayCalls%}, Larastan\\Larastan\\Rules\\OctaneCompatibilityRule: {phpstan.rules.rule: %checkOctaneCompatibility%}, Larastan\\Larastan\\Rules\\UnusedViewsRule: {phpstan.rules.rule: %checkUnusedViews%}, Larastan\\Larastan\\Rules\\NoMissingTranslationsRule: {phpstan.rules.rule: %checkMissingTranslations%}, Larastan\\Larastan\\Rules\\ModelAppendsRule: {phpstan.rules.rule: %checkModelAppends%}, Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule: {phpstan.rules.rule: %checkModelMethodVisibility%}, Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %generalizeEnvReturnType%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension: {phpstan.broker.dynamicMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension: {phpstan.broker.dynamicStaticMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\Rules\\ConfigCollectionRule: {phpstan.rules.rule: %checkConfigTypes%}}, parameters: {universalObjectCratesClasses: [Illuminate\\Http\\Request, Illuminate\\Support\\Optional], earlyTerminatingFunctionCalls: [abort, dd], mixinExcludeClasses: [Eloquent], bootstrapFiles: [bootstrap.php], checkOctaneCompatibility: false, noEnvCallsOutsideOfConfig: true, noModelMake: true, noUnnecessaryCollectionCall: true, noUnnecessaryCollectionCallOnly: [], noUnnecessaryCollectionCallExcept: [], noUnnecessaryEnumerableToArrayCalls: false, squashedMigrationsPath: [], databaseMigrationsPath: [], disableMigrationScan: false, disableSchemaScan: false, configDirectories: [], viewDirectories: [], translationDirectories: [], checkModelProperties: false, checkUnusedViews: false, checkMissingTranslations: false, checkModelAppends: true, checkModelMethodVisibility: false, generalizeEnvReturnType: false, checkConfigTypes: false, checkAuthCallsWhenInRequestScope: false, parseModelCastsMethod: false, enableMigrationCache: false, level: 5, paths: [C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app], tmpDir: C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\storage\\phpstan}, rules: [Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessWithFunctionCallsRule, Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessValueFunctionCallsRule, Larastan\\Larastan\\Rules\\DeferrableServiceProviderMissingProvidesRule, Larastan\\Larastan\\Rules\\ConsoleCommand\\UndefinedArgumentOrOptionRule], services: {{class: Larastan\\Larastan\\Methods\\RelationForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\EloquentBuilderForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderTapProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderCollectionProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\StorageMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ContractsMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\FacadesMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ManagersMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\AuthsMethodsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelFactoryMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\RedirectResponseMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\MacroMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ViewWithMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelAccessorExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\HigherOrderCollectionProxyPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\HigherOrderTapProxyExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\Properties\\ModelRelationsExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelOnlyDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelFactoryDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthManagerExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DateExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestFileExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestRouteExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestUserExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentBuilderExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RelationCollectionExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TestCaseExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Support\\CollectionHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AuthExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\CollectExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\NowAndTodayExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ResponseExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValidatorExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\LiteralExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionFilterRejectDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionWhereNotNullDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\NewModelQueryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\FactoryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: true}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: true}}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AppExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValueExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\StrExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\TapExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\StorageDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\GenericEloquentCollectionTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Types\\ViewStringTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Rules\\OctaneCompatibilityRule}, {class: Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule, arguments: {configDirectories: %configDirectories%}}, {class: Larastan\\Larastan\\Rules\\NoModelMakeRule}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule, arguments: {onlyMethods: %noUnnecessaryCollectionCallOnly%, excludeMethods: %noUnnecessaryCollectionCallExcept%}}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule}, {class: Larastan\\Larastan\\Rules\\ModelAppendsRule}, {class: Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule}, {class: Larastan\\Larastan\\Types\\GenericEloquentBuilderTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppFacadeEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\ModelProperty\\ModelPropertyTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension], arguments: {active: %checkModelProperties%}}, {class: Larastan\\Larastan\\Types\\CollectionOf\\CollectionOfTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Properties\\MigrationHelper, arguments: {databaseMigrationPath: %databaseMigrationsPath%, disableMigrationScan: %disableMigrationScan%, parser: @migrationsParser, reflectionProvider: @reflectionProvider}}, iamcalSqlParser: {class: Larastan\\Larastan\\SQL\\IamcalSqlParser, autowired: false}, sqlParserFactory: {class: Larastan\\Larastan\\SQL\\SqlParserFactory, arguments: {iamcalSqlParser: @iamcalSqlParser}}, sqlParser: {type: Larastan\\Larastan\\SQL\\SqlParser, factory: [@sqlParserFactory, create]}, {class: Larastan\\Larastan\\Properties\\SquashedMigrationHelper, arguments: {schemaPaths: %squashedMigrationsPath%, disableSchemaScan: %disableSchemaScan%}}, {class: Larastan\\Larastan\\Properties\\ModelCastHelper, arguments: {parser: @currentPhpVersionSimpleDirectParser, parseModelCastsMethod: %parseModelCastsMethod%}}, {class: Larastan\\Larastan\\Properties\\MigrationCache, arguments: {cacheDirectory: %tmpDir%, enabled: %enableMigrationCache%}}, {class: Larastan\\Larastan\\Properties\\ModelPropertyHelper}, {class: Larastan\\Larastan\\Rules\\ModelRuleHelper}, {class: Larastan\\Larastan\\Methods\\BuilderHelper, arguments: {checkProperties: %checkModelProperties%}}, {class: Larastan\\Larastan\\Rules\\RelationExistenceRule, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Bus\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Events\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Properties\\Schema\\MySqlDataTypeToPhpTypeConverter}, {class: Larastan\\Larastan\\LarastanStubFilesExtension, tags: [phpstan.stubFilesExtension]}, {class: Larastan\\Larastan\\Rules\\UnusedViewsRule}, {class: Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedEmailViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewFacadeMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedRouteFacadeViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewInAnotherViewCollector}, {class: Larastan\\Larastan\\Support\\ViewFileHelper, arguments: {viewDirectories: %viewDirectories%}}, {class: Larastan\\Larastan\\Support\\ViewParser, arguments: {parser: @currentPhpVersionSimpleDirectParser}}, {class: Larastan\\Larastan\\Rules\\NoMissingTranslationsRule, arguments: {translationDirectories: %translationDirectories%}}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationTranslatorCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFacadeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationViewCollector}, {class: Larastan\\Larastan\\ReturnTypes\\ApplicationMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\ArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\OptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasOptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TranslatorGetReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\LangGetReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TransHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DoubleUnderscoreHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeHelper}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationResolver}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationHelper}, {class: Larastan\\Larastan\\Support\\HigherOrderCollectionProxyHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension}, {class: Larastan\\Larastan\\Support\\ConfigParser, arguments: {parser: @currentPhpVersionSimpleDirectParser, configPaths: %configDirectories%, treatPhpDocTypesAsCertain: %treatPhpDocTypesAsCertain%}}, {class: Larastan\\Larastan\\Internal\\ConfigHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\FormRequestSafeDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentCollectionMapDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\ConfigCollectionRule}, {class: Illuminate\\Filesystem\\Filesystem, autowired: self}, migrationsParser: {class: PHPStan\\Parser\\CachedParser, arguments: {originalParser: @currentPhpVersionSimpleDirectParser, cachedNodesByStringCountMax: %cache.nodesByStringCountMax%}, autowired: false}}}',
  'analysedPaths' => 
  array (
    0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app',
  ),
  'scannedFiles' => 
  array (
  ),
  'composerLocks' => 
  array (
    'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/composer.lock' => '745a51e2c8d3de1dbc68a3436c2f3c3fdadd9bc7597eba6ff257e1a74dcd69c7',
  ),
  'composerInstalled' => 
  array (
    'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'barryvdh/laravel-dompdf' => 
        array (
          'pretty_version' => 'v3.1.2',
          'version' => '3.1.2.0',
          'reference' => 'ee3b72b19ccdf57d0243116ecb2b90261344dedc',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../barryvdh/laravel-dompdf',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'brick/math' => 
        array (
          'pretty_version' => '0.14.8',
          'version' => '0.14.8.0',
          'reference' => '63422359a44b7f06cae63c3b429b59e8efcc0629',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../brick/math',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'carbonphp/carbon-doctrine-types' => 
        array (
          'pretty_version' => '3.2.0',
          'version' => '3.2.0.0',
          'reference' => '18ba5ddfec8976260ead6e866180bd5d2f71aa1d',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../carbonphp/carbon-doctrine-types',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'composer/pcre' => 
        array (
          'pretty_version' => '3.4.0',
          'version' => '3.4.0.0',
          'reference' => 'd5a341b3fb61f3001970940afb1d332968a183ed',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/./pcre',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'composer/semver' => 
        array (
          'pretty_version' => '3.4.4',
          'version' => '3.4.4.0',
          'reference' => '198166618906cb2de69b95d7d47e5fa8aa1b2b95',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/./semver',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'cordoval/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'darkaonline/l5-swagger' => 
        array (
          'pretty_version' => '11.1.0',
          'version' => '11.1.0.0',
          'reference' => '110b59478c9417c13794cef62a82b019433d642a',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../darkaonline/l5-swagger',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'davedevelopment/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'dflydev/dot-access-data' => 
        array (
          'pretty_version' => 'v3.0.3',
          'version' => '3.0.3.0',
          'reference' => 'a23a2bf4f31d3518f3ecb38660c95715dfead60f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../dflydev/dot-access-data',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/inflector' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => '6d6c96277ea252fc1304627204c3d5e6e15faa3b',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../doctrine/inflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/lexer' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => '31ad66abc0fc9e1a1f2d9bc6a42668d2fbbcd6dd',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../doctrine/lexer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dompdf/dompdf' => 
        array (
          'pretty_version' => 'v3.1.5',
          'version' => '3.1.5.0',
          'reference' => 'f11ead23a8a76d0ff9bbc6c7c8fd7e05ca328496',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../dompdf/dompdf',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dompdf/php-font-lib' => 
        array (
          'pretty_version' => '1.0.2',
          'version' => '1.0.2.0',
          'reference' => 'a6e9a688a2a80016ac080b97be73d3e10c444c9a',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../dompdf/php-font-lib',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dompdf/php-svg-lib' => 
        array (
          'pretty_version' => '1.0.2',
          'version' => '1.0.2.0',
          'reference' => '8259ffb930817e72b1ff1caef5d226501f3dfeb1',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../dompdf/php-svg-lib',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dragonmantank/cron-expression' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => 'd61a8a9604ec1f8c3d150d09db6ce98b32675013',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../dragonmantank/cron-expression',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'egulias/email-validator' => 
        array (
          'pretty_version' => '4.0.4',
          'version' => '4.0.4.0',
          'reference' => 'd42c8731f0624ad6bdc8d3e5e9a4524f68801cfa',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../egulias/email-validator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ezyang/htmlpurifier' => 
        array (
          'pretty_version' => 'v4.19.0',
          'version' => '4.19.0.0',
          'reference' => 'b287d2a16aceffbf6e0295559b39662612b77fcf',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../ezyang/htmlpurifier',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'fakerphp/faker' => 
        array (
          'pretty_version' => 'v1.24.1',
          'version' => '1.24.1.0',
          'reference' => 'e0ee18eb1e6dc3cda3ce9fd97e5a0689a88a64b5',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../fakerphp/faker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'filp/whoops' => 
        array (
          'pretty_version' => '2.18.4',
          'version' => '2.18.4.0',
          'reference' => 'd2102955e48b9fd9ab24280a7ad12ed552752c4d',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../filp/whoops',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fruitcake/php-cors' => 
        array (
          'pretty_version' => 'v1.4.0',
          'version' => '1.4.0.0',
          'reference' => '38aaa6c3fd4c157ffe2a4d10aa8b9b16ba8de379',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../fruitcake/php-cors',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'graham-campbell/result-type' => 
        array (
          'pretty_version' => 'v1.1.4',
          'version' => '1.1.4.0',
          'reference' => 'e01f4a821471308ba86aa202fed6698b6b695e3b',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../graham-campbell/result-type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/guzzle' => 
        array (
          'pretty_version' => '7.15.1',
          'version' => '7.15.1.0',
          'reference' => '61443dfb33c62f308ee8add20f45b4d6e4bf8d2f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../guzzlehttp/guzzle',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/promises' => 
        array (
          'pretty_version' => '2.5.1',
          'version' => '2.5.1.0',
          'reference' => '9ad1e4fc607446a055b95870c7f668e93b5cff29',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../guzzlehttp/promises',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/psr7' => 
        array (
          'pretty_version' => '2.13.0',
          'version' => '2.13.0.0',
          'reference' => 'dad89620b7a6edb60c15858442eb2e408b45d8f4',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../guzzlehttp/psr7',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/uri-template' => 
        array (
          'pretty_version' => 'v1.0.10',
          'version' => '1.0.10.0',
          'reference' => 'f6c24c21f42b990e9a58912b332d0874df6ba839',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../guzzlehttp/uri-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'hamcrest/hamcrest-php' => 
        array (
          'pretty_version' => 'v2.1.1',
          'version' => '2.1.1.0',
          'reference' => 'f8b1c0173b22fa6ec77a81fe63e5b01eba7e6487',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../hamcrest/hamcrest-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'iamcal/sql-parser' => 
        array (
          'pretty_version' => 'v0.7',
          'version' => '0.7.0.0',
          'reference' => '610392f38de49a44dab08dc1659960a29874c4b8',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../iamcal/sql-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'illuminate/auth' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/reflection' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.64.0',
          ),
        ),
        'kkomelin/laravel-translatable-string-exporter' => 
        array (
          'pretty_version' => '1.26.0',
          'version' => '1.26.0.0',
          'reference' => '6e8b5596df329d0678574982666ff4493b9be829',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../kkomelin/laravel-translatable-string-exporter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'kodova/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'larastan/larastan' => 
        array (
          'pretty_version' => 'v3.10.0',
          'version' => '3.10.0.0',
          'reference' => '2970f83398154178a739609c244577267c7ee8eb',
          'type' => 'phpstan-extension',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../larastan/larastan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/framework' => 
        array (
          'pretty_version' => 'v12.64.0',
          'version' => '12.64.0.0',
          'reference' => '727a8ea2949c23ca8b5316b86a00984b6017b7a0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/framework',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/pail' => 
        array (
          'pretty_version' => 'v1.2.7',
          'version' => '1.2.7.0',
          'reference' => '2f7d27dada8effc48b8c424445a69cca7007daaa',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/pail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/pint' => 
        array (
          'pretty_version' => 'v1.29.3',
          'version' => '1.29.3.0',
          'reference' => 'da1d1111a6aa2e082d2a388b194afe1ba0a05d14',
          'type' => 'project',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/pint',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/prompts' => 
        array (
          'pretty_version' => 'v0.3.21',
          'version' => '0.3.21.0',
          'reference' => '7753c65c281c2550c7c183f14e18062073b7d821',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/prompts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/sail' => 
        array (
          'pretty_version' => 'v1.64.0',
          'version' => '1.64.0.0',
          'reference' => '08cacd3e72d6798df3fa8bd4b5d55d0f7f920625',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.15',
          'version' => '2.0.15.0',
          'reference' => 'dccd8bcb851bb03fcc005df650b708b57cc52661',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/serializable-closure',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/tinker' => 
        array (
          'pretty_version' => 'v3.0.2',
          'version' => '3.0.2.0',
          'reference' => '4faba77764bd33411735936acdf30446d058c78b',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/tinker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/commonmark' => 
        array (
          'pretty_version' => '2.8.3',
          'version' => '2.8.3.0',
          'reference' => '1902f60f984235023acbe03db6ad614a37b3c3e7',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/commonmark',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/config' => 
        array (
          'pretty_version' => 'v1.2.0',
          'version' => '1.2.0.0',
          'reference' => '754b3604fb2984c71f4af4a9cbe7b57f346ec1f3',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/config',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem' => 
        array (
          'pretty_version' => '3.35.2',
          'version' => '3.35.2.0',
          'reference' => 'b277b5dc3d56650b68904117124e79c851e12376',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/flysystem',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem-local' => 
        array (
          'pretty_version' => '3.31.0',
          'version' => '3.31.0.0',
          'reference' => '2f669db18a4c20c755c2bb7d3a7b0b2340488079',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/flysystem-local',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/mime-type-detection' => 
        array (
          'pretty_version' => '1.17.0',
          'version' => '1.17.0.0',
          'reference' => 'f5f47eff7c48ed1003069a2ca67f316fb4021c76',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/mime-type-detection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '08cf38e3924d4f56238125547b5720496fac8fd4',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/uri',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-interfaces' => 
        array (
          'pretty_version' => '7.8.1',
          'version' => '7.8.1.0',
          'reference' => '85d5c77c5d6d3af6c54db4a78246364908f3c928',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../league/uri-interfaces',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'maatwebsite/excel' => 
        array (
          'pretty_version' => '3.1.69',
          'version' => '3.1.69.0',
          'reference' => 'ae5d65b7c9a2fac43bff4d44f796ac95d7a8e760',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../maatwebsite/excel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'maennchen/zipstream-php' => 
        array (
          'pretty_version' => '3.1.2',
          'version' => '3.1.2.0',
          'reference' => 'aeadcf5c412332eb426c0f9b4485f6accba2a99f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../maennchen/zipstream-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'markbaker/complex' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => '95c56caa1cf5c766ad6d65b6344b807c1e8405b9',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../markbaker/complex',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'markbaker/matrix' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => '728434227fe21be27ff6d86621a1b13107a2562c',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../markbaker/matrix',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'masterminds/html5' => 
        array (
          'pretty_version' => '2.10.1',
          'version' => '2.10.1.0',
          'reference' => 'fd5018f6815fff903946d0564977b44ce8010e29',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../masterminds/html5',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mockery/mockery' => 
        array (
          'pretty_version' => '1.6.12',
          'version' => '1.6.12.0',
          'reference' => '1f4efdd7d3beafe9807b08156dfcb176d18f1699',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../mockery/mockery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'monolog/monolog' => 
        array (
          'pretty_version' => '3.10.0',
          'version' => '3.10.0.0',
          'reference' => 'b321dd6749f0bf7189444158a3ce785cc16d69b0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../monolog/monolog',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mtdowling/cron-expression' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '^1.0',
          ),
        ),
        'myclabs/deep-copy' => 
        array (
          'pretty_version' => '1.13.4',
          'version' => '1.13.4.0',
          'reference' => '07d290f0c47959fd5eed98c95ee5602db07e0b6a',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../myclabs/deep-copy',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nesbot/carbon' => 
        array (
          'pretty_version' => '3.13.1',
          'version' => '3.13.1.0',
          'reference' => '2937ad3d1d2c506fd2bc97d571438a95641f44e2',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nesbot/carbon',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/schema' => 
        array (
          'pretty_version' => 'v1.3.5',
          'version' => '1.3.5.0',
          'reference' => 'f0ab1a3cda782dbc5da270d28545236aa80c4002',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nette/schema',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/utils' => 
        array (
          'pretty_version' => 'v4.1.5',
          'version' => '4.1.5.0',
          'reference' => 'b043439dbdf954e6c28b5ea7e34b0100f83165e0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nette/utils',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nikic/php-parser' => 
        array (
          'pretty_version' => 'v5.8.0',
          'version' => '5.8.0.0',
          'reference' => '044a6a392ff8ad0d61f14370a5fbbd0a0107152f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nikic/php-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nunomaduro/collision' => 
        array (
          'pretty_version' => 'v8.9.5',
          'version' => '8.9.5.0',
          'reference' => 'fb53eacd509a1d303858e2d20cfebf2d630254ec',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nunomaduro/collision',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nunomaduro/termwind' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => '712a31b768f5daea284c2169a7d227031001b9a8',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../nunomaduro/termwind',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'openai-php/client' => 
        array (
          'pretty_version' => 'v0.20.0',
          'version' => '0.20.0.0',
          'reference' => 'b5c0e1e0f210e6b9aca5ee048157fcf3039ca91f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../openai-php/client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'openai-php/laravel' => 
        array (
          'pretty_version' => 'v0.20.0',
          'version' => '0.20.0.0',
          'reference' => 'd6535960d7fe67c30025ae83f00005b4a2d10278',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../openai-php/laravel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phar-io/manifest' => 
        array (
          'pretty_version' => '2.0.4',
          'version' => '2.0.4.0',
          'reference' => '54750ef60c58e43759730615a392c31c80e23176',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phar-io/manifest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/version' => 
        array (
          'pretty_version' => '3.2.1',
          'version' => '3.2.1.0',
          'reference' => '4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phar-io/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'php-http/async-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
          ),
        ),
        'php-http/client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
          ),
        ),
        'php-http/discovery' => 
        array (
          'pretty_version' => '1.20.0',
          'version' => '1.20.0.0',
          'reference' => '82fe4c73ef3363caed49ff8dd1539ba06044910d',
          'type' => 'composer-plugin',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../php-http/discovery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'php-http/multipart-stream-builder' => 
        array (
          'pretty_version' => '1.4.2',
          'version' => '1.4.2.0',
          'reference' => '10086e6de6f53489cca5ecc45b6f468604d3460e',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../php-http/multipart-stream-builder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpoffice/phpspreadsheet' => 
        array (
          'pretty_version' => '1.30.6',
          'version' => '1.30.6.0',
          'reference' => 'a416375ffc8bf5b661c1bb4e6c60d8f3fddbe5ce',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpoffice/phpspreadsheet',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpoption/phpoption' => 
        array (
          'pretty_version' => '1.9.5',
          'version' => '1.9.5.0',
          'reference' => '75365b91986c2405cf5e1e012c5595cd487a98be',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpoption/phpoption',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpstan/phpdoc-parser' => 
        array (
          'pretty_version' => '2.3.3',
          'version' => '2.3.3.0',
          'reference' => 'fb19eedd2bb67ff8cf7a5502ad329e701d6398a3',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpstan/phpdoc-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpstan/phpstan' => 
        array (
          'pretty_version' => '2.2.5',
          'version' => '2.2.5.0',
          'reference' => '909c1e5fef7989ac0d0c1c5c42e32a5c4f6198a0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpstan/phpstan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-code-coverage' => 
        array (
          'pretty_version' => '11.0.12',
          'version' => '11.0.12.0',
          'reference' => '2c1ed04922802c15e1de5d7447b4856de949cf56',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/php-code-coverage',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-file-iterator' => 
        array (
          'pretty_version' => '5.1.1',
          'version' => '5.1.1.0',
          'reference' => '2f3a64888c814fc235386b7387dd5b5ed92ad903',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/php-file-iterator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-invoker' => 
        array (
          'pretty_version' => '5.0.1',
          'version' => '5.0.1.0',
          'reference' => 'c1ca3814734c07492b3d4c5f794f4b0995333da2',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/php-invoker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-text-template' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '3e0404dc6b300e6bf56415467ebcb3fe4f33e964',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/php-text-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-timer' => 
        array (
          'pretty_version' => '7.0.1',
          'version' => '7.0.1.0',
          'reference' => '3b415def83fbcb41f991d9ebf16ae4ad8b7837b3',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/php-timer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/phpunit' => 
        array (
          'pretty_version' => '11.5.55',
          'version' => '11.5.55.0',
          'reference' => 'adc7262fccc12de2b30f12a8aa0b33775d814f00',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../phpunit/phpunit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'psr/clock' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'e41a24703d4560fd0acb709162f73b8adfc3aa0d',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/clock-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/container' => 
        array (
          'pretty_version' => '2.0.2',
          'version' => '2.0.2.0',
          'reference' => 'c71ecc56dfe541dbd90c5360474fbc405f8d5963',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/container',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/container-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.1|2.0',
          ),
        ),
        'psr/event-dispatcher' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-client' => 
        array (
          'pretty_version' => '1.0.3',
          'version' => '1.0.3.0',
          'reference' => 'bb5906edc1c324c9a05aa0873d40117941e5fa90',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/http-client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
            1 => '1.0',
          ),
        ),
        'psr/http-factory' => 
        array (
          'pretty_version' => '1.1.0',
          'version' => '1.1.0.0',
          'reference' => '2b4765fddfe3b508ac62f829e852b1501d3f6e8a',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/http-factory',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-factory-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
            1 => '1.0',
          ),
        ),
        'psr/http-message' => 
        array (
          'pretty_version' => '2.0',
          'version' => '2.0.0.0',
          'reference' => '402d35bcb92c70c026d1a6a9883f06b2ead23d71',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/http-message',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-message-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '*',
            1 => '1.0',
          ),
        ),
        'psr/log' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => 'f16e1d5863e37f8d8c2a01719f5b34baa2b714d3',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/log',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/log-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
            1 => '3.0.0',
          ),
        ),
        'psr/simple-cache' => 
        array (
          'pretty_version' => '3.0.0',
          'version' => '3.0.0.0',
          'reference' => '764e0b3939f5ca87cb904f570ef9be2d78a07865',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psr/simple-cache',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/simple-cache-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
          ),
        ),
        'psy/psysh' => 
        array (
          'pretty_version' => 'v0.12.24',
          'version' => '0.12.24.0',
          'reference' => 'ca0fdcf8a7617afa3adfdf1b5fef573dffb69ca1',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../psy/psysh',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'pusher/pusher-php-server' => 
        array (
          'pretty_version' => '7.2.8',
          'version' => '7.2.8.0',
          'reference' => '4aa139ed2a2a805cd265449b691198beee1309d2',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../pusher/pusher-php-server',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'radebatz/type-info-extras' => 
        array (
          'pretty_version' => '1.0.7',
          'version' => '1.0.7.0',
          'reference' => '95a524a74a61648b44e355cb33d38db4b17ef5ce',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../radebatz/type-info-extras',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ralouphie/getallheaders' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '120b605dfeb996808c31b6477290a714d356e822',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../ralouphie/getallheaders',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/collection' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '344572933ad0181accbf4ba763e85a0306a8c5e2',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../ramsey/collection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/uuid' => 
        array (
          'pretty_version' => '4.9.3',
          'version' => '4.9.3.0',
          'reference' => '1df15849d00943a67d677dc9cfd80795f038c9f8',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../ramsey/uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'rhumsaa/uuid' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '4.9.3',
          ),
        ),
        'sabberworm/php-css-parser' => 
        array (
          'pretty_version' => 'v9.4.0',
          'version' => '9.4.0.0',
          'reference' => 'fd3bf9fb173e0df649bc4e3e0d088a1b2417c08f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sabberworm/php-css-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'sebastian/cli-parser' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => '15c5dd40dc4f38794d383bb95465193f5e0ae180',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/cli-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/code-unit' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '54391c61e4af8078e5b276ab082b6d3c54c9ad64',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/code-unit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/code-unit-reverse-lookup' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '183a9b2632194febd219bb9246eee421dad8d45e',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/code-unit-reverse-lookup',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/comparator' => 
        array (
          'pretty_version' => '6.3.3',
          'version' => '6.3.3.0',
          'reference' => '2c95e1e86cb8dd41beb8d502057d1081ccc8eca9',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/comparator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/complexity' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => 'ee41d384ab1906c68852636b6de493846e13e5a0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/complexity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/diff' => 
        array (
          'pretty_version' => '6.0.2',
          'version' => '6.0.2.0',
          'reference' => 'b4ccd857127db5d41a5b676f24b51371d76d8544',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/diff',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/environment' => 
        array (
          'pretty_version' => '7.2.1',
          'version' => '7.2.1.0',
          'reference' => 'a5c75038693ad2e8d4b6c15ba2403532647830c4',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/environment',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/exporter' => 
        array (
          'pretty_version' => '6.3.2',
          'version' => '6.3.2.0',
          'reference' => '70a298763b40b213ec087c51c739efcaa90bcd74',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/exporter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/global-state' => 
        array (
          'pretty_version' => '7.0.2',
          'version' => '7.0.2.0',
          'reference' => '3be331570a721f9a4b5917f4209773de17f747d7',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/global-state',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/lines-of-code' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => 'd36ad0d782e5756913e42ad87cb2890f4ffe467a',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/lines-of-code',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-enumerator' => 
        array (
          'pretty_version' => '6.0.1',
          'version' => '6.0.1.0',
          'reference' => 'f5b498e631a74204185071eb41f33f38d64608aa',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/object-enumerator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-reflector' => 
        array (
          'pretty_version' => '4.0.1',
          'version' => '4.0.1.0',
          'reference' => '6e1a43b411b2ad34146dee7524cb13a068bb35f9',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/object-reflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/recursion-context' => 
        array (
          'pretty_version' => '6.0.3',
          'version' => '6.0.3.0',
          'reference' => 'f6458abbf32a6c8174f8f26261475dc133b3d9dc',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/recursion-context',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/type' => 
        array (
          'pretty_version' => '5.1.3',
          'version' => '5.1.3.0',
          'reference' => 'f77d2d4e78738c98d9a68d2596fe5e8fa380f449',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/version' => 
        array (
          'pretty_version' => '5.0.2',
          'version' => '5.0.2.0',
          'reference' => 'c687e3387b99f5b03b6caa64c74b63e2936ff874',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../sebastian/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'spatie/once' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'staabm/side-effects-detector' => 
        array (
          'pretty_version' => '1.0.5',
          'version' => '1.0.5.0',
          'reference' => 'd8334211a140ce329c13726d4a715adbddd0a163',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../staabm/side-effects-detector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'swagger-api/swagger-ui' => 
        array (
          'pretty_version' => 'v5.32.8',
          'version' => '5.32.8.0',
          'reference' => '4e0d3f88de7db0395a80ef0541ff428f0926d484',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../swagger-api/swagger-ui',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/clock' => 
        array (
          'pretty_version' => 'v7.4.8',
          'version' => '7.4.8.0',
          'reference' => '674fa3b98e21531dd040e613479f5f6fa8f32111',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/console' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '92f58bc4bf97a92ed1b9f367f0cd44f20bde0e87',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/console',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/css-selector' => 
        array (
          'pretty_version' => 'v7.4.9',
          'version' => '7.4.9.0',
          'reference' => 'b75663ed96cf4756e28e3105476f220f92886cc4',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/css-selector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/deprecation-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'f3202fa1b5097b0af062dc978b32ecf63404e31d',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/deprecation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/error-handler' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '4e1a093b481f323e6e326451f9760c3868430673',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/error-handler',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '51fe3d170227be8d1772214b82ae506e15ed78ff',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'c7de7a00ffb67842132da02ea92988a39ccd9f4e',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/event-dispatcher-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.0|3.0',
          ),
        ),
        'symfony/finder' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '13b38720174286f55d1761152b575a8d1436fc25',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/finder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-foundation' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '06db5ae1552177bf8572f8908839f12e3c06aed3',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/http-foundation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-kernel' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'e99af79b1e776646eda0e1c23b7b45c184ff99be',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/http-kernel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mailer' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'f88ce03ae73e3edb5c176ce1f337709996e88495',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/mailer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mime' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => 'a845722765c4f6b2ce88beaf4f4479975b186770',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/mime',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-ctype' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => '141046a8f9477948ff284fa65be2095baafb94f2',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-ctype',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-grapheme' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'e9247d281d694a5120554d9afaf54e070e88a603',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-intl-grapheme',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-idn' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'dc21118016c039a66235cf93d96b435ffb282412',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-intl-idn',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-normalizer' => 
        array (
          'pretty_version' => 'v1.38.0',
          'version' => '1.38.0.0',
          'reference' => '2d446c214bdbe5b71bde5011b060a05fece3ae6b',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-intl-normalizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-mbstring' => 
        array (
          'pretty_version' => 'v1.38.2',
          'version' => '1.38.2.0',
          'reference' => 'd3d318bad5e7a1bfbd026009c8bfb8d8f99ae6b6',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-mbstring',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php80' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => 'dfb55726c3a76ea3b6459fcfda1ec2d80a682411',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-php80',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php83' => 
        array (
          'pretty_version' => 'v1.38.2',
          'version' => '1.38.2.0',
          'reference' => '796a26abb75ce49f3a84433cd81bf1009d73d5f8',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-php83',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php84' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'f4e1dfaee5b74aba5964fe1fd4dfc7ba5e3085fa',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-php84',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php85' => 
        array (
          'pretty_version' => 'v1.38.1',
          'version' => '1.38.1.0',
          'reference' => 'ba2ba04f3352cfa2dcbbcb90aee13ed967f505b1',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-php85',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-uuid' => 
        array (
          'pretty_version' => 'v1.37.0',
          'version' => '1.37.0.0',
          'reference' => '26dfec253c4cf3e51b541b52ddf7e42cb0908e94',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/polyfill-uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/process' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => 'f5804be144caceb570f6747519999636b664f24c',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/process',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/routing' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => '3a162171bb008e5e0f15dce6581373a4c0e8390d',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/routing',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/service-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'c0a284bab1ed8aa0417e3d69250ab437739563a0',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/service-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/string' => 
        array (
          'pretty_version' => 'v7.4.13',
          'version' => '7.4.13.0',
          'reference' => '961683010db3b27ec6ebcd7308e6e1ee8fa7ffde',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/string',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'a1af4dacb24eb7ef4f1ca71b94da8ddbce572281',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/translation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-contracts' => 
        array (
          'pretty_version' => 'v3.7.1',
          'version' => '3.7.1.0',
          'reference' => 'ccb206b98faccc511ebae8e5fad50f2dc0b30621',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/translation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.3|3.0',
          ),
        ),
        'symfony/type-info' => 
        array (
          'pretty_version' => 'v7.4.9',
          'version' => '7.4.9.0',
          'reference' => 'cafeedbf157b890e94ac5b83eaed85595106d5d6',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/type-info',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/uid' => 
        array (
          'pretty_version' => 'v7.4.9',
          'version' => '7.4.9.0',
          'reference' => '2676b524340abcfe4d6151ec698463cebafee439',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/uid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/var-dumper' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => '9a3a56a4a1e65a5cb4f8d13801fe8ab0a170e358',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/var-dumper',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/yaml' => 
        array (
          'pretty_version' => 'v7.4.14',
          'version' => '7.4.14.0',
          'reference' => 'f8f328665ace2370d1e10645b807ba1646dc7dcc',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../symfony/yaml',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'thecodingmachine/safe' => 
        array (
          'pretty_version' => 'v3.4.0',
          'version' => '3.4.0.0',
          'reference' => '705683a25bacf0d4860c7dea4d7947bfd09eea19',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../thecodingmachine/safe',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'theseer/tokenizer' => 
        array (
          'pretty_version' => '1.3.1',
          'version' => '1.3.1.0',
          'reference' => 'b7489ce515e168639d17feec34b8847c326b0b3c',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../theseer/tokenizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'tijsverkoyen/css-to-inline-styles' => 
        array (
          'pretty_version' => 'v2.4.0',
          'version' => '2.4.0.0',
          'reference' => 'f0292ccf0ec75843d65027214426b6b163b48b41',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../tijsverkoyen/css-to-inline-styles',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'vlucas/phpdotenv' => 
        array (
          'pretty_version' => 'v5.6.4',
          'version' => '5.6.4.0',
          'reference' => '416df702837983f8d5ff48c9c3fee4f5f57b980b',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../vlucas/phpdotenv',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'voku/portable-ascii' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '8e1051fe39379367aecf014f41744ce7539a856f',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../voku/portable-ascii',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'zircote/swagger-php' => 
        array (
          'pretty_version' => '6.3.1',
          'version' => '6.3.1.0',
          'reference' => '599d620d55945fcea162189dc2e3c1d3bfb0c405',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../zircote/swagger-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
      ),
    ),
  ),
  'executedFilesHashes' => 
  array (
    'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\larastan\\larastan\\bootstrap.php' => '5a3eacbf63b3e41659adfee92facededf8e020a932800f93c9a8b0e67f235805',
    'phar://C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\Attribute85.php' => 'cb8b31e82c61ce197871c9e8a6f122256751f2ab606dd2be90846d4fa5f8933e',
    'phar://C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionAttribute.php' => 'c0068e383717870a304781d462f7e2afe1c6f24e9133851852a2aca96b4fa26f',
    'phar://C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionIntersectionType.php' => '65fe0a8bc6fe285d8ddc8798ab5b9299920af70db5ad74596bc08df823e7c5d9',
    'phar://C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\phpstan\\phpstan\\phpstan.phar\\stubs\\runtime\\ReflectionUnionType.php' => '1e2fe940e4ba4e00d9ee6adb2af3ee1bf333e6f8afe61c61deb038886d293427',
  ),
  'phpExtensions' => 
  array (
    0 => 'Core',
    1 => 'PDO',
    2 => 'Phar',
    3 => 'Reflection',
    4 => 'SPL',
    5 => 'SimpleXML',
    6 => 'bcmath',
    7 => 'bz2',
    8 => 'calendar',
    9 => 'ctype',
    10 => 'curl',
    11 => 'date',
    12 => 'dom',
    13 => 'exif',
    14 => 'fileinfo',
    15 => 'filter',
    16 => 'ftp',
    17 => 'gd',
    18 => 'gettext',
    19 => 'hash',
    20 => 'iconv',
    21 => 'json',
    22 => 'libxml',
    23 => 'mbstring',
    24 => 'mysqli',
    25 => 'mysqlnd',
    26 => 'openssl',
    27 => 'pcre',
    28 => 'pdo_mysql',
    29 => 'pdo_sqlite',
    30 => 'random',
    31 => 'readline',
    32 => 'session',
    33 => 'sodium',
    34 => 'standard',
    35 => 'tokenizer',
    36 => 'xml',
    37 => 'xmlreader',
    38 => 'xmlwriter',
    39 => 'zip',
    40 => 'zlib',
  ),
  'stubFiles' => 
  array (
  ),
  'level' => '5',
),
	'projectExtensionFiles' => array (
),
	'errorsCallback' => static function (): array { return array (
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
); },
	'linesToIgnore' => array (
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Actions\\ApproveBudgetAction',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'abort',
        1 => 23,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Actions\\CreatePreventiveTicketAction',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Actions\\CreatePreventiveTicketAction',
        1 => 'execute',
        2 => 'App\\Actions\\CreatePreventiveTicketAction',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\actions\\createpreventiveticketaction' . "\0" . 'resolvetechnician',
          1 => 'm' . "\0" . 'app\\services\\ticketstatusservice' . "\0" . 'getbyname',
          2 => 'm' . "\0" . 'illuminate\\database\\eloquent\\builder' . "\0" . 'create',
          3 => 'f' . "\0" . 'now',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Concerns\\BroadcastsTicketStatus.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitDeclarationCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
        1 => 12,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\DatabaseBackup.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'exec',
        1 => 90,
      ),
      1 => 
      array (
        0 => 'exec',
        1 => 111,
      ),
      2 => 
      array (
        0 => 'exec',
        1 => 122,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\File',
        1 => 'makeDirectory',
        2 => 30,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\File',
        1 => 'delete',
        2 => 140,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetDecisionData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\BudgetDecisionData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetSubmissionData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\BudgetSubmissionData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CloseTicketData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\CloseTicketData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CreateTicketData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\CreateTicketData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\ScheduleTicketData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\ScheduleTicketData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreEquipmentData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\StoreEquipmentData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreRoomData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\StoreRoomData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreUserData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\StoreUserData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\TicketFilters.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\TicketFilters',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateEquipmentData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\UpdateEquipmentData',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateUserData.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\UpdateUserData',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\DTOs\\UpdateUserData',
        1 => 'hasPassword',
        2 => 'App\\DTOs\\UpdateUserData',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\DTOs\\UpdateUserData',
        1 => 'toArray',
        2 => 'App\\DTOs\\UpdateUserData',
        3 => 
        array (
          0 => 'f' . "\0" . 'array_filter',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Actions\\CancelTicketAction',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Actions\\CloseTicketAction',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Actions\\ReopenTicketAction',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Actions\\StartTicketAction',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Queries\\ScheduledEventsQuery',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Queries\\TicketKpiQuery',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketPriorityQuery.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Queries\\TicketPriorityQuery',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TopEntitiesQuery.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Queries\\TopEntitiesQuery',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Scopes\\TicketScopes',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
        1 => 'hasStatus',
        2 => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\services\\ticketstatusservice' . "\0" . 'getbyname',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\BudgetStatusEnum.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Enums\\BudgetStatusEnum',
        1 => 'label',
        2 => 'App\\Enums\\BudgetStatusEnum',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\NotificationTypeEnum.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Enums\\NotificationTypeEnum',
        1 => 'icon',
        2 => 'App\\Enums\\NotificationTypeEnum',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketPriorityEnum.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Enums\\TicketPriorityEnum',
        1 => 'normalize',
        2 => 'App\\Enums\\TicketPriorityEnum',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Enums\\TicketPriorityEnum',
        1 => 'values',
        2 => 'App\\Enums\\TicketPriorityEnum',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Enums\\TicketPriorityEnum',
        1 => 'label',
        2 => 'App\\Enums\\TicketPriorityEnum',
        3 => 
        array (
        ),
      ),
      3 => 
      array (
        0 => 'App\\Enums\\TicketPriorityEnum',
        1 => 'weight',
        2 => 'App\\Enums\\TicketPriorityEnum',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketStatusEnum.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Enums\\TicketStatusEnum',
        1 => 'fromValue',
        2 => 'App\\Enums\\TicketStatusEnum',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Enums\\TicketStatusEnum',
        1 => 'values',
        2 => 'App\\Enums\\TicketStatusEnum',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Enums\\TicketStatusEnum',
        1 => 'label',
        2 => 'App\\Enums\\TicketStatusEnum',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\UserRoleEnum.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Enums\\UserRoleEnum',
        1 => 'values',
        2 => 'App\\Enums\\UserRoleEnum',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Enums\\UserRoleEnum',
        1 => 'label',
        2 => 'App\\Enums\\UserRoleEnum',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\TicketCreatedBroadcast',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\TicketCreatedBroadcast',
        1 => 'broadcastOn',
        2 => 'App\\Events\\TicketCreatedBroadcast',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\broadcasting\\channel' . "\0" . '__construct',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Events\\TicketCreatedBroadcast',
        1 => 'broadcastAs',
        2 => 'App\\Events\\TicketCreatedBroadcast',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Events\\TicketCreatedBroadcast',
        1 => 'broadcastWith',
        2 => 'App\\Events\\TicketCreatedBroadcast',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        1 => 'broadcastOn',
        2 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\broadcasting\\channel' . "\0" . '__construct',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        1 => 'broadcastAs',
        2 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        1 => 'broadcastWith',
        2 => 'App\\Events\\TicketStatusUpdatedBroadcast',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Exports\\TicketsExport',
        1 => 'headings',
        2 => 'App\\Exports\\TicketsExport',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Exports\\TicketsExport',
        1 => 'title',
        2 => 'App\\Exports\\TicketsExport',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Exports\\TicketsExport',
        1 => 'styles',
        2 => 'App\\Exports\\TicketsExport',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Methods\\OverridingMethodRenamesParameterCollector' => 
    array (
      0 => 
      array (
        0 => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
        1 => 'map',
        2 => 'App\\Exports\\TicketsExport',
        3 => 'row',
        4 => 'ticket',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\AdminController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\AnalyticsController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Conta temporariamente bloqueada. Tente novamente mais tarde.',
        1 => 29,
      ),
      1 => 
      array (
        0 => 'Credenciais inválidas.',
        1 => 47,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\AuthController',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Cache\\Repository',
        1 => 'put',
        2 => 45,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Cache\\Repository',
        1 => 'forget',
        2 => 50,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'calendar',
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\CalendarController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'abort',
        1 => 17,
      ),
      1 => 
      array (
        0 => 'abort',
        1 => 26,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PageController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'main',
      1 => 'ui.auth',
      2 => 'ui.auth-reset',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\PageController',
        1 => 'home',
        2 => 'App\\Http\\Controllers\\PageController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Controllers\\PageController',
        1 => 'login',
        2 => 'App\\Http\\Controllers\\PageController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Http\\Controllers\\PageController',
        1 => 'passwordResetForm',
        2 => 'App\\Http\\Controllers\\PageController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'session',
        1 => 37,
      ),
      1 => 
      array (
        0 => 'abort',
        1 => 66,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Support\\Facades\\Mail',
        1 => 'raw',
        2 => 69,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Email de recuperação enviado com sucesso.',
        1 => 21,
      ),
      1 => 
      array (
        0 => 'Token inválido ou expirado.',
        1 => 31,
      ),
      2 => 
      array (
        0 => 'Password reposta com sucesso. Faça login.',
        1 => 36,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\PasswordResetController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Password atual incorreta',
        1 => 17,
      ),
      1 => 
      array (
        0 => 'Password alterada com sucesso.',
        1 => 23,
      ),
      2 => 
      array (
        0 => 'A palavra-passe atual é obrigatória para alterar a password.',
        1 => 32,
      ),
      3 => 
      array (
        0 => 'Password atual incorreta',
        1 => 36,
      ),
      4 => 
      array (
        0 => 'Perfil atualizado com sucesso.',
        1 => 49,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\RegisterController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'rooms.create',
      1 => 'rooms.show',
      2 => 'rooms.edit',
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\RoomController',
        1 => 'createRoom',
        2 => 'App\\Http\\Controllers\\RoomController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Controllers\\RoomController',
        1 => 'showRoom',
        2 => 'App\\Http\\Controllers\\RoomController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Http\\Controllers\\RoomController',
        1 => 'editRoom',
        2 => 'App\\Http\\Controllers\\RoomController',
        3 => 
        array (
          0 => 'f' . "\0" . 'view',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Pedido de orçamento submetido com detalhes. Aguarde aprovação.',
        1 => 81,
      ),
      1 => 
      array (
        0 => 'Custo dentro do limiar. Intervenção autorizada automaticamente.',
        1 => 93,
      ),
      2 => 
      array (
        0 => 'Custo estimado excede o limiar. Ticket pendente de aprovação orçamental.',
        1 => 116,
      ),
      3 => 
      array (
        0 => 'Custo estimado dentro da autonomia. Pode prosseguir com a intervenção.',
        1 => 136,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\TicketBudgetController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Não existem tickets abertos prioritários.',
        1 => 124,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'ui.ticket-detail',
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\TicketController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php' => 
  array (
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => 'event(new \\App\\Events\\TicketStatusUpdatedBroadcast($ticket, $oldStatus, $newStatus->value)):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user()->first():20',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user():20',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Classes\\ImpossibleInstanceOfRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->email:22',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->notify(new \\App\\Notifications\\TicketStatusChanged($ticket, $oldStatus, $newStatus->value)):23',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Failed to broadcast ticket status change\', [\'ticket_id\' => $ticket->id, \'error\' => $e->getMessage()]):26',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$e->getMessage():28',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\Ticket\\TicketAssignmentController',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'event',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'App\\Services\\TechnicianAssignmentService',
        ),
        1 => 'assignToTicket',
        2 => 30,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Intervenção concluída e ticket fechado com sucesso.',
        1 => 89,
      ),
    ),
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => 'event(new \\App\\Events\\TicketStatusUpdatedBroadcast($ticket, $oldStatus, $newStatus->value)):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user()->first():20',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user():20',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Classes\\ImpossibleInstanceOfRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->email:22',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->notify(new \\App\\Notifications\\TicketStatusChanged($ticket, $oldStatus, $newStatus->value)):23',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Failed to broadcast ticket status change\', [\'ticket_id\' => $ticket->id, \'error\' => $e->getMessage()]):26',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$e->getMessage():28',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\Ticket\\TicketCloseController',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'event',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'App\\Services\\TicketWorkflowService',
        ),
        1 => 'close',
        2 => 38,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Connection',
        1 => 'transaction',
        2 => 74,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\Ticket\\TicketLifecycleController',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'App\\Services\\TicketWorkflowService',
        ),
        1 => 'cancel',
        2 => 51,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php' => 
  array (
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => 'event(new \\App\\Events\\TicketStatusUpdatedBroadcast($ticket, $oldStatus, $newStatus->value)):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->relationLoaded(\'user\'):20',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user()->first():20',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$ticket->user():20',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Classes\\ImpossibleInstanceOfRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User:22',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->email:22',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user instanceof \\App\\Models\\User && $user->email:22',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$user->notify(new \\App\\Notifications\\TicketStatusChanged($ticket, $oldStatus, $newStatus->value)):23',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Failed to broadcast ticket status change\', [\'ticket_id\' => $ticket->id, \'error\' => $e->getMessage()]):26',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Concerns\\BroadcastsTicketStatus',
        2 => '$e->getMessage():28',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\Ticket\\TicketStartController',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'event',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureMethodCallCollector' => 
    array (
      0 => 
      array (
        0 => 
        array (
          0 => 'App\\Services\\TicketWorkflowService',
        ),
        1 => 'startRepair',
        2 => 60,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'ui.index',
      1 => 'ui.tickets',
      2 => 'ui.ticket-create',
      3 => 'ui.equipments',
      4 => 'ui.users',
      5 => 'ui.users-create',
      6 => 'ui.users-edit',
      7 => 'ui.rooms',
      8 => 'ui.rooms.create',
      9 => 'ui.rooms.show',
      10 => 'ui.rooms.edit',
      11 => 'ui.audits',
      12 => 'ui.ticket-detail',
      13 => 'ui.analytics',
      14 => 'ui.profile',
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\UiController',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Middleware\\CsrfMiddleware',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Middleware\\CustomAuthMiddleware',
        1 => 'hasInvalidProfile',
        2 => 'App\\Http\\Middleware\\CustomAuthMiddleware',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Middleware\\RateLimitMiddleware',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\AssignTechnicianRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\AssignTechnicianRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\AssignTechnicianRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\AssignTechnicianRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianToTicketRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\BudgetDecisionRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\BudgetDecisionRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\BudgetDecisionRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\BudgetDecisionRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\BudgetDecisionRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ChangePasswordRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\ChangePasswordRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\ChangePasswordRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\ChangePasswordRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\ChangePasswordRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\http\\requests\\registerrequest' . "\0" . 'passwordrules',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\CloseTicketRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\CloseTicketRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\CloseTicketRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\CloseTicketRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketSimpleRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\LoginRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\LoginRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\LoginRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\LoginRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\LoginRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RegisterRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\RegisterRequest',
        1 => 'passwordRules',
        2 => 'App\\Http\\Requests\\RegisterRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\RegisterRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\RegisterRequest',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Http\\Requests\\RegisterRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\RegisterRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\http\\requests\\registerrequest' . "\0" . 'passwordrules',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RequestBudgetRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\RequestBudgetRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\RequestBudgetRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\RequestBudgetRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\RequestBudgetRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ResetPasswordRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\ResetPasswordRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\ResetPasswordRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\ResetPasswordRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\ResetPasswordRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\http\\requests\\registerrequest' . "\0" . 'passwordrules',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ScheduleTicketRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\ScheduleTicketRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\ScheduleTicketRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\ScheduleTicketRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\ScheduleTicketRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SendResetLinkRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\SendResetLinkRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\SendResetLinkRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\SendResetLinkRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\SendResetLinkRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StartTicketRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StartTicketRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StartTicketRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StartTicketRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StartTicketRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreCommentRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StoreCommentRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StoreCommentRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StoreCommentRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StoreCommentRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreEquipmentRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StoreEquipmentRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StoreEquipmentRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StoreEquipmentRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StoreEquipmentRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StorePreventiveRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StorePreventiveRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StorePreventiveRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StorePreventiveRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StorePreventiveRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreRoomRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StoreRoomRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StoreRoomRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StoreRoomRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StoreRoomRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreTicketRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StoreTicketRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StoreTicketRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StoreTicketRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StoreTicketRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\validation\\rule' . "\0" . 'in',
          1 => 'm' . "\0" . 'app\\enums\\ticketpriorityenum' . "\0" . 'values',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreUserRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\StoreUserRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\StoreUserRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\StoreUserRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\StoreUserRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\http\\requests\\registerrequest' . "\0" . 'passwordrules',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SubmitBudgetRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\SubmitBudgetRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\SubmitBudgetRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\SubmitBudgetRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\SubmitBudgetRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateEquipmentRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateEquipmentRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\UpdateEquipmentRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateEquipmentRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\UpdateEquipmentRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\http\\request' . "\0" . 'route',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateProfileRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateProfileRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\UpdateProfileRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateProfileRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\UpdateProfileRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateRoomRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateRoomRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\UpdateRoomRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateRoomRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\UpdateRoomRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateUserRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateUserRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\UpdateUserRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\UpdateUserRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\UpdateUserRequest',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\http\\request' . "\0" . 'route',
          1 => 'm' . "\0" . 'app\\http\\requests\\registerrequest' . "\0" . 'passwordrules',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UploadPhotoRequest.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Requests\\UploadPhotoRequest',
        1 => 'authorize',
        2 => 'App\\Http\\Requests\\UploadPhotoRequest',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Requests\\UploadPhotoRequest',
        1 => 'rules',
        2 => 'App\\Http\\Requests\\UploadPhotoRequest',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TestMail.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Mail\\TestMail',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Mail\\TestMail',
        1 => 'envelope',
        2 => 'App\\Mail\\TestMail',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\mail\\mailables\\envelope' . "\0" . '__construct',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Mail\\TestMail',
        1 => 'content',
        2 => 'App\\Mail\\TestMail',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\mail\\mailables\\content' . "\0" . '__construct',
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedEmailViewCollector' => 
    array (
      0 => 'emails.ticketCreated',
    ),
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Mail\\TicketCreated',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Mail\\TicketCreated',
        1 => 'envelope',
        2 => 'App\\Mail\\TicketCreated',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\mail\\mailables\\envelope' . "\0" . '__construct',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Mail\\TicketCreated',
        1 => 'content',
        2 => 'App\\Mail\\TicketCreated',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\mail\\mailables\\content' . "\0" . '__construct',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Mail\\TicketCreated',
        1 => 'attachments',
        2 => 'App\\Mail\\TicketCreated',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'call_user_func([static::class, $event], function ($model) use ($event) {
    try {
        self::createAudit($model, $event);
    } catch (\\Throwable $e) {
        \\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]);
    }
}):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::createAudit($model, $event):19',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]):21',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):22',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$e->getMessage():24',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():35',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::resolveUserId($request):38',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():44',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():46',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():48',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):49',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):49',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):53',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request?->fullUrl(), \'ip_address\' => $request?->ip(), \'user_agent\' => $request?->userAgent()]):61',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):63',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():64',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():68',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():69',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():70',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth()->user():83',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():83',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:84',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():85',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:89',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():90',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      47 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::hashToken($token):92',
        3 => NULL,
      ),
      48 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken)->value(\'id\'):93',
        3 => NULL,
      ),
      49 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken):93',
        3 => NULL,
      ),
      50 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
      51 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 61,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\Auditable',
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'call_user_func([static::class, $event], function ($model) use ($event) {
    try {
        self::createAudit($model, $event);
    } catch (\\Throwable $e) {
        \\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]);
    }
}):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::createAudit($model, $event):19',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]):21',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):22',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$e->getMessage():24',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():35',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::resolveUserId($request):38',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():44',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():46',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():48',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):49',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):49',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):53',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request?->fullUrl(), \'ip_address\' => $request?->ip(), \'user_agent\' => $request?->userAgent()]):61',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):63',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():64',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():68',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():69',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():70',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth()->user():83',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():83',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:84',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():85',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:89',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():90',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      47 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::hashToken($token):92',
        3 => NULL,
      ),
      48 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken)->value(\'id\'):93',
        3 => NULL,
      ),
      49 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken):93',
        3 => NULL,
      ),
      50 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
      51 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 61,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\Auditable',
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'call_user_func([static::class, $event], function ($model) use ($event) {
    try {
        self::createAudit($model, $event);
    } catch (\\Throwable $e) {
        \\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]);
    }
}):17',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::createAudit($model, $event):19',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\Illuminate\\Support\\Facades\\Log::warning(\'Audit trail failed\', [\'model\' => get_class($model), \'event\' => $event, \'error\' => $e->getMessage()]):21',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):22',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$e->getMessage():24',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):34',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():35',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::resolveUserId($request):38',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':43',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():44',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':45',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():46',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():48',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):49',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):49',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):53',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request?->fullUrl(), \'ip_address\' => $request?->ip(), \'user_agent\' => $request?->userAgent()]):61',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):63',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():64',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():68',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():69',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():70',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'self::$resolvedUserId !== null:76',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):82',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth()->user():83',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():83',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:84',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():85',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null:89',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:89',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId === null && $request:89',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):90',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():90',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):91',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':91',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':91',
        3 => NULL,
      ),
      47 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::hashToken($token):92',
        3 => NULL,
      ),
      48 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken)->value(\'id\'):93',
        3 => NULL,
      ),
      49 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $hashedToken):93',
        3 => NULL,
      ),
      50 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
      51 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$userId !== null:97',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'hasStatus',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
          0 => 'f' . "\0" . 'app',
          1 => 'm' . "\0" . 'app\\domain\\ticket\\services\\ticketstatuschecker' . "\0" . 'hasstatus',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'getBudgetPauseMinutesAttribute',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\valueobjects\\budgetpauseminutes' . "\0" . '__construct',
          1 => 'm' . "\0" . 'app\\domain\\ticket\\valueobjects\\budgetpauseminutes' . "\0" . 'value',
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 17,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 61,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\Auditable',
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'getAvailableRoles',
        2 => 'App\\Models\\User',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\enums\\userroleenum' . "\0" . 'values',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isValidProfile',
        2 => 'App\\Models\\User',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\enums\\userroleenum' . "\0" . 'values',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'hashToken',
        2 => 'App\\Models\\User',
        3 => 
        array (
          0 => 'f' . "\0" . 'config',
        ),
      ),
      3 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isAdmin',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
      4 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isTechnician',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
      5 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isCommonUser',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
        2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Userprofile.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\NewTicketNotification.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\NewTicketNotification',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\NewTicketNotification',
        1 => 'via',
        2 => 'App\\Notifications\\NewTicketNotification',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Notifications\\NewTicketNotification',
        1 => 'toMail',
        2 => 'App\\Notifications\\NewTicketNotification',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\notifications\\messages\\simplemessage' . "\0" . 'subject',
          1 => 'm' . "\0" . 'illuminate\\notifications\\messages\\simplemessage' . "\0" . 'greeting',
          2 => 'm' . "\0" . 'illuminate\\notifications\\messages\\simplemessage' . "\0" . 'line',
          3 => 'm' . "\0" . 'illuminate\\notifications\\messages\\simplemessage' . "\0" . 'action',
          4 => 'f' . "\0" . 'url',
          5 => 'm' . "\0" . 'illuminate\\notifications\\messages\\simplemessage' . "\0" . 'salutation',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Notifications\\NewTicketNotification',
        1 => 'toArray',
        2 => 'App\\Notifications\\NewTicketNotification',
        3 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketNotification.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\TicketNotification',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\TicketNotification',
        1 => 'via',
        2 => 'App\\Notifications\\TicketNotification',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Notifications\\TicketNotification',
        1 => 'toBroadcast',
        2 => 'App\\Notifications\\TicketNotification',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\notifications\\messages\\broadcastmessage' . "\0" . '__construct',
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\TicketStatusChanged',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Notifications\\TicketStatusChanged',
        1 => 'via',
        2 => 'App\\Notifications\\TicketStatusChanged',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Notifications\\TicketStatusChanged',
        1 => 'toArray',
        2 => 'App\\Notifications\\TicketStatusChanged',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Notifications\\TicketStatusChanged',
        1 => 'resolveStatusLabel',
        2 => 'App\\Notifications\\TicketStatusChanged',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\enums\\ticketstatusenum' . "\0" . 'label',
        ),
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'viewAny',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'view',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\policies\\ticketpolicy' . "\0" . 'canaccessticket',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'comment',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\policies\\ticketpolicy' . "\0" . 'canaccessticket',
        ),
      ),
      3 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'attachPhoto',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\policies\\ticketpolicy' . "\0" . 'canaccessticket',
        ),
      ),
      4 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'deletePhoto',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\policies\\ticketpolicy' . "\0" . 'canaccessticket',
        ),
      ),
      5 => 
      array (
        0 => 'App\\Policies\\TicketPolicy',
        1 => 'schedule',
        2 => 'App\\Policies\\TicketPolicy',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\policies\\ticketpolicy' . "\0" . 'canaccessticket',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\AIService',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\AnalyticsService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\AnalyticsService',
        1 => 'getDashboardPayload',
        2 => 'App\\Services\\AnalyticsService',
        3 => 
        array (
          0 => 'm' . "\0" . 'illuminate\\cache\\repository' . "\0" . 'remember',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\BudgetCalculatorService',
        1 => 'calculateTotalMaterialCost',
        2 => 'App\\Services\\BudgetCalculatorService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\services\\budgetcalculatorservice' . "\0" . 'calculatebytype',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Services\\BudgetCalculatorService',
        1 => 'calculateTotalLaborCost',
        2 => 'App\\Services\\BudgetCalculatorService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\services\\budgetcalculatorservice' . "\0" . 'calculatebytype',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Services\\BudgetCalculatorService',
        1 => 'calculateBudgetTotal',
        2 => 'App\\Services\\BudgetCalculatorService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\services\\budgetcalculatorservice' . "\0" . 'calculatetotalmaterialcost',
          1 => 'm' . "\0" . 'app\\services\\budgetcalculatorservice' . "\0" . 'calculatetotallaborcost',
        ),
      ),
      3 => 
      array (
        0 => 'App\\Services\\BudgetCalculatorService',
        1 => 'calculateByType',
        2 => 'App\\Services\\BudgetCalculatorService',
        3 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\CalendarService',
        1 => 'getScheduledEvents',
        2 => 'App\\Services\\CalendarService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\queries\\scheduledeventsquery' . "\0" . '__construct',
          1 => 'm' . "\0" . 'app\\domain\\ticket\\queries\\scheduledeventsquery' . "\0" . 'execute',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 121,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 141,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 153,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TechnicianAssignmentService',
        1 => 
        array (
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TicketSearchService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'abort',
        1 => 41,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Cache\\Repository',
        1 => 'put',
        2 => 33,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Cache\\Repository',
        1 => 'forget',
        2 => 44,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Cache\\Repository',
        1 => 'forget',
        2 => 49,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\ConstructorWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 
        array (
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 'startRepair',
        2 => 'App\\Services\\TicketWorkflowService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\actions\\startticketaction' . "\0" . 'execute',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 'reopen',
        2 => 'App\\Services\\TicketWorkflowService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\actions\\reopenticketaction' . "\0" . 'execute',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 'cancel',
        2 => 'App\\Services\\TicketWorkflowService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\actions\\cancelticketaction' . "\0" . 'execute',
        ),
      ),
      3 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 'close',
        2 => 'App\\Services\\TicketWorkflowService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\actions\\closeticketaction' . "\0" . 'execute',
        ),
      ),
      4 => 
      array (
        0 => 'App\\Services\\TicketWorkflowService',
        1 => 'findHigherPriorityTickets',
        2 => 'App\\Services\\TicketWorkflowService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\domain\\ticket\\actions\\checkhigherpriorityaction' . "\0" . 'execute',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Sessão terminada com sucesso.',
        1 => 56,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\UserService',
        1 => 'getAvailableRoles',
        2 => 'App\\Services\\UserService',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\enums\\userroleenum' . "\0" . 'values',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Services\\UserService',
        1 => 'hashToken',
        2 => 'App\\Services\\UserService',
        3 => 
        array (
          0 => 'f' . "\0" . 'config',
        ),
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitDeclarationCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\Auditable',
        1 => 9,
      ),
    ),
  ),
); },
	'dependencies' => array (
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php' => 
  array (
    'fileHash' => '8365017c9636c680d526a122377d9a2f25ee988253fb76a1128fdd9afa9cdcc9',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php' => 
  array (
    'fileHash' => '52d128c04798fd74b30c81956c0229d9ab2d88d1637c421c497271da541cb3cd',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Concerns\\BroadcastsTicketStatus.php' => 
  array (
    'fileHash' => '297fd701f1c71119b46fba4160932d0d01a6e8673fcbf79c41cfb4696fdf2517',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
    'usedTraitDependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\DatabaseBackup.php' => 
  array (
    'fileHash' => '7133daeb692f693008190c7a7b7a284a68fac42327bb4a4a0d9dcd59d7438ffc',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\PartitionAudits.php' => 
  array (
    'fileHash' => '1835737f27898d1665ad99151198e39023dca18f9b419ca903f6e2a340eab8c1',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php' => 
  array (
    'fileHash' => 'eecc1bc5071d7f4a6c6903b3e02440443a02e5b3d72ccb1e54a4041abb7214d9',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetDecisionData.php' => 
  array (
    'fileHash' => 'c616d1f188d84401ea321bf918db710e389d3d8fd203aa75115b99ed5c0b52c0',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetSubmissionData.php' => 
  array (
    'fileHash' => '5d77bf0cdcbbe5187c1b4eb70f18ec04369f86f0efefd9132a4a87075a50351a',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CloseTicketData.php' => 
  array (
    'fileHash' => 'bfbb9ffb848c365025849e582c255c7ca86be859f1510896263e089975c35b3f',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CreateTicketData.php' => 
  array (
    'fileHash' => '6972635297531f8b335abf2d26229d463f943fbb07744e4f3c707a64ecb47763',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\ScheduleTicketData.php' => 
  array (
    'fileHash' => '2165a81e4fd607b32ad4aa868ac11eec0afe699b56d07bed93b3027f89cd9e60',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreEquipmentData.php' => 
  array (
    'fileHash' => '56826f673d0876d0bfcb8e43257d8de6cdeab5b0676b21f82927d6d018c703bf',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreRoomData.php' => 
  array (
    'fileHash' => 'fb11a1feefbea2760fe834866936885e3381428be2528aee88053b940bea9759',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreUserData.php' => 
  array (
    'fileHash' => 'cdd32ef9116b5fea43bf76bca00e6f09938741bb6b201d175c52d71637e9ffff',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\TicketFilters.php' => 
  array (
    'fileHash' => '464909e70bf18621739b769708076bb1bc62532881507167b0907b74d778ed70',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateEquipmentData.php' => 
  array (
    'fileHash' => 'b1bc52f3e617e0369e2ae97eaf30ca6a29a7ceb21b84b5d86156c3f3c10b17b9',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateUserData.php' => 
  array (
    'fileHash' => 'e7c5d4fefd188c751e247489d21614aa51f2419fec221c7fb2ad1df14eb6cd8f',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php' => 
  array (
    'fileHash' => 'af2ed752bc950b4ba780604e3a8566f840542aff9589baec2912140f1f63edce',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php' => 
  array (
    'fileHash' => 'fae49b988e9475621bfd65a44412dd442067bc1997276586a88f4853caad6d41',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php' => 
  array (
    'fileHash' => 'c599a3ce946c3d81c410736133fce400184dc74212cf9e212b12bf7af618d02b',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php' => 
  array (
    'fileHash' => '6d3edad543ebaf4a611484271731e970ab5914bf5fbd5838ff8b61a785bfa121',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php' => 
  array (
    'fileHash' => '8ed5aee74968ffefbc74e3e3bfb31c1d95c1b45ec287f384c09a170e49a80e20',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php' => 
  array (
    'fileHash' => 'a3f810678bbc1aa50a7dcd39c496b3a5d4eef6dbc05c49759b91d521cc7f3726',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php' => 
  array (
    'fileHash' => 'a3cb8e023d6666f4b6aa58b75f816f0922db1aec483ae8e719bdf085baf53b3e',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php' => 
  array (
    'fileHash' => '29e0a75105d43590f9e74e2d4d34be84dddbdb4ca6a3167a77551080232a37e6',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketPriorityQuery.php' => 
  array (
    'fileHash' => 'cb992941b719791b07bf868f3a6b7dfe14eb83dcfa7daf9274f1680d2e169ff7',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TopEntitiesQuery.php' => 
  array (
    'fileHash' => '20e8aabccae3bc0d2686dce477855d7969b05260d40c1921ee2ed4ff749dabc6',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php' => 
  array (
    'fileHash' => '4f5155fd9931c63fc4fecf0f815f8f6f55409ee10175e0d3929f79446d9d1abe',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php' => 
  array (
    'fileHash' => 'ae7f9e0090c776d0643a1feb140532eb8e3c2869b61b20080f4daf4faf616b14',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes.php' => 
  array (
    'fileHash' => '8078e2d568eb3399dfce445d41a11e4b465876691431ab66c629a1402c4932cb',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\BudgetStatusEnum.php' => 
  array (
    'fileHash' => '8b49146b03eb6ee0e6d8238fe0aea8bc1282e8a8ce8f48306f38eda7b483e77c',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\NotificationTypeEnum.php' => 
  array (
    'fileHash' => '5f33c002cfd0c972e30efd41a38c81c1d2dfa9f11dbc3085c9dade90c5563143',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketPriorityEnum.php' => 
  array (
    'fileHash' => '0b9af6c4606468a9b6a932a28d28541341085115f8c0ff7dbd92a1dfda9608e0',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CreateTicketData.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\TicketFilters.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketPriorityQuery.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreTicketRequest.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketStatusEnum.php' => 
  array (
    'fileHash' => 'be0585bd948ecc73b816197e33870393955961e7ea465ed0ef0f316243bcfb43',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\UserRoleEnum.php' => 
  array (
    'fileHash' => 'ef5d00f0f1fc288886727da9ae9afeb7b8a0f810f678b092f1162c30a576c6a2',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php' => 
  array (
    'fileHash' => '2567e4d663a65c4252b5b85e662aa70985afa9ed4ed5a9041e00f12a84ceb07b',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php' => 
  array (
    'fileHash' => '2a8ef04baa84ca4266a8316c394992544a8fa036aa4fd624f463a081d884f8a2',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php' => 
  array (
    'fileHash' => 'a7201340162e82afe6dbdc41ec57d81dc54fc5da2fe78b6aa7979f42c86b9f3c',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php' => 
  array (
    'fileHash' => '6f386b7d15dd1d0cf5ae3e9e28521aa6ac3080236b91284fbbb65df7d4a5b363',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php' => 
  array (
    'fileHash' => '8a95d74947044483bd0a6a2717f585cf7c2701143f13f4cc9bfcc4da0419d94d',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php' => 
  array (
    'fileHash' => '953f4fe52780b0888042333c5af5687a3b414df7c06c282dc6213adefa5576b9',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    'fileHash' => 'dab09dba6254d8ba7bcb174d43cb164ba974053144f20d5ca5ee80b9e7ea23ae',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ApiDocsController.php' => 
  array (
    'fileHash' => 'c824c1f228717cc7921b1b99618f1322ed404bb90817702f6b4d1b6a25586942',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php' => 
  array (
    'fileHash' => 'adb9c191fbf3d4e3a6a60cbc4aa62f4000cc5bd9d6871f9b9d129a331163f03c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    'fileHash' => '1e791190ebf59d90d54b5f801d15d7422621c9698f681c771fa8c2f7bc2cee60',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    'fileHash' => 'ad624d11fd50d9e752d7236550c037e4486246e3cdd74c367324f64b7d582a9c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    'fileHash' => '28f053aca932168a5c2777f0e7aa66358814c3865fe4fe33d92f6ed7879a512e',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ApiDocsController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PageController.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php' => 
  array (
    'fileHash' => '83f1199c663599bc0bc2ba1c328e75b929319f7cc6d413d35455c8226279d136',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PageController.php' => 
  array (
    'fileHash' => '2b92e4ad5c3f793d8c2cef9372e74a99a8f3b89738c558b12859d01abcf5a94a',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php' => 
  array (
    'fileHash' => '9aeae56e05ca49bb80bcb3307ec488faabd0ea351060bc3b72437ce2e66b4676',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php' => 
  array (
    'fileHash' => 'e94552ab74d4924dff9d7679c73b9cb48c4ba155ebbe1d41c3bb6b1e33ab218b',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php' => 
  array (
    'fileHash' => 'ac352238e8c382460940f56fecdc4d15c68fc40e8cbd765546ffdaf45727d1b1',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    'fileHash' => 'a87f82c89bf98eb4e04f179aff3b13ca5f491994f507432587b75937e7a63c21',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php' => 
  array (
    'fileHash' => '2fdd2b663536626bbb44632e7c566a8a9cf5fc3936215a9af764a20a47462730',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php' => 
  array (
    'fileHash' => 'f4b4b19b22e9c38ba3405ae4a59282d7028097e1d5b5c8d82f4e91a9f503d3a4',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php' => 
  array (
    'fileHash' => '2d6d153d938b631e421eb2c6a60d2a65a872b65379b48ae6e0f9a5fb0804e470',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    'fileHash' => '29e4270725f7172230306801a9ab47552b03c2bf1c0f6c5b6045617200c477ea',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php' => 
  array (
    'fileHash' => '03dcb68f0c50b7270a28e8c780efb56d7ebe8dc98e2884b8d55d4fe7748f71db',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php' => 
  array (
    'fileHash' => 'f90ea6c44413685e2e311cbbfad027f5f158eecc484273faa56ec5347f83497d',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php' => 
  array (
    'fileHash' => '2cc108263f30cd2becc7f2252c6debd0a8dc0142c8ce5718028375ad79505135',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php' => 
  array (
    'fileHash' => 'ce8b374ab54501fdf2787a5b1569d378e776c3738af231d4a37a0607dc078c0c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php' => 
  array (
    'fileHash' => '1854a1f5d97121070ebb8973a55101b88356176dd942c115bfd577198dbb6e1e',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    'fileHash' => '0db6ec5740094ab81e50c506d7c806cfd6681201471cac950e56da5c00ff0964',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    'fileHash' => '737de7ae246740a11146c342ce5b90101caa59dcfc70746f2824a84f1a52c158',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    'fileHash' => '43e905eeeaea2d835c6e8e2214c44ede804cebda3a9055f1d24903c0e5c780ad',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php' => 
  array (
    'fileHash' => '21f56fc39f19e1ab310aa3210e00ec39ddb742964e3098a89df0d770688cf731',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php' => 
  array (
    'fileHash' => 'ec365848b9c62c6f72409d197523f191ff380f6712f915f5fa065fc0ceb2f8a2',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SecurityHeaders.php' => 
  array (
    'fileHash' => '51b04585aa11aaac30b956076fbd44e5091d168ac6df6313f1a16e795a691eda',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SetLocaleMiddleware.php' => 
  array (
    'fileHash' => 'ec51a5845efc8c4800887c898d0cf0100e8335cba89ff164f7572db50f9015a1',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianRequest.php' => 
  array (
    'fileHash' => '5baa7a7ef2968ad034a5d3ee220a51b22079ceaa39846bd5b70f6709fce6b7e4',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianToTicketRequest.php' => 
  array (
    'fileHash' => 'ac1c166519d5971b9109dcebda44b40301bd5e5703a6a6e359aaddbb20ffb52f',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\BudgetDecisionRequest.php' => 
  array (
    'fileHash' => '9a333e38213fc1084ccef997dbe93419263e884dbde9427bcddbd428e7099f69',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ChangePasswordRequest.php' => 
  array (
    'fileHash' => 'bc56414ff3a55e9797a10e3988b935aaaed25059bb71bec97b44d42bbeb48cc7',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketRequest.php' => 
  array (
    'fileHash' => 'd40e01787c6613d111a09ee6ae9ad97f7e0152bbb64af06a453a6de23f51c4ce',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketSimpleRequest.php' => 
  array (
    'fileHash' => '0d5e81dbbde1f54a058e062a36361c70d9407ac856f16a45701a6291024efc83',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\LoginRequest.php' => 
  array (
    'fileHash' => 'f541edffa3e796e01daeb51978a978ce458cf46549483673058a150e005fe645',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RegisterRequest.php' => 
  array (
    'fileHash' => '512ece316e4d200ecc24542f781c69bcbcd68b04a74159faf04812f1df292713',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ChangePasswordRequest.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ResetPasswordRequest.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreUserRequest.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateUserRequest.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RequestBudgetRequest.php' => 
  array (
    'fileHash' => '91aba75487e28af3adca395a01ec4480aa82a6a7ca93ced6dbc36d376035d52e',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ResetPasswordRequest.php' => 
  array (
    'fileHash' => '8f2e86cdf2b514712fe1f4e3577d893f356f1b1e4409d834ffa4c07fc68918e9',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ScheduleTicketRequest.php' => 
  array (
    'fileHash' => '5b74179caa2b433a8659da9dc6fc348a725d50a5c0839342b6063f7a47dff78f',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SendResetLinkRequest.php' => 
  array (
    'fileHash' => '6bca5fa07f76751628f0e66d668a7af610114f69d8fa5981152f360101cfd180',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StartTicketRequest.php' => 
  array (
    'fileHash' => '352a31bb367418dd8f6f888ff4a7290eef851bd8df4543d20736afab60387b33',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreCommentRequest.php' => 
  array (
    'fileHash' => '3993593771f311c8f512e642fa4c6b5662eca8fe4e656e353de9f534b2308ce0',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreEquipmentRequest.php' => 
  array (
    'fileHash' => '3b6b2962b5d00fb3ddadf681e36382943a50f6b665f4a4ce6a8e13cd2df77875',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StorePreventiveRequest.php' => 
  array (
    'fileHash' => '7966e12295636ff0e3516c19bb2275d22a9692b6e19ea678fc713e04547202b1',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreRoomRequest.php' => 
  array (
    'fileHash' => 'ff4c8124d2aacf3c1405078a5b2346da8395a4c5f7a0fed05085c3b66c46b441',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreTicketRequest.php' => 
  array (
    'fileHash' => '919d22cb289b913ad4a0a2de597a2894aa6dda09b1df15ffd60e9edefd738079',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreUserRequest.php' => 
  array (
    'fileHash' => '7f8239b51b906aa24aa86bdf374a53a03d0adbd61c9bddad7faa882a480ac392',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SubmitBudgetRequest.php' => 
  array (
    'fileHash' => '388f554d0ab0f8f0a3a2e7cebcdf3f70da03f6d1953ee8c2a43f5ccd1bb6b0b7',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateEquipmentRequest.php' => 
  array (
    'fileHash' => 'c49fc6e3bd9adaf941334d4c7edac44486266d51ca28acc4ceb20f21f454b312',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateProfileRequest.php' => 
  array (
    'fileHash' => 'db19e7aa6d63e3c01f6182e13a346b36234c5dd4e0814470f52ac74b4cbb7110',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateRoomRequest.php' => 
  array (
    'fileHash' => '225eb2d56c19909bbf71fcca746a656b136d3947ba8bd7043cbcafa88edebe29',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateUserRequest.php' => 
  array (
    'fileHash' => '0db8b081cbef88c20583b2911bda2c4dcb3ca31cdb3785a6b4c9661e6581022c',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UploadPhotoRequest.php' => 
  array (
    'fileHash' => '469853092dda129089a560b12c225f105c9a5284d92385d8949ad5c9ad3c87cd',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TestMail.php' => 
  array (
    'fileHash' => 'ec05867309ba53eadcb5d911c41353fa444e42bced096f5f9850212a4b3c2447',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php' => 
  array (
    'fileHash' => 'd73ba06f95340060056db324ea1438665e4c7989fae339c93ada8d2ad9025caf',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php' => 
  array (
    'fileHash' => '5aec5f0b9194bf607d51a891898d97fe749dc6fc7dda1c96cf79c3abf9e8ca38',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    'fileHash' => '782d56fcf298d659e5271b83c682bb9769ff1c0378e8da57c7dddb6a8af4a1a4',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\EquipmentService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php' => 
  array (
    'fileHash' => 'c9bd8a35a53945eb6097935c62dadc2e2958ad33ccc6759cc86f32c2fc31835d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php' => 
  array (
    'fileHash' => '9a023a1107e87e68ed6f1acb76f6ba57eebba72dc5ab9fa94286e6012a8a01ae',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    'fileHash' => '651ddc9d23c8858b50afc83709d97fe117143874e7bf333c27d73b601bd55c10',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    'fileHash' => 'e1e2827768bf7de5a795c518b0c6ac32065f08d1846c1dd44a1e257d3916bd90',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
      25 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      26 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php',
      27 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      28 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      29 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      30 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      31 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php',
      32 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      33 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      34 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php',
      35 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php',
      36 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      37 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
      38 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php',
      39 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php',
      40 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
      41 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      42 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
      43 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    'fileHash' => 'c5d256401b563a3699c0e5cddac6395a5c5d6054160ac39074f4b9e748cefaa3',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
  array (
    'fileHash' => 'd43ab6208f7b062e0f93af3aa8435be0d1245c327bfe91d9a857850c78eb3704',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    'fileHash' => '9302cc683890ae1302927920b700a29bcabe1ba36893687bbe4c53a544182b0d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php' => 
  array (
    'fileHash' => 'ccd8e47c2ff9a9c54fa72b60fafdc359ca5d2bbaebbc466702cea5be059a8464',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php' => 
  array (
    'fileHash' => 'b76cc60436a11500ca3c1a2e009857009e472d0ea33773e3c0cdfbcf5a8a6772',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php' => 
  array (
    'fileHash' => '2ed5ec960cc5642b9dc200191315accabcb887525ab1248f98595914e879613d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      25 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php',
      26 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php',
      27 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php',
      28 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php',
      29 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      30 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php',
      31 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      32 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      33 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      34 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      35 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      36 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Userprofile.php',
      37 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\EquipmentPolicy.php',
      38 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\RoomPolicy.php',
      39 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php',
      40 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\UserPolicy.php',
      41 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      42 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php',
      43 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
      44 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\PasswordResetService.php',
      45 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      46 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
  array (
    'fileHash' => 'c78095089c35d79d044a292d4ac26a0b9280813a74ac8cd1a6ffe3922a11559d',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Userprofile.php' => 
  array (
    'fileHash' => 'c78095089c35d79d044a292d4ac26a0b9280813a74ac8cd1a6ffe3922a11559d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      25 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php',
      26 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php',
      27 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php',
      28 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php',
      29 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      30 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php',
      31 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      32 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      33 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      34 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      35 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      36 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      37 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php',
      38 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\EquipmentPolicy.php',
      39 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\RoomPolicy.php',
      40 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php',
      41 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\UserPolicy.php',
      42 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      43 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php',
      44 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
      45 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\PasswordResetService.php',
      46 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      47 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\NewTicketNotification.php' => 
  array (
    'fileHash' => 'f4fc6740a95d24323e4c7250997f447af58aa87ee4c7a655121d8e3cecacd28b',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketNotification.php' => 
  array (
    'fileHash' => '1abba402701d54443b70617b0f641a9bd6ce5b54e924c1e0fc20321512c6daef',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php' => 
  array (
    'fileHash' => '826bd0b85203b1192a9968c29556f47d0189716aef16b1f97992304f8188e152',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\OpenApi\\OpenApiSpec.php' => 
  array (
    'fileHash' => '269d04168a9e1806336f81720aa6f5136bb2358120d61ecdfa61dd485f372f3c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\EquipmentPolicy.php' => 
  array (
    'fileHash' => '4f4ed313de721f78c2a9039eaaefcd04a2d77d86c7e6ab5049177104aefd5e90',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\RoomPolicy.php' => 
  array (
    'fileHash' => '00ba77b9fcaa690b536cb17578755540c808bee14ca447f483af7b27c81fa0fb',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php' => 
  array (
    'fileHash' => '091658a6d554b6fe4d413b9c0e33ef71d2f0bc5fef5ae5e22895ea4a8cdc0893',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\UserPolicy.php' => 
  array (
    'fileHash' => '70e6652eea576f291b04214be997aa0b55458dd96f3fe4a0b263c9f32da5d163',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Providers\\AppServiceProvider.php' => 
  array (
    'fileHash' => '200dad3f50a142863dd210eecf1c5c2511218b8e4f7816511d4b5dddf590fae8',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    'fileHash' => 'eb5e1f956f9ffd5cc700b5e156266a74501451565c33d8dc2a055dff053c4d6c',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php' => 
  array (
    'fileHash' => 'f22eca1d24f8ef97408a633fc9f38f42b97cea45e645dc81d003f7ea4a80a846',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php' => 
  array (
    'fileHash' => 'efdf46a15f5ca5707ce35fa816be466cbff3c2b0310ed15a039b0c1b87e408af',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php' => 
  array (
    'fileHash' => 'db912c4fb84660ebc3c7dd637e97d41cdd19ebf6f54be757a4fe834442d23de9',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\EquipmentService.php' => 
  array (
    'fileHash' => '574ea81e43f46ebca2a952e3e4b262929712b0ac91198251aa391ddb373f7978',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php' => 
  array (
    'fileHash' => '622eae3bccfdd5b2e2fb6c07c4a7976a9d440fc63f35d5fc3bd952705a3376fc',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\PasswordResetService.php' => 
  array (
    'fileHash' => '3530be898b2c7d37fc2fb3cd0a52d5a5064cdc9dadf1521e84f31cdfa7a6c887',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php' => 
  array (
    'fileHash' => '72ba9fa014628174037543c2e92ade819ea5aa429f31cad9c14b3018215849ef',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php' => 
  array (
    'fileHash' => '755285e761405b6af1378aae84655653bb01109fca4c79d38eeb8bb8b5acadac',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php' => 
  array (
    'fileHash' => '1835183135248ff44507afc9e94f3e4865686517ab9a9df54e73a08ffaf95e9d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php' => 
  array (
    'fileHash' => '221c8ac1216254b702cbaa75527bbf4f165dd89541aca521576fad05db4f4316',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php' => 
  array (
    'fileHash' => '1ff2ec06c246547b7d2fb0e6044d110cd44a23e3227db3ec3e688931dbe36ce3',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
    'fileHash' => 'd0ace2e3521260e41816d729666bef984d68ef27b6d70bb5c403e35e954a5071',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php',
      23 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php',
      24 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php',
      25 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php',
      26 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php',
      27 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php',
      28 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      29 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php',
      30 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      31 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php',
      32 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      33 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      34 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      35 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      36 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php',
      37 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      38 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      39 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php',
      40 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php',
      41 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
      42 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php',
      43 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php',
      44 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php',
      45 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\EquipmentService.php',
      46 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php',
      47 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php',
      48 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php',
      49 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php',
    ),
    'usedTraitDependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
),
	'packageDependencies' => array (
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php' => 
  array (
    0 => 'symfony/console',
    1 => 'laravel/framework',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php' => 
  array (
    0 => 'maatwebsite/excel',
    1 => 'laravel/framework',
    2 => 'phpoffice/phpspreadsheet',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'psr/simple-cache',
    3 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
    3 => 'psr/container',
    4 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SetLocaleMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/console',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Providers\\AppServiceProvider.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ApiDocsController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SecurityHeaders.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
    3 => 'psr/container',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TestMail.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
    4 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\OpenApi\\OpenApiSpec.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\DatabaseBackup.php' => 
  array (
    0 => 'symfony/console',
    1 => 'laravel/framework',
    2 => 'nesbot/carbon',
    3 => 'symfony/finder',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\PartitionAudits.php' => 
  array (
    0 => 'symfony/console',
    1 => 'laravel/framework',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'barryvdh/laravel-dompdf',
    3 => 'dompdf/dompdf',
    4 => 'nesbot/carbon',
    5 => 'maatwebsite/excel',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
    3 => 'symfony/mailer',
    4 => 'psr/log',
    5 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PageController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
    3 => 'psr/container',
    4 => 'symfony/mailer',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'psr/log',
    3 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\NewTicketNotification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketNotification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'openai-php/client',
    2 => 'openai-php/laravel',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\ControllerHelpers.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetDecisionData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetSubmissionData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CloseTicketData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CreateTicketData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\ScheduleTicketData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreEquipmentData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreRoomData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreUserData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\TicketFilters.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateEquipmentData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateUserData.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketPriorityQuery.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TopEntitiesQuery.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes.php' => 
  array (
    0 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\BudgetStatusEnum.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\NotificationTypeEnum.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketPriorityEnum.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketStatusEnum.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\UserRoleEnum.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
    3 => 'psr/container',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'ramsey/uuid',
    3 => 'league/flysystem',
    4 => 'psr/http-message',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketWorkflowController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
    3 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianToTicketRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\BudgetDecisionRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ChangePasswordRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketSimpleRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\LoginRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RegisterRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RequestBudgetRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ScheduleTicketRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StartTicketRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreCommentRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreEquipmentRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StorePreventiveRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreRoomRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreTicketRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreUserRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SubmitBudgetRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateEquipmentRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateProfileRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateRoomRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateUserRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UploadPhotoRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Userprofile.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\EquipmentPolicy.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\RoomPolicy.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\UserPolicy.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/simple-cache',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\EquipmentService.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/log',
    2 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'psr/simple-cache',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Concerns\\BroadcastsTicketStatus.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ResetPasswordRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SendResetLinkRequest.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\PasswordResetService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'nesbot/carbon',
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\ApproveBudgetAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Actions\\ApproveBudgetAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notificationService',
               'type' => 'App\\Services\\NotificationService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Ticket',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'admin',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'App\\DTOs\\BudgetDecisionData',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Actions\\CreatePreventiveTicketAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Actions\\CreatePreventiveTicketAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\Ticket',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'admin',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'title',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'description',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'scheduledAt',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Concerns\\BroadcastsTicketStatus.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedTraitNode::__set_state(array(
       'name' => 'App\\Concerns\\BroadcastsTicketStatus',
       'phpDoc' => NULL,
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastStatusChange',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'oldStatus',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'newStatus',
               'type' => 'App\\Enums\\TicketStatusEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\DatabaseBackup.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Console\\Commands\\DatabaseBackup',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Console\\Command',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'signature',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'description',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\PartitionAudits.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Console\\Commands\\PartitionAudits',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Console\\Command',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'signature',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'description',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Console\\Commands\\SimulateTelemetry',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Comando de simulação de telemetria para manutenção preventiva.
 * Gera tickets de avaria automáticos com base em anomalias aleatórias nos equipamentos.
 * Deve ser agendado via `routes/console.php` para execução periódica.
 *
 * Uso: php artisan telemetry:simulate
 */',
         'namespace' => 'App\\Console\\Commands',
         'uses' => 
        array (
          'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
          'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
          'equipment' => 'App\\Models\\Equipment',
          'ticket' => 'App\\Models\\Ticket',
          'user' => 'App\\Models\\User',
          'ticketstatusservice' => 'App\\Services\\TicketStatusService',
          'command' => 'Illuminate\\Console\\Command',
          'arr' => 'Illuminate\\Support\\Arr',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Console\\Command',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'signature',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * A assinatura e descrição do comando Artisan.
     */',
             'namespace' => 'App\\Console\\Commands',
             'uses' => 
            array (
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'equipment' => 'App\\Models\\Equipment',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'command' => 'Illuminate\\Console\\Command',
              'arr' => 'Illuminate\\Support\\Arr',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'description',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Execução principal do comando de simulação.
     */',
             'namespace' => 'App\\Console\\Commands',
             'uses' => 
            array (
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'equipment' => 'App\\Models\\Equipment',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'command' => 'Illuminate\\Console\\Command',
              'arr' => 'Illuminate\\Support\\Arr',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetDecisionData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\BudgetDecisionData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'decision',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'feedback',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\BudgetSubmissionData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\BudgetSubmissionData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'estimatedBudget',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'budgetDetails',
               'type' => '?array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'isDetailedRequest',
               'type' => 'bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromSubmitEstimate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromDetailedRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CloseTicketData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\CloseTicketData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actualCost',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'report',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'force',
               'type' => 'bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\CreateTicketData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\CreateTicketData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'title',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'description',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priority',
               'type' => 'App\\Enums\\TicketPriorityEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'equipmentId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'roomId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\ScheduleTicketData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\ScheduleTicketData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'scheduledAt',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'scheduledEnd',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreEquipmentData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\StoreEquipmentData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'serial',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'roomId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'categoryId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreRoomData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\StoreRoomData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'location',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\StoreUserData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\StoreUserData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'email',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'password',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'profileId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'active',
               'type' => 'bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\TicketFilters.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\TicketFilters',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priority',
               'type' => '?App\\Enums\\TicketPriorityEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'dateFrom',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'dateTo',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateEquipmentData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\UpdateEquipmentData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'serial',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'roomId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'categoryId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'active',
               'type' => '?bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\DTOs\\UpdateUserData.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\DTOs\\UpdateUserData',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'name',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'email',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'password',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'profileId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'active',
               'type' => '?bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hasPassword',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toArray',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CancelTicketAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Actions\\CancelTicketAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\CloseTicketAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Actions\\CloseTicketAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'cost',
               'type' => '?float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'report',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'minutesSpent',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\ReopenTicketAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Actions\\ReopenTicketAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Actions\\StartTicketAction.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Actions\\StartTicketAction',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Queries\\MonthlyTicketsQuery',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'openStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'inProgressStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'closedStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'now',
               'type' => 'Illuminate\\Support\\Carbon',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\ScheduledEventsQuery.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Queries\\ScheduledEventsQuery',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'from',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'to',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketKpiQuery.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Queries\\TicketKpiQuery',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'openStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'inProgressStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'closedStatusId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'slaTargetMinutes',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TicketPriorityQuery.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Queries\\TicketPriorityQuery',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'baseQuery',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'execute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Queries\\TopEntitiesQuery.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Queries\\TopEntitiesQuery',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'baseQuery',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTopEquipments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTopRooms',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTopTechnicians',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Scopes\\TicketScopes.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Scopes\\TicketScopes',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeOpen',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeInProgress',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeClosed',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeScheduled',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeByPriority',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priority',
               'type' => 'App\\Enums\\TicketPriorityEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeForTechnician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => 'Illuminate\\Database\\Eloquent\\Builder',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\Services\\TicketStatusChecker.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hasStatus',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticketStatusId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => 'App\\Enums\\TicketStatusEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'requestedAt',
               'type' => '?Carbon\\CarbonInterface',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'decidedAt',
               'type' => '?Carbon\\CarbonInterface',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 4,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'value',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\BudgetStatusEnum.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\BudgetStatusEnum',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Pending',
           'value' => '\'pending\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Approved',
           'value' => '\'approved\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Rejected',
           'value' => '\'rejected\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'label',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\NotificationTypeEnum.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\NotificationTypeEnum',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'BudgetRequest',
           'value' => '\'budget_request\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'BudgetSubmitted',
           'value' => '\'budget_submitted\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'BudgetApproved',
           'value' => '\'budget_approved\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'BudgetRejected',
           'value' => '\'budget_rejected\'',
           'phpDoc' => NULL,
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'BudgetAutoApproved',
           'value' => '\'budget_auto_approved\'',
           'phpDoc' => NULL,
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'TicketClosed',
           'value' => '\'ticket_closed\'',
           'phpDoc' => NULL,
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'PriorityOverride',
           'value' => '\'priority_override\'',
           'phpDoc' => NULL,
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'icon',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketPriorityEnum.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\TicketPriorityEnum',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Low',
           'value' => '\'baixa\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Medium',
           'value' => '\'média\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'High',
           'value' => '\'alta\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Critical',
           'value' => '\'crítica\'',
           'phpDoc' => NULL,
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'label',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'weight',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'normalize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'value',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'values',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\TicketStatusEnum.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\TicketStatusEnum',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Open',
           'value' => '\'aberta\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'InProgress',
           'value' => '\'em curso\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Closed',
           'value' => '\'fechada\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Cancelled',
           'value' => '\'cancelada\'',
           'phpDoc' => NULL,
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'PendingBudget',
           'value' => '\'pendente orçamento\'',
           'phpDoc' => NULL,
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Rejected',
           'value' => '\'recusada\'',
           'phpDoc' => NULL,
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'label',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'fromValue',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => '?self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'value',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'values',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Enums\\UserRoleEnum.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedEnumNode::__set_state(array(
       'name' => 'App\\Enums\\UserRoleEnum',
       'scalarType' => 'string',
       'phpDoc' => NULL,
       'implements' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'User',
           'value' => '\'user\'',
           'phpDoc' => NULL,
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Technician',
           'value' => '\'technician\'',
           'phpDoc' => NULL,
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedEnumCaseNode::__set_state(array(
           'name' => 'Admin',
           'value' => '\'admin\'',
           'phpDoc' => NULL,
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'label',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'values',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Events\\TicketCreatedBroadcast',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Broadcasting\\ShouldBroadcastNow',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastOn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastAs',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastWith',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Events\\TicketStatusUpdatedBroadcast',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Broadcasting\\ShouldBroadcastNow',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Foundation\\Events\\Dispatchable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'oldStatus',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'newStatus',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastOn',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastAs',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'broadcastWith',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Exports\\TicketsExport',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Classe de exportação para ficheiro Excel utilizando o pacote Maatwebsite/Excel.
 * Implementa FromQuery para processar os dados em modo streaming,
 * evitando problemas de memória com grandes volumes de registos.
 */',
         'namespace' => 'App\\Exports',
         'uses' => 
        array (
          'ticket' => 'App\\Models\\Ticket',
          'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
          'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
          'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
          'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
          'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
          'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
          'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
          'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
        0 => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
        1 => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
        2 => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
        3 => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
        4 => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
        5 => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'query',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Query base para a exportação. Utiliza cursor-friendly eager loading mínimo.
     */',
             'namespace' => 'App\\Exports',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
              'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
              'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
              'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
              'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
              'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
              'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Builder',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'headings',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Define o cabeçalho da folha de cálculo.
     */',
             'namespace' => 'App\\Exports',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
              'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
              'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
              'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
              'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
              'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
              'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'map',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mapeia cada registo Eloquent para uma linha da folha de cálculo.
     */',
             'namespace' => 'App\\Exports',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
              'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
              'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
              'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
              'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
              'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
              'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'title',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Título da folha no ficheiro Excel.
     */',
             'namespace' => 'App\\Exports',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
              'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
              'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
              'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
              'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
              'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
              'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'styles',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Aplica estilos à folha – cabeçalho em negrito com fundo azul escuro.
     */',
             'namespace' => 'App\\Exports',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'builder' => 'Illuminate\\Database\\Eloquent\\Builder',
              'fromquery' => 'Maatwebsite\\Excel\\Concerns\\FromQuery',
              'shouldautosize' => 'Maatwebsite\\Excel\\Concerns\\ShouldAutoSize',
              'withheadings' => 'Maatwebsite\\Excel\\Concerns\\WithHeadings',
              'withmapping' => 'Maatwebsite\\Excel\\Concerns\\WithMapping',
              'withstyles' => 'Maatwebsite\\Excel\\Concerns\\WithStyles',
              'withtitle' => 'Maatwebsite\\Excel\\Concerns\\WithTitle',
              'worksheet' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'sheet',
               'type' => 'PhpOffice\\PhpSpreadsheet\\Worksheet\\Worksheet',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AdminController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianService',
               'type' => 'App\\Services\\TechnicianAssignmentService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'approveBudgetAction',
               'type' => 'App\\Actions\\ApproveBudgetAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'createPreventiveAction',
               'type' => 'App\\Actions\\CreatePreventiveTicketAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approveBudget',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\BudgetDecisionRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'assignTechnician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\AssignTechnicianRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storePreventive',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StorePreventiveRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminEquipmentController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AdminEquipmentController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StoreEquipmentRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\UpdateEquipmentRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'destroy',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminUserController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AdminUserController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StoreUserRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\UpdateUserRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'inactivate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'profiles',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AnalyticsController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'analyticsService',
               'type' => 'App\\Services\\AnalyticsService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'stats',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportCsv',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportPdf',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportExcel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ApiDocsController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\ApiDocsController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'swagger',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna a especificação OpenAPI/Swagger para a documentação da API.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AuditController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista os registos de auditoria do sistema.
     * Protegido globalmente via web.php com os middlewares custom.auth e role:admin.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'audit' => 'App\\Models\\Audit',
              'request' => 'Illuminate\\Http\\Request',
              'oa' => 'OpenApi\\Attributes',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'OpenApi\\Attributes\\Get',
               'args' => 
              array (
                'path' => '\'/admin/audits\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Listar auditoria\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de auditoria\')]',
              ),
            )),
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AuthController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'userService',
               'type' => 'App\\Services\\UserService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'login',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\LoginRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logout',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\CalendarController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'calendarService',
               'type' => 'App\\Services\\CalendarService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'events',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Controller',
       'phpDoc' => NULL,
       'abstract' => true,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authenticatedUser',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'App\\Models\\User',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'requireRole',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'roles',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'jsonNotFound',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'jsonValidationError',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'errors',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\NotificationController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'OpenApi\\Attributes\\Get',
               'args' => 
              array (
                'path' => '\'/notifications\'',
                'tags' => '[\'Notifications\']',
                'summary' => '\'Listar notificações do utilizador\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista paginada de notificações\')]',
              ),
            )),
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'markAsRead',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'OpenApi\\Attributes\\Patch',
               'args' => 
              array (
                'path' => '\'/notifications/{id}\'',
                'tags' => '[\'Notifications\']',
                'summary' => '\'Marcar notificação como lida\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Notificação atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Notificação não encontrada\')]',
              ),
            )),
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sendTestEmail',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'OpenApi\\Attributes\\Post',
               'args' => 
              array (
                'path' => '\'/notifications/test-email\'',
                'tags' => '[\'Notifications\']',
                'summary' => '\'Enviar email de teste via Mailgun\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Email de teste enviado\')]',
              ),
            )),
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PageController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\PageController',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Controller para páginas estáticas e utilitárias
 * que anteriormente usavam closures nas rotas.
 *
 * Consolidar aqui permite que php artisan route:cache funcione.
 */',
         'namespace' => 'App\\Http\\Controllers',
         'uses' => 
        array (
          'request' => 'Illuminate\\Http\\Request',
          'mail' => 'Illuminate\\Support\\Facades\\Mail',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'home',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Página inicial (landing page).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'mail' => 'Illuminate\\Support\\Facades\\Mail',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'switchLang',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Alternar idioma da aplicação (pt / en).
     *
     * Se o utilizador já estiver autenticado (token presente no cookie),
     * redireciona para o painel em vez da página de login.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'mail' => 'Illuminate\\Support\\Facades\\Mail',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'locale',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'login',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Vista de login (formulário de autenticação).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'mail' => 'Illuminate\\Support\\Facades\\Mail',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'testEmail',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Rota de teste de e-mail (apenas em ambientes não-produção).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'mail' => 'Illuminate\\Support\\Facades\\Mail',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'passwordResetForm',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Formulário de reset de password (API).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'mail' => 'Illuminate\\Support\\Facades\\Mail',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'token',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\PasswordResetController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\PasswordResetController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'passwordResetService',
               'type' => 'App\\Services\\PasswordResetService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sendResetLink',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\SendResetLinkRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetPassword',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\ResetPasswordRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ProfileController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\ProfileController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'changePassword',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\ChangePasswordRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateProfile',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\UpdateProfileRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RegisterController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\RegisterController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'userService',
               'type' => 'App\\Services\\UserService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\RegisterRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\RoomController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'indexRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storeRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StoreRoomRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'showRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'room',
               'type' => 'App\\Models\\Room',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'editRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'room',
               'type' => 'App\\Models\\Room',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\UpdateRoomRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'inactivateRoom',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketAttachmentController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\TicketAttachmentController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\UploadPhotoRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'destroy',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'photoId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketBudgetController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\TicketBudgetController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notificationService',
               'type' => 'App\\Services\\NotificationService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'submitEstimate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\SubmitBudgetRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'requestAuthorization',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\RequestBudgetRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketCommentController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\TicketCommentController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StoreCommentRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\TicketController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianService',
               'type' => 'App\\Services\\TechnicianAssignmentService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'searchService',
               'type' => 'App\\Services\\TicketSearchService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StoreTicketRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'search',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse|Illuminate\\View\\View',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openTickets',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getMostUrgentOpenTicket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketAssignmentController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Ticket\\TicketAssignmentController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianService',
               'type' => 'App\\Services\\TechnicianAssignmentService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketCloseController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Ticket\\TicketCloseController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'workflowService',
               'type' => 'App\\Services\\TicketWorkflowService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notificationService',
               'type' => 'App\\Services\\NotificationService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'closeFinal',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\CloseTicketRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketLifecycleController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Ticket\\TicketLifecycleController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'workflowService',
               'type' => 'App\\Services\\TicketWorkflowService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reopen',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'cancel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketScheduleController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Ticket\\TicketScheduleController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\ScheduleTicketRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Ticket\\TicketStartController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Ticket\\TicketStartController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Concerns\\BroadcastsTicketStatus',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'workflowService',
               'type' => 'App\\Services\\TicketWorkflowService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notificationService',
               'type' => 'App\\Services\\NotificationService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__invoke',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'App\\Http\\Requests\\StartTicketRequest',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\UiController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'equipmentService',
               'type' => 'App\\Services\\EquipmentService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticketCreate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'users',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'userCreate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'userEdit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rooms',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomCreate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomDetail',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomEdit',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'audits',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticketDetail',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getEquipments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'analytics',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'profile',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\CsrfMiddleware',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'session',
          ),
           'phpDoc' => NULL,
           'type' => 'Illuminate\\Contracts\\Session\\Session',
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'session',
               'type' => 'Illuminate\\Contracts\\Session\\Session',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'shouldSkipCsrfValidation',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getCsrfTokenFromRequest',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'validateCsrfToken',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'token',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'regenerateSessionId',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\CustomAuthMiddleware',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\RateLimitMiddleware',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'limiter',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The rate limiter instance.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Create a new middleware instance.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'limiter',
               'type' => 'Illuminate\\Cache\\RateLimiter',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Handle an incoming request.
     *
     * @return mixed
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'maxAttempts',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'decayMinutes',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resolveRequestSignature',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Resolve request signature.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'addHeaders',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Add the limit header information to the response.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'response',
               'type' => 'Symfony\\Component\\HttpFoundation\\Response',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'maxAttempts',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'remainingAttempts',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calculateRemainingAttempts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Calculate the number of remaining attempts.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'key',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'maxAttempts',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'buildResponse',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Build the response when rate limit is exceeded.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'ratelimiter' => 'Illuminate\\Cache\\RateLimiter',
              'request' => 'Illuminate\\Http\\Request',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'key',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'maxAttempts',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'decayMinutes',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\RoleMiddleware',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Handle an incoming request and delegate to the next middleware in the chain.
     *
     * @param  string  ...$roles  The roles that are allowed to access this route
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'closure' => 'Closure',
              'request' => 'Illuminate\\Http\\Request',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'roles',
               'type' => 'string',
               'byRef' => false,
               'variadic' => true,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SecurityHeaders.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\SecurityHeaders',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SetLocaleMiddleware.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Middleware\\SetLocaleMiddleware',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'request' => 'Illuminate\\Http\\Request',
              'app' => 'Illuminate\\Support\\Facades\\App',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Symfony\\Component\\HttpFoundation\\Response',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'next',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\AssignTechnicianRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\AssignTechnicianToTicketRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\AssignTechnicianToTicketRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\BudgetDecisionRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\BudgetDecisionRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ChangePasswordRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\ChangePasswordRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\CloseTicketRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\CloseTicketSimpleRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\CloseTicketSimpleRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\LoginRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\LoginRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RegisterRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\RegisterRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'passwordRules',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @return list<string> */',
             'namespace' => 'App\\Http\\Requests',
             'uses' => 
            array (
              'formrequest' => 'Illuminate\\Foundation\\Http\\FormRequest',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\RequestBudgetRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\RequestBudgetRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ResetPasswordRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\ResetPasswordRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\ScheduleTicketRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\ScheduleTicketRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SendResetLinkRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\SendResetLinkRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StartTicketRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StartTicketRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreCommentRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StoreCommentRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreEquipmentRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StoreEquipmentRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StorePreventiveRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StorePreventiveRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreRoomRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StoreRoomRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreTicketRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StoreTicketRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\StoreUserRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\StoreUserRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\SubmitBudgetRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\SubmitBudgetRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateEquipmentRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\UpdateEquipmentRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateProfileRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\UpdateProfileRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateRoomRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\UpdateRoomRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UpdateUserRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\UpdateUserRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Requests\\UploadPhotoRequest.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Requests\\UploadPhotoRequest',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => 'Illuminate\\Foundation\\Http\\FormRequest',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'authorize',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rules',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TestMail.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Mail\\TestMail',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Mail\\Mailable',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'recipientName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 1,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'envelope',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Mail\\Mailables\\Envelope',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'content',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Mail\\Mailables\\Content',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Mail\\TicketCreated',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Mail\\Mailable',
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
        1 => 'Illuminate\\Queue\\SerializesModels',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'ticket',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Create a new message instance.
     */',
             'namespace' => 'App\\Mail',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'shouldqueue' => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
              'mailable' => 'Illuminate\\Mail\\Mailable',
              'attachment' => 'Illuminate\\Mail\\Mailables\\Attachment',
              'content' => 'Illuminate\\Mail\\Mailables\\Content',
              'envelope' => 'Illuminate\\Mail\\Mailables\\Envelope',
              'serializesmodels' => 'Illuminate\\Queue\\SerializesModels',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'build',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'envelope',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the message envelope.
     */',
             'namespace' => 'App\\Mail',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'shouldqueue' => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
              'mailable' => 'Illuminate\\Mail\\Mailable',
              'attachment' => 'Illuminate\\Mail\\Mailables\\Attachment',
              'content' => 'Illuminate\\Mail\\Mailables\\Content',
              'envelope' => 'Illuminate\\Mail\\Mailables\\Envelope',
              'serializesmodels' => 'Illuminate\\Queue\\SerializesModels',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Mail\\Mailables\\Envelope',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'content',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the message content definition.
     */',
             'namespace' => 'App\\Mail',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'shouldqueue' => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
              'mailable' => 'Illuminate\\Mail\\Mailable',
              'attachment' => 'Illuminate\\Mail\\Mailables\\Attachment',
              'content' => 'Illuminate\\Mail\\Mailables\\Content',
              'envelope' => 'Illuminate\\Mail\\Mailables\\Envelope',
              'serializesmodels' => 'Illuminate\\Queue\\SerializesModels',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Mail\\Mailables\\Content',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attachments',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */',
             'namespace' => 'App\\Mail',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'shouldqueue' => 'Illuminate\\Contracts\\Queue\\ShouldQueue',
              'mailable' => 'Illuminate\\Mail\\Mailable',
              'attachment' => 'Illuminate\\Mail\\Mailables\\Attachment',
              'content' => 'Illuminate\\Mail\\Mailables\\Content',
              'envelope' => 'Illuminate\\Mail\\Mailables\\Envelope',
              'serializesmodels' => 'Illuminate\\Queue\\SerializesModels',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Audit',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Audit records are append-only: UPDATE is forbidden at the Eloquent level.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'attributes',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'options',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'delete',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Audit records are append-only: DELETE is forbidden at the Eloquent level.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Equipment',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Traits\\Auditable',
        1 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'category',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'room',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\EquipmentCategory',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Notification',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Room',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Traits\\Auditable',
        1 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Ticket',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'App\\Traits\\Auditable',
        1 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_OPEN',
               'value' => '\'aberta\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::Open->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_IN_PROGRESS',
               'value' => '\'em curso\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::InProgress->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_CLOSED',
               'value' => '\'fechada\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::Closed->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_CANCELLED',
               'value' => '\'cancelada\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::Cancelled->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_PENDING_BUDGET',
               'value' => '\'pendente orçamento\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::PendingBudget->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'STATUS_REJECTED',
               'value' => '\'recusada\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketStatusEnum::Rejected->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'PRIORITY_LOW',
               'value' => '\'baixa\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketPriorityEnum::Low->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'PRIORITY_MEDIUM',
               'value' => '\'média\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketPriorityEnum::Medium->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'PRIORITY_HIGH',
               'value' => '\'alta\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketPriorityEnum::High->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'PRIORITY_CRITICAL',
               'value' => '\'crítica\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use TicketPriorityEnum::Critical->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'BUDGET_PENDING',
               'value' => '\'pending\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use BudgetStatusEnum::Pending->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'BUDGET_APPROVED',
               'value' => '\'approved\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use BudgetStatusEnum::Approved->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'BUDGET_REJECTED',
               'value' => '\'rejected\'',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use BudgetStatusEnum::Rejected->value */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'flushStatusCache',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getStatusIdByName',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @deprecated Use app(TicketStatusService::class)->getByName(TicketStatusEnum::*) */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => '?int',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<string> */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var array<string, string> */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'ticketstatuschecker' => 'App\\Domain\\Ticket\\Services\\TicketStatusChecker',
              'budgetpauseminutes' => 'App\\Domain\\Ticket\\ValueObjects\\BudgetPauseMinutes',
              'budgetstatusenum' => 'App\\Enums\\BudgetStatusEnum',
              'ticketpriorityenum' => 'App\\Enums\\TicketPriorityEnum',
              'ticketstatusenum' => 'App\\Enums\\TicketStatusEnum',
              'ticketstatusservice' => 'App\\Services\\TicketStatusService',
              'auditable' => 'App\\Traits\\Auditable',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'status',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        18 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'budgetApprovedBy',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        19 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'workflowHistory',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        20 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        21 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'technician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        22 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipment',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        23 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'room',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        24 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'comments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        25 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attachments',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        26 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hasStatus',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => 'App\\Enums\\TicketStatusEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        27 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeOpen',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        28 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeInProgress',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        29 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeClosed',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        30 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeScheduled',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        31 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeByPriority',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'priority',
               'type' => 'App\\Enums\\TicketPriorityEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        32 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scopeForTechnician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'query',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianId',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        33 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getBudgetPauseMinutesAttribute',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TicketAttachment',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TicketComment',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TicketStatus',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'type',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém o tipo de avaria ao qual este estado pertence.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém os tickets que estão atualmente neste estado.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TicketType',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'statuses',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém os estados associados a este tipo de avaria.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\TicketWorkflowHistory',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'originStatus',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'destinationStatus',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'technician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\User',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @property-read UserProfile|null $profile
 * @property-read int $tickets_ativos
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'userroleenum' => 'App\\Enums\\UserRoleEnum',
          'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
          'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
          'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
          'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
          'notifiable' => 'Illuminate\\Notifications\\Notifiable',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Auth\\User',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
        2 => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var string */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<string> */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var list<string> */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/** @var array<string, string> */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'ROLE_USER',
               'value' => '\\App\\Enums\\UserRoleEnum::User->value',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'ROLE_TECHNICIAN',
               'value' => '\\App\\Enums\\UserRoleEnum::Technician->value',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedClassConstantsNode::__set_state(array(
           'constants' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedClassConstantNode::__set_state(array(
               'name' => 'ROLE_ADMIN',
               'value' => '\\App\\Enums\\UserRoleEnum::Admin->value',
               'attributes' => 
              array (
              ),
            )),
          ),
           'public' => true,
           'private' => false,
           'final' => false,
           'phpDoc' => NULL,
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Tickets criados pelo utilizador.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'assignedTickets',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Tickets atribuídos ao utilizador (caso seja técnico).
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'profile',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Perfil associado ao utilizador.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isAdmin',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isTechnician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isCommonUser',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isCommon',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Alias de isCommonUser() – utilizado nos controllers para verificar se o utilizador não tem papel elevado.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getAvailableRoles',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isValidProfile',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'profileName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hashToken',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Gera um hash HMAC-SHA256 do token para armazenamento seguro na BD.
     * O token em texto plano é devolvido ao cliente; o hash fica na BD.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'token',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'booted',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Registo dos Model Events do Laravel.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'userroleenum' => 'App\\Enums\\UserRoleEnum',
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
              'softdeletes' => 'Illuminate\\Database\\Eloquent\\SoftDeletes',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Userprofile.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\UserProfile',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @property int $id
 * @property string $name
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'users',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Relação: Um perfil pertence a muitos utilizadores.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\NewTicketNotification.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Notifications\\NewTicketNotification',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Notifications\\Notification',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Create a new notification instance.
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'mailmessage' => 'Illuminate\\Notifications\\Messages\\MailMessage',
              'notification' => 'Illuminate\\Notifications\\Notification',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'via',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the notification\'s delivery channels.
     *
     * @return array<int, string>
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'mailmessage' => 'Illuminate\\Notifications\\Messages\\MailMessage',
              'notification' => 'Illuminate\\Notifications\\Notification',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toMail',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the mail representation of the notification.
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'mailmessage' => 'Illuminate\\Notifications\\Messages\\MailMessage',
              'notification' => 'Illuminate\\Notifications\\Notification',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Notifications\\Messages\\MailMessage',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toArray',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'queueable' => 'Illuminate\\Bus\\Queueable',
              'mailmessage' => 'Illuminate\\Notifications\\Messages\\MailMessage',
              'notification' => 'Illuminate\\Notifications\\Notification',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketNotification.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Notifications\\TicketNotification',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Notifications\\Notification',
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Broadcasting\\ShouldBroadcast',
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'title',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'message',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => true,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'title',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'via',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toBroadcast',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => NULL,
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Notifications\\TicketStatusChanged',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Notifications\\Notification',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 2,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'oldStatus',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 2,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'newStatus',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 2,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'via',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toMail',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Notifications\\Messages\\MailMessage',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'toArray',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'notifiable',
               'type' => 'object',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\OpenApi\\OpenApiSpec.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\OpenApi\\OpenApiSpec',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
      ),
       'attributes' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'OpenApi\\Attributes\\Info',
           'args' => 
          array (
            'title' => '\'Gestão de Avarias API\'',
            'version' => '\'1.0.0\'',
            'description' => '\'Documentação OpenAPI da aplicação de gestão de tickets, equipamentos, auditoria e relatórios.\'',
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'OpenApi\\Attributes\\Server',
           'args' => 
          array (
            'url' => '\'/\'',
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'OpenApi\\Attributes\\SecurityScheme',
           'args' => 
          array (
            'securityScheme' => '\'X-Auth-Token\'',
            'type' => '\'apiKey\'',
            'in' => '\'header\'',
            'name' => '\'X-Auth-Token\'',
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
           'name' => 'OpenApi\\Attributes\\SecurityScheme',
           'args' => 
          array (
            'securityScheme' => '\'BearerAuth\'',
            'type' => '\'http\'',
            'scheme' => '\'bearer\'',
            'bearerFormat' => '\'JWT\'',
          ),
        )),
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\EquipmentPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\EquipmentPolicy',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'manage',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\RoomPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\RoomPolicy',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'manage',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\TicketPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\TicketPolicy',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'viewAny',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'view',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'comment',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'attachPhoto',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'deletePhoto',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'cancel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'start',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'close',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reopen',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'schedule',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'submitBudget',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approveBudget',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Policies\\UserPolicy.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Policies\\UserPolicy',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'manage',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'admin',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'inactivate',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'admin',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'target',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Providers\\AppServiceProvider.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Providers\\AppServiceProvider',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Support\\ServiceProvider',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Register any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'boot',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Bootstrap any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\AIService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'recomendarTecnico',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AnalyticsService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\AnalyticsService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getDashboardPayload',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportCsv',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\BudgetCalculatorService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\BudgetCalculatorService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calculateTotalMaterialCost',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calculateTotalLaborCost',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calculateBudgetTotal',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getBreakdown',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\CalendarService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\CalendarService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getScheduledEventsForUser',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getScheduledEvents',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Support\\Collection',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'from',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'to',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\EquipmentService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\EquipmentService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'listPaginated',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'search',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\NotificationService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\NotificationService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'notifyBudgetSubmitted',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'notifyBudgetAutoApproved',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'notifyBudgetDecision',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'decision',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'notifyTicketClosed',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'message',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'notifyPriorityOverride',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technician',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'urgentCount',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\PasswordResetService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\PasswordResetService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createResetToken',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'email',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'validateToken',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\User',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'email',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'token',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resetPassword',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'password',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TechnicianAssignmentService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TechnicianAssignmentService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getLeastBusyTechnician',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\User',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'assignToTicket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\User',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'technicianId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'findMostUrgentOpenTicket',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?App\\Models\\Ticket',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'excludeId',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketSearchService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TicketSearchService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'search',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\Pagination\\LengthAwarePaginator',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'filters',
               'type' => 'App\\DTOs\\TicketFilters',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketStatusService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TicketStatusService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getByName',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?int',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'status',
               'type' => 'App\\Enums\\TicketStatusEnum',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'flush',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\TicketWorkflowService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TicketWorkflowService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusService',
               'type' => 'App\\Services\\TicketStatusService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'startAction',
               'type' => 'App\\Domain\\Ticket\\Actions\\StartTicketAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'closeAction',
               'type' => 'App\\Domain\\Ticket\\Actions\\CloseTicketAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reopenAction',
               'type' => 'App\\Domain\\Ticket\\Actions\\ReopenTicketAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'cancelAction',
               'type' => 'App\\Domain\\Ticket\\Actions\\CancelTicketAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'checkHigherPriorityAction',
               'type' => 'App\\Domain\\Ticket\\Actions\\CheckHigherPriorityAction',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 68,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'startRepair',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reopen',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'cancel',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'close',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'cost',
               'type' => '?float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'report',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'minutesSpent',
               'type' => '?int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'checkAutoClose',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'threshold',
               'type' => 'float',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'findHigherPriorityTickets',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ticket',
               'type' => 'App\\Models\\Ticket',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\UserService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\UserService',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => true,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getAvailableRoles',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ensureDefaultProfile',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hashToken',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'token',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createToken',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'buildAuthResponse',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'user',
               'type' => 'App\\Models\\User',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'plainToken',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'statusCode',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'buildLogoutResponse',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
               'phpDoc' => NULL,
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedTraitNode::__set_state(array(
       'name' => 'App\\Traits\\Auditable',
       'phpDoc' => NULL,
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'bootAuditable',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
