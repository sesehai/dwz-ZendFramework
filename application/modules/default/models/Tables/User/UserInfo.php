<?php

class User_UserInfo {

    private $userId;//主键ID
    private $userName;//用户名称
    private $email;//邮箱
//    private $password;//口令
//    private $createAt;//注册时间
    private $isAdministrator;//是否系统管理员
//    private $status;//状态(1有效0无效)


    function __construct($userArray = null) {
        if ($userArray != null) {
            if (empty($userArray["user_id"])) {
                $this->userId = null;
            } else {
                $this->userId = $userArray["user_id"];
            }

		$this->userName = $userArray["user_name"];
		$this->email = $userArray["email"];
//		$this->password = $userArray["password"];
//		$this->createAt = $userArray["create_at"];
		$this->isAdministrator = $userArray["is_administrator"];
//		$this->status = $userArray["status"];

        }
    }

	function getUserId()
	{
		return $this->userId;
	}

	function setUserId($userId)
	{
		$this->userId=$userId;
	}

	function getUserName()
	{
		return $this->userName;
	}

	function setUserName($userName)
	{
		$this->userName=$userName;
	}

	function getEmail()
	{
		return $this->email;
	}

	function setEmail($email)
	{
		$this->email=$email;
	}

//	function getPassword()
//	{
//		return $this->password;
//	}
//
//	function setPassword($password)
//	{
//		$this->password=$password;
//	}
//
//	function getCreateAt()
//	{
//		return $this->createAt;
//	}
//
//	function setCreateAt($createAt)
//	{
//		$this->createAt=$createAt;
//	}
//
	function getIsAdministrator()
	{
		return $this->isAdministrator;
	}

	function setIsAdministrator($isAdministrator)
	{
		$this->isAdministrator=$isAdministrator;
	}
//
//	function getStatus()
//	{
//		return $this->status;
//	}
//
//	function setStatus($status)
//	{
//		$this->status=$status;
//	}


}
