<?php

namespace Source\Services;

class RequestHelper
{
    /**
     * Megadja, hogy az aktuális URL egyezik-e a megadott route-tal
     * @param $currentUri
     * @param $route
     * @return bool
     */
    static function isMatch($currentUri, $route): bool
    {
        $uriParts = array_values(array_filter(explode("/", $currentUri)));
        $routeParts = explode("/", $route);

        foreach ($uriParts as $key => $uriPart) {
            if($uriPart !== $routeParts[$key] && !str_starts_with($routeParts[$key], "{")) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $currentUri
     * @param $route
     * @return array
     */
    static function getUriParams($currentUri, $route): array
    {
        $routeParts = explode("/", $route);
        $uriParts = array_values(array_filter(explode("/", $currentUri)));

        $uriParams = array_combine($routeParts, $uriParts);
        var_dump($uriParams);die();

//        array(asdasd=123,uilulk=444)
        return $uriParams;
    }
}