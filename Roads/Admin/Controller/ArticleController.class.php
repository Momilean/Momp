<?php
/**
 * Created by PhpStorm.
 * User: pyz31
 * Date: 16-2-27
 * Time: 16:37
 */
namespace Admin\Controller;
use Common\Controller\AdminsController;
use Common\Controller\AuthController;



class ArticleController extends  AdminsController {

    public function index(){
        $this->display();
    }
}