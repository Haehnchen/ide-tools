<?php

namespace espend\IdeBundle;

use espend\IdeBundle\DependencyInjection\Compiler\IdeDataCollectorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class espendIdeBundle extends Bundle
{
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new IdeDataCollectorPass());
    }

}
