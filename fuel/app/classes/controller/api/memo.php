<?php

use Fuel\Core\Controller;
use Fuel\Core\Session;
use Fuel\Core\Response;
use Fuel\Core\Input;
use Auth\Auth;

class Controller_Api_Memo extends Controller
{
    /**
     * JSON レスポンスを返す共通メソッド
     */
    protected function jsonResponse(array $data, int $code = 200)
    {
        return Response::forge(
            json_encode($data),
            $code,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * memo の存在とユーザー権限をチェックし、問題があれば Response を返す
     * 問題がなければ memo を返す
     * @param string $memo_id
     * @param int $user_id
     * @return array|Response
     */
    protected function validateMemo($memo_id, int $user_id)
    {
        $memo = Model_Memo::get_memo($memo_id);
        if (empty($memo)) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => '指定されたメモが見つかりませんでした',
            ], 400);
        }

        if ($memo[0]['user_id'] != $user_id) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => '指定されたメモの権限がありません',
            ], 403);
        }

        return $memo;
    }

    public function get_list()
    {
        $user_id = Auth::get_user_id()[1];
        $memo_list = Model_Memo::get_user_memo_list($user_id);
        return $this->jsonResponse(array(
            'status' => 'success',
            'memo_list' => $memo_list,
        ));
    }

    public function get_get()
    {
        $user_id = Auth::get_user_id()[1];
        $memo_id = Input::post('memo_id');
        $memo = $this->validateMemo($memo_id, $user_id);
        // validateMemoがレスポンスを返していればエラーなので、チェックする
        if ($memo instanceof Response) {
            return $memo;
        }
        return $this->jsonResponse(array(
            'status' => 'success',
            'memo' => $memo[0],
        ));
    }

    public function post_create()
    {
        $user_id = Auth::get_user_id()[1];
        $title = Input::post('title');

        if (empty($title)) {
            return $this->jsonResponse(array(
                'status' => 'error',
                'message' => 'タイトルが入力されていません',
            ), 400);
        }

        $memo_id = $this->generateRandomString();
        Model_Memo::create_memo($user_id, $memo_id, $title);
        return $this->jsonResponse(array(
            'status' => 'success',
            'memo_id' => $memo_id,
        ));
    }

    private function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function post_update()
    {
        $user_id = Auth::get_user_id()[1];
        $memo_id = Input::post('memo_id');
        $title = Input::post('title');
        $content_json = Input::post('content_json');
        $content_html = Input::post('content_html');
        $is_published = Input::post('is_published');


        $memo = $this->validateMemo($memo_id, $user_id);
        // validateMemoがレスポンスを返していればエラーなので、チェックする
        if ($memo instanceof Response) {
            return $memo;
        }

        Model_Memo::update_memo($memo_id, $title, $content_json, $content_html, $is_published);

        return $this->jsonResponse(array(
            'status' => 'success',
            'memo_id' => $memo_id,
        ));
    }

    public function post_delete()
    {
        $user_id = Auth::get_user_id()[1];
        $memo_id = Input::post('memo_id');

        $memo = $this->validateMemo($memo_id, $user_id);
        // validateMemoがレスポンスを返していればエラーなので、チェックする
        if ($memo instanceof Response) {
            return $memo;
        }

        Model_Memo::delete_memo($memo_id);
        return $this->jsonResponse(array(
            'status' => 'success',
            'memo_id' => $memo_id,
        ));
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
