<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routes.php';
include_once 'Bootstrap.php';

use Source\Bootstrap\Bootstrap;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$bootstrap = new Bootstrap();
$bootstrap->boot($containerBuilder);

