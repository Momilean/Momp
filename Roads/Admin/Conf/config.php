<?php
return array(
	//'配置项'=>'配置值'
     //   'DEFAULT_THEME' => 'Default',
    //'DEFAULT_V_LAYER'       =>  'Template',
    //定义引用常量
    'TMPL_PARSE_STRING'  =>array(
    '__PUBLIC__' =>__ROOT__ . '/Roads/Public', // 更改默认的/Public 替换规则
    '__JS__'     => '/Roads/Public/Js/', // 增加新的JS类库路径替换规则
    // '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
   '__CSS__'=> '/Roads/Admin/Public', 
    
),
);
 