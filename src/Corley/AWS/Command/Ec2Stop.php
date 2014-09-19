<?php
namespace Corley\AWS\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Aws\Ec2\Ec2Client;

class Ec2Stop extends Command
{
    private $awsClient;
    
    public function setClient($client)
    {
        $this->awsClient = $client;
    }

    protected function configure()
    {
        $this->setName('ec2:stop')
            ->setDescription('Stop list of AWS EC2')
            ->addArgument(
                'instances',
                InputArgument::IS_ARRAY,
                'List of EC2 instance ids'
            );
    } 

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ids = $input->getArgument("instances");
        if(count($ids) == 0){
            $output->writeln('<error>List of instances ids are required</error>');
            exit;
        }

        try {
            $this->awsClient->stopInstances(array("InstanceIds" => $ids));
            $output->writeln("Ok");
        } catch (\Exception $e){
            $output->writeln("<error>[{$e->getCode()}] {$e->getMessage()}</error>");
        }
    }
}
