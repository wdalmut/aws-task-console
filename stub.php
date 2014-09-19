#!/usr/bin/env php
<?php

Phar::mapPhar('aws-console.phar');
require_once 'phar://aws-console.phar/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Corley\AWS\Command\Ec2Start;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator("phar://aws-console.phar"));;
$loader->load("config/console.yml");

$loader = new YamlFileLoader($container, new FileLocator(__DIR__));;
if(!file_exists(__DIR__."/parameters.yml")){
    echo "Create your configuration file: '".__DIR__."/parameters.yml' and set your configurations \n\r";
    exit;
}
$loader->load("parameters.yml");

$application = $container->get("console");
$application->run();

unset($application, $loader, $container);
__HALT_COMPILER();

