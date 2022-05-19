<?php

namespace Source\Services;

use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class RequestHandler
{
    private ContainerBuilder $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder, Logger $logger)
    {
        $this->containerBuilder = $containerBuilder;
        $this->logger = $logger;
    }

    public function handle()
    {
        $this->containerCompile();

        $routes = include dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "routes.php";

        // foreach routes tömb, aktuális kulcs matchel-e (regex) a server request uri-val, ha igen return az url-lel, ha nem 404
        // egy request servicenek kéne csinálnia a vizsgálatokat (function-ök)

        /*
        "asdf/sadfasdf/{asdasd}/sddg/sdfsdf/{uilulk}"

    function isMatch (current_uri, route) : boole

        function getUriParams (current_uri, route) : array(asdasd=123,uilulk=444)

        */
        $helper = new RequestHelper();

        $matched = false;

        foreach ($routes as $route => $controllerMethods) {
            //az aktuális URL létezik-e a route-ok között
            if ($helper::isMatch("$_SERVER[REQUEST_URI]", $route)) {

                $uriParams = $helper::getUriParams("$_SERVER[REQUEST_URI]", $route);
//                var_dump($uriParams);

                $controllerMethod = explode('@', $controllerMethods[$_SERVER['REQUEST_METHOD']]);
                $controller = $controllerMethod[0];
                $method = $controllerMethod[1];

                // check controller és method

                $matched = true;

                try {
                    $currentController = $this->containerBuilder->get($controller);
                    $currentController->{$method}(...array_values($uriParams));
                } catch (\Exception $exception) {
                    $matched = false;
                    $this->logger->error($exception->getMessage());
                    // logable és nem-logable exception-ök
                    // logger ki-bekapcsolhatósága
                    // program bármely pontján lehessen logolni
                    // logger implementálása: dependency injection? statikus?
                    // exception kezelés (többféle exception)
                    // GET/POST változók leszedése a controller-ben
                }

                        //url nem létezik
                        //controller nem létezik
                        //metódus nem létezik
                        //http metódus nem engedélyezett
                        //routes.php array-e

                break;
            }
        }

        if ($matched) {
            http_response_code(200);
        } else {
            http_response_code(404);
            include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'Views' . DIRECTORY_SEPARATOR . '404.php'); // provide your own HTML for the error page
            die();
        }
    }

    private function containerCompile()
    {
        $loader = new XmlFileLoader($this->containerBuilder, new FileLocator(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR. "config" . DIRECTORY_SEPARATOR));
        $loader->load('services.xml');

        $this->containerBuilder->compile();
    }

}

