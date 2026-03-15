<?php

use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Auth\Auth;

class Controller_Login extends Controller
{
    public function action_index()
    {
        $view = array();
        $view['header'] = View::forge('header');
        $view['content'] = View::forge('login/index');
        $view['footer'] = View::forge('footer');

        return View::forge('layout', $view);
    }

    public function post_index()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            Session::set_flash('message', '入力は全て必須です');
            return self::action_index();
        }

        if (Auth::login($_POST['username'], $_POST['password'])) {
            Response::redirect('/');
        } else {
            Session::set_flash('message', 'ユーザー名かパスワードが間違っています');
            return self::action_index();
        }
    }
}
