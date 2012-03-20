<?php

class User_UserDao {

    /**
     * Singleton implementation
     */
    protected static $_instance = null;
    // 设置默认表名
	protected $_name = "letv_user";
    // 默认主键为’id’
    protected $_primary = "user_id";

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
        $userInfo = new User_UserInfo($row);
        return $userInfo;
    }

    public function load(&$userInfo) {
        $ds = new Ds($this->_name, $this->_primary);
        $row = $ds->getRow($userInfo->getUserId());
        $userInfo = new User_UserInfo($row);
    }

    public function add(&$userInfo) {
    	$row['user_id'] = $userInfo->getUserId();
        $row['user_name'] = $userInfo->getUserName();
        $row['email'] = $userInfo->getEmail();
//        $row['password'] = $userInfo->getPassword();
//        $row['create_at'] = $userInfo->getCreateAt();
        $row['is_administrator'] = $userInfo->getIsAdministrator();
//        $row['status'] = $userInfo->getStatus();
        $table = new User_UserTable();
        $id = $table->insert($row);
        $userInfo->setUserId($id);
    }

    public function modify(&$userInfo) {
        $row['user_name'] = $userInfo->getUserName();
        $row['email'] = $userInfo->getEmail();
//        $row['password'] = $userInfo->getPassword();
//        $row['create_at'] = $userInfo->getCreateAt();
        $row['is_administrator'] = $userInfo->getIsAdministrator();
//        $row['status'] = $userInfo->getStatus();

        $table = new User_UserTable();
        $db = $table->getAdapter();
        $where = $db->quoteInto(" user_id = ?", $userInfo->getUserId());
        $table->update($row, $where);
    }

    public function del($userInfo) {
        $this->delById($userInfo->getUserId());
    }

    public function delById($id) {
//        $table = new User_UserTable();
//        $db = $table->getAdapter();
//        $where = $db->quoteInto('user_id=?', $id);
//        $table->delete($where);
		  $userInfo = $this->get($id);
		  $userInfo->setStatus(0);
		  $this->modify($userInfo);
    }

    public function getList($perpage, $page) {
        $ds = new Ds($this->_name, $this->_primary);
        $list = $ds->getList(' status=1 ', $perpage, $page);
        $userInfoArray = array();
        foreach ($list as $row) {
            $userInfo = new User_UserInfo($row);
            array_push($userInfoArray, $userInfo);
        }
        return $userInfoArray;
    }

    public function getArrayList($perpage = 0, $page = 0) {
        $log = Zend_Registry::get('log');

        $ds = new Ds("letv_user", "user_id");
        $list = $ds->getList(' 1=1 ', $perpage, $page);
        $userInfoArray = array();
        foreach ($list as $row) {
            //$userInfo = new User_UserInfo($row);
            //$log->debug( "################### page:".(Zend_Json::encode($row)));
            array_push($userInfoArray, $row);
        }
        return $userInfoArray;
    }

    public function getListAllCount() {
        $ds = new Ds($this->_name, $this->_primary);
        return $ds->getListCount(' status=1 ');
    }
}

