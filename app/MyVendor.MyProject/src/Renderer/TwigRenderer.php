<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Renderer;

use BEAR\Resource\RenderInterface;
use BEAR\Resource\ResourceObject;
use Ray\Aop\WeavedInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

use function array_map;
use function explode;
use function get_class;
use function get_parent_class;
use function implode;
use function ltrim;
use function preg_replace;
use function str_replace;
use function strtolower;

class TwigRenderer implements RenderInterface
{
    /** @var Environment */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(ResourceObject $ro): string
    {
        $ro->headers['Content-Type'] = 'text/html; charset=UTF-8';
        $ro->view = $this->twig->render($this->getInferTemplateName($ro), (array)$ro->body);

        return $ro->view;
    }

    private function getInferTemplateName(ResourceObject $ro): string
    {
        $className = $ro instanceof WeavedInterface ? get_parent_class($ro) : get_class($ro);
        if ($className === false) {
            return '???';
        }

        $name = str_replace(
            'MyVendor\\MyProject\\Resource\\Page\\',
            '',
            $className
        );
        $names = array_map(static function ($a) {
            $b = preg_replace('/[A-Z]/', '_\0', $a);
            if ($b === null) {
                return null;
            }

            return strtolower(ltrim($b, '_'));
        }, explode('\\', $name));

        return implode('/', $names) . '.html.twig';
    }
}
