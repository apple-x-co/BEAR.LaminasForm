<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Dotenv\Dotenv;
use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;

use Ray\Di\Scope;
use Twig\Environment;
use function dirname;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $appDir = $this->appMeta->appDir;

        (new Dotenv())->load(dirname(__DIR__, 2));

        $this->bind(Environment::class)
             ->toProvider(TwigProvider::class)
             ->in(Scope::SINGLETON);
        $this->bind()->annotatedWith('twig_template_dir')->toInstance($appDir . '/var/templates');

        $this->install(new PackageModule());
    }
}
