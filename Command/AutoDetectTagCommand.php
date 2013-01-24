<?php
namespace Jnonon\OpenCalaisBundle\Command;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class AutoDetectTagCommand extends ContainerAwareCommand
{

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Console\Command.Command::configure()
     */
    protected function configure()
    {
        $this->setName('calais:get-tags')->setDescription('Auto Detect Tag from a file')
             ->addArgument('path', InputArgument::REQUIRED);
    }

    /**
     * Imports an article from legacy db to new CMS
     *
     * @param InputInterface  $input  Input
     * @param OutputInterface $output Output
     * @return boolean
     *
     * @see Symfony\Component\Console\Command.Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $service = $this->getContainer()->get('jnonon_open_calais.api');;

        try {

            return true;

        } catch (\Exception $error) {

            return false;
        }
    }

}
