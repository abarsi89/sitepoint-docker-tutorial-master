<?php

namespace Source\Controllers;

use Smarty;

abstract class Controller
{
    protected $smarty;

    function __construct(Smarty $smarty)
    {
        $this->smarty = $smarty;
        $this->smarty->setTemplateDir(dirname(__DIR__, 1) . DIRECTORY_SEPARATOR. 'Views' . DIRECTORY_SEPARATOR);
        $this->smarty->setConfigDir(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR. 'config' . DIRECTORY_SEPARATOR);
        $this->smarty->setCacheDir(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR. 'cache' . DIRECTORY_SEPARATOR);
    }
}