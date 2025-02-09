<?php

use Fuel\Core\DB;

class Model_Memo extends \Fuel\Core\Model
{
    protected static $_table_name = 'memo';
    protected static $_primary_key = 'memo_id';

    protected static $_memo_id = 'memo_id';
    protected static $_user_id = 'user_id';
    protected static $_title = 'title';
    protected static $_content_json = 'content_json';
    protected static $_content_html = 'content_html';
    protected static $_is_published = 'is_published';
    protected static $_created_at = 'created_at';
    protected static $_updated_at = 'updated_at';

    public static function get_user_memo_list($user_id)
    {
        $query = DB::select(self::$_memo_id, self::$_user_id, self::$_title, self::$_created_at, self::$_updated_at)
            ->from(self::$_table_name)
            ->where(self::$_user_id, $user_id)
            ->order_by(self::$_updated_at, 'desc');
        return $query->execute()->as_array();
    }

    public static function get_memo($memo_id)
    {
        $query = DB::select(self::$_memo_id, self::$_user_id, self::$_title, self::$_content_json, self::$_content_html, self::$_is_published, self::$_created_at, self::$_updated_at)
            ->from(self::$_table_name)
            ->where(self::$_memo_id, $memo_id);
        return $query->execute()->as_array();
    }

    public static function update_memo($memo_id, $title = null, $memo_json = null, $memo_html = null, $is_published = null)
    {
        // nullでないものだけ更新する
        if (!is_null($title)) {
            $array[self::$_title] = $title;
        }
        if (!is_null($memo_json)) {
            $array[self::$_content_json] = $memo_json;
        }
        if (!is_null($memo_html)) {
            $array[self::$_content_html] = $memo_html;
        }
        if (!is_null($is_published)) {
            $array[self::$_is_published] = $is_published;
        }
        $query = DB::update(self::$_table_name)
            ->set($array)
            ->where(self::$_memo_id, $memo_id);
        return $query->execute();
    }

    public static function create_memo($user_id, $memo_id, $title)
    {
        $query = DB::insert(self::$_table_name)
            ->set(array(
                self::$_user_id => $user_id,
                self::$_memo_id => $memo_id,
                self::$_title => $title,
            ));
        return $query->execute();
    }

    public static function delete_memo($memo_id)
    {
        $query = DB::delete(self::$_table_name)
            ->where(self::$_memo_id, $memo_id);
        return $query->execute();
    }
}
