<?php

use Fuel\Core\Controller;
use Fuel\Core\View;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Auth\Auth;

class Controller_View extends Controller
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
        if (!intval($memo[0]['is_published'])) {
            Session::set_flash('message', '指定されたメモは公開されていません。');
            return Response::redirect('/');
        }
        $data = array();
        // nullの場合は初期値を設定
        $memo[0]['content_json'] = $memo[0]['content_json'] ?? '';
        $memo[0]['content_html'] = $memo[0]['content_html'] ?? '';
        $memo[0]['view'] = true;
        $data['memo'] = $memo[0];
        $view = array();
        $view['header'] = View::forge('header');
        $view['content'] = View::forge('edit/editor', $data);
        $view['footer'] = View::forge('edit/dummy');

        return View::forge('layout', $view);
    }
}
