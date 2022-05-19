<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routes.php';

use Monolog\Handler\StreamHandler;

use Monolog\Logger;
use Source\Services\RequestHandler;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$logger = new Logger('general');
$logger->pushHandler(new StreamHandler(dirname(__DIR__).DIRECTORY_SEPARATOR.'app.log', Logger::WARNING));

$bootstrap = new RequestHandler($containerBuilder, $logger);
// try-catch
$bootstrap->handle();
