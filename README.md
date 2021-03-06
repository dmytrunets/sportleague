Installation
--------------
1. Clone the repository
2. Edit app/config/parameters.yml and change the relevant values for your setup.
3. Install dependencies: php composer.phar install
4. Run app/console doctrine:schema:create to setup the DB.
5. Run app/console assets:install web to deploy the assets on the web dir.
6. Make a VirtualHost with DocumentRoot pointing to web/

Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/2.6/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/2.6/book/doctrine.html
[8]:  https://symfony.com/doc/2.6/book/templating.html
[9]:  https://symfony.com/doc/2.6/book/security.html
[10]: https://symfony.com/doc/2.6/cookbook/email.html
[11]: https://symfony.com/doc/2.6/cookbook/logging/monolog.html
[12]: https://symfony.com/doc/2.6/cookbook/assetic/asset_management.html
[13]: https://symfony.com/doc/2.6/bundles/SensioGeneratorBundle/index.html
# sportleague 
