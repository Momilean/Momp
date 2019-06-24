<?php
return array(
	//'配置项'=>'配置值'
    'SHOW_PAGE_TRACE' =>true,
    'ERROR_MESSAGE' =>'发生错误！',
    'URL_MODEL' => '2',
     //'URL_PATHINFO_DEPR'=>'-',// 更改PATHINFO参数分隔符
    //数据库配置信息
    'DB_TYPE'    => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'  => 'roads', // 数据库名
    'DB_USER'    => 'root', // 用户名
    'DB_PWD'     => '', // 密码
    'DB_PORT'    => 3306, // 端口
    'DB_PREFIX'  => 'bs_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    //错误模板
    'TMPL_ACTION_SUCCESS'   => 'Public/dispatch_jump',
    'TMPL_ACTION_ERROR'     => 'Public/dispatch_jump',

    //模块组
    'MODULE_ALLOW_LIST' => array('Home','Admin'),//允许模块组,可增,以逗号为隔
    'DEFAULT_MODULE'    => 'Home',//默认模块Home

    //session 设置
    'SESSION_OPTIONS'         =>  array(
   // 'name'                =>  'MSESSID',                    //设置session名
    //'expire'              =>  600,                      //SESSION保存15天
    'prefix'                =>'roads',
    //    'path'                => 'C:/Apache24/htdocs/sessions/',
    //     'use_trans_sid'       =>  1,                               //跨页传递
    //     'use_cookie'          => 1,
    //     'use_only_cookies'    =>  0,                               //是否只开启基于cookies的session的会话方式
    ),
    //权限验证设置
    'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'bs_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'bs_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'bs_auth_rule', //权限规则表
        'AUTH_USER' => 'bs_user'//用户信息表
    ),
    //超级管理员id,拥有全部权限,只要用户uid在这个角色组里的,就跳出认证.可以设置多个值,如array('1','2','3')
    'ADMINISTRATOR'=>array('1'),
    //tonke令牌
    // 'view_filter' => array('Behavior\TokenBuildBehavior'),
    // 'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    // 'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    // 'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    // 'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'seventytwo_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
);
