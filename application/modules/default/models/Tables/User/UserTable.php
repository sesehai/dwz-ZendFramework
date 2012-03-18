<?php
/**
 * User_UserTable
 */

class User_UserTable extends Zend_Db_Table
{
    // 设置默认表名
	protected $_name = "letv_user";
    // 默认主键为’id’
    protected $_primary = "user_id";
}
