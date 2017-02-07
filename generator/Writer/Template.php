<?php

namespace Spatie\SchemaOrg\Generator\Writer;

use Twig_Environment;
use Twig_SimpleFilter;
use Twig_Loader_Filesystem;
class Template
{
    /** @var \Twig_Environment */
    protected $twig;
    /** @var string */
    protected $template;
    public function __construct($template)
    {
        $this->template = $template;
        $this->twig = $this->createTwigEnvironment();
    }
    public function render(array $context)
    {
        return $this->twig->load($this->template)->render($context);
    }
    protected function createTwigEnvironment()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates/twig');
        $twig = new Twig_Environment($loader, ['cache' => false, 'autoescape' => false]);
        $twig->addFilter(new Twig_SimpleFilter('doc', [Filters::class, 'doc'], ['is_variadic' => true]));
        $twig->addFilter(new Twig_SimpleFilter('lcfirst', [Filters::class, 'lcfirst']));
        return $twig;
    }
}