<?php

namespace espend\Ide\DataCollector\Collector\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use espend\Ide\DataCollector\Collector\IdeCollectorParameter;
use espend\Ide\DataCollector\Collector\IdeDataCollectorInterface;

class DoctrineDataCollector implements IdeDataCollectorInterface
{

    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function collect(IdeCollectorParameter $parameter)
    {

        $doctrine = array();

        /** @var \Doctrine\ORM\EntityManager $em */
        foreach ($this->registry->getManagers() as $name => $em) {

            /** @var MappingDriverChain $mappingDriver */
            $mappingDriver = $em->getConfiguration()->getMetadataDriverImpl();
            if ($mappingDriver instanceof MappingDriverChain) {

                /** @var \Doctrine\Common\Persistence\Mapping\Driver\FileDriver $driver */
                foreach ($mappingDriver->getDrivers() as $driver) {
                    $doctrine[$name]['mappings'][] = array(
                      'extensions' => $driver->getLocator()->getFileExtension(),
                      'paths' => $parameter->getPathResolver()->getPaths($driver->getLocator()->getPaths()),
                    );
                }
            }

            $doctrine[$name]['entity_namespaces'] = $em->getConfiguration()->getEntityNamespaces();

        }

        return $doctrine;
    }

    public function getAlias()
    {
        return 'doctrine';
    }

}