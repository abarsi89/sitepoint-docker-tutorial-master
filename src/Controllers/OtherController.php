<?php


namespace Source\Controllers;


use Smarty;

class OtherController extends Controller
{
    public function __construct(Smarty $smarty)
    {
        parent::__construct($smarty);
    }

    public function getShow($id, $xyz)
    {
//        $this->smarty->assign('name', 'Other');
        $this->smarty->assign('id', $id);
        $this->smarty->assign('name', $xyz);
        $this->smarty->display('other.view.tpl');
    }
}