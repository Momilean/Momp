<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_THEME' => 'Default',
    //'DEFAULT_V_LAYER'       =>  'Template',
    //定义引用常量
    'TMPL_PARSE_STRING' => array(
    '__PUBLIC__' =>__ROOT__ . '/Roads/Public', // 更改默认的/Public 替换规则
    '__STATIC__' => __ROOT__ . '/Public/Static',
    //'__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
    '__IMG__'    => __ROOT__ . '/Roads',
    '__CSS__'    => __ROOT__ . '/Roads/Public/Css',
    '__JS__'     => __ROOT__ . '/Roads/Public/Js',
    ),
);