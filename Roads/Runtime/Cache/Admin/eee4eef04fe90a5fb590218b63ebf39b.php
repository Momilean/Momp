<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo C('WEB_SITE_TITLE');?>|<?php echo ($meta_title); ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/Roads/Public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/Roads/Public/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Roads/Public/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/Roads/Public/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/Roads/Public/admin/dist/css/Aglob.css">
  <link rel="stylesheet" href="/Roads/Public/admin/dist/css/skins/skin-red.min.css">
    <!-- jQuery 2.1.4 -->
  <script src="/Roads/Public/Js//jquery.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="/Roads/Public/bootstrap/js/bootstrap.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
 
                  <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <!--<li class="active"><a href="<?php echo U ('Pulp/index');?>">后台<span class="sr-only">(current)</span></a></li>-->
                            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">微信平台</a></li>
                                    <li><a href="#">网站建设</a></li>
                                    <li><a href="#">素材分享</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">其他</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                            </div>
                        </form>
                    </div>
            <!-- /.navbar-collapse -->
            <!-- 快捷菜单 -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                  <!-- Menu toggle button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">4</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have 4 messages</li>
                    <li>
                      <!-- inner menu: contains the messages -->
                      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                        <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                          <!-- start message -->
                          <li>
                            <a href="#">
                              <div class="pull-left">
                                <!-- User Image -->
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                              </div>
                              <!-- Message title and timestamp -->
                              <h4>
                                Support Team
                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <!-- The message -->
                              <p>Why not buy a new awesome theme?</p>
                            </a>
                          </li>
                          <!-- end message -->
                        </ul>
                        <div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                        <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                      </div>
                      <!-- /.menu -->
                    </li>
                    <li class="footer"><a href="#">See All Messages</a></li>
                  </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->

                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs"><?php echo (session('sname')); ?></span>
                  </a>
                  <ul class="dropdown-menu" >
                    <li class="user-body " style="border: 0px solid #dddddd!important; color:#fff;">
                      <div class="col-xs-5 text-center  globt">
                        <i class="fa fa-refresh">  <a href="javascript:;" onclick="clear_cache();">清楚缓存</a></i>
                      </div>
                      <div class="col-xs-5 globt  ">
                        <i class="fa fa-key"><a href="javascript:;" onclick="edit_pwd();">修改密码</a></i>
                      </div>
                      <div class="col-xs-2 text-center">

                      </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="#" class="btn btn-info btn-flat">锁定</a>
                      </div>
                      <div class="pull-right">
                        <a href="<?php echo U('Mom/logout');?>" class="btn btn-warning btn-flat">注销</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- /.navbar-custom-menu -->
          </div>
          <!-- /.container-fluid -->
        </nav>
      </header>
    
    <!-- Left side column. contains the logo and sidebar -->
   
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/Public/<?php echo (session('logo')); ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo (session('sniname')); ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form (Optional) -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">HEADER</li>
                    <!-- 左侧动态菜单！ -->
                    <?php if(!empty($_extra_menu)): echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                    <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li class="treeview">
                            <?php if(!empty($key)): ?><a href="#"><i class="fa fa-puzzle-piece"></i> <span><?php echo ($key); ?></span>
                                    <i class="fa fa-angle-left pull-right"></i></a><?php endif; ?>
                            <ul class="treeview-menu">
                                <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->
        
<script>
//删除
function del(id){
	parent.layer.confirm('请确认该组下已经没有组成员了，否则需要重新授权，真的要删除吗？', {
		btn: ['是的','取消'], //按钮
		shade: [0.3, '#393D49']
	}, function(){
		$.post("<?php echo U('Admin/group_del');?>", { "id": id },function(data){
			alert(data);
/*		if(data == 1){
			parent.layer.msg('删除成功', {icon: 1});
			window.location.reload();
		}else{
			parent.layer.msg('删除失败', {icon: 2});
		}*/
	   }, "json");
	});
}
</script>
 

<div class="roq maintop">
    <div class="nav_button">
    	<a href="<?php echo U('Admin/group_add');?>"><button class="btn btn-info">+添加用户组 </button></a>
    </div>
    <br>

<div class="table-responsive ">
	  <table  class="table table-condensed ">
      <thead>
	    <tr class="active info ">
	      <td  width="10%">编号</td>
	      <td  width="15%"> 角色/组 </td>
	      <td  width="18%"> 创建时间 </td>
          <td  width="8%"> 状态 </td>
          <td  width="17%"> 描述</td>
	      <td   > 操作 </td>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
	      <td height="50"> <?php echo ($vo["id"]); ?>  </td>
	      <td> <?php echo ($vo["title"]); ?> </td>
	      <td> <?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?> </td>
                  <td>
            <?php if($vo["status"] == 1): ?><i class="fa fa-check fa-2x " style="color:#5cb85c"></i> 
                <?php else: ?>
                <i class="fa  fa-remove fa-2x " style="color:#f0ad4e"> </i><?php endif; ?>
        </td>
        <td>
            <?php echo ($vo["describe"]); ?>        
        </td>
                <td style="width: 394px;">
                    <a href="<?php echo U('Admin/group_edit',array('id'=>$vo[id]));?>"    class="btn btn-info btn-sm" onclick="edit(<?php echo ($vo[id]); ?>)">授权 </a>
                    <a href=" " rel="roleuser" class="btn btn-info btn-sm"  
                    mask="true" title="审核员 用户列表 ">用户列表</a>
                    <a href="<?php echo U('Admin/group_edit',array('id'=>$vo[id]));?>" rel="roleedit3" class="btn btn-info btn-sm"  
                    mask="true" width="500" height="400">编辑</a>
                    
                    <a href="/zswin/index.php/Admin/Role/foreverdelete/id/3/navTabId/Role" class="btn btn-danger btn-sm" target="ajaxTodo" title="确定要删除该行信息吗？">删</a>
                 </td>
	     </tr><?php endforeach; endif; ?>
        </tbody>
  </table>
</div>
</div>
<!-- 分页 -->
<div class="page">
<?php echo ($page); ?>
</div>
 


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>

<!-- //清除缓存 -->
<script>
function clear_cache(){
	layer.open({

    type: 2,
    closeBtn: 1,
    area: ['460px', '200px'],
    title: '清除缓存',
     skin: 'yourclass',
     shade: 0.6,
    content: '<?php echo U('pulp/clear_cache');?>'
	});
}
  function  edit_pwd(){
    layer.open({
              type: 2,
              closeBtn: 1,
              area: ['460px', '220px'],
              skin: 'yourclass',
              title:'修改密码',
              shade: 0.6,
              content: '<?php echo U('pulp/edit_pwd');?>'
  });
  }
</script>

  <!-- REQUIRED JS SCRIPTS -->

  <!-- AdminLTE App -->
  <script src="/Roads/Public/admin/dist/js/app.min.js"></script>
  <script src="/Roads/Public/layer/layer.js"></script>
  <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>