<?php
/**
 * Created by PhpStorm.
 * User: pyz31
 * Date: 16-2-27
 * Time: 16:37
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

//模型管理类
class ModelController extends AuthController{

    public function index(){
        $this->meta_title = '模型管理';
		$this->display ();
    }
}