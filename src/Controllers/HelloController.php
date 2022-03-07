<?php


namespace Source\Controllers;


class HelloController extends Controller
{
    public function index()
    {
        echo 'Ez itten a Hello controller index függvénye!';
//        var_dump($this->smarty);
    }

    public function show($id)
    {
        echo 'Ez itten a Hello controller show függvénye ezzel az ID-val: '.$id;
    }

    public function getShow($id)
    {
        return include(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'Views' . DIRECTORY_SEPARATOR . 'hello.view.php');;
    }
}