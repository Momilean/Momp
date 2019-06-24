<?php
namespace Home\Controller;
use Think\Controller;
class UserinfoController extends Controller {
    public function index(){
        // header('Localhost'.edit_pwd);
        $this->display();         
    }
    //修改密码
    public function edit_pwd(){
        if(!empty($_POST)){
            $info = M('user');
            $where['id'] = session('sid');
            $where['password'] = md5(I('password'));
            $new_pwd = md5(I('new_pwd'));
            $data = $info->field('id')->where($where)->find();
              var_dump($data);
              die;
            if(empty($data)){
                $this->ajaxReturn(0);//原始密码验证错误
            }else{
                $result = $info->$where('id='.$where['id'])->data('password='.$new_pwd)->save();
                if($result){
                    session('sid',NULL);
                    session('sname',Null);
                    session(null); 
                    $this->ajaxReturn(1);// 修改成功
                }else{
                    $this->ajaxReturn(2);// 更新失败
                }
            }
        }else{
            $this->display();
          
        }
    }
 
    
}
