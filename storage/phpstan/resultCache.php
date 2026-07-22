<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1784719355,
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
    'C:/laravel/Projeto Final Cesae/Projeto-Final-Cesae/composer.lock' => '0c5bb40aa5c8b3eb436a2a9c488c6e18e0931ea67ed1d9145e5e05c45d7ecd00',
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
          'pretty_version' => 'v1.0.9',
          'version' => '1.0.9.0',
          'reference' => 'd7580af6d3f8384325d9cd3e99b21c3ed1848176',
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
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/reflection' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.63.0',
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
          'pretty_version' => 'v12.63.0',
          'version' => '12.63.0.0',
          'reference' => '7adfddbf4738f2e6cae5419b0e6bc46d4cccfbcf',
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
          'pretty_version' => 'v1.63.0',
          'version' => '1.63.0.0',
          'reference' => '51bbce3f803c1d386cabbb44e618c955a12ff5fc',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/sanctum' => 
        array (
          'pretty_version' => 'v4.3.2',
          'version' => '4.3.2.0',
          'reference' => '2a9bccc18e9907808e0018dd15fa643937886b1e',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/sanctum',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.13',
          'version' => '2.0.13.0',
          'reference' => 'b566ee0dd251f3c4078bed003a7ce015f5ea6dce',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/serializable-closure',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/tinker' => 
        array (
          'pretty_version' => 'v2.11.1',
          'version' => '2.11.1.0',
          'reference' => 'c9f80cc835649b5c1842898fb043f8cc098dd741',
          'type' => 'library',
          'install_path' => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\vendor\\composer/../laravel/tinker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/commonmark' => 
        array (
          'pretty_version' => '2.8.2',
          'version' => '2.8.2.0',
          'reference' => '59fb075d2101740c337c7216e3f32b36c204218b',
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
          'pretty_version' => '1.16.0',
          'version' => '1.16.0.0',
          'reference' => '2d6702ff215bf922936ccc1ad31007edc76451b9',
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
          'pretty_version' => '3.13.0',
          'version' => '3.13.0.0',
          'reference' => '40f6618f052df16b545f626fbf9a878e6497d16a',
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
          'pretty_version' => 'v4.1.4',
          'version' => '4.1.4.0',
          'reference' => '7da6c396d7ebe142bc857c20479d5e70a5e1aac7',
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
          'pretty_version' => 'v8.9.4',
          'version' => '8.9.4.0',
          'reference' => '716af8f95a470e9094cfca09ed897b023be191a5',
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
          'pretty_version' => '1.30.5',
          'version' => '1.30.5.0',
          'reference' => '97bcabd32a64924688487dcd64aceaf158affb5c',
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
    33 => 'standard',
    34 => 'tokenizer',
    35 => 'xml',
    36 => 'xmlreader',
    37 => 'xmlwriter',
    38 => 'zip',
    39 => 'zlib',
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
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 416,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 429,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Credenciais inválidas.',
        1 => 142,
      ),
      1 => 
      array (
        0 => 'Sessão terminada com sucesso.',
        1 => 173,
      ),
      2 => 
      array (
        0 => 'Password atual incorreta',
        1 => 195,
      ),
      3 => 
      array (
        0 => 'Password alterada com sucesso.',
        1 => 202,
      ),
      4 => 
      array (
        0 => 'A palavra-passe atual é obrigatória para alterar a password.',
        1 => 223,
      ),
      5 => 
      array (
        0 => 'Password atual incorreta',
        1 => 227,
      ),
      6 => 
      array (
        0 => 'Perfil atualizado com sucesso.',
        1 => 240,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'calendar',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'abort',
        1 => 28,
      ),
      1 => 
      array (
        0 => 'abort',
        1 => 37,
      ),
      2 => 
      array (
        0 => 'abort',
        1 => 53,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'index',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'create',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'store',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      3 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'show',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      4 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'edit',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      5 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'update',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
        array (
        ),
      ),
      6 => 
      array (
        0 => 'App\\Http\\Controllers\\EquipmentController',
        1 => 'destroy',
        2 => 'App\\Http\\Controllers\\EquipmentController',
        3 => 
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    'Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector' => 
    array (
      0 => 
      array (
        0 => 'Custo estimado excede o limiar. Ticket pendente de aprovação orçamental.',
        1 => 790,
      ),
      1 => 
      array (
        0 => 'Custo estimado dentro da autonomia. Pode prosseguir com a intervenção.',
        1 => 809,
      ),
      2 => 
      array (
        0 => 'Pedido de orçamento submetido com detalhes. Aguarde aprovação.',
        1 => 855,
      ),
      3 => 
      array (
        0 => 'Custo dentro do limiar. Intervenção autorizada automaticamente.',
        1 => 867,
      ),
      4 => 
      array (
        0 => 'Estado "fechada" não encontrado.',
        1 => 890,
      ),
      5 => 
      array (
        0 => 'Intervenção concluída e ticket fechado com sucesso.',
        1 => 905,
      ),
    ),
    'Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector' => 
    array (
      0 => 'ui.ticket-detail',
      1 => 'calendar',
    ),
    'PHPStan\\Rules\\Comparison\\ConstantConditionInTraitCollector' => 
    array (
      0 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '$request->user():18',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '!$user->profile || !in_array($user->profile->name, $roles, true):26',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '$user->profile:26',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => 'in_array($user->profile->name, $roles, true):26',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => 'in_array($user->profile->name, $roles, true):26',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanOrConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '!$user->profile:26',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanOrConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '!in_array($user->profile->name, $roles, true):26',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanOrConstantConditionRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => '!$user->profile || !in_array($user->profile->name, $roles, true):26',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\ControllerHelpers',
        2 => 'abort(403, \'Acesso proibido para o seu perfil.\'):27',
        3 => NULL,
      ),
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
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'abort',
        1 => 27,
      ),
      1 => 
      array (
        0 => 'event',
        1 => 193,
      ),
      2 => 
      array (
        0 => 'event',
        1 => 508,
      ),
      3 => 
      array (
        0 => 'event',
        1 => 556,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 494,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 653,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 663,
      ),
      3 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 674,
      ),
      4 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 684,
      ),
      5 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 696,
      ),
      6 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 706,
      ),
      7 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 717,
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\ControllerHelpers',
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
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'index',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      1 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'create',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      2 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'store',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      3 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'show',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      4 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'edit',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      5 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'update',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
        array (
        ),
      ),
      6 => 
      array (
        0 => 'App\\Http\\Controllers\\UserController',
        1 => 'destroy',
        2 => 'App\\Http\\Controllers\\UserController',
        3 => 
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
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Middleware\\CsrfMiddleware',
        1 => 'getCsrfConfig',
        2 => 'App\\Http\\Middleware\\CsrfMiddleware',
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
        $request = null;
        if (function_exists(\'request\')) {
            $request = request();
        }
        $userId = null;
        // Tenta obter o utilizador autenticado (o guard pode ser nulo em alguns contextos)
        $authGuard = null;
        if (function_exists(\'auth\')) {
            $authGuard = auth();
        }
        if ($authGuard && method_exists($authGuard, \'user\')) {
            $authUser = $authGuard->user();
            if ($authUser) {
                // Suporte para objectos de utilizador Eloquent
                $userId = $authUser->id ?? $authUser->getKey() ?? null;
            }
        } elseif ($request) {
            $token = $request->header(\'X-Auth-Token\') ?: $request->bearerToken();
            if (is_string($token) && $token !== \'\') {
                $u = \\App\\Models\\User::where(\'api_token\', $token)->first();
                $userId = $u ? $u->id : null;
            }
        }
        $old = null;
        $new = null;
        if ($event === \'created\') {
            $new = $model->getAttributes();
        } elseif ($event === \'deleted\') {
            $old = $model->getOriginal();
        } else {
            // updated
            $changes = $model->getChanges();
            if (!empty($changes)) {
                $oldVals = [];
                $newVals = [];
                foreach ($changes as $k => $v) {
                    $oldVals[$k] = $model->getOriginal($k);
                    $newVals[$k] = $v;
                }
                $old = $oldVals;
                $new = $newVals;
            }
        }
        \\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]);
    } catch (\\Throwable $e) {
        // Falha silenciosamente para não quebrar o fluxo principal se a auditoria falhar
    }
}):15',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():19',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():26',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard:29',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard->user():30',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:31',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():33',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:35',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():36',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token)->first():38',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token):38',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$u:39',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():47',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():49',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():51',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):52',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):52',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):56',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]):64',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):66',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():67',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:71',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():71',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:72',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():72',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:73',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():73',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 15,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 64,
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
        $request = null;
        if (function_exists(\'request\')) {
            $request = request();
        }
        $userId = null;
        // Tenta obter o utilizador autenticado (o guard pode ser nulo em alguns contextos)
        $authGuard = null;
        if (function_exists(\'auth\')) {
            $authGuard = auth();
        }
        if ($authGuard && method_exists($authGuard, \'user\')) {
            $authUser = $authGuard->user();
            if ($authUser) {
                // Suporte para objectos de utilizador Eloquent
                $userId = $authUser->id ?? $authUser->getKey() ?? null;
            }
        } elseif ($request) {
            $token = $request->header(\'X-Auth-Token\') ?: $request->bearerToken();
            if (is_string($token) && $token !== \'\') {
                $u = \\App\\Models\\User::where(\'api_token\', $token)->first();
                $userId = $u ? $u->id : null;
            }
        }
        $old = null;
        $new = null;
        if ($event === \'created\') {
            $new = $model->getAttributes();
        } elseif ($event === \'deleted\') {
            $old = $model->getOriginal();
        } else {
            // updated
            $changes = $model->getChanges();
            if (!empty($changes)) {
                $oldVals = [];
                $newVals = [];
                foreach ($changes as $k => $v) {
                    $oldVals[$k] = $model->getOriginal($k);
                    $newVals[$k] = $v;
                }
                $old = $oldVals;
                $new = $newVals;
            }
        }
        \\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]);
    } catch (\\Throwable $e) {
        // Falha silenciosamente para não quebrar o fluxo principal se a auditoria falhar
    }
}):15',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():19',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():26',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard:29',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard->user():30',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:31',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():33',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:35',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():36',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token)->first():38',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token):38',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$u:39',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():47',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():49',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():51',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):52',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):52',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):56',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]):64',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):66',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():67',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:71',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():71',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:72',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():72',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:73',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():73',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 15,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 64,
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
        $request = null;
        if (function_exists(\'request\')) {
            $request = request();
        }
        $userId = null;
        // Tenta obter o utilizador autenticado (o guard pode ser nulo em alguns contextos)
        $authGuard = null;
        if (function_exists(\'auth\')) {
            $authGuard = auth();
        }
        if ($authGuard && method_exists($authGuard, \'user\')) {
            $authUser = $authGuard->user();
            if ($authUser) {
                // Suporte para objectos de utilizador Eloquent
                $userId = $authUser->id ?? $authUser->getKey() ?? null;
            }
        } elseif ($request) {
            $token = $request->header(\'X-Auth-Token\') ?: $request->bearerToken();
            if (is_string($token) && $token !== \'\') {
                $u = \\App\\Models\\User::where(\'api_token\', $token)->first();
                $userId = $u ? $u->id : null;
            }
        }
        $old = null;
        $new = null;
        if ($event === \'created\') {
            $new = $model->getAttributes();
        } elseif ($event === \'deleted\') {
            $old = $model->getOriginal();
        } else {
            // updated
            $changes = $model->getChanges();
            if (!empty($changes)) {
                $oldVals = [];
                $newVals = [];
                foreach ($changes as $k => $v) {
                    $oldVals[$k] = $model->getOriginal($k);
                    $newVals[$k] = $v;
                }
                $old = $oldVals;
                $new = $newVals;
            }
        }
        \\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]);
    } catch (\\Throwable $e) {
        // Falha silenciosamente para não quebrar o fluxo principal se a auditoria falhar
    }
}):15',
        3 => NULL,
      ),
      1 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      2 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'request\'):18',
        3 => NULL,
      ),
      3 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'request():19',
        3 => NULL,
      ),
      4 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      5 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'function_exists(\'auth\'):25',
        3 => NULL,
      ),
      6 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'auth():26',
        3 => NULL,
      ),
      7 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      8 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      9 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard:29',
        3 => NULL,
      ),
      10 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      11 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard && method_exists($authGuard, \'user\'):29',
        3 => NULL,
      ),
      12 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authGuard->user():30',
        3 => NULL,
      ),
      13 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser:31',
        3 => NULL,
      ),
      14 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$authUser->getKey():33',
        3 => NULL,
      ),
      15 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:35',
        3 => NULL,
      ),
      16 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      17 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->header(\'X-Auth-Token\'):36',
        3 => NULL,
      ),
      18 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->bearerToken():36',
        3 => NULL,
      ),
      19 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      20 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      21 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      22 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token):37',
        3 => NULL,
      ),
      23 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$token !== \'\':37',
        3 => NULL,
      ),
      24 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanAndConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'is_string($token) && $token !== \'\':37',
        3 => NULL,
      ),
      25 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token)->first():38',
        3 => NULL,
      ),
      26 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\User::where(\'api_token\', $token):38',
        3 => NULL,
      ),
      27 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$u:39',
        3 => NULL,
      ),
      28 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      29 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'created\':46',
        3 => NULL,
      ),
      30 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getAttributes():47',
        3 => NULL,
      ),
      31 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ElseIfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      32 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\StrictComparisonOfDifferentTypesRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$event === \'deleted\':48',
        3 => NULL,
      ),
      33 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal():49',
        3 => NULL,
      ),
      34 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getChanges():51',
        3 => NULL,
      ),
      35 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\IfConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '!empty($changes):52',
        3 => NULL,
      ),
      36 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\BooleanNotConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'empty($changes):52',
        3 => NULL,
      ),
      37 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getOriginal($k):56',
        3 => NULL,
      ),
      38 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeStaticMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '\\App\\Models\\Audit::create([\'user_id\' => $userId, \'auditable_type\' => get_class($model), \'auditable_id\' => $model->getKey(), \'event\' => $event, \'old_values\' => $old, \'new_values\' => $new, \'url\' => $request ? $request->fullUrl() : null, \'ip_address\' => $request ? $request->ip() : null, \'user_agent\' => $request ? $request->userAgent() : null]):64',
        3 => NULL,
      ),
      39 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeFunctionCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => 'get_class($model):66',
        3 => NULL,
      ),
      40 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$model->getKey():67',
        3 => NULL,
      ),
      41 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:71',
        3 => NULL,
      ),
      42 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->fullUrl():71',
        3 => NULL,
      ),
      43 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:72',
        3 => NULL,
      ),
      44 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->ip():72',
        3 => NULL,
      ),
      45 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\TernaryOperatorConstantConditionRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request:73',
        3 => NULL,
      ),
      46 => 
      array (
        0 => 'PHPStan\\Rules\\Comparison\\ImpossibleCheckTypeMethodCallRule',
        1 => 'App\\Traits\\Auditable',
        2 => '$request->userAgent():73',
        3 => NULL,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'getTotalMaterialCostAttribute',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\models\\ticket' . "\0" . 'calculatebudgettotalbytype',
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'getTotalLaborCostAttribute',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\models\\ticket' . "\0" . 'calculatebudgettotalbytype',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'getBudgetTotalAttribute',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
        ),
      ),
      3 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'calculateBudgetTotalByType',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
        ),
      ),
      4 => 
      array (
        0 => 'App\\Models\\Ticket',
        1 => 'hasStatus',
        2 => 'App\\Models\\Ticket',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\models\\ticket' . "\0" . 'getstatusidbyname',
        ),
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureFuncCallCollector' => 
    array (
      0 => 
      array (
        0 => 'call_user_func',
        1 => 15,
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 64,
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
        ),
      ),
      1 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isValidProfile',
        2 => 'App\\Models\\User',
        3 => 
        array (
          0 => 'm' . "\0" . 'app\\models\\user' . "\0" . 'getavailableroles',
        ),
      ),
      2 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isAdmin',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
      3 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'isTechnician',
        2 => 'App\\Models\\User',
        3 => 
        array (
        ),
      ),
      4 => 
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
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
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
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Bus\\Queueable',
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
        1 => 8,
      ),
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\ControllerHelpers.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitDeclarationCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Traits\\ControllerHelpers',
        1 => 11,
      ),
    ),
  ),
); },
	'dependencies' => array (
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php' => 
  array (
    'fileHash' => '814071fd3569dc29aa6c2be2887fc6d0817f1dc18ba6542b1e748a2773e2ccd8',
    'dependentFiles' => 
    array (
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
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
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
    'fileHash' => '7506d48e481bc9b8b583ed19170be8eba0f6d037f4b9105a0f5dadfbeae3c379',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    'fileHash' => 'bb307b8974813042c7fe743bf6821809c75cfb0ba1ff40c1e5ae5649818fea3f',
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
    'fileHash' => 'f16bb89ec617ca70e4a3fd105d5810ba2332895058ca621bac9427b062b1a737',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    'fileHash' => 'ac3998ea0cdd3b76da48f8afc52f3156bd64b844a4d2fc8ee41d7c453407ec38',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    'fileHash' => '70707569c1f7a945698a42517b94c3e584d0bd43d05b95ab4f39ebd51cf99b83',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\ApiDocsController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php' => 
  array (
    'fileHash' => '089d219206f04da281cb67e1a561109cb3031dd1ed8003ea1dc8c1fe07bc3f06',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php' => 
  array (
    'fileHash' => 'ee76d58b58f98084ee4e51e61950fe39f3c2d189874f3323b86cf5fade837358',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    'fileHash' => 'bad90e0a6f72a25aaf047fbfd2e093b87ca59d7d3bdcb5ca9ebce802bd9f8486',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    'fileHash' => '274c06a5d77e3559d11693dac794b7de7f732cb2a19f8ff32ca8ed2eccf03459',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    'fileHash' => '78ff1acb53c0354a9af2dc8174c2c0d116aa322dbd002f63df491acf657ff8ad',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php' => 
  array (
    'fileHash' => 'cd9a57cddb39859679020bd2fbcc74c6053312275897ba4d8b4a5174cf7c146d',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    'fileHash' => '2e157df21792b8bf0fee551c87045dd2a2d8ae1b48c45e019342b01f5a4cffaa',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    'fileHash' => '022e81f619821fae46108d5b0eced0bcd897a8e8a3b4ccc7714f0ca9a4578981',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\SetLocaleMiddleware.php' => 
  array (
    'fileHash' => 'ec51a5845efc8c4800887c898d0cf0100e8335cba89ff164f7572db50f9015a1',
    'dependentFiles' => 
    array (
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
    'fileHash' => '149548fb8315ba9f09685073a7c23df1aaacfe496c3e509b74e440f84072e3d6',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuditController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Category.php' => 
  array (
    'fileHash' => '40f149bdd5c3e829a60c4e7dbc1f78ade091460cb9d0e89471f04ea199eb31ce',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    'fileHash' => '2f18050bf6fe79682e89379f0e96264b350f3dbc997d14d9f30925dcfb66de45',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
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
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    'fileHash' => 'a38b9c655bf304912c1c150c5f93cafecd7f240414b61e7beea7ec273d690891',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    'fileHash' => 'f6e2e8510e1139b76955648efeb11ec531399b14e2fc3fb7a7459b994b6c9d04',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    'fileHash' => 'c5d256401b563a3699c0e5cddac6395a5c5d6054160ac39074f4b9e748cefaa3',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
  array (
    'fileHash' => 'd43ab6208f7b062e0f93af3aa8435be0d1245c327bfe91d9a857850c78eb3704',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    'fileHash' => '9302cc683890ae1302927920b700a29bcabe1ba36893687bbe4c53a544182b0d',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
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
    'fileHash' => '6aa4485320c7a8f5a92ccc32acceff34403adaf0ffce2da2288c47c6e0fc75bf',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
  array (
    'fileHash' => 'd645ee75aeda6cb2e70c6d14a1064ba6448746009db2d3d89fff88db7689bc4f',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\NotificationController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
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
    'fileHash' => 'e4bda4b6c0e366c6b9eca4402cf2da74b36e48f043d9c64005b2d381f7eb4434',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\OpenApi\\OpenApiSpec.php' => 
  array (
    'fileHash' => '269d04168a9e1806336f81720aa6f5136bb2358120d61ecdfa61dd485f372f3c',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Providers\\AppServiceProvider.php' => 
  array (
    'fileHash' => 'caf306ef6a25a547bbb7edd5508a39b51c365083eb6dd58378cf2242018e94c7',
    'dependentFiles' => 
    array (
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    'fileHash' => 'd25df3a51daa77ba12d81713cca0d12b1f22ccc84a9fe69421f063be1c7c55c6',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
    'fileHash' => 'abda73c6002ef2c3ab9357c0c9b34e514848a18861606cb15c632f2487674d4c',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Console\\Commands\\SimulateTelemetry.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php',
      3 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php',
      4 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php',
      5 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php',
      6 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php',
      7 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php',
      8 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php',
      9 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
      10 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php',
      11 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php',
      12 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      13 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php',
      14 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      15 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
      16 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php',
      17 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php',
      18 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php',
      19 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketWorkflowHistory.php',
      20 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\User.php',
      21 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php',
      22 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php',
    ),
    'usedTraitDependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php',
      1 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php',
      2 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php',
    ),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\ControllerHelpers.php' => 
  array (
    'fileHash' => '46af0947464dcf1fb44113381c6f6f8daa1efd2e4bfb0dcf5d512924ec634436',
    'dependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
    ),
    'usedTraitDependentFiles' => 
    array (
      0 => 'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketCreatedBroadcast.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Exports\\TicketsExport.php' => 
  array (
    0 => 'maatwebsite/excel',
    1 => 'laravel/framework',
    2 => 'phpoffice/phpspreadsheet',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\Controller.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\TicketController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'symfony/http-kernel',
    3 => 'nesbot/carbon',
    4 => 'league/flysystem',
    5 => 'psr/http-message',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TestMail.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Audit.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Category.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Room.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Ticket.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketComment.php' => 
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\NewTicketNotification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Events\\TicketStatusUpdatedBroadcast.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AdminController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
    3 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AuthController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\RoomController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RateLimitMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Mail\\TicketCreated.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Equipment.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\EquipmentCategory.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketType.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketNotification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Notifications\\TicketStatusChanged.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\OpenApi\\OpenApiSpec.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Services\\AIService.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'openai-php/client',
    2 => 'openai-php/laravel',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\Auditable.php' => 
  array (
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\AnalyticsController.php' => 
  array (
    0 => 'zircote/swagger-php',
    1 => 'laravel/framework',
    2 => 'symfony/http-foundation',
    3 => 'nesbot/carbon',
    4 => 'barryvdh/laravel-dompdf',
    5 => 'dompdf/dompdf',
    6 => 'maatwebsite/excel',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\CalendarController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'nesbot/carbon',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php' => 
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UiController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CsrfMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'psr/log',
    3 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\CustomAuthMiddleware.php' => 
  array (
    0 => 'laravel/framework',
    1 => 'symfony/http-foundation',
    2 => 'psr/log',
    3 => 'monolog/monolog',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Middleware\\RoleMiddleware.php' => 
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Notification.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketAttachment.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\TicketStatus.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Providers\\AppServiceProvider.php' => 
  array (
    0 => 'laravel/framework',
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\ControllerHelpers.php' => 
  array (
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
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
          'equipment' => 'App\\Models\\Equipment',
          'ticket' => 'App\\Models\\Ticket',
          'user' => 'App\\Models\\User',
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
              'equipment' => 'App\\Models\\Equipment',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
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
              'equipment' => 'App\\Models\\Equipment',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
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
           'name' => 'users',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna todos os utilizadores (Apenas para Administradores).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
                'path' => '\'/admin/users\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Listar utilizadores\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de utilizadores\')]',
              ),
            )),
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'inactivateUser',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Inativa um utilizador do sistema.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
                'path' => '\'/admin/users/{id}/inactive\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Inativar utilizador\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Utilizador inativado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Utilizador não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Operação inválida\')]',
              ),
            )),
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storeUser',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Regista um novo utilizador no sistema.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateUser',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Atualiza um utilizador existente.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna os perfis de utilizador disponíveis.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipments',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista equipamentos com a respetiva sala associada.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
                'path' => '\'/admin/equipment\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Listar equipamentos\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de equipamentos\')]',
              ),
            )),
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storeEquipment',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Regista um novo equipamento no sistema.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
               'name' => 'OpenApi\\Attributes\\Post',
               'args' => 
              array (
                'path' => '\'/admin/equipment\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Criar equipamento\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Equipamento criado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateEquipment',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Atualiza os dados de um equipamento existente.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
                'path' => '\'/admin/equipment/{id}\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Atualizar equipamento\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento atualizado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'destroyEquipment',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Remove fisicamente um equipamento do sistema.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
               'name' => 'OpenApi\\Attributes\\Delete',
               'args' => 
              array (
                'path' => '\'/admin/equipment/{id}\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Eliminar equipamento\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Equipamento eliminado\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Equipamento não encontrado\')]',
              ),
            )),
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storePreventive',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Aprova um pedido de orçamento associado a um ticket de avaria.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
               'name' => 'OpenApi\\Attributes\\Patch',
               'args' => 
              array (
                'path' => '\'/admin/tickets/{id}/approve-budget\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Aprovar orçamento\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Orçamento aprovado\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Pedido inválido\')]',
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedAttributeNode::__set_state(array(
               'name' => 'OpenApi\\Attributes\\Post',
               'args' => 
              array (
                'path' => '\'/admin/preventive\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Criar manutenção preventiva\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Manutenção preventiva criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approveBudget',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Processa a decisão orçamental do Administrador (aprovar ou recusar).
     * Suporta tanto o formato PATCH original como o POST do frontend (action + feedback).
     * Rota: PATCH /admin/tickets/{id}/approve-budget
     * Rota: POST /admin/tickets/{id}/budget-decision (compatibilidade frontend)
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'userprofile' => 'App\\Models\\UserProfile',
              'request' => 'Illuminate\\Http\\Request',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'str' => 'Illuminate\\Support\\Str',
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
           'name' => 'stats',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém o payload completo do dashboard analítico para a interface web.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketsexport' => 'App\\Exports\\TicketsExport',
              'audit' => 'App\\Models\\Audit',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
              'request' => 'Illuminate\\Http\\Request',
              'carbon' => 'Illuminate\\Support\\Carbon',
              'collection' => 'Illuminate\\Support\\Collection',
              'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
              'oa' => 'OpenApi\\Attributes',
              'streamedresponse' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
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
                'path' => '\'/analytics/stats\'',
                'tags' => '[\'Analytics\']',
                'summary' => '\'Métricas gerais\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'KPIs agregados\')]',
              ),
            )),
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'charts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Fornece os dados para os gráficos do dashboard analítico.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketsexport' => 'App\\Exports\\TicketsExport',
              'audit' => 'App\\Models\\Audit',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
              'request' => 'Illuminate\\Http\\Request',
              'carbon' => 'Illuminate\\Support\\Carbon',
              'collection' => 'Illuminate\\Support\\Collection',
              'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
              'oa' => 'OpenApi\\Attributes',
              'streamedresponse' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
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
                'path' => '\'/analytics/charts\'',
                'tags' => '[\'Analytics\']',
                'summary' => '\'Dados para dashboards\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Séries para gráficos\')]',
              ),
            )),
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportCsv',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Exporta o relatório de todos os tickets em formato de fluxo CSV (Streaming).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketsexport' => 'App\\Exports\\TicketsExport',
              'audit' => 'App\\Models\\Audit',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
              'request' => 'Illuminate\\Http\\Request',
              'carbon' => 'Illuminate\\Support\\Carbon',
              'collection' => 'Illuminate\\Support\\Collection',
              'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
              'oa' => 'OpenApi\\Attributes',
              'streamedresponse' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
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
                'path' => '\'/analytics/export/csv\'',
                'tags' => '[\'Analytics\']',
                'summary' => '\'Exportar CSV\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro CSV descarregado\')]',
              ),
            )),
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportPdf',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Exporta o relatório de tickets em formato PDF via DOMPDF.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketsexport' => 'App\\Exports\\TicketsExport',
              'audit' => 'App\\Models\\Audit',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
              'request' => 'Illuminate\\Http\\Request',
              'carbon' => 'Illuminate\\Support\\Carbon',
              'collection' => 'Illuminate\\Support\\Collection',
              'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
              'oa' => 'OpenApi\\Attributes',
              'streamedresponse' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
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
                'path' => '\'/analytics/export/pdf\'',
                'tags' => '[\'Analytics\']',
                'summary' => '\'Exportar PDF\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro PDF descarregado\')]',
              ),
            )),
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'exportExcel',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Exporta o relatório de tickets em formato Excel (.xlsx).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketsexport' => 'App\\Exports\\TicketsExport',
              'audit' => 'App\\Models\\Audit',
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
              'request' => 'Illuminate\\Http\\Request',
              'carbon' => 'Illuminate\\Support\\Carbon',
              'collection' => 'Illuminate\\Support\\Collection',
              'excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
              'oa' => 'OpenApi\\Attributes',
              'streamedresponse' => 'Symfony\\Component\\HttpFoundation\\StreamedResponse',
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
                'path' => '\'/analytics/export/excel\'',
                'tags' => '[\'Analytics\']',
                'summary' => '\'Exportar Excel\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Ficheiro XLSX descarregado\')]',
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
           'name' => 'register',
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
                'path' => '\'/register\'',
                'tags' => '[\'Auth\']',
                'summary' => '\'Registar utilizador\'',
                'requestBody' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'name\', \'email\', \'password\', \'password_confirmation\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'name\', type: \'string\', example: \'João Silva\'), new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'password_confirmation\', type: \'string\', format: \'password\', example: \'password123\'), new \\OpenApi\\Attributes\\Property(property: \'profile_id\', type: \'integer\', nullable: true, example: 1)]))',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Utilizador criado\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
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
                'path' => '\'/login\'',
                'tags' => '[\'Auth\']',
                'summary' => '\'Autenticar utilizador\'',
                'requestBody' => 'new \\OpenApi\\Attributes\\RequestBody(required: true, content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', required: [\'email\', \'password\'], properties: [new \\OpenApi\\Attributes\\Property(property: \'email\', type: \'string\', format: \'email\', example: \'joao@example.com\'), new \\OpenApi\\Attributes\\Property(property: \'password\', type: \'string\', format: \'password\', example: \'password123\')]))',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Autenticado com sucesso\', content: new \\OpenApi\\Attributes\\JsonContent(type: \'object\', properties: [new \\OpenApi\\Attributes\\Property(property: \'token\', type: \'string\', example: \'abc123\'), new \\OpenApi\\Attributes\\Property(property: \'user\', type: \'object\')])), new \\OpenApi\\Attributes\\Response(response: 401, description: \'Credenciais inválidas\')]',
              ),
            )),
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
           'name' => 'changePassword',
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
           'name' => 'updateProfile',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Resolve e valida o utilizador atualmente autenticado com base no token fornecido.
     * Procura o token prioritariamente no cabeçalho customizado \'X-Auth-Token\'
     * ou, em alternativa, no cabeçalho padrão \'Authorization\' (Bearer Token).
     *
     * * @throws HttpException
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'request' => 'Illuminate\\Http\\Request',
              'httpexception' => 'Symfony\\Component\\HttpKernel\\Exception\\HttpException',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Garante programaticamente que o utilizador possui um dos perfis/papéis permitidos.
     * Caso o perfil não corresponda, lança uma exceção HTTP 403 (Acesso Proibido).
     *
     * @throws HttpException
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'request' => 'Illuminate\\Http\\Request',
              'httpexception' => 'Symfony\\Component\\HttpKernel\\Exception\\HttpException',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\EquipmentController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\EquipmentController',
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
     * Display a listing of the resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for creating a new resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Store a newly created resource in storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Display the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
               'name' => 'equipment',
               'type' => 'App\\Models\\Equipment',
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
           'name' => 'edit',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for editing the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
               'name' => 'equipment',
               'type' => 'App\\Models\\Equipment',
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
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Update the specified resource in storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'equipment',
               'type' => 'App\\Models\\Equipment',
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
           'name' => 'destroy',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Remove the specified resource from storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
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
               'name' => 'equipment',
               'type' => 'App\\Models\\Equipment',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista todas as salas registadas.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
                'path' => '\'/admin/rooms\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Listar salas\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Lista de salas\')]',
              ),
            )),
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'createRoom',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for creating a new resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'storeRoom',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Cria uma nova sala de trabalho.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
               'name' => 'OpenApi\\Attributes\\Post',
               'args' => 
              array (
                'path' => '\'/admin/rooms\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Criar sala\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 201, description: \'Sala criada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'showRoom',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Display the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for editing the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Atualiza os detalhes de uma sala.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
                'path' => '\'/admin/rooms/{id}\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Atualizar sala\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala atualizada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\'), new \\OpenApi\\Attributes\\Response(response: 422, description: \'Erro de validação\')]',
              ),
            )),
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'inactivateRoom',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Inativa uma sala (Gestão lógica / Soft management).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'room' => 'App\\Models\\Room',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
                'path' => '\'/admin/rooms/{id}/inactive\'',
                'tags' => '[\'Admin\']',
                'summary' => '\'Inativar sala\'',
                'security' => '[[\'X-Auth-Token\' => []], [\'BearerAuth\' => []]]',
                'parameters' => '[new \\OpenApi\\Attributes\\Parameter(name: \'id\', in: \'path\', required: true, schema: new \\OpenApi\\Attributes\\Schema(type: \'integer\'))]',
                'responses' => '[new \\OpenApi\\Attributes\\Response(response: 200, description: \'Sala inativada\'), new \\OpenApi\\Attributes\\Response(response: 404, description: \'Sala não encontrada\')]',
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
        0 => 'App\\Traits\\ControllerHelpers',
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
               'name' => 'aiService',
               'type' => 'App\\Services\\AIService',
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
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista os tickets na view index
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Armazena um novo ticket (criação de avaria)
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'search',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Pesquisa tickets por palavra-chave, prioridade ou intervalo de datas.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Exibe o detalhe do ticket injetando a sugestão em tempo real da IA
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'atribuirTecnico',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Grava a alocação do técnico sugerido pela IA ou escolhido manualmente
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'assignTechnician',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Associa explicitamente um técnico a um ticket (Apenas Administradores).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reopenTicket',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Reabre um ticket que tenha sido previamente fechado.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'cancelTicket',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Cancela um ticket que ainda esteja em estado Aberto.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'addComment',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Adiciona um comentário técnico ou de progresso ao ticket.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'listComments',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista todos os comentários associados a um determinado ticket.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'uploadPhoto',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Faz o upload de um anexo fotográfico ou evidência para o ticket.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'listPhotos',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista os anexos multimédia carregados no âmbito do ticket.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'deletePhoto',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Remove uma fotografia/anexo do ticket (Evidências Fotográficas).
     * Elimina o ficheiro físico do disco e o registo da base de dados.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'startTicket',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Inicia a reparação de um ticket (Técnico assume o ticket como "Em Curso").
     *
     * Se existirem tickets de prioridade mais alta pendentes, o sistema avisa o técnico.
     * Se o técnico forçar (force=true), o admin é notificado da decisão.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'closeTicket',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Conclui de forma definitiva um ticket em curso, registando tempos e custos operacionais.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        16 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'scheduleTicket',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Agenda um ticket para uma data futura (Operador ou Admin).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'openTickets',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Lista tickets abertos para o dashboard do técnico.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        18 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calendarView',
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
        19 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'calendarEvents',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna os eventos do calendário (tickets programados com scheduled_at) em formato JSON.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        20 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'submitEstimatedBudget',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Submete o custo estimado pelo técnico e aciona o fluxo orçamental.
     * Se o custo exceder o threshold, o ticket fica "Pendente Orçamento".
     * Rota: POST /tickets/{id}/budget
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        21 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'requestBudget',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Técnico solicita autorização orçamental com orçamento detalhado.
     * Rota: PUT /technician/tickets/{id}/request-budget
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
        22 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'closeTicketFinal',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Finaliza o ticket com custo final e relatório técnico.
     * Rota: POST /tickets/{id}/close
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'ticketstatusupdatedbroadcast' => 'App\\Events\\TicketStatusUpdatedBroadcast',
              'notification' => 'App\\Models\\Notification',
              'ticket' => 'App\\Models\\Ticket',
              'ticketattachment' => 'App\\Models\\TicketAttachment',
              'ticketcomment' => 'App\\Models\\TicketComment',
              'user' => 'App\\Models\\User',
              'ticketstatuschanged' => 'App\\Notifications\\TicketStatusChanged',
              'aiservice' => 'App\\Services\\AIService',
              'controllerhelpers' => 'App\\Traits\\ControllerHelpers',
              'request' => 'Illuminate\\Http\\Request',
              'storage' => 'Illuminate\\Support\\Facades\\Storage',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
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
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra o painel principal da interface web.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'tickets',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página com a lista de tickets.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticketCreate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página de criação de um novo ticket.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'equipments',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página com os equipamentos registados.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'users',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página com os utilizadores do sistema.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'userCreate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra o formulário de criação de utilizador.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'userEdit',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra o formulário de edição de utilizador.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'rooms',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página com a lista de salas.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomCreate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página de criação de uma nova sala.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomDetail',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra os detalhes de uma sala específica.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'roomEdit',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra o formulário de edição de uma sala.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
           'name' => 'audits',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página de auditoria.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'ticketDetail',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra os detalhes de um ticket específico.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        13 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getEquipments',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna a lista de equipamentos para a interface (acessível a todos os utilizadores).
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'analytics',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página de analytics com gráficos e relatórios.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'profile',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Mostra a página de perfil do utilizador autenticado.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'equipment' => 'App\\Models\\Equipment',
              'room' => 'App\\Models\\Room',
              'user' => 'App\\Models\\User',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Http\\Controllers\\UserController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\UserController',
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
     * Display a listing of the resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'create',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for creating a new resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Store a newly created resource in storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Display the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'edit',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Show the form for editing the specified resource.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Update the specified resource in storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
            1 => 
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
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'destroy',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Remove the specified resource from storage.
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The session instance.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
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
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'config',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * CSRF Token configuration from config/csrf.php.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
              'response' => 'Symfony\\Component\\HttpFoundation\\Response',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => 'array',
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
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'handle',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Handle an incoming request and delegate to the next middleware in the chain.
     * Validates CSRF token from headers, cookies, or session storage.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'shouldSkipCsrfValidation',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Determine if CSRF validation should be skipped.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getCsrfTokenFromRequest',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get CSRF token from request (header, cookie, or session).
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'validateCsrfToken',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Validate the CSRF token.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'regenerateSessionId',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Regenerate session ID to prevent CSRF fixation attacks.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getCsrfConfig',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get CSRF configuration from config/csrf.php.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'closure' => 'Closure',
              'sessioncontract' => 'Illuminate\\Contracts\\Session\\Session',
              'request' => 'Illuminate\\Http\\Request',
              'log' => 'Illuminate\\Support\\Facades\\Log',
              'str' => 'Illuminate\\Support\\Str',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Trata uma rota protegida validando o token customizado da aplicação.
     */',
             'namespace' => 'App\\Http\\Middleware',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'closure' => 'Closure',
              'request' => 'Illuminate\\Http\\Request',
              'auth' => 'Illuminate\\Support\\Facades\\Auth',
              'log' => 'Illuminate\\Support\\Facades\\Log',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\Category.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Category',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
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
           'phpDoc' => NULL,
        )),
        9 => 
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
           'phpDoc' => NULL,
        )),
        10 => 
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
           'phpDoc' => NULL,
        )),
        11 => 
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
           'phpDoc' => NULL,
        )),
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'guarded',
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
        13 => 
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
        14 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'status',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<TicketStatus, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        15 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'budgetApprovedBy',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        16 => 
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
        17 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'user',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'name' => 'technician',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<User, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'name' => 'equipment',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Equipment, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        20 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'room',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * @return BelongsTo<Room, $this>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
        22 => 
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
        23 => 
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
          ),
           'attributes' => 
          array (
          ),
        )),
        24 => 
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
        25 => 
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
          ),
           'attributes' => 
          array (
          ),
        )),
        26 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'requestBudgetAuthorization',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Solicitado pelo Técnico quando avalia que o custo estimado supera o limiar da empresa.
     * Congela/Regista o timestamp para permitir a pausa do SLA nos relatórios de Analytics.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'bool',
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
        27 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approveBudget',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Executado exclusivamente pelo Administrador para aprovar ou rejeitar o orçamento.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
               'name' => 'decision',
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
            2 => 
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
               'flags' => 0,
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        28 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getBudgetPauseMinutesAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Helper de Negócio: Calcula o tempo morto (em minutos) em que o ticket esteve parado a aguardar decisão orçamental.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'int',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        29 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTotalMaterialCostAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Calcula o custo total de materiais a partir do budget_details (JSON).
     * Material: quantity × unit_price
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        30 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getTotalLaborCostAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Calcula o custo total de mão de obra a partir do budget_details (JSON).
     * Labor: hours × hourly_rate
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        31 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getBudgetTotalAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Calcula o custo total do orçamento (materiais + mão de obra).
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'float',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        32 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getBudgetBreakdownAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Retorna um array com breakdown material vs labor.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        33 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getStatusIdByName',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém o ID do status pelo nome na tabela `ticket_statuses`.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
        34 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'hasStatus',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Verifica se o ticket está num determinado estado pelo nome.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'static' => false,
           'returnType' => 'bool',
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
        35 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getLeastBusyTechnician',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém o técnico com menos tickets atribuídos no momento.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'returnType' => '?App\\Models\\User',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        36 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getScheduledEvents',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Atalho de segurança para recolher eventos agendados para o FullCalendar.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
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
           'returnType' => NULL,
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
          'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
          'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
               'value' => '\'user\'',
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
               'value' => '\'technician\'',
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
               'value' => '\'admin\'',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Verifica se o utilizador é Administrador.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isTechnician',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Verifica se o utilizador é Técnico.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
        12 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isCommonUser',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Verifica se o utilizador é Utilizador Comum.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Obtém todas as constantes de roles disponíveis.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Verifica se um nome de perfil pertence às roles válidas do sistema.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
           'name' => 'booted',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Registo dos Model Events do Laravel.
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Models\\UserProfile.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\UserProfile',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
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
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Notificação enviada ao criador do ticket quando o estado da avaria muda.
 * Suporta canal de email. Pode ser estendida com canais adicionais (database, broadcast).
 */',
         'namespace' => 'App\\Notifications',
         'uses' => 
        array (
          'ticket' => 'App\\Models\\Ticket',
          'queueable' => 'Illuminate\\Bus\\Queueable',
          'mailmessage' => 'Illuminate\\Notifications\\Messages\\MailMessage',
          'notification' => 'Illuminate\\Notifications\\Notification',
        ),
         'constUses' => 
        array (
        ),
      )),
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Define os canais de entrega desta notificação.
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
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
     * Constrói a mensagem de email a enviar ao utilizador.
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
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
     * Representação em array (para canais database/broadcast futuros).
     */',
             'namespace' => 'App\\Notifications',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
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
           'name' => 'recomendarTecnico',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Motor de IA exclusivo para apoiar o Administrador na alocação de recursos.
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'ticket' => 'App\\Models\\Ticket',
              'user' => 'App\\Models\\User',
              'openai' => 'OpenAI\\Laravel\\Facades\\OpenAI',
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
  'C:\\laravel\\Projeto Final Cesae\\Projeto-Final-Cesae\\app\\Traits\\ControllerHelpers.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedTraitNode::__set_state(array(
       'name' => 'App\\Traits\\ControllerHelpers',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * Trait ControllerHelpers
 */',
         'namespace' => 'App\\Traits',
         'uses' => 
        array (
          'user' => 'App\\Models\\User',
          'request' => 'Illuminate\\Http\\Request',
        ),
         'constUses' => 
        array (
        ),
      )),
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Resolve e valida o utilizador atualmente autenticado.
     */',
             'namespace' => 'App\\Traits',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'request' => 'Illuminate\\Http\\Request',
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
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Garante que o utilizador possui um dos perfis/papéis permitidos.
     */',
             'namespace' => 'App\\Traits',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'request' => 'Illuminate\\Http\\Request',
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
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
