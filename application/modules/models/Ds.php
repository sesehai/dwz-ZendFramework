<?php

class Ds {

	private $_db;
	private $_tableName;
	private $_primaryKeyName;

	public function __construct($tableName = null, $primaryKeyName = null) {
		$this->_db = Zend_Registry::get('db');
		$this->_tableName = $tableName;
		$this->_primaryKeyName = $primaryKeyName;
		//$dbchar = 'utf8';
		//$this->_db->query('set character_set_connection='.$dbchar.',character_set_results='.$dbchar.',character_set_client=binary;');
	}



	public function getList($whereSql = '1=1', $limit = 0, $page = 0, $fieldStr = "*", $orderSql = "") {
		$select = $this->_db->select();
		if (empty($orderSql)) {
			$orderSql = ($this->_primaryKeyName) . ' desc';
		}
		$select->from($this->_tableName, $fieldStr);
		$select->where($whereSql)
		->order($orderSql);

		// 分页
		if ($limit > 0 && $page > 0) {
			$select->limitPage($page, $limit);
		} elseif ($limit > 0) {
			$select->limit($limit);
		}

		$sql = $select->__toString();

		//$log = Zend_Registry::get('log');
		//$log->debug("################### sql:" . $sql);
		return $this->_db->fetchAll($sql);
	}

	public function getRow($id) {
		$select = $this->_db->select();
		$select->from($this->_tableName, "*");
		$select->where(($this->_primaryKeyName) . "=?", $id);

		$sql = $select->__toString();
		//$log = Zend_Registry::get('log');
		//$log->debug("################### sql:" . $sql);
		return $this->_db->fetchRow($sql);
	}


	public function fetchOne($sql) {
		$row = $this->_db->fetchOne($sql);
		return $row;
	}

	public function query($sql) {
		$this->_db->query($sql);
	}

	public function fetchRow($sql) {
		return $this->_db->fetchRow($sql);
	}

	public function fetchAll($sql) {

		return $this->_db->fetchAll($sql);
	}


	public function getListCount($whereSql = '1=1') {
		$select = $this->_db->select();
		$select->from($this->_tableName, 'count(*)')
		->where($whereSql);
		$sql = $select->__toString();
		return intval($this->_db->fetchOne($sql));
	}

	public function getDb() {
		return $this->_db;
	}

	public function getTableName() {
		return $this->_tableName;
	}


	public function insert($row) {
		$this->_db->insert($this->_tableName,$row);
		return $this->_db->lastInsertId();
	}

	public function update($row) {
		$where = $this->_db->quoteInto(" ".$this->_primaryKeyName." = ?", $row[$this->_primaryKeyName]);

		return $this->_db->update($this->_tableName,$row,$where);
	}

	public function delete($id) {
		$where = $this->_db->quoteInto(" ".$this->_primaryKeyName." = ?", $id);
		$this->_db->delete($this->_tableName,$where);
	}

}

