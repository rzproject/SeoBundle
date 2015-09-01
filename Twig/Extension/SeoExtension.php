<?php

namespace Rz\SeoBundle\Twig\Extension;

use Sonata\SeoBundle\Seo\SeoPageInterface;

class SeoExtension extends \Twig_Extension
{
    protected $page;

    protected $encoding;

    /**
     * @param \Sonata\SeoBundle\Seo\SeoPageInterface $page
     * @param $encoding
     */
    public function __construct(SeoPageInterface $page, $encoding)
    {
        $this->page = $page;
        $this->encoding = $encoding;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('rz_seo_title', array($this, 'renderRawTitle')),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'rz_seo';
    }

    /**
     * @return void
     */
    public function renderRawTitle()
    {
        return strip_tags($this->page->getTitle());
    }
}
