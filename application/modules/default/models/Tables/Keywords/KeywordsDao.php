<?php

class Keywords_KeywordsDao {

	/**
	 * Singleton implementation
	 */
	protected static $_instance = null;
	// 设置默认表名
	protected $_name = "dp_keywords";
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
		$userInfo = new User_UserInfo($row);
		return $userInfo;
	}

	public function load(&$userInfo) {
		$ds = new Ds($this->_name, $this->_primary);
		$row = $ds->getRow($userInfo->getId());
		$userInfo = new Keywords_KeywordsInfo($row);
	}

	public function add(&$keywordsInfo) {
		$row['code'] = $keywordsInfo->getCode();
		$row['name'] = $keywordsInfo->getName();
		$row['type'] = $keywordsInfo->getType();
		$ds = new Ds($this->_name, $this->_primary);
		$ds->setUserId($row);
	}

	public function modify(&$keywordsInfo) {
		$row['code'] = $keywordsInfo->getCode();
		$row['name'] = $keywordsInfo->getName();
		$row['type'] = $keywordsInfo->getType();

		$ds = new Ds($this->_name, $this->_primary);
		$where = $db->quoteInto(" id = ?", $keywordsInfo->getId());
		$table->update($row, $where);
	}

	public function del($keywordsInfo) {
		$ds = new Ds($this->_name, $this->_primary);
		$ds->delete($keywordsInfo->getId());
	}

	public function delById($id) {
		$ds = new Ds($this->_name, $this->_primary);
		$keywordsInfo = $this->get($id);
		$keywordsInfo->setStatus(0);
		$this->modify($keywordsInfo);
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
		$log = Zend_Registry::get('log');

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

