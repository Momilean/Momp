<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class LoginController extends Controller {
    public function index(){
        
       
        $this->redirect("Index/index"); 
        // 中止执行  避免出错后继续执行
        exit ;
        
    }
    public function verify(){   	
    	ob_clean();		//清除缓存
    	$verify = new \Think\Verify();
    	$verify->fontSize = 30;	//验证码字体大小
    	$verify->length = 4;	//验证码位数
        $verify->useImgBg = FALSE;
         $verify->useNoise = false;
        $verify->codeSet = '0123456789'; 
    	$verify->entry(1);
        
    }
    

    //登录验证
    public function login(){
                   
       if(!empty($_POST)) { 
        $road = array(
            'username'  =>  I('ajaxu'),
            'password'  =>  I('ajaxp','','md5'),
        );
        $verify = I('post.scode','');
        if(check_code($verify)){ //公共方法检查验证码
            $m = M('user');
            $res = $m->field('id,username,nickname,entryip,userphoto,login_count,status')->where($road)->find();
            if($res){
                if($res['status'] == 0){
                    $this->error('账户状态异常，请联系管理员！',U('Home/User/index'));
                }
                session(null);
                session('sid',$res['id']);
                session('sname',$res['username']);
                session('sniname',$res['nickname']);
                session('logo',$res['userphoto']);
                session('logintime',time());
                //验证和模型if检查后登录，状态
                //保存登录信息
    			$data['id'] = $res['id'];	//用户ID	
                $data['entryip'] = get_client_ip(); //最后登录IP
                $data['entrdata'] = time(); //最后登录时间
                $data['login_count'] = $res['login_count'] +1;
                $m->save($data); //更新数据           
                $this->success('凭据有效，登入成功',1,1);
            }else{
                $this->error('检查您的账户与密码!',0,0);
            }
             
        }else{
            $this->error('验证码无效！',0,0);
        }
        
        }else{
            if(session('sid')){
                $this->error('已登录！',U('Home/Index'));
            }else{     
               $this->redirect('You are not logged in！'); 
               exit();
            }
        }
       
    }   
    
  /* 用户注册 */
     public function register(){
         // 判断提交方式 做不同处理
         if (IS_Ajax) {
             $User = D("Login"); // 实例化User对象
             $data = $User->create(); //内存保存数据 
                if (!$User->create()){
                    // 如果创建失败 表示验证没有通过 输出错误提示信息
                    $this->ajaxReturn($User->getError());
                }else{ 
                    //将内存中的数据注册session
                    session('sname',$data['username']);     
                    session('sname',$data['username']); 
                    session('logo',$data['usersign']);
                    //add自动完成 
                    $User->add($data);
                    // 验证通过 可以进行其他数据操作
                    $this->success("<center><h3 style='color:red!important'>注册成功！3秒后跳转...</h3></center>",U('Index/index'));
            }    
        }
        $this->redirect("Home/Index/index"); 
        // 中止执行  避免出错后继续执行
        exit ;
     }
    
    //登出
    public function logout(){
        session('[destroy]'); // 销毁session
        session('sid',null);	//注销 uid ，account
        session('sname',null);  
	   $this->success('退出成功!',U('Home/Index/index'));
	}
    
}