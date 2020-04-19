# Symfony asset versioning based on Git
This is a small Symfony bundle that implements a custom version strategy which uses the current Git commit short-hash as the version identifier.

This will turn the URL of your assets from this:
```
/css/style.css
```
to 
```
/css/styles.css?v=b4703f8
```

This will ensure that you assets always match the current version of your project by eliminating browser caching issues.

---

## Getting started

To get started, add the bundle to your project using Composer, like so:
```bash
composer require emileperron/git-version-strategy-bundle
```

Then, in your `config/bundles.php` file, include the bundle like so:
```php
<?php

return [
    // ...
    Emileperron\GitVersionStrategyBundle\EmileperronGitVersionStrategyBundle::class => ['all' => true],
];
```

Once that's done, you should be all set!
The bundle automatically updates the configuration for `framework.assets.version_strategy` to use the `GitVersionStrategy`.

---

## Manual configuration of the VersionStrategy

If for some reason the configuration is not set automatically, which can happen if another bundle also changes this configuration, define the following configuration in your `config/packages/framework.yaml`:
```yaml

framework:
    assets:
        version_strategy: 'Emileperron\GitVersionStrategyBundle\Asset\GitVersionStrategy'
```

---

## Safe mode, execution operator and `shell_exec()`

This bundle uses the [Execution Operator](https://www.php.net/manual/en/language.operators.execution.php) in order to get the current commit's hash. It is important to note that this **will not work** when [safe mode](https://www.php.net/manual/en/ini.sect.safe-mode.php#ini.safe-mode) is enabled or [shell_exec()](https://www.php.net/manual/en/function.shell-exec.php) is disabled.
