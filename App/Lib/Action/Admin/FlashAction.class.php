<?php
/**
 * 系统配置管理
 * Enter description here ...
 * @author Administrator
 *
 */
class FlashAction extends BaseAction {
    function __construct()
    {
    	parent::__construct('Flash','Flash');
    }
    function ajax_flash() {
    	$save=array('open'=>$_POST['open']);
		$where=array('id'=>$_POST['id']);
		M('flash')->where($where)->save($save);
	}
}