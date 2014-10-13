<?php

namespace espend\IdeBundle\Command;

use espend\Ide\Generator\Doctrine\MagicMethodProxyGenerator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DoctrineMagicMethodGeneratorCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('espend:ide:doctrine-magic-interfaces')
          ->setDescription('Generate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $rootDir = dirname($this->getContainer()->get('kernel')->getRootDir());

        // @TODO: use service to register command; only on valid doctrine
        $generator = new MagicMethodProxyGenerator($this->getContainer()->get('doctrine'));
        $content = $generator->getPhpInterface();

        $filename = $rootDir . '/_ide-doctrine.php';
        file_put_contents($filename, $content);

        $output->writeln(sprintf('wrote %s bytes to %s', strlen($content), $filename));

    }

}