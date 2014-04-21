<?php


namespace Rz\SeoBundle\Block\Social;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;


class GoogleShareButtonBlockService extends BaseShareButtonBlockService
{
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        $url = $settings['url'] ?:  $settings['default_url'];

        if($url) {
            $settings['share_url'] = sprintf('https://plus.google.com/share?url=%s', urlencode($url));
        }

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
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template'    => 'RzSeoBundle:Block:block_google_share_button.html.twig',
            'url'         => null,
            'default_url' => null,
            'share_url'   => null,
            'layout'      => $this->layoutList['content'],
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('default_url',    'url',      array('required' => false)),
                array('url',    'url',      array('required' => false)),
                array('layout', 'choice',   array('required' => true, 'choices' => $this->layoutList)),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Rz Custom Google+ Share button';
    }
}
