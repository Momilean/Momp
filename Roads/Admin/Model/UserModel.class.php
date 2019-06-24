<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    
   

    
    public function login($id, $username){
        $array = array(
            'id' =>$id,
            'username'=>$username
        );
        try {
            session('username', $array);
            return true;
        } catch (Exception $e) {
            $this->error = '未知错误';
            return false;
        }

    }
    
 public function checkLogin($username, $password){
    $user = $this->where("username = '{$usrename}'")->find();
    if($user){
        if(password($password) == $user['password']){
            return $user['id'];
        }else{
            return -2;
        }
    }else{
        return -1;
    }
}

    
    public function getuserlist(){
        $page = I("p",1,"int");
//          return $this->order('entrdata DESC')->select();
        $data = $this->order('entrdata DESC')->page($page.',5')->select();
//        $this->assign('lists,$list'); // 赋值数据值
//        $count = $this->where('status=1')->count(); //查询满足条件的总记录数
        $count = $this->count();
        $page = new \Think\Page($count,5); //实例化分页类
       // $this->assign('page',$show);// 赋值分页输出
        $show = $page->show(); //分页输出
        return array('lists'=>$data,'page'=>$show);
        
        
    }  
        public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->success('上传成功！');
            }
        }

    
}