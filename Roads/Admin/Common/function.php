<?php
/**
 * 以下部分从ONEThink精简移植，后台公共文件，用于后台配置管理 菜单 导航
 * 主要定义后台公共函数库
 */


/**
 * 获取配置的类型
 * @param string $type 配置类型
 * @return string
 */
function get_config_type($type=0){
    $list = C('CONFIG_TYPE_LIST');
    return $list[$type];
}

/**
 * 获取配置的分组
 * @param string $group 配置分组
 * @return string
 */
 function get_config_group($group=0){
     $list = C('CONFIG_GROUP_LIST');
     return $group?$list[$group]:'';
 }

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data,$map=array('status'=>array(1=>'正常',-1=>'删除',0=>'禁用',2=>'未审核',3=>'草稿'))) {
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col.'_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 动态扩展左侧菜单,base.html里用到
 * @author 朱亚杰 <zhuyajie@topthink.net>
 */
function extra_menu($extra_menu,&$base_menu){
    foreach ($extra_menu as $key=>$group){
        if( isset($base_menu['child'][$key]) ){
            $base_menu['child'][$key] = array_merge( $base_menu['child'][$key], $group);
        }else{
            $base_menu['child'][$key] = $group;
        }
    }
}



 // 分析枚举类型配置值 格式 a:名称1,b:名称2
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}

 // 分析枚举类型字段值 格式 a:名称1,b:名称2
 // 暂时和 parse_config_attr功能相同
 // 但请不要互相使用，后期会调整
function parse_field_attr($string) {
    if(0 === strpos($string,':')){
        // 采用函数定义
        return   eval(substr($string,1).';');
    }
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}
/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
    if(is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**
 * 调用系统的API接口方法（静态方法）
 * api('User/getName','id=5'); 调用公共模块的User接口的getName方法
 * api('Admin/User/getName','id=5');  调用Admin模块的User接口
 * @param  string  $name 格式 [模块名]/接口名/方法名
 * @param  array|string  $vars 参数
 */
function api($name,$vars=array()){
    $array     = explode('/',$name);
    $method    = array_pop($array);
    $classname = array_pop($array);
    $module    = $array? array_pop($array) : 'Common';
    $callback  = $module.'\\Api\\'.$classname.'Api::'.$method;
    if(is_string($vars)) {
        parse_str($vars,$vars);
    }
    return call_user_func_array($callback,$vars);
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
 function lists ($model,$where=array(),$order='',$base = array('status'=>array('egt',0)),$field=true){
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

