<?php

use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Auth\Auth;

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

    public function post_index()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            Session::set_flash('message', '入力は全て必須です');
            return self::action_index();
        }

        try {
            if (Auth::create_user($_POST['username'], $_POST['password'], $_POST['username'] . '@example.com')) {
                Auth::login($_POST['username'], $_POST['password']);
                Session::set_flash('message', 'アカウントを作成しました');
                Response::redirect('/');
            } else {
                Session::set_flash('message', 'アカウントの作成に失敗しました');
                return self::action_index();
            }
        } catch (Exception $e) {
            Session::set_flash('message', 'そのユーザー名は使用できません');
            return self::action_index();
        }
    }
}
