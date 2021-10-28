<?php


namespace Source\Controllers;


class HelloController extends Controller
{
    public function index()
    {
        echo 'Ez itten a Hello controller index függvénye!';
        var_dump($this->smarty);
    }
}