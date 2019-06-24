<?php

namespace Admin\Controller;
use Think\Controller;

//权限控制类
class IndexController extends Controller {
    public function index(){
        $this->redirect('/Home/Index', 0);
        exit();
    }
    
}
