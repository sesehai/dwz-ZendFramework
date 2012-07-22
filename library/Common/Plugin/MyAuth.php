<?php
/**
 * Common
 *
 * LICENSE:
 *
 * @category   Common
 * @package    Common
 * @subpackage Controller
 * @copyright  Copyright (c)  PConline
 * @license
 * @version
 */

/**
 * Zend_Controller_Plugin_Abstract
 */
require_once    'Zend/Controller/Plugin/Abstract.php';

/**
 * Implement the privilege controller.
 *
 * @category   Common
 * @package    Common
 * @subpackage Plugin
 * @author
 * @copyright  Copyright (c)  PConline
 * @license
 */
class Common_Plugin_MyAuth  extends Zend_Controller_Plugin_Abstract
{
    /**
     * An instance of Zend_Auth
     * @var Zend_Auth
     */
    private $_auth;

    /**
     * An instance of Custom_Acl
     * @var Custom_Acl
     */
    private $_acl;

    /**
     * Redirect to a new controller when the user has a invalid indentity.
     * @var array
     */
    private $_noauth=array( 'module'=>'default',
                            'controller'=>'user',
                            'action'=>'login');
    /**
     * Redirect to 'error' controller when the user has a vailid identity
     * but no privileges
     * @var array
     */
    private $_nopriv=array( 'module'=>'default',
                            'controller'=>'error',
                            'action'=>'nopriv');

    /**
     * Constructor.
     * @return void
     */

    public function __construct()
    {
        //创建验证对象
        $auth = Zend_Auth::getInstance();
        //创建访问权限对象
        $acl = new Common_Plugin_MyAcl();
        $this->_auth = $auth;
        $this->_acl = $acl;
    }

    /**
     * Track user privileges.
     * @param Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        /* session 验证方式
         if($this->_auth->hasIdentity()){
         $role = $this->_auth->getIdentity()->role;
         }else{
         $role = 'guest';
         }
         */
        // cookie验证方式
        $role = $this->getCookie('role')?$this->getCookie('role'):'admin';

        $module = $request->module;
        $controller = $request->controller;
        $action = $request->action;
        $resource = "$module:$controller";
        if(!$this->_acl->has($resource)){
            $resource = null;
        }

        if(!$this->_acl->isAllowed($role,$resource,$action)){
            // session验证方式
            //if(!$this->_auth->hasIdentity()){
            // cookie验证方式
            if($role=='guest'){
                $module = $this->_noauth['module'];
                $controller = $this->_noauth['controller'];
                $action = $this->_noauth['action'];
            }else{
                $module = $this->_nopriv['module'];
                $controller = $this->_nopriv['controller'];
                $action = $this->_nopriv['action'];
            }
        }

        $request->setModuleName($module);
        $request->setControllerName($controller);
        $request->setActionName($action);
    }

    /**
     * 获得cookie
     *
     * @param string $name  cookie名
     * @return string
     */
    function getCookie($name)
    {
        if(isset($_COOKIE['zfblog_auth'])){
            $val = $this->authcode($_COOKIE['zfblog_auth'],'DECODE');
        }
        else
        {
            return null;
        }
        $cookiearr = explode('|',$val);
        foreach ($cookiearr as $v)
        {
            list($key,$value) = explode('=',$v);
            if ($key==$name) {
                return $value;
            }
        }
        return null;
    }

    /**
     * 字符串加解密函数
     *
     * @param string $string
     * @param string $operation
     * @param string $key
     * @param int $expiry
     * @return string
     */
    function authcode($string, $operation = 'DECODE', $key = 'zfblog', $expiry = 0) {

        $ckey_length = 4;

        $key = md5($key ? $key : 'zfblog');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }

}