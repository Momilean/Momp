<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class AdminController extends AuthController {
	//系统配置
	public function sys(){
		$sys=M('sys')->where(array('sys_id'=>1))->find();
		$this->assign('sys',$sys)->display();
		
	}
	public function runsys(){
		if(!IS_AJAX){
			$$this->error('提交方式不正确',0,0);
		}else{
			M('sys')->save($$_POST);
			$$this->success('站点设置成功',1,1)
		}
	}

}