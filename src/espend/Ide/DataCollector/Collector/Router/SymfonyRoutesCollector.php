<?php

namespace espend\Ide\DataCollector\Collector\Router;

use espend\Ide\DataCollector\Collector\IdeCollectorParameter;
use espend\Ide\DataCollector\Collector\IdeDataCollectorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

class SymfonyRoutesCollector implements IdeDataCollectorInterface
{

    protected $router;
    protected $nameParser;

    public function __construct(RouterInterface $router, ControllerNameParser $nameParser)
    {
        $this->router = $router;
        $this->nameParser = $nameParser;
    }

    public function collect(IdeCollectorParameter $parameter)
    {
        $router = array();

        /** @var \Symfony\Component\Routing\Route $route */
        foreach ($this->router->getRouteCollection() as $name => $route) {
            $this->convertController($route);

            $router['routes'][] = array(
              'name' => $name,
              'path' => $route->getPath(),
              'controller' => $route->getDefault('_controller'),
            );

        }

        return $router;
    }

    protected function convertController(Route $route)
    {
        if ($route->hasDefault('_controller')) {
            try {
                $route->setDefault('_controller', $this->nameParser->build($route->getDefault('_controller')));
            } catch (\InvalidArgumentException $e) {
            }
        }
    }

    public function getAlias()
    {
        return 'router';
    }
}