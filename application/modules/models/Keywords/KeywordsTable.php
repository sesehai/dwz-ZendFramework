<?php
/**
 * 功能:keywords数据表类，继承自Zend_Db_Table
 */

class Keywords_KeywordsTable extends Zend_Db_Table
{
    // 设置默认表名
    protected $_name = "dwz_keywords";
    // 默认主键为’id’
    protected $_primary = "id";
}
