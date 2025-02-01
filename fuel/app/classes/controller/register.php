<?php

use Fuel\Core\Controller;
use Fuel\Core\View;

class Controller_Register extends Controller
{
    public function action_index()
    {
        $view = array();
        $view['header'] = View::forge('header');
        $view['content'] = View::forge('register/index');
        $view['footer'] = View::forge('footer');

        return View::forge('layout', $view);
    }
}