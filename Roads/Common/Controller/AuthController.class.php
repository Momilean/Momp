<?php
/*
 * @如果需要公共控制器，就不要继承AuthController，直接继承Controller
 */
namespace Common\Controller;
use Think\Controller;
use Think\Auth;
use Think\Model;

//权限认证
class AuthController extends Controller {
	protected function _initialize(){
		/* 读取数据库中的配置 */
		$config =   S('DB_CONFIG_DATA');
		$config =   api('Config/lists');
		S('DB_CONFIG_DATA',$config);
		C($config); //添加配置
		//菜单标签引用
		$this->assign('__MENU__', $this->getMenus());

		//session不存在时，不允许直接访问
		if(!session('sid')){
			$this->error('还没有登录，正在跳转到登录页',U('Mom/illian'));
		}
		//session存在时，不需要验证的权限
		$not_check = array(
			// 'Admin/Admin','Admin/Pulp','Pulp/Index','Pulp/index',
			// 'Index/edit_pwd','Index/logout','Admin/admin_list',
			// 'Admin/admin_list','Admin/admin_edit','Admin/admin_add','Admin/check_account','Admin/admin_del',
            // 'Admin/auth_group','Admin/group_edit','Admin/auth_rule','Admin/admin_rule_add','Admin/admin_rule_state',
            // 'Admin/auth_rule_edit','Admin/auth_rule_runedit','pulp/delDirAndFile',
			// 			'Menu/add','Menu/edit','Menu/del',
					);

		//当前操作的请求                 模块名/方法名
		if(in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $not_check)){
			return true;
		}

		//下面代码动态判断权限
		$auth = new Auth();
		if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,session('sid')) && session('sid') != 10){
			$this->error('无效权限',  U('Home/User/index'));
		}

	}

	/**
	 * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
	 * @author 朱亚杰  <xcoolcc@gmail.com>
	 */
 // public function getMenus($controller=CONTROLLER_NAME){
 // 				// 获取主菜单
 // 				$where['pid']   =   0;
 // 				$where['hide']  =   1;
 // 				$menus['main']  =   M('Menu')->where($where)->order('sort asc')->select();
 // 				$menus['child'] = array(); //设置子节点
 // 				//高亮主菜单
 // 				$current = M('Menu')->where("url like '%{$controller}/".ACTION_NAME."%'")->field('id')->find();
 // 				if($current){
 // 						$nav = D('Menu')->getPath($current['id']);
 // 						$nav_first_title = $nav[0]['title'];
 // 						foreach ($menus['main'] as $key => $item) {
 // 								if (!is_array($item) || empty($item['title']) || empty($item['url']) ) {
 // 										$this->error('控制器基类$menus属性元素配置有误');
 // 								}
 // 								if( stripos($item['url'],MODULE_NAME)!==0 ){
 // 										$item['url'] = MODULE_NAME.'/'.$item['url'];
 // 								}
 // 								// 获取当前主菜单的子菜单项
 // 								if($item['title'] == $nav_first_title){
 // 										$menus['main'][$key]['class']='current';
 // 										//生成child树
 // 										$groups = M('Menu')->where("pid = {$item['id']}")->distinct(true)->field("`group`")->select();
 // 										if($groups){
 // 												$groups = array_column($groups, 'group');
 // 										}else{
 // 												$groups =   array();
 // 										}
 // 										//获取二级分类的合法url
 // 										$where          =   array();
 // 										$where['pid']   =   $item['id'];
 // 										$where['hide']  =   0;
 // 										$second_urls = M('Menu')->where($where)->getField('id,url');
 //
 // 										// 按照分组生成子菜单树
 // 										foreach ($groups as $g) {
 // 												$map = array('group'=>$g);
 // 												if(isset($to_check_urls)){
 // 														if(empty($to_check_urls)){
 // 																// 没有任何权限
 // 																continue;
 // 														}else{
 // 																$map['url'] = array('in', $to_check_urls);
 // 														}
 // 												}
 // 												$map['pid'] =   $item['id'];
 // 												$map['hide']    =   0;
 //
 // 												$menuList = M('Menu')->where($map)->field('id,pid,title,url,tip')->order('sort asc')->select();
 // 												$menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
 // 										}
 // 										if($menus['child'] === array()){
 // 												//$this->error('主菜单下缺少子菜单，请去系统=》后台菜单管理里添加');
 // 										}
 // 								}
 // 						}
 // 				}
 // 		return $menus;
 // }
 final public function getMenus($controller=CONTROLLER_NAME){
	 // $menus  =   session('ADMIN_MENU_LIST'.$controller);
	 if(empty($menus)){
		 // 获取主菜单
		 $where['pid']   =   0;
		 //$where['hide']  =   0;

		 $menus['main']  =   M('Menu')->where($where)->order('sort asc')->select();

		 $menus['child'] = array(); //设置子节点

		 //高亮主菜单
		 $current = M('Menu')->where("url like '%{$controller}/".ACTION_NAME."%'")->field('id')->find();
		 if($current){
			 $nav = D('Menu')->getPath($current['id']);
			 $nav_first_title = $nav[0]['title'];

			 foreach ($menus['main'] as $key => $item) {
				 if (!is_array($item) || empty($item['title']) || empty($item['url']) ) {
					 $this->error('控制器基类$menus属性元素配置有误');
				 }
				 if( stripos($item['url'],MODULE_NAME)!==0 ){
					 $item['url'] = MODULE_NAME.'/'.$item['url'];
				 }
				//  // 判断主菜单权限
				//  if ( !IS_ROOT && !$this->checkRule($item['url'],AuthRuleModel::RULE_MAIN,null) ) {
				// 	 unset($menus['main'][$key]);
				// 	 continue;//继续循环
				//  }

				 // 获取当前主菜单的子菜单项
				 if($item['title'] == $nav_first_title){
					 $menus['main'][$key]['class']='current';
					 //生成child树
					 $groups = M('Menu')->where("pid = {$item['id']}")->distinct(true)->field("`group`")->select();
					 if($groups){
						 $groups = array_column($groups, 'group');
					 }else{
						 $groups =   array();
					 }

					 //获取二级分类的合法url
					 //$where          =   array();
					 $where['pid']   =   $item['id'];
					 //$where['hide']  =   0;

					 $second_urls = M('Menu')->where($where)->getField('id,url');

					//  if(!IS_ROOT){
					// 	 // 检测菜单权限
					// 	 $to_check_urls = array();
					// 	 foreach ($second_urls as $key=>$to_check_url) {
					// 		 if( stripos($to_check_url,MODULE_NAME)!==0 ){
					// 			 $rule = MODULE_NAME.'/'.$to_check_url;
					// 		 }else{
					// 			 $rule = $to_check_url;
					// 		 }
					// 		 if($this->checkRule($rule, AuthRuleModel::RULE_URL,null))
					// 			 $to_check_urls[] = $to_check_url;
					// 	 }
					//  }
					 // 按照分组生成子菜单树
					 foreach ($groups as $g) {
						 $map = array('group'=>$g);
						//  if(isset($to_check_urls)){
						// 	 if(empty($to_check_urls)){
						// 		 // 没有任何权限
						// 		 continue;
						// 	 }else{
						// 		 $map['url'] = array('in', $to_check_urls);
						// 	 }
						//  }
						 $map['pid'] =   $item['id'];
						//  $map['hide']    =   0;
						//  if(!C('DEVELOP_MODE')){ // 是否开发者模式
						// 	 $map['is_dev']  =   0;
						//  }
						 $menuList = M('Menu')->where($map)->field('id,pid,title,url,tip')->order('sort asc')->select();
						 $menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
					 }
					 if($menus['child'] === array()){
						 //$this->error('主菜单下缺少子菜单，请去系统=》后台菜单管理里添加');
					 }
				 }
			 }
		 }
		 // session('ADMIN_MENU_LIST'.$controller,$menus);
	 }
	 return $menus;
 }
	/**
		* 返回后台节点数据
		* @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
		* @retrun array
		*
		* 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
		*
		* @author 朱亚杰 <xcoolcc@gmail.com>
		*/
	 final protected function returnNodes($tree = true){
			 static $tree_nodes = array();
			 if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
					 return $tree_nodes[$tree];
			 }
			 if((int)$tree){
					 $list = M('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();
					 foreach ($list as $key => $value) {
							 if( stripos($value['url'],MODULE_NAME)!==0 ){
									 $list[$key]['url'] = MODULE_NAME.'/'.$value['url'];
							 }
					 }
					 $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
					 foreach ($nodes as $key => $value) {
							 if(!empty($value['operator'])){
									 $nodes[$key]['child'] = $value['operator'];
									 unset($nodes[$key]['operator']);
							 }
					 }
			 }else{
					 $nodes = M('Menu')->field('title,url,tip,pid')->order('sort asc')->select();
					 foreach ($nodes as $key => $value) {
							 if( stripos($value['url'],MODULE_NAME)!==0 ){
									 $nodes[$key]['url'] = MODULE_NAME.'/'.$value['url'];
							 }
					 }
			 }
			 $tree_nodes[(int)$tree]   = $nodes;
			 return $nodes;
	 }


	     /**
	      * 通用分页列表数据集获取方法
	      *
	      *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
	      *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
	      *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
	      *
	      * @param sting|Model  $model   模型名或模型实例
	      * @param array        $where   where查询条件(优先级: $where>$_REQUEST>模型设定)
	      * @param array|string $order   排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
	      *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
	      *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
	      *
	      * @param array        $base    基本的查询条件
	      * @param boolean      $field   单表模型用不到该参数,要用在多表join时为field()方法指定参数
	      * @author 朱亚杰 <xcoolcc@gmail.com>
	      *
	      * @return array|false
	      * 返回数据集
	      */
	     protected function lists ($model,$where=array(),$order='',$base = array('status'=>array('egt',0)),$field=true){
	         $options    =   array();
	         $REQUEST    =   (array)I('request.');
	         if(is_string($model)){
	             $model  =   M($model);
	         }

	         $OPT        =   new \ReflectionProperty($model,'options');
	         $OPT->setAccessible(true);

	         $pk         =   $model->getPk();
	         if($order===null){
	             //order置空
	         }else if ( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ) {
	             $options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
	         }elseif( $order==='' && empty($options['order']) && !empty($pk) ){
	             $options['order'] = $pk.' desc';
	         }elseif($order){
	             $options['order'] = $order;
	         }
	         unset($REQUEST['_order'],$REQUEST['_field']);

	         $options['where'] = array_filter(array_merge( (array)$base, /*$REQUEST,*/ (array)$where ),function($val){
	             if($val===''||$val===null){
	                 return false;
	             }else{
	                 return true;
	             }
	         });
	         if( empty($options['where'])){
	             unset($options['where']);
	         }
	         $options      =   array_merge( (array)$OPT->getValue($model), $options );
	         $total        =   $model->where($options['where'])->count();

	         if( isset($REQUEST['r']) ){
	             $listRows = (int)$REQUEST['r'];
	         }else{
	             $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
	         }
	         $page = new \Think\Page($total, $listRows, $REQUEST);
	         if($total>$listRows){
	             $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
	         }
	         $p =$page->show();
	         $this->assign('_page', $p? $p: '');
	         $this->assign('_total',$total);
	         $options['limit'] = $page->firstRow.','.$page->listRows;
	         $model->setProperty('options',$options);
	         return $model->field($field)->select();
	     }





}
