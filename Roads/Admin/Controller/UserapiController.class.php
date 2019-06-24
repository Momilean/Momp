<?php
namespace Admin\Controller;
use Think\Controller;

 
class UserapiController extends Controller{
    //登录页面
    public function userck(){
		$m = M('auth_rule');
		$field = 'id,name,title';
	    // $data = $m->field($field)->where('id=0 AND status=1')->select();	   
     	// var_dump($data);
    	 
    }
}