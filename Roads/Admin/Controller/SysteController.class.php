<?php

namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

//权限控制类
class SysteController extends AuthController {
	//系统配置

	public function index(){
		echo "";
		$this->display();

	}
	// public function runsys(){
	// 	if(!IS_AJAX){
	// 		$$this->error('提交方式不正确',0,0);
	// 	}else{
	// 		M('sys')->save($$_POST);
	// 		$$this->success('站点设置成功',1,1);
	// 	}
	// }

}
