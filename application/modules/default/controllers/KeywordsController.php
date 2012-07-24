<?php
class Default_KeywordsController extends Dwz_Controller_Action {
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

        $oKeywordsDao = Keywords_KeywordsDao::getInstance();
        $totalCount = $oKeywordsDao->getListAllCount();

        $this->view->list = $oKeywordsDao->getList($numPerPage, $offset);
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
        $oKeywordsDao = Keywords_KeywordsDao::getInstance();
        $this->view->vo = $oKeywordsDao->get($this->_getParam('id'));
    }

    /**
     * 创建数据操作
     */
    function insertAction() {
        try {
            $oKeywordsDao = Keywords_KeywordsDao::getInstance();
            $property['code']          = $this->_getParam('code');
            $property['name']          = $this->_getParam('name');
            $property['type']          = $this->_getParam('type');
            $property['status']        = '1';//状态:1-活动 2-暂停使用
            $property['parent_id']     = 0;//上级关联标签
            $property['description']   = $this->_getParam('description');//描述
            $property['is_delete']     = 0;//0:未删除 1:已删除
            $property['created_date']  = date('Y-m-d H:i:s',time());
            $property['created_user']  = '';//
            $property['modified_date'] = date('Y-m-d H:i:s',time());
            $property['modified_user'] = '';//

            $oKeywordsInfo = new Keywords_KeywordsInfo($property);

            $id = $oKeywordsDao->add($oKeywordsInfo);
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
            $oKeywordsDao = Keywords_KeywordsDao::getInstance();

            $id            = $this->_getParam('id');
            $code          = $this->_getParam('code');
            $name          = $this->_getParam('name');
            $type          = $this->_getParam('type');
            $description   = $this->_getParam('description');//描述
            $modified_date = date('Y-m-d H:i:s',time());

            $oKeywordsInfo = $oKeywordsDao->get($id);
            $oKeywordsInfo->setCode($code);
            $oKeywordsInfo->setName($name);
            $oKeywordsInfo->setType($type);
            $oKeywordsInfo->setDescription($description);
            $oKeywordsInfo->setModifiedDate($modified_date);

            $oKeywordsDao->modify($oKeywordsInfo);

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
            $oKeywordsDao = Keywords_KeywordsDao::getInstance();
            $oKeywordsDao->delById($this->_getParam('id'));
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
            $oKeywordsDao = Keywords_KeywordsDao::getInstance();
            $oKeywordsDao->del($this->_getParam('id'));
            $this->success ( "操作成功" );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }


}
?>