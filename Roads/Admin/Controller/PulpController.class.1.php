<?php

namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

//权限控制类
class PulpController extends AuthController {

	//首页
	public function index(){
		$this->assign('__MENU__', $this->getMenus());
		$info = $this->getIp();


		$this->display();

	}

    //退出登录
    public function logout(){
    	session('sid',null);	//注销 uid ，account
    	session('sname',null);
    	$this->success('退出登录成功',U('Public/login'));
    }

		//清除缓存
    public function clear_cache(){
    	$str = I('clear');	//防止搜索到第一个位置为0的情况

    	if($str){
			//strpos 参数必须加引号
    		//删除Runtime/Cache/admin目录下面的编译文件
    		if(strpos("'".$str."'", '1')){
    			$dir = APP_PATH.'Runtime/Cache/Admin/';
    			$this->delDirAndFile($dir);
    		}
    		//删除Runtime/Cache/Home目录下面的编译文件
    		if(strpos("'".$str."'", '2')){
    			$dir = APP_PATH.'Runtime/Cache/Home/';
    			$this->delDirAndFile($dir);
    		}
    		//删除Runtime/Data/目录下面的编译文件
    		if(strpos("'".$str."'", '3')){
    			$dir = APP_PATH.'Runtime/Data/';
    			$this->delDirAndFile($dir);
    		}
    		//删除Runtime/Temp/目录下面的编译文件
    		if(strpos("'".$str."'", '4')){
    			$dir = APP_PATH.'Runtime/Temp/';
    			$this->delDirAndFile($dir);
    		}
    		$this->ajaxReturn(1);	//成功
    	}else{
    		$this->display();
    	}
    }
		 //循环删除目录和文件函数
		function delDirAndFile($dirName){
			if ( $handle = opendir( "$dirName" ) ) {
				while ( false !== ( $item = readdir( $handle ) ) ) {
					if ( $item != "." && $item != ".." ) {
						if ( is_dir( "$dirName/$item" ) ) {
							delDirAndFile( "$dirName/$item" );
						} else {
							unlink( "$dirName/$item" );
						}
					}
				}
				closedir( $handle );
				if( rmdir( $dirName ) ) return true;
			}
		}
	//修改密码
	public function edit_pwd(){
		if(!empty($_POST)){
			$m = M('user');
			$where['id'] = session('sid');
			$where['password'] = md5(I('old_pwd'));
			$new_pwd = md5(I('new_pwd'));
			$data = $m->field('id')->where($where)->find();
			if(empty($data)){
				$this->ajaxReturn(0);	//失败，原密码错误
			}else{
				$result = $m->where('id='.$where['id'])->data('password='.$new_pwd)->save();
				if($result){
					session('sid',null);
					session('sname',null);
					$this->ajaxReturn(1);	//修改成功
				}else{
					$this->ajaxReturn(2);	//更新失败
				}
			}
		}else{
			$this->display();
		}
	}


	// 获取ip地址
	function getIp($ip,$newIp){
		if(!isset($newIp)){
			$newIp = new \Org\Util\IP();
		}
		if($ip=='127.0.0.1'){
			$ads = "本机地址";
		}else{
			$tmp = $newIp->find($ip);
			if($tmp[1]==$tmp[2]){
				$ads = $tmp[1];
			}elseif($tmp[3]==''){
				$ads = $tmp[1].'省'.$tmp[2].'市';
			}else{
				$ads = $tmp[1].'省'.$tmp[2].'市'.$tmp[3];
			}
		}
		return $ads;
	}


}
