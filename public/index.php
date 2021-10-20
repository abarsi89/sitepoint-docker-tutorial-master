<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routes.php';
include_once 'bootstrap.php';

use Source\Bootstrap\Bootstrap;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

$containerBuilder = new ContainerBuilder();
/*$loader = new XmlFileLoader($containerBuilder, new FileLocator(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config'));
$loader->load('services.xml');
*/
/** @var \Source\Sample\SampleService $sampleService */
/*$sampleService = $containerBuilder->get('sample_service');
$sampleParam = $containerBuilder->getParameter('sample_param');
echo $sampleService->sample(). "\n";
echo $sampleParam;*/

$bootstrap = new Bootstrap();
$bootstrap->boot($containerBuilder);

//$smarty = $containerBuilder->get('smarty');
//var_dump($smarty);

//bootstrapYourself($routes);
