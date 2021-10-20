<?php


namespace Source\Controllers;


class HelloController extends Controller
{
    public function index()
    {
        echo 'Ez itten a Hello controller index függvénye!<br>';
        var_dump($this->smarty);

        //return view('hello');
    }
}