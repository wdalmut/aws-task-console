#!/usr/bin/env php
<?php
require __DIR__."/vendor/autoload.php";

use Symfony\Component\Console\Application;
use Corley\AWS\Command\Ec2Start;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));;
$loader->load("config/console.yml");

if(!file_exists(__DIR__."/config/parameters.yml")){
    echo "Copy ".__DIR__."/config/parameters.yml.dist in ".__DIR__."/config/parameters.yml and set your configurations \n\r";
    exit;
}
$loader->load("config/parameters.yml");

$application = $container->get("console");
$application->run();
