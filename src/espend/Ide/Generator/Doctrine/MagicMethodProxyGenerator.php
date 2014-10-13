<?php

namespace espend\Ide\Generator\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Util\Inflector;

class MagicMethodProxyGenerator
{

    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function getPhpInterface()
    {

        $output = array();

        /** @var \Doctrine\ORM\EntityManager $em */
        foreach ($this->registry->getManagers() as $name => $em) {

            /** @var \Doctrine\ORM\Mapping\ClassMetadata $metadata */
            foreach ($em->getMetadataFactory()->getAllMetadata() as $metadata) {


                $output[] = '';
                $nameNsSplit = explode('\\', $metadata->getName());

                $className = array_pop($nameNsSplit);

                $output[] = 'namespace ' . implode('\\', $nameNsSplit) . ' {';
                $output[] = '  interface ' . $className . 'IdeMagicMethods {';
                $output[] = '';
                foreach ($metadata->getFieldNames() as $fieldName) {
                    $camelize = ucfirst(Inflector::camelize($fieldName));

                    $output[] = '    /** @return \\' . $metadata->getName() . ' */';
                    $output[] = '    function findOneBy' . $camelize . '();';
                    $output[] = '';

                    $output[] = '    /** @return \\' . $metadata->getName() . '[] */';
                    $output[] = '    function findBy' . $camelize . '();';
                    $output[] = '';

                }

                $output[] = '  }';
                $output[] = '}';
            }

        }

        if (count($output) == 0) {
            return null;
        }

        return implode(
          "\n",
          array_merge(
            array(
              '<?php',
              '/**',
              '/* Helper file to support doctrine magic methods',
              '/* exit("Just an IDE file");',
              ' */',
              '',
            ),
            $output
          )
        );

    }
}