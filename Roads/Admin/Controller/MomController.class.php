<?php
namespace Admin\Controller;
use Think\Controller;


class MomController extends Controller{
    //登录页面
    public function index(){
        header("Location: Mom/illian"); //调用下面的方法
        exit();
        //$this->display();
    }

    public function verify(){
    	ob_clean();		//清除缓存
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 20;	//验证码字体大小
    	$Verify->length = 4;	//验证码位数
       // $Verify->imageH = 40;
        //$Verify->imagew = 60;
        $Verify->codeSet = '0123456789';
    	$Verify->entry();
    }

    // // check_verify方法检测输入的验证码是否正确，$code为用户输入的验证码字符串
      function check_verify(){
            ob_clean();		//清除缓存
            $code = I('code'); //获取验证码字符串
            $verify = new \Think\Verify();
            return $verify->check($code);
            }

    //登录验证
    public function illian(){
    	if(!empty($_POST)){
    		$pt['username'] = I('ajaxu');   //用户名
    		$pt['password'] = md5(I('ajaxp'));	//密码

    		$m = M('user');
    		$result = $m->field('id,username,userphoto,nickname,login_count,status')->where($pt)->find();
    		if($result){
    			if($result['status'] == 0){
    				$this->error('登录失败，账号被禁用',U('Home/Index/index'));
    			}
            session(null); // 清空当前的session
      		session('sid',$result['id']);	//管理员ID
            session('sname',$result['username']);
            session('sniname',$result['nickname']);
            session('logo',$result['userphoto']);
            session('logintime',time());
    			//保存登录信息
    			$data['id'] = $result['id'];	//用户ID
    			$data['entryip'] = get_client_ip();	//最后登录IP
    			$data['entrdata'] = time();		//最后登录时间
    			$data['login_count'] = $result['login_count'] + 1;
    			$m->save($data);
    			$this->success('验证成功，正在跳转到首页',U('Pulp/Index'));
                $success = true;
    				}else{
    			$this->error('账户或密码错误',U('Pulp/Index'));
    		}
    	}else{
    		if(session('sid')){
    			$this->success('已登录，正在跳转到主页',U('Pulp/Index'));
    		}
        $this->display();
    	}
    }
//    public function checkLogin(){
//
//            $username = I("username");
//            $password = md5(I("password"));
//            //$code=$this->check_verify();
//            $verify = new \Think\Verify();
//            if($this->check_verify()){
//                $user = M("User"); // 实例化User对象
//                $users=$user->where("username = '{$username}'")->find();
////                $m=M("user");
////                $result=$m->where($where)->find();
//                $user=null;
//                $verify=null;
//
//            if($users){
//                    session('username',$users['username']);
//                    session('uid',$users['uid']);
//
//// 检测session 是否赋值和获取
////                $value = session('name');
////                $value = session();
////                dump($value);
////                dump($users);
////                dump($_SESSION['usernames']);
//
//
//                    $this->success('登录成功!',U('Admin/Index/index'));
//                }else{
//                    $this->error('账号或密码错误!',U('Admin/Login/index'));
//                    }
//                }else{
//                    $this->error('验证码错误!',U('Home/Index/index'));
//                }
//    }

    //退出
	public function logout(){
		// unset($_SESSION['username']);
		// unset($_SESSION['aid']);
       session('[destroy]');
       session('sid',null);	//注销 uid ，account
       session('sname',null);
       $this->success('退出成功!',U('Home/Index/index'));
	}

}
