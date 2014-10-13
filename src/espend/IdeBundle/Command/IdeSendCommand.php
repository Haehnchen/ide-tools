<?php

namespace espend\IdeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IdeSendCommand extends ContainerAwareCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {

        $this->setName('espend:ide:send')
          ->setDescription('Send data to ide server')
          ->addArgument('project', InputArgument::REQUIRED, 'IDE project name');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $project = $input->getArgument('project');

        $collectedData = $this->getContainer()->get('espend_ide_collector')->collect();
        $response = $this->getContainer()->get('espend_ide_client')->send($project, $collectedData);

        $output->writeln('Server response: ' . trim($response->getContent()));
    }


}