<?php

namespace espend\Ide\DataCollector\Collector\Twig;

use espend\Ide\DataCollector\Collector\IdeCollectorParameter;
use espend\Ide\DataCollector\Collector\IdeDataCollectorInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class TwigDataCollector implements IdeDataCollectorInterface
{

    protected $loaderFilesystem;
    protected $kernel;

    public function __construct(\Twig_Loader_Filesystem $loaderFilesystem, KernelInterface $kernel)
    {
        $this->loaderFilesystem = $loaderFilesystem;
        $this->kernel = $kernel;
    }

    public function collect(IdeCollectorParameter $parameter)
    {

        $twig = array();

        foreach ($this->loaderFilesystem->getNamespaces() as $namespace) {
            $twig['namespaces']['add_path'][$namespace] = $parameter->getPathResolver()->getPaths(
              $this->loaderFilesystem->getPaths($namespace)
            );
        }

        // @TODO: we should remove this here, to remove KernelInterface deps
        foreach ($this->kernel->getBundles() as $bundle) {
            $path = $bundle->getPath() . '/Resources/views';
            if (is_dir($path) && ($relativePath = $parameter->getPathResolver()->getPath($path))) {
                $twig['namespaces']['bundle'][$bundle->getName()] = $relativePath;
            }
        }

        return $twig;
    }

    public function getAlias()
    {
        return 'twig';
    }

}