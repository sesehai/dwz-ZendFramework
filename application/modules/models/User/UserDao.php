<?php
/**
 * 功能:数据库操作类,user
 * 作者:luq <sesehai@gmail.com>
 * 日期:2012-07-22
 */
class User_UserDao {

    /**
     * Singleton implementation
     */
    protected static $_instance = null;
    // 设置默认表名
    protected $_name = "dwz_user";
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
        $oUserInfo = new User_UserInfo($row);
        return $oUserInfo;
    }

    public function load($oUserInfo) {
        $oDs = new Ds($this->_name, $this->_primary);
        $row = $oDs->getRow($oUserInfo->getId());
        $oUserInfo = new User_UserInfo($row);
        return $oUserInfo;
    }

    public function add($oUserInfo) {
        $row = $oUserInfo->getPropertys();
        unset($row[$this->_primary]);
        $oDs = new Ds($this->_name, $this->_primary);
        $id = $oDs->insert($row);
        $oUserInfo->setId($id);
        return $oUserInfo;
    }

    public function modify($oUserInfo) {
        $row = $oUserInfo->getPropertys();

        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->update($row);
    }

    public function del($id) {
        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->delete($id);
    }

    public function delById($id) {
        $oUserInfo = $this->get($id);
        $oUserInfo->setStatus(0);
        return $this->modify($oUserInfo);
    }

    public function getList($perpage, $page) {
        $oDs = new Ds($this->_name, $this->_primary);
        $list = $oDs->getList(' status=1 ', $perpage, $page);
        $oUserInfoArray = array();
        foreach ($list as $row) {
            $oUserInfo = new User_UserInfo($row);
            array_push($oUserInfoArray, $oUserInfo);
        }
        return $oUserInfoArray;
    }

    public function getArrayList($perpage = 0, $page = 0) {
        //$log = Zend_Registry::get('log');

        $oDs = new Ds($this->_name, $this->_primary);
        $list = $oDs->getList(' 1=1 ', $perpage, $page);
        $oUserInfoArray = array();
        foreach ($list as $row) {
            array_push($oUserInfoArray, $row);
        }
        return $oUserInfoArray;
    }

    public function getListAllCount() {
        $oDs = new Ds($this->_name, $this->_primary);
        return $oDs->getListCount(' status=1 ');
    }
}

