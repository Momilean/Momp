<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

//后台管理员
class AdminController extends AuthController {

 
	//用户列表
    public function admin_list(){
      $page = I("p",1,"int");
    	$m = M('User');
    	$field = 'id,username,entrdata,	entryip,regidata,status';
    	// page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    	$data = $m->field($field)->order('id ASC')->page($page.',8')->select();
    	$auth = new Auth();
    	foreach ($data as $k=>$v){
    		$group = $auth->getGroups($v['id']);
    		$data[$k]['group'] = $group[0]['title'];
    	}
    	$this->assign('userlist',$data);
    	//分页
    	$count = $m->count(id);		// 查询满足要求的总记录数
    	$page = new \Think\Page($count,8);		// 实例化分页类 传入总记录数和每页显示的记录数
    	$show = $page->show();		// 分页显示输出
    	$this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 总数输出
    	$this->display();
    }

    //检查账号是否已注册
    public function check_account(){
    	$m = M('user');
    	$where['username'] = I('username');	//账号
    	$data = $m->field('id')->where($where)->find();
    	if(empty($data)){
    		$this->ajaxReturn(0);   //不存在
    	}else{
    		$this->ajaxReturn(1);	//存在
    	}
    }

    //添加用户
    public function admin_add(){
    	if(!empty($_POST)){
    		$m = M('User');
            $data = array(
            'username'  =>  I('username'),
            'password'  =>  I('password','','md5'),
            );
    		$result = $m->field('username')->where($data)->find();
    		if(!empty($result)){
    			$this->ajaxReturn(0);  //用户名重复
    		}
    		//添加用户
    		$result['uid']  = $m->add($data);
    		$result['group_id'] = I('group_id');	//用户组ID
    		if($result['uid']){
    			$m = M('auth_group_access');
    			//分配用户组
    			if($m->add($result)){
    				$this->ajaxReturn(1);	//分配用户组成功
    			}else{
    				$this->ajaxReturn(2);	//分配用户组失败
    			}
    		}else{
    			$this->ajaxReturn(0);  //添加用户失败
    		}
    	}else{
    		$m = M('auth_group');
    		$data = $m->field('id,title')->select();
    		$this->assign('data',$data);
    		$this->display();
    	 }
    }

    //编辑
    public function admin_edit(){
    	if(!empty($_POST)){
    		//修改所属组
    		$access = M('auth_group_access');
    		if (empty($_POST['group_id'])){
    			$this->error('请选择用户组');
    		}
    		$result = $access->where('uid='.$_POST['id'])->find();
    		if(empty($result)){
    			$map['uid'] = $_POST['id'];
    			$map['group_id'] = $_POST['group_id'];
    			$access->add($map);
    		}else {
    			$save['group_id'] = $_POST['group_id'];
    			$access->where('uid='.$_POST['id'])->save($save);
    		}
    		$data['id'] = $_POST['id'];
    		$data['mobile'] = $_POST['mobile'];
    		$data['email'] = $_POST['email'];
    		if ($_POST['status'] >= 0){
    			$data['status'] = $_POST['status'];
    		}
    		$m = M('User');
    		$result = $m->where('id='.$data['id'])->save($data);
    		if ($result === false){
    			$this->error('修改失败');
    		}else{
    			$this->success('修改成功', U('admin_list'));
    		}
    	}else{
    		$m = M('User');
    		$result = $m->where('id='.I('id'))->find();
    		//获取当前所属组
    		$auth = new Auth();
    		$group = $auth->getGroups($result['id']);
    		$result['title'] = $group[0]['title'];
    		$result['group_id'] = $group[0]['group_id'];
    		$this->assign('vo',$result);
    		//获取所有组
    		$m = M('auth_group');
    		$group = $m->order('id DESC')->select();
    		$this->assign('group',$group);
    		$this->display();
            //var_dump($_SESSION);测试成功
    	}
    }

    //删除用户
    public function admin_del(){
     	$id = $_POST['id'];		//用户ID
    	if($id == 10){
    		$this->ajaxReturn(2);	//不允许删除超级管理员
    	}
    	$m = M('auth_group_access');
    	$m->where('uid='.$id)->delete();   //删除权限表里面给的权限

    	$m = M('user');
    	$result = $m->where('id='.$id)->delete();
    	if ($result){
    		$this->ajaxReturn(1);	//成功
    	}else {
    		$this->ajaxReturn(0);	//删除失败
    	}
    }

    //角色-组
    public function auth_group(){
    	$m = M('auth_group');
    	$data = $m->order('id ASC')->select();
    	$this->assign('data',$data);
    	$this->display();
    }

    //添加组
    public function group_add(){
    	if(!empty($_POST)){
    		$data['rules'] = I('rules');
    		if(empty($data['rules'])){
    			$this->error('权限不能为空');
    		}
    		$m = M('auth_group');
    		$data['title'] = I('title');
    		$data['rules'] = implode(',', $data['rules']);
    		if($m->add($data)){
    			$this->success('添加成功',U('Admin/auth_group'));
    		}else{
    			$this->error('添加失败');
    		}
    	}else{
    		$m = M('auth_rule');
	    	$data = $m->field('id,name,title')->where('pid=0')->select();
	    	foreach ($data as $k=>$v){
	    		$data[$k]['sub'] = $m->field('id,name,title')->where('pid='.$v['id'])->select();
	    	}
	    	$this->assign('data',$data);	// 顶级
    		$this->display();
    	}
    }

    //编辑组
    public function group_edit(){
    	$m = M('auth_group');
    	if(!empty($_POST)){
    		$data['id'] = I('id');
    		$data['title'] = I('title');
    		$data['rules'] = implode(',', I('rules'));
    		if($m->save($data)){
    			$this->success('修改成功');
    		}else{
    			$this->error('修改失败');
    		}
    	}else{
    		$where['id'] = I('id');	//组ID
    		$reuslt = $m->field('id,title,rules')->where($where)->find();
    		$reuslt['rules'] = ','.$reuslt['rules'].',';
    		$this->assign('reuslt',$reuslt);

     		$m = M('auth_rule');
    		$data = $m->field('id,title')->where('pid = 0')->select();
    		$arr = array();
    		foreach ($data as $k => $v){
    			$data[$k]['sub'] = $m->field('id,title')->where('pid ='.$v['id'])->select();
    		}
			
    		$this->assign('data',$data);
    		$this->display();
			dump($data);
    	}
    }

    //删除组
    public function group_del(){
    	$where['id'] = I('id');
    	$m = M('auth_group');
    	if($m->where($where)->delete()){
    		$this->ajaxReturn(1);
    	}else{
    		$this->ajaxReturn(0);
    	}
    }

    //权限列表
    public function auth_rule(){
    	if(!empty($_POST)){
    		$m = M('auth_rule');
    		$data['id'] = '';
    		$data['name'] = I('name');
    		$data['title'] = I('title');
    		$data['pid'] = I('pid');
    		$data['status'] = I('status');
    		$data['create_time'] = time();
    		if($m->add($data)){
    			$this->success('添加成功');	//成功
    		}else{
    			$this->success('添加失败');	//失败
    		}
    	}else{
    		$m = M('auth_rule');
    		$field = 'id,name,title,create_time,status,sort';
	    	$data = $m->field($field)->where('pid=0')->select();
	    	foreach ($data as $k=>$v){
	    		$data[$k][''] = $m->field($field)->where('pid='.$v['id'])->select();

	    	}
	    	$this->assign('data',$data);	// 顶级
	    	$this->display();
    	}
    }

    //  public function admin_rule(){
    // 	$nav = new \Org\Util\Leftnav;
    // 	$admin_rule=M('auth_rule')->order('sort')->select();
    // 	$arr = $nav::rule($admin_rule);
	//    	$this->assign('admin_rule',$arr);//权限列表
    // 	$this->display();
    // }
    public function admin_state(){
    	$id=I('x');
    	$statusone=M('User')->where(array('id'=>$id))->getField('status');//判断当前状态情况
    	if($statusone==1){
    		$statedata = array('status'=>0);
    		$auth_group=M('User')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态禁止',1,1);
    	}else{
    		$statedata = array('status'=>1);
    		$auth_group=M('User')->where(array('id'=>$id))->setField($statedata);
    		$this->success('状态开启',1,1);
    	}
    }

   public function auth_rule_edit(){
    	$admin_rule=M('auth_rule')->where(array('id'=>I('id')))->find();
    	$this->assign('rule',$admin_rule);
    	$this->display();
    }

    public function auth_rule_runedit(){
        	if(!IS_POST){
    		$this->error('提交方式不正确',0,0);
    	}else{
    		$admin_rule=M('auth_rule');
    		$sldata=array(
    				'id'=>I('id'),
    				'name'=>I('name'),
    				'title'=>I('title'),
    				'status'=>I('status'),
    				'css'=>I('css'),
    				'sort'=>I('sort'),
    		);
    		$admin_rule->save($sldata);
    		$this->success('权限修改成功',U('auth_rule'),1);
    	}
    }


}
