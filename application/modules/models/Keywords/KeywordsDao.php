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
        $oDs = new Ds($this->_name, $this->_primary);
        $row = $oDs->getRow($id);
        $oKeywordsInfo = new Keywords_KeywordsInfo($row);
        return $oKeywordsInfo;
    }

    public function load($oKeywordsInfo) {
        $oDs = new Ds($this->_name, $this->_primary);
        $row = $oDs->getRow($oKeywordsInfo->getId());
        $oKeywordsInfo = new Keywords_KeywordsInfo($row);
        return $oKeywordsInfo;
    }

    public function add($oKeywordsInfo) {
        $row = $oKeywordsInfo->getPropertys();
        unset($row[$this->_primary]);
        $oDs = new Ds($this->_name, $this->_primary);
        $id = $oDs->insert($row);
        $oKeywordsInfo->setId($id);
        return $oKeywordsInfo;
    }

    public function modify($oKeywordsInfo) {
        $row = $oKeywordsInfo->getPropertys();

        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->update($row);
    }

    public function del($id) {
        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->delete($id);
    }

    public function delById($id) {
        $oKeywordsInfo = $this->get($id);
        $oKeywordsInfo->setStatus(0);
        return $this->modify($oKeywordsInfo);
    }

    public function getList($perpage, $page) {
        $oDs = new Ds($this->_name, $this->_primary);
        $list = $oDs->getList(' status=1 ', $perpage, $page);
        $oKeywordsInfoArray = array();
        foreach ($list as $row) {
            $oKeywordsInfo = new Keywords_KeywordsInfo($row);
            array_push($oKeywordsInfoArray, $oKeywordsInfo);
        }
        return $oKeywordsInfoArray;
    }

    public function getArrayList($perpage = 0, $page = 0) {
        //$log = Zend_Registry::get('log');

        $oDs = new Ds($this->_name, $this->_primary);
        $list = $oDs->getList(' 1=1 ', $perpage, $page);
        $oKeywordsInfoArray = array();
        foreach ($list as $row) {
            array_push($oKeywordsInfoArray, $row);
        }
        return $oKeywordsInfoArray;
    }

    public function getListAllCount() {
        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->getListCount(' status=1 ');
    }
}

