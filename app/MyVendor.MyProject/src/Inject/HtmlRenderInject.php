<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Inject;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

trait HtmlRenderInject
{
    /**
     * @Inject
     * @Named("html_render")
     */
    public function setRenderer(RenderInterface $renderer): ResourceObject
    {
        return parent::setRenderer($renderer);
    }
}
