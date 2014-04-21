<?php


namespace Rz\SeoBundle\Block\Social;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;


class FacebookShareButtonBlockService extends BaseShareButtonBlockService
{
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        $url = $settings['url'] ?:  $settings['default_url'];
        $title = $settings['title'] ?:  $settings['default_title'];

        if($url && $title) {
            $settings['share_url'] = sprintf('https://www.facebook.com/share.php?u=%s&title=%s', urlencode($url), urlencode($title));
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
            'template'    => 'RzSeoBundle:Block:block_facebook_share_button.html.twig',
            'url'         => null,
            'title'       => null,
            'default_url' => null,
            'default_title'=> null,
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
                array('default_title',  'text',  array('required' => false)),
                array('url',    'url',      array('required' => false)),
                array('title',  'text',  array('required' => false)),
                array('layout', 'choice',   array('required' => true, 'choices' => $this->layoutList)),
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Rz Custom Facebook Share button';
    }
}
