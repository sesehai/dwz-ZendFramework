<?php

class User_UserInfo {

    private $id;//主键ID
    private $name;//用户名
    private $realname;//真实名称
    private $password;//密码

    private $sex;
    private $email;
    private $phone;
    private $status;
    private $address;
    private $is_delete;
    private $created_date;
    private $created_user;
    private $modified_date;
    private $modified_user;
    private $role_id;
    private $propertys;



    public function __construct($userArray = null) {
        if ($userArray != null) {
            $this->id = $userArray['id'];
            $this->name = $userArray['name'];
            $this->realname = $userArray['realname'];
            $this->password = $userArray['password'];

            $this->sex = $userArray['sex'];
            $this->email = $userArray['email'];
            $this->phone = $userArray['phone'];
            $this->status = $userArray['status'];
            $this->address = $userArray['address'];
            $this->is_delete = $userArray['is_delete'];
            $this->created_date = $userArray['created_date'];
            $this->created_user = $userArray['created_user'];
            $this->modified_date = $userArray['modified_date'];
            $this->modified_user = $userArray['modified_user'];
            $this->role_id = $userArray['role_id'];
        }
    }

    private function propertyToArray(){
        $this->propertys['id'] = $this->id;
        $this->propertys['name'] = $this->name;
        $this->propertys['realname'] = $this->realname;
        $this->propertys['password'] = $this->password;

        $this->propertys['sex'] = $this->sex;
        $this->propertys['email'] = $this->email;
        $this->propertys['phone'] = $this->phone;
        $this->propertys['status'] = $this->status;
        $this->propertys['address'] = $this->address;
        $this->propertys['is_delete'] = $this->is_delete;
        $this->propertys['created_date'] = $this->created_date;
        $this->propertys['created_user'] = $this->created_user;
        $this->propertys['modified_date'] = $this->modified_date;
        $this->propertys['modified_user'] = $this->modified_user;
        $this->propertys['role_id'] = $this->role_id;

    }

    public function getPropertys(){
        $this->propertyToArray();
        return $this->propertys;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getRealname()
    {
        return $this->realname;
    }

    public function setrealname($realname)
    {
        $this->realname=$realname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password=$password;
    }

    public function getSex()
    {
        return $this->sex;
    }

    public function setSex($sex)
    {
        $this->sex=$sex;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email=$email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone=$phone;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status=$status;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address=$address;
    }

    public function setIsDelete($is_delete)
    {
        $this->is_delete=$is_delete;
    }

    public function getIsDelete()
    {
        return $this->is_delete;
    }

    public function setCreatedDate($created_date)
    {
        $this->created_date=$created_date;
    }

    public function getCreatedDate()
    {
        return $this->created_date;
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

    public function getRoleId()
    {
        return $this->role_id;
    }

    public function setRoleId($role_id)
    {
        $this->role_id=$role_id;
    }

}
