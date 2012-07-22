<?php
/**
 * Common
 *
 * LICENSE:
 *
 * @category   Common
 * @package    Common
 * @copyright  Copyright (c)  PConline
 * @license
 * @version    OOPHP V1.01
 */
/**
 * Zend_Acl
 */
require_once    'Zend/Acl.php';

/**
 * Zend_Acl_Role
 */
require_once    'Zend/Acl/Role.php';

/**
 *Zend_Acl_Resource
 */
require_once    'Zend/Acl/Resource.php';

/**
 * Access Control List (ACL)
 * @category   Common
 * @package    Common
 * @author
 * @copyright  Copyright (c)  PConline
 * @license
 */
class Common_Plugin_MyAcl extends Zend_Acl
{
    /**
     * Constructor.
     * @return void
     */
    public function __construct()
    {
        //Add resource
        $resource = new Zend_Config_Ini(APPLICATION_PATH . '/configs/resource.ini',null);
        foreach ($resource->toArray() as $key_one=>$arr) {
            $this->add(new Zend_Acl_Resource($key_one));
            foreach ($arr as $key_two=>$value){
                $this->add(new Zend_Acl_Resource($value),$key_one);
            }
        }

        //Add role
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('member'),'guest');
        $this->addRole(new Zend_Acl_Role('admin'),'member');

        //游客权限
        $this->allow('guest','default:index',array('index','detail','code','search','relate','feed'));
        $this->allow('guest','default:album',array('index','detail'));
        $this->allow('guest','default:link',array('index','apply'));
        $this->allow('guest','default:comment',array('add'));
        $this->allow('guest','default:feedback',array('index','add'));
        $this->allow('guest','default:tag',array('index'));
        $this->allow('guest','default:about',array('index','contact'));
        $this->allow('guest','default:error',array('error','nopriv'));
        $this->allow('guest','admin:index',array('login','findpwd'));
        $this->allow('guest','default:user',array('login','findpwd','register','imgcode','checkuname','activation','checkcode'));
        //会员权限
        $this->allow('member','default:user',array('index','modinfo','logout'));
        $this->allow('member','default:comment',array('edit','delete','feedback'));
        $this->allow('guest','default:feedback',array('edit','delete'));
        //超级管理员拥有所有权限
        $this->allow('admin');
    }
}