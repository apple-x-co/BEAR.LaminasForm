<?php

declare(strict_types=1);

use MyVendor\MyProject\Bootstrap;

require dirname(__DIR__) . '/autoload.php';
exit((new Bootstrap())('dev-html-app', $GLOBALS, $_SERVER));
