<?php

class Controller_Login extends Controller
{
    public function action_index()
    {
        $data = array();
        // $data['title'] =
        $view = array();
        $view['header'] = View::forge('header');
        $view['footer'] = View::forge('footer');
        $view['content'] = View::forge('content');

        return View::forge('layout', $view);
    }

    // public function action_404()
    // {
    //     return Response::forge(Presenter::forge('original/404'), 404);
    // }
}