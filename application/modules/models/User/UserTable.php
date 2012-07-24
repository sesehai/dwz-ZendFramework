<?php
/**
 * 功能:user数据表类，继承自Zend_Db_Table
 */

class User_UserTable extends Zend_Db_Table
{
    // 设置默认表名
    protected $_name = "dwz_user";
    // 默认主键为’id’
    protected $_primary = "id";
}
