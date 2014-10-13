<?php

namespace espend\IdeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;


class IdeDataCollectorPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('espend_ide_collector')) {
            return;
        }

        $definition = $container->getDefinition('espend_ide_collector');
        $taggedServices = $container->findTaggedServiceIds('ide_data_collector');

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addCollector', array(new Reference($id)));
        }

    }
}