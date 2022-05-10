Symfony Probe Bundle
=================================

|  Version  |                       Build Status                        |                              Code Coverage                               |
|:---------:|:---------------------------------------------------------:|:------------------------------------------------------------------------:|
|  `main`   |   [![CI][master Build Status Image]][main Build Status]   |    [![Coverage Status][main Code Coverage Image]][main Code Coverage]    |
| `develop` | [![CI][develop Build Status Image]][develop Build Status] | [![Coverage Status][develop Code Coverage Image]][develop Code Coverage] |

Installation
============

Step 1: Download the Bundle
----------------------------------
Open a command console, enter your project directory and execute:

```console
$ composer require dtoch56/symfony-probe-bundle
```

Step 2: Enable the Bundle
----------------------------------
Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            DToch56\SymfonyProbeBundle\SymfonyProbeBundle::class => ['all' => true],
        );
        // ...
    }
    // ...
}
```

Create Symfony Probe Bundle Config:
----------------------------------
`config/packages/symfony_probe.yaml`

Configurating health check - all available you can see [here](https://github.com/dtoch56/symfony-probe-bundle/tree/master/src/Check).

```yaml
symfony_probe:
    health_checks:
        stopOnFirstError: false
        checks:
            - id: symfony_probe.environment_check
    ping_checks:
      stopOnFirstError: false
      checks:
        - id: symfony_probe.status_up_check
```

Create Symfony Probe Bundle Routing Config:
----------------------------------
`config/routes/symfony_probe.yaml`

```yaml
health_check:
    resource: '@SymfonyProbeBundle/Resources/config/routes.xml'
```

Step 3: Configuration
=============

Security Optional:
----------------------------------
`config/packages/security.yaml`

If you are using [symfony/security](https://symfony.com/doc/current/security.html) and your health check is to be used anonymously, add a new firewall to the configuration

```yaml
    firewalls:
        healthcheck:
            pattern: ^/health
            security: false
        ping:
            pattern: ^/ping
            security: false
```

Step 4: Additional settings
=============

Add Custom Check:
----------------------------------
It is possible to add your custom health check:

```php
<?php

declare(strict_types=1);

namespace YourProject\Check;

use SymfonyProbeBundle\Probe\Response;

class CustomCheck implements CheckInterface
{
    public function check(): Response
    {
        return new Response('status', true, 'up');
    }
}
```

Then we add our custom health check to collection

```yaml
symfony_probe:
    health_checks:
        checks:
            - id: symfony_probe.environment_check
            - id: custom_probes // custom service check id
```

How Change Route:
----------------------------------
You can change the default behavior with a light configuration, remember to return to Step 3 after that:
```yaml
health:
    path: /your/custom/url
    methods: GET
    controller: DToch56\SymfonyProbeBundle\Controller\HealthController::healthCheckAction
    
ping:
    path: /your/custom/url
    methods: GET
    controller: DToch56\SymfonyProbeBundle\Controller\PingController::pingAction

```

How To Use Healthcheck In Docker
----------------------------------
```dockerfile
HEALTHCHECK --start-period=15s --interval=5s --timeout=3s --retries=3 CMD curl -sS {{your host}}/health || exit 1
```

[main Build Status]: https://github.com/dtoch56/symfony-probe-bundle/actions?query=workflow%3ACI+branch%3Amaster
[main Build Status Image]: https://github.com/dtoch56/symfony-probe-bundle/workflows/CI/badge.svg?branch=master
[develop Build Status]: https://github.com/dtoch56/symfony-probe-bundle/actions?query=workflow%3ACI+branch%3Adevelop
[develop Build Status Image]: https://github.com/dtoch56/symfony-probe-bundle/workflows/CI/badge.svg?branch=develop
[main Code Coverage]: https://codecov.io/gh/dtoch56/symfony-probe-bundle/branch/master
[main Code Coverage Image]: https://img.shields.io/codecov/c/github/dtoch56/symfony-probe-bundle/master?logo=codecov
[develop Code Coverage]: https://codecov.io/gh/dtoch56/symfony-probe-bundle/branch/develop
[develop Code Coverage Image]: https://img.shields.io/codecov/c/github/dtoch56/symfony-probe-bundle/develop?logo=codecov
