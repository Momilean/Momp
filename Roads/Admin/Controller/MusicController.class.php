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

//权限控制类
 

class MusicController extends  AuthController {

    public function index(){
        $this->assign('__MENU__', $this->getMenus());
        $this->meta_title = '歌曲';
        $this->display();
    }
    public function demo(){
        
    }
}