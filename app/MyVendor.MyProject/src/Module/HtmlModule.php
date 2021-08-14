<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Resource\RenderInterface;
use MyVendor\MyProject\Renderer\TwigRenderer;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class HtmlModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind(RenderInterface::class)->annotatedWith('html_render')->to(TwigRenderer::class)->in(Scope::SINGLETON);
    }
}
