<?php


namespace Source\Controllers;


class HelloController extends Controller
{
    public function index()
    {
        echo 'Ez itten a Hello controller index függvénye!';

        return view('hello');
    }
}