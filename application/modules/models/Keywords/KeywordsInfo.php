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



	public function __construct($keywordsArray = null) {
		if ($keywordsArray != null) {
			$this->id=$keywordsArray['id'];//主键ID
			$this->cod=$keywordsArray['cod'];;//编号
			$this->name=$keywordsArray['name'];//名称
			$this->type=$keywordsArray['type'];//标签类型1:标签分类2:取值标签3:匹配标签

			$this->status=$keywordsArray['status'];//状态:1-活动 2-暂停使用
			$this->parent_id=$keywordsArray['parent_id'];//上级关联标签
			$this->description=$keywordsArray['description'];//描述
			$this->is_delete=$keywordsArray['is_delete'];//0:未删除 1:已删除
			$this->created_date=$keywordsArray['created_date'];//
			$this->created_user=$keywordsArray['created_user'];//
			$this->modified_date=$keywordsArray['modified_date'];//
			$this->modified_user=$keywordsArray['modified_user'];//
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id=$id;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setCode($code)
	{
		$this->code=$code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name=$name;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type=$type;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status=$status;
	}

	public function getParentId()
	{
		return $this->parent_id;
	}

	public function setParentId($parent_id)
	{
		$this->parent_id=$parent_id;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description=$description;
	}

	public function setIsDelete($is_delete)
	{
		$this->is_delete=$is_delete;
	}

	public function getIsDelete()
	{
		return $this->created_date;
	}

	public function setCreatedDate($created_date)
	{
		$this->created_date=$created_date;
	}

	public function getCreatedUser()
	{
		return $this->created_user;
	}

	public function setCreatedUser($created_user)
	{
		$this->created_user=$created_user;
	}

	public function getModifiedDate()
	{
		return $this->modified_date;
	}

	public function setModifiedDate($modified_date)
	{
		$this->modified_date=$modified_date;
	}

	public function getModifiedUser()
	{
		return $this->modified_user;
	}

	public function setModifiedUser($modified_user)
	{
		$this->modified_user=$modified_user;
	}

}
