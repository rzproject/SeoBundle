<?php


namespace Rz\SeoBundle\Block\Social;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Sonata\SeoBundle\Seo\SeoPageInterface;


abstract class BaseShareButtonBlockService extends BaseBlockService
{
    protected $layoutList = array(
        'footer' => 'footer',
        'content'  => 'content',
        'sidebar'  => 'sidebar',
    );

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();
        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'    => $blockContext->getBlock(),
            'settings' => $settings,
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Rz Custom Share button';
    }
}
