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
		
		$numPerPage = 20;
		$offset = 0;
		$pageNum = $_REQUEST ['pageNum'];
		if (! empty ( $pageNum ) && $pageNum > 0) {
			$offset = ($pageNum - 1) * $numPerPage;
		}
		
		$keywordsDao = new Keywords_KeywordsDao();
		$totalCount = $keywordsDao->getListAllCount()
		
		$this->view->list = $keywordsDao->getArrayList($numPerPage = 0, $offset = 0);//$model->fetchAll ( $where, $order, $numPerPage, $offset );
		$this->view->totalCount = $totalCount;
		$this->view->numPerPage = $numPerPage;
		$this->view->currentPage = $pageNum > 0 ? $pageNum : 1;
	
	}
}
?>