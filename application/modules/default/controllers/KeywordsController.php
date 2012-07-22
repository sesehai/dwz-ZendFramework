<?php
class Default_KeywordsController extends Dwz_Controller_Action {
    public function init() {
        parent::init ();
    }

    /**
     * 数据列表展示页面
     */
    function indexAction() {
        if (! empty ( $_REQUEST ['orderField'] )) {
            $order = $_REQUEST ['orderField'];
            if (empty ( $_REQUEST ['orderDirection'] )) {
                $order .= ' asc';
            } else {
                $order .= ' ' . $_REQUEST ['orderDirection'];
            }
        }

        $numPerPage = 10;
        $offset = 0;
        $pageNum = $_REQUEST ['pageNum'];
        if (! empty ( $pageNum ) && $pageNum > 0) {
            $offset = ($pageNum - 1) * $numPerPage;
        }

        $keywordsDao = Keywords_KeywordsDao::getInstance();
        $totalCount = $keywordsDao->getListAllCount();

        $this->view->list = $keywordsDao->getList($numPerPage, $offset);
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
        $keywordsDao = Keywords_KeywordsDao::getInstance();
        $this->view->vo = $keywordsDao->get($_REQUEST ['id']);
    }

    /**
     * 创建数据操作
     */
    function insertAction() {
        try {
            $keywordsDao = Keywords_KeywordsDao::getInstance();
            $dbMap = $this->_dbMap ( $model->info ( 'cols' ) );
            $id = $keywordsDao->add($oKeywordsInfo);
            $this->success ( '操作成功' );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }

    /**
     * 更新数据操作
     */
    function updateAction() {
        try {
            $keywordsDao = Keywords_KeywordsDao::getInstance();

            $keywordsDao->modify($keywordsInfo);

            $this->success ( '操作成功' );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }

    /**
     * 删除数据操作，设置删除标志
     */
    function deleteAction() {
        try {
            $model = $this->M ();
            $db = $model->getAdapter ();

            $where = $db->quoteInto ( 'id=?', $_REQUEST ['id'] );
            $row_affected = $model->update ( array ('is_delete' => 1 ), $where );

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
            $model = $this->M ();
            $db = $model->getAdapter ();
            $where = $db->quoteInto ( 'id=?', $_REQUEST ['id'] );
            $row_affected = $model->delete ( $where );
            $this->success ( "操作成功" );
        } catch ( Exception $e ) {
            $this->error ( '操作失败' );
        }
    }

    private function M() {
        $className = ucfirst ( $this->_request->getControllerName () ) . 'Model';
        return new $className ();
    }

}
?>