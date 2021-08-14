<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Resource\Page;

use BEAR\Resource\ResourceObject;
use MyVendor\MyProject\Inject\HtmlRenderInject;

class Index extends ResourceObject
{
    use HtmlRenderInject;

    public function onGet(): ResourceObject
    {
        return $this;
    }
}
