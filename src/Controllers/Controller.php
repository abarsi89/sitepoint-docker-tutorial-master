<?php

namespace Source\Controllers;

use Smarty;

abstract class Controller
{
    protected $smarty; 
    function __construct(Smarty $smarty)
    {
        $this->smarty = $smarty;
    }
}