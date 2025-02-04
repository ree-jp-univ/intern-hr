<?php

use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Auth\Auth;

class Controller_Edit extends Controller
{
    public function action_index($memo_id = null)
    {
        if (is_null($memo_id)) {
            return Response::redirect('/404');
        }

        $memo = Model_Memo::get_memo($memo_id);
        // メモが見つからない場合はトップページにリダイレクト
        if (empty($memo)) {
            Session::set_flash('message', '指定されたメモが見つかりませんでした。');
            return Response::redirect('/');
        }
        // メモの持ち主以外は弾く
        if ($memo[0]['user_id'] != Auth::get_user_id()[1]) {
            Session::set_flash('message', '指定されたメモは編集できません。');
            return Response::redirect('/');
        }
        $data = array();
        $data['title'] = $memo[0]['title'];
        $data['json'] = $memo[0]['content_json'] ?? '{}';
        $data['is_published'] = $memo[0]['is_published'];
        $view = array();
        $view['header'] = View::forge('header');
        $view['content'] = View::forge('edit/editor', $data);
        $view['footer'] = View::forge('edit/dummy');

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
}
