<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
	public function index(){
		header("Location:lists");
		 
	}
    
    public function login(){

             if(IS_POST){ //登录验证
           $username = I('post.username');
            $password = I('post.password');
//              dump ($user);
//                 die;
            $user = D('User');
                    
            $id = $user->checkLogin($username, $password);
//            dump ($user);
            if(0 < $id){
                //登录用户
                if($user->login($id, $username)){
                    $this->success('登录成功！',U('/Home'));
                } else {
                    $this->error($user->getError());
                }

            } else { //登录失败
                switch($id) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else { //显示登录表单
            $this->display();
        }
    
    }
    
	public function lists(){
        // 列表犯法
	    $user_list = D('User')->getUserlist();
        //使用大U方法
        $this->assign('user_list',$user_list);
       // $lits = assign('user_list',$user_list);
		$this->display();
        //dump($user_list);
	}
    public function edit(){
        if(IS_POST){
            $data = array();
            $data['username'] = I("username","");
            $data['password'] = I("password","");
            $uid = I("get.id",0 ,"int");
            M("user")->where("id ='{$uid}'")->save($data);
            header("location:".U("User/lists"));
        }else{
            $uid= I("id", 0 ,'int');
            $user_info= M("user")->where("id = '$uid'")->find();
            //dump ($user_info); dump测试
            $this->assign("user_info",$user_info);
            $this->display();
        }
        
    }
    public function delete(){
        $uid = I("id",0,"int");
        M("User")->where("id ='{$uid}'")->delete();
        header("location:".U("User/lists"));
    }
}
