<?php

use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Auth\Auth;

class Controller_Home extends Controller
{
    public function action_index()
    {
        $data = array();
        $data['username'] = Auth::get_screen_name();
        $view = array();
        $view['header'] = View::forge('header');
        $view['content'] = View::forge('home/content', $data);
        $view['footer'] = View::forge('footer');

        return View::forge('layout', $view);
    }

    public function before()
    {
        parent::before();
        if (!Auth::check()) {
            Session::set_flash('message', 'ログインしてください');
            return Response::redirect('login');
        }
    }

    public function get_memos()
    {
        list(, $user_id) = Auth::get_user_id();
        $memos = Model_Memo::get_user_memo_list($user_id);
        return Response::forge(json_encode($memos));
    }
}
