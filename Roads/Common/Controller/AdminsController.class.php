<?php
/**
 * Created by PhpStorm.
 * User: pyz31
 * Date: 16-2-27
 * Time: 15:31
 */

/*权限认证，及公用方法*/

namespace Common\Controller;
use Think\Controller;
use Think\Auth;
use Think\Model;


class AdminsController extends Controller {
    /**
     *
     */
    public function _initialize(){
        if(session('sid')){



            $id = session('sid');
            $user = M('user');

            $users=$user->where('id='.$id)->find();
            if(!$this->check_login($id)){
                    $this->error("无法验证有效凭据！");
                exit();
            }
// //            $rule = MODULE_NAME.CONTROLLER_NAME.ACTION_NAME;
//              dump($users);

//             var_dump($this->admin_menu_cache());
            $this->assign('admin',$users);

        }else{
            if(!session('sid')){
                $this->error("无效凭据的访问!", U("admin/index"));
            }else{
                header("Location:".U("admin/index"));
                exit();
            }
        }
    }

    //获取菜单
    public function admin_menu(){
        $menu = F('Menu');
        if('!$menu'){
            $menu = M('Menu')->menu_cache();
        }
        var_dump($menu);
        return $menu;
    }

    public function admin_menu_cache($data = null) {
        if (empty($data)) {
            $data = $this->select();
            F("Menu", $data);
        } else {
            F("Menu", $data);
        }
        return $data;
    }

    //菜单



    //角色判断
    private function check_login($uid){
        if($uid == 10){
            return true;
        }
        $rule = MODULE_NAME.CONTROLLER_NAME.ACTION_NAME;

        $no_rule = array("Pulpindex",);
        if(!$rule){
            return auth_check($uid);
        }else{
            return true;
        }
    }
}