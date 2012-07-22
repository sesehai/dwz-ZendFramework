<?php
/**
 * 生成图像验证码
 *
 * 代码来自 ThinkPHP 的 Lib/ORG/Util/Image.class.php 文件，特此对 ThinkPHP 团队表示感谢
 *
 * Custom
 *
 * LICENSE:
 *
 * @category   Common
 * @package    Plugin
 * @copyright  Copyright (c)  PConline
 * @license
 * @version
 */

/**
 * Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'Zend/Session/Namespace.php';

class Common_Plugin_MyCaptcha extends Zend_Controller_Plugin_Abstract
{
    /**
     * 生成图像验证码
     *
     * @param string $length    验证码长度
     * @param string $mode      类型
     * @param string $type      图像格式
     * @param string $width     图像宽度
     * @param string $height    图像高度
     * @return string
     */
    function image($length=4,$mode=1,$type='png',$width=40,$height=20)
    {
        $randval = $this->rand_string($length,$mode);

        $authCode = new Zend_Session_Namespace('Auth_Code');
        $authCode->imagecode = $randval;

        $width = ($length*9+10)>$width?$length*9+10:$width;
        if ( $type!='gif' && function_exists('imagecreatetruecolor')) {
            $im = @imagecreatetruecolor($width,$height);
        }else {
            $im = @imagecreate($width,$height);
        }
        $r = Array(225,255,255,223);
        $g = Array(225,236,237,255);
        $b = Array(225,236,166,125);
        $key = mt_rand(0,3);

        // 背景色（随机）
        $backColor = imagecolorallocate($im, $r[$key],$g[$key],$b[$key]);
        // 边框色
        $borderColor = imagecolorallocate($im, 100, 100, 100);
        // 点颜色
        $pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));

        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
        $stringColor = imagecolorallocate($im,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
        // 干扰
        for($i=0;$i<10;$i++){
            $fontcolor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(30,300),mt_rand(20,200),55,44,$fontcolor);
        }
        for($i=0;$i<25;$i++){
            $fontcolor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
        }

        @imagestring($im, 5, 5, 3, $randval, $stringColor);
        $this->output($im,$type);
    }

    /**
     * 输出图像
     *
     * @param string $im
     * @param string $type
     */
    function output($im,$type='png')
    {
        header("Content-type: image/".$type);
        $ImageFun='Image'.$type;
        $ImageFun($im);
        imagedestroy($im);
    }

    /**
     * 产生随机字串，字母和数字混合
     *
     * @param string $len       长度
     * @param string $type      字串类型 (0 字母 1 数字 其它 混合)
     * @param string $addChars  额外字符
     * @return string
     */
    function rand_string($len=4,$type='',$addChars='') {
        $str ='';
        switch($type) {
            case 0:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 1:
                $chars= str_repeat('0123456789',3);
                break;
            case 2:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
                break;
            case 3:
                $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            default :
                // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
                break;
        }
        if($len>10 ) {//位数过长重复字符串一定次数
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
        }
        if($type!=4) {
            $chars   =   str_shuffle($chars);
            $str     =   substr($chars,0,$len);
        }else{
            // 中文随机字
            for($i=0;$i<$len;$i++){
                $str.= substr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);
            }
        }
        return $str;
    }

}
