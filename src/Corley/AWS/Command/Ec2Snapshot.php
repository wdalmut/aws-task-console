<?php
namespace Corley\AWS\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Aws\Ec2\Ec2Client;

class Ec2Snapshot extends Command
{
    private $awsClient;
    
    public function setClient($client)
    {
        $this->awsClient = $client;
    }

    protected function configure()
    {
        $this->setName('ec2:snapshot')
            ->setDescription('Start list of AWS EC2')
            ->addArgument(
                'volumes',
                InputArgument::IS_ARRAY,
                'List of EC2 volumes'
            );
    } 

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $volumes = $input->getArgument("volumes");
        if(count($volumes) == 0){
            $output->writeln('<error>List of volumes ids are required</error>');
            exit;
        }

        foreach($volumes as $volumeId) {
            try {
               $backup = $this->awsClient->createSnapshot(
                    array(
                        'VolumeId' => $volumeId,
                        'Description' => $volumeId . "-" . date('YmdHis')
                    )
                ); 
                $output->writeln("Snapshot ID: ".$backup->get("SnapshotId"));
            } catch (\Exception $e){
                $output->writeln("<error>[{$volumeId}][{$e->getCode()}] {$e->getMessage()}</error>");
            }
        }
    }
}
