<?php
/**
 * 功能:数据库操作类,keyword
 * 作者:luq <sesehai@gmail.com>
 * 日期:2012-07-22
 */
class Keywords_KeywordsDao {

    /**
     * Singleton implementation
     */
    protected static $_instance = null;
    // 设置默认表名
    protected $_name = "dwz_keywords";
    // 默认主键为’id’
    protected $_primary = "id";

    private function __construct() {

    }

    private function __clone() {

    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function get($id) {
        $ds = new Ds($this->_name, $this->_primary);
        $row = $ds->getRow($id);
        $oKeywordsInfo = new Keywords_KeywordsInfo($row);
        return $oKeywordsInfo;
    }

    public function load($oKeywordsInfo) {
        $ds = new Ds($this->_name, $this->_primary);
        $row = $ds->getRow($oKeywordsInfo->getId());
        $oKeywordsInfo = new Keywords_KeywordsInfo($row);
        return $oKeywordsInfo;
    }

    public function add($oKeywordsInfo) {
        $row['code']          = $oKeywordsInfo->getCode();
        $row['name']          = $oKeywordsInfo->getName();
        $row['type']          = $oKeywordsInfo->getType();

        $row['status']        = $oKeywordsInfo->getStatus();//状态:1-活动 2-暂停使用
        $row['parent_id']     = $oKeywordsInfo->getParentId();//上级关联标签
        $row['description']   = $oKeywordsInfo->getDescription();//描述
        $row['is_delete']     = $oKeywordsInfo->getIsDelete();//0:未删除 1:已删除
        $row['created_date']  = $oKeywordsInfo->getCreatedDate();//
        $row['created_user']  = $oKeywordsInfo->getCreatedUser();//
        $row['modified_date'] = $oKeywordsInfo->getModifiedDate();//
        $row['modified_user'] = $oKeywordsInfo->getModifiedUser();//
        $ds = new Ds($this->_name, $this->_primary);
        $id = $ds->insert($row);
        $oKeywordsInfo->setId($id);
        return $oKeywordsInfo;
    }

    public function modify($keywordsInfo) {
        $row['id']            = $oKeywordsInfo->getId();
        $row['code']          = $oKeywordsInfo->getCode();
        $row['name']          = $oKeywordsInfo->getName();
        $row['type']          = $oKeywordsInfo->getType();

        $row['status']        = $oKeywordsInfo->getStatus();//状态:1-活动 2-暂停使用
        $row['parent_id']     = $oKeywordsInfo->getParentId();//上级关联标签
        $row['description']   = $oKeywordsInfo->getDescription();//描述
        $row['is_delete']     = $oKeywordsInfo->getIsDelete();//0:未删除 1:已删除
        $row['created_date']  = $oKeywordsInfo->getCreatedDate();//
        $row['created_user']  = $oKeywordsInfo->getCreatedUser();//
        $row['modified_date'] = $oKeywordsInfo->getModifiedDate();//
        $row['modified_user'] = $oKeywordsInfo->getModifiedUser();//

        $ds = new Ds($this->_name, $this->_primary);
        return $db->update($row);
    }

    public function del($keywordsInfo) {
        $ds = new Ds($this->_name, $this->_primary);
        return $ds->delete($keywordsInfo->getId());
    }

    public function delById($id) {
        $ds = new Ds($this->_name, $this->_primary);
        $keywordsInfo = $this->get($id);
        $keywordsInfo->setStatus(0);
        return $this->modify($keywordsInfo);
    }

    public function getList($perpage, $page) {
        $ds = new Ds($this->_name, $this->_primary);
        $list = $ds->getList(' status=1 ', $perpage, $page);
        $keywordsInfoArray = array();
        foreach ($list as $row) {
            $keywordsInfo = new Keywords_KeywordsInfo($row);
            array_push($keywordsInfoArray, $keywordsInfo);
        }
        return $keywordsInfoArray;
    }

    public function getArrayList($perpage = 0, $page = 0) {
        //$log = Zend_Registry::get('log');

        $ds = new Ds($this->_name, $this->_primary);
        $list = $ds->getList(' 1=1 ', $perpage, $page);
        $keywordsInfoArray = array();
        foreach ($list as $row) {
            array_push($keywordsInfoArray, $row);
        }
        return $keywordsInfoArray;
    }

    public function getListAllCount() {
        $ds = new Ds($this->_name, $this->_primary);
        return $ds->getListCount(' status=1 ');
    }
}

