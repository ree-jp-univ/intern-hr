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
}
