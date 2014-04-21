<?php

namespace Rz\SeoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        //override Text Block from sonata
        $definition = $container->getDefinition('sonata.seo.block.breadcrumb.homepage');
        $definition->setClass($container->getParameter('rz.seo.block.breadcrumb.homepage.class'));
    }
}
