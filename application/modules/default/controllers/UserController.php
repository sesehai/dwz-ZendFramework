<?php
class Default_UserController extends Dwz_Controller_Action {
    public function init() {
        parent::init ();
    }

    /**
     * 数据列表展示页面
     */
    function indexAction() {
        $orderField = $this->_getParam('orderField');
        $orderDirection = $this->_getParam('orderDirection');
        if (! empty ( $orderField )) {
            $order = $orderField;
            if (empty ( $orderDirection )) {
                $order .= ' asc';
            } else {
                $order .= ' ' . $orderDirection;
            }
        }

        $numPerPage = 10;
        $offset = 0;
        $pageNum = $this->_getParam('pageNum');
        if (! empty ( $pageNum ) && $pageNum > 0) {
            $offset = ($pageNum - 1) * $numPerPage;
        }

        $oUserDao = User_UserDao::getInstance();
        $totalCount = $oUserDao->getListAllCount();

        $this->view->list = $oUserDao->getList($numPerPage, $offset);
        $this->view->totalCount = $totalCount;
        $this->view->numPerPage = $numPerPage;
        $this->view->currentPage = $pageNum > 0 ? $pageNum : 1;

    }

    /**
     * 数据展示页面
     */
    function readAction() {
        $this->editAction ();
    }

    /**
     * 数据创建页面
     */
    function addAction() {

    }

    /**
     * 数据编辑页面
     */
    function editAction() {
        $oUserDao = User_UserDao::getInstance();
        $this->view->vo = $oUserDao->get($this->_getParam('id'));
    }

    /**
     * 创建数据操作
     */
    function insertAction() {
        try {
            $oUserDao = User_UserDao::getInstance();
            $property['name']          = $this->_getParam('name');
            $property['realname']      = $this->_getParam('realname');
            $property['email']         = $this->_getParam('email');
            $property['address']       = $this->_getParam('address');
            $property['role_id']       = $this->_getParam('role_id');
            $property['status']        = '1';//状态:1-活动 2-暂停使用
            $property['is_delete']     = 0;//0:未删除 1:已删除
            $property['created_date']  = date('Y-m-d H:i:s',time());
            $property['created_user']  = '';//
            $property['modified_date'] = date('Y-m-d H:i:s',time());
            $property['modified_user'] = '';//

            $oUserInfo = new User_UserInfo($property);

            $id = $oUserDao->add($oUserInfo);
            $this->success ( '操作成功' );
        } catch ( Exception $e ) {
            $this->error ( '操作失败'.$e );
        }
    }

    /**
     * 更新数据操作
     */
    function updateAction() {
        try {
            $oUserDao = User_UserDao::getInstance();

            $id            = $this->_getParam('id');
            $name          = $this->_getParam('name');
            $realname      = $this->_getParam('realname');
            $email          = $this->_getParam('email');
            $modified_date = date('Y-m-d H:i:s',time());

            $oUserInfo = $oUserDao->get($id);
            $oUserInfo->setName($name);
            $oUserInfo->setRealame($realname);
            $oUserInfo->setEmail($email);
            $oUserInfo->setModifiedDate($modified_date);

            $oUserDao->modify($oUserInfo);

            $this->success ( '操作成功' );
        } catch ( Exception $e ) {
            $this->error ( '操作失败'.$e );
        }
    }

    /**
     * 删除数据操作，设置删除标志
     */
    function deleteAction() {
        try {
            $oUserInfo = User_UserDao::getInstance();
            $oUserInfo->delById($this->_getParam('id'));
            $this->success ( "操作成功" );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }

    /**
     * 强制删除数据操作
     */
    function foreverdeleteAction() {
        try {
            $oUserInfo = User_UserDao::getInstance();
            $oUserInfo->del($this->_getParam('id'));
            $this->success ( "操作成功" );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }


}
?>