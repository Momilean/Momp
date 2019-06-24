<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model {
    
    public function getuserinfo(){
        $data = $_SESSION['roads']['sname'];        
        $uinfo = M('user')->where(array('username' => $data))->find();
        return $uinfo;
    }
}
