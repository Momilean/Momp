<?php
namespace Home\Model;
use Think\Model;

class LoginModel extends Model {
    protected $tableName = 'user';
    protected $patchValidate = true;
    protected $_map = array(
         //字段映射，
         'name' =>'username', // 把表单中name映射到数据表的username字段
         'pwd'  =>'password', // 把表单中的mail映射到数据表的email字段
         'pwds' =>'passwords',
         
     );

    protected $_validate = array(
     //验证规则
     array('username','/^[a-zA-Z0-9_]{4,20}$/','用户名长度4-20位，且为数字和字母！'), //默认情况下用正则进行验证
     array('username','', '该帐号名称已经存在！',0,'unique'), // 在新增的时候验证name字段是否唯一
    //  array('nickname','/^[a-zA-Z0-9_]{2,20}$/','用户名长度4-20位，且为数字和大小写字母！'), //默认情况下用正则进行验证
    //  array('nickname','', '已经存在！',0,'unique'), // 在新增的时候验证name字段是否唯一
     array('password','/^[a-zA-Z0-9]{6,18}$/','密码最小长度6位！'), //默认情况下用正则进行验证
     array('passwords','password','确认密码不一直',0,'confirm'), // 验证确认密码是否和密码一致
    
     
   );
    
    protected $_auto = array ( 
         //注册提交的数据处理 
         array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
         array('regidata','date',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
         array('entryip','get_client_ip','1','function'),
     );
    
    // public function registers(){

 
    //         if (!$this->create()){
    //              // 如果创建失败 表示验证没有通过 输出错误提示信息
                 
    //              return($this->getError());

    //              $this->error("<center><h5 style='color:red!important'>注册发生异常，请重新注册</h5></center>",U('Index/index'));
    //         }else{
    //              // 验证通过 可以进行其他数据操作
    //                 $this->add();
    //                 return ();
 
    //         }
 
    // }
    
    
     
    
    
}