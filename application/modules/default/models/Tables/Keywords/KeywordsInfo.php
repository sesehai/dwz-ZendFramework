<?php

class Keywords_KeywordsInfo {

	private $id;//主键ID
	private $code;//编号
	private $name;//名称
	private $type;//标签类型1:标签分类2:取值标签3:匹配标签
	
	private $status;//状态:1-活动 2-暂停使用
	private $parent_id;//上级关联标签
	private $description;//描述
	private $is_delete;//0:未删除 1:已删除
	private $created_date;//
	private $created_user;//
	private $modified_date;//
	private $modified_user;//
	


	function __construct($userArray = null) {
		if ($userArray != null) {

		}
	}

	function getId()
	{
		return $this->id;
	}

	function setId($id)
	{
		$this->id=$id;
	}

	function getCode()
	{
		return $this->code;
	}

	function setCode($code)
	{
		$this->code=$code;
	}

	function getName()
	{
		return $this->name;
	}

	function setName($name)
	{
		$this->name=$name;
	}

	function getType()
	{
		return $this->type;
	}

	function setType($type)
	{
		$this->type=$type;
	}
	
	function getStatus()
	{
		return $this->status;
	}

	function setStatus($status)
	{
		$this->status=$status;
	}
	
	function getParentId()
	{
		return $this->parent_id;
	}

	function setParentId($parent_id)
	{
		$this->parent_id=$parent_id;
	}
	
	function getDescription()
	{
		return $this->description;
	}

	function setDescription($description)
	{
		$this->description=$description;
	}
	
	function getIsdelete()
	{
		return $this->is_delete;
	}

	function setIsDelete($is_delete)
	{
		$this->is_delete=$is_delete;
	}

	function getIsDelete()
	{
		return $this->created_date;
	}

	function setCreatedDate($created_date)
	{
		$this->created_date=$created_date;
	}
	
	function getCreatedUser()
	{
		return $this->created_user;
	}

	function setCreatedUser($created_user)
	{
		$this->created_user=$created_user;
	}
	
	function getModifiedDate()
	{
		return $this->modified_date;
	}

	function setModifiedDate($modified_date)
	{
		$this->modified_date=$modified_date;
	}

	function getModifiedUser()
	{
		return $this->modified_user;
	}

	function setModifiedUser($modified_user)
	{
		$this->modified_user=$modified_user;
	}

}
