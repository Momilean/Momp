<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

class UserController extends Controller {
    public function index(){
        
        if($_SESSION['sid']=null || $_SESSION['sid']='' ){
            $this->error("不是有效的凭据",U('Index/index'));
        }     
        else{
            $info = D('User')->getuserinfo();
            $this->assign('info',$info); 
            $data = I('POST.');
         }
            $nowtime = time(); //检测当前时间，90秒后登录锁定！
            $s_time = $_SESSION['roads']['logintime'];
            //var_dump($_SESSION['roads']['logintime']);
            if (($nowtime - $s_time) > 18000){
                unset($_SESSION['logintime']);
                $this->error('已超时锁定，请重新登录', U('Locksc/Index'));
            }else{
                $_SESSION['logintime'] = $nowtime;
            }
            $this->display();
    }

    //接受登录页面数据
    // public function register(){
    //     if($_POST){
    //         $data = I('POST.');
    //         if($data['userpasswd'] != $data ['userpasswd']){
    //          $this->show(D('Home/User')-> register($data));

    //     }else{
    //                 $this->display();
    //     }
        
    //     }
    // }
    //根据当前session并使用model提取用户信息
    // public function userinfo(){
    //     $info = D('User')->getuserinfo();
    //     $this->assign('info',$info);
    //     $this->display();
    //     }
        
    public function edit_pwd(){
        if(!empty($_POST)){
            $info = M('user');
            $where['id'] = session('sid');
            $where['password'] = md5(I('password'));
            $new_pwd = md5(I('new_pwd'));
            $data = $info->field('id')->where($where)->find();        
            if(empty($data)){
                $this->ajaxReturn(0);//原始密码验证错误
            }else{
                $result = $info->$where('id='.$where['id'])->data('password='.$new_pwd)->save();
                if($result){
                    session('sid',null);
                    session('sname',null);
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
    
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     1024*1024 ;//1M 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     'Public/'; // 设置附件上传根目录
        $upload->savePath  =     'Uploads/'; // 设置附件上传（子）目录
        $upload->saveRule = time().sprintf('%04s',mt_rand(0,1000));
        //上传文件 
        //$info   =   $upload->upload();
        if(!$upload->upload()) {// 上传错误提示错误信息
            $this->ajaxReturn($upload->getError());

        }else{// 上传成
        	 //$info =  $upload->$upload->upload();
        	 $info =  $upload->upload();
	         $imgurl = $info[0]['savename'];
                $arr =  array(
                'msg'=>'0000',
                'error'=>'', //返回错误
                'imgurl'=>$imgurl,//返回图片名
            );
              
            echo json_encode($arr);
exit;
             
        }
    }
    
}

