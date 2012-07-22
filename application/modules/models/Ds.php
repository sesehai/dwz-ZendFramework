<?php
/**
 * 功能:数据库管理类，实现了数据库的各种操作
 * 作者:luq <sesehai@gmail.com>
 * 日期:2012-07-22
 *
 */
class Ds {

    private $_dbConnectionName;
    private $_tableName;
    private $_primaryKeyName;

    public function __construct($tableName = null, $primaryKeyName = null,$dbConnectionName = 'db') {
        $this->_tableName        = $tableName;
        $this->_primaryKeyName   = $primaryKeyName;
        $this->_dbConnectionName = $dbConnectionName;
    }



    public function getList($whereSql = '1=1', $limit = 0, $page = 0, $fieldStr = "*", $orderSql = "") {
        $db     = Zend_Registry::get($this->_dbConnectionName);
        $select = $db->select();
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
        $result = $db->fetchAll($sql);
        $db->closeConnection();
        return $result;
    }

    public function getRow($id) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $select = $db->select();
        $select->from($this->_tableName, "*");
        $select->where(($this->_primaryKeyName) . "=?", $id);

        $sql = $select->__toString();
        //$log = Zend_Registry::get('log');
        //$log->debug("################### sql:" . $sql);
        $result = $db->fetchRow($sql);
        $db->closeConnection();
        return $result;
    }


    public function fetchOne($sql) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $row = $db->fetchOne($sql);
        $db->closeConnection();
        return $row;
    }

    public function query($sql) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $result = $db->query($sql);
        $db->closeConnection();
        return $result;
    }

    public function fetchRow($sql) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $result = $db->fetchRow($sql);
        $db->closeConnection();
        return $result;

    }

    public function fetchAll($sql) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $result = $db->fetchAll($sql);
        $db->closeConnection();
        return $result;
    }


    public function getListCount($whereSql = '1=1') {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $select = $db->select();
        $select->from($this->_tableName, 'count(*)')
        ->where($whereSql);
        $sql = $select->__toString();
        $result = intval($db->fetchOne($sql));
        $db->closeConnection();
        return $result;
    }

    public function getDb() {
        $db = Zend_Registry::get($this->_dbConnectionName);
        return $db;
    }

    public function getTableName() {
        return $this->_tableName;
    }


    public function insert($row) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $db->insert($this->_tableName,$row);
        $result = $db->lastInsertId();
        $db->closeConnection();
        return $result;
    }

    public function update($row) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $where = $db->quoteInto(" ".$this->_primaryKeyName." = ?", $row[$this->_primaryKeyName]);
        $result = $db->update($this->_tableName,$row,$where);
        $db->closeConnection();
        return $result;
    }

    public function delete($id) {
        $db = Zend_Registry::get($this->_dbConnectionName);
        $where = $db->quoteInto(" ".$this->_primaryKeyName." = ?", $id);
        $result = $db->delete($this->_tableName,$where);
        $db->closeConnection();
        return $result;
    }

}

