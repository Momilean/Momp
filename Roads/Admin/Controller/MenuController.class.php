<?php

namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Auth;

/** 后台配置控制器 **/
class MenuController extends AuthController {

    //后台菜单
    public function index(){
        $pid  = I('get.pid',0);
        if($pid){
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data',$data);
        }
        $title      =   trim(I('get.title'));
        $type       =   C('CONFIG_GROUP_LIST');
        $all_menu   =   M('Menu')->getField('id,title');
        $map['pid'] =   $pid;
        if($title)
        $map['title'] = array('like',"%{$title}%");
        $list       =   M("Menu")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,array('hide'=>array(1=>'是',0=>'否'),'is_dev'=>array(1=>'是',0=>'否')));
        if($list) {
            foreach($list as &$key){
                if($key['pid']){
                    $key['up_title'] = $all_menu[$key['pid']];
                }
            }
            $this->assign('list',$list);
        }
        $this->meta_title = '菜单列表';
        $this->display();
    }

    /**
     * 新增菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function add(){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                $id = $Menu->add();
                if($id){
                    // S('DB_CONFIG_DATA',null);
                    //记录行为
                    //action_log('update_menu', 'Menu', $id, UID);
                    $this->success('新增成功', Cookie('__forward__'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $this->assign('info',array('pid'=>I('pid')));
            $menus = M('Menu')->field(true)->select();
            $menus = D('Tree')->toFormatTree($menus);//这引用了Tree模型来控制分组和格式
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            $this->meta_title = '新增菜单';
            $this->display('edit');
        }
    }

    /**
     * 编辑配置
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function edit($id = 0){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    // S('DB_CONFIG_DATA',null);
                    //记录行为
                    //action_log('update_menu', 'Menu', $data['id'], UID);
                    $this->success('更新成功','/Admin/Menu/index');
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Menu')->field(true)->find($id);
            $menus = M('Menu')->field(true)->select();
            $menus = D('Tree')->toFormatTree($menus); //这引用了Tree模型来控制分组和格式
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑后台菜单';
            $this->display();
        }
    }

    /**
     * 删除后台菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Menu')->where($map)->delete()){
            // S('DB_CONFIG_DATA',null);
            //记录行为
            action_log('update_menu', 'Menu', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    public function toogleHide($id,$value = 1){
        $this->editRow('Menu', array('hide'=>$value), array('id'=>$id));
    }

    public function toogleDev($id,$value = 1){
        $this->editRow('Menu', array('is_dev'=>$value), array('id'=>$id));
    }

    /**
     * 菜单排序
     * @author huajie <banhuajie@163.com>
     */
    public function sort(){
        if(IS_GET){
            $ids = I('get.ids');
            $pid = I('get.pid');

            //获取排序的数据
            $map = array('status'=>array('gt',-1));
            if(!empty($ids)){
                $map['id'] = array('in',$ids);
            }else{
                if($pid !== ''){
                    $map['pid'] = $pid;
                }
            }
            $list = M('Menu')->where($map)->field('id,title')->order('sort asc,id asc')->select();

            $this->assign('list', $list);
            $this->meta_title = '菜单排序';
            $this->display();
        }elseif (IS_POST){
            $ids = I('post.ids');
            $ids = explode(',', $ids);
            foreach ($ids as $key=>$value){
                $res = M('Menu')->where(array('id'=>$value))->setField('sort', $key+1);
            }
            if($res !== false){
                $this->success('排序成功！');
            }else{
                $this->eorror('排序失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }



}
