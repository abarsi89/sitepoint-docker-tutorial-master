<?php

namespace Source\Services;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class RequestHandler
{
    private ContainerBuilder $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
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

        foreach ($routes as $route => $controllerMethods) {
            //az aktuális URL létezik-e a route-ok között
            if ($helper::isMatch("$_SERVER[REQUEST_URI]", $route)) {
                print_r("yayy", true);

                $uriParams = $helper::getUriParams("$_SERVER[REQUEST_URI]", $route);

                $uriParts = explode("/", "$_SERVER[REQUEST_URI]");

//                var_dump($uriParams);
//                var_dump($uriParts); die();
//                var_dump($controllerMethods);
//                var_dump($_SERVER['REQUEST_METHOD']);

                $controllerMethod = explode('@', $controllerMethods[$_SERVER['REQUEST_METHOD']]);
                $controller = $controllerMethod[0];
                $method = $controllerMethod[1];

                try {
                    $currentController = $this->containerBuilder->get($controller);
                    $currentController->{$method}($uriParts[3]);
                } catch (\Exception $exception) {
                    var_dump($exception->getMessage());
                }

                        //url nem létezik
                        //controller nem létezik
                        //metódus nem létezik
                        //http metódus nem engedélyezett
                        //routes.php array-e

                break;
            }
        }

        http_response_code(404);
        include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'Views' . DIRECTORY_SEPARATOR . '404.php'); // provide your own HTML for the error page
        die();
    }

    private function containerCompile()
    {
        $loader = new XmlFileLoader($this->containerBuilder, new FileLocator(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR. "config" . DIRECTORY_SEPARATOR));
        $loader->load('services.xml');

        $this->containerBuilder->compile();
    }

}

