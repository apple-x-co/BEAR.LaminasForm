<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;
use Twig\Cache\FilesystemCache;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use function file_exists;
use function is_dir;
use function mkdir;

class TwigProvider implements ProviderInterface
{
    /** @var string */
    private $templateDir;

    /**
     * Twigインスタンスの生成
     *
     * @param string      $templateDir テンプレートディレクトリ
     *
     * @Named("templateDir=twig_template_dir")
     */
    public function __construct(string $templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        return new Environment(new FilesystemLoader($this->templateDir));
    }
}
