<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>会员中心</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/Roads/Public/member/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/Roads/Public/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="/Roads/Public/Css/Home/View/Static/member/if/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="/Roads/Public/member/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/Roads/Public/member/dist/css/skins/skin-green-light.min.css">
    <!--[if lte IE 9]>
            <link rel="stylesheet" href="/Roads/Public/Css/Home/View/Static/assets/css/ace-ie.css" />
    <![endif]-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/Roads/Public/Js/jquery.js"></script>
    <script src="/Roads/Public/layer/layer.js"></script>
</head>

<body class="hold-transition skin-green-light layout-boxed">
    <div class="wrapper">
        <!--导航块-->
        
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="/index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>7</b>2</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Seventy</b>-two</span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the messages -->
                                        <ul class="menu">
                                            <li>
                                                <!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
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
                                        <!-- /.menu -->
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- /.messages-menu -->
                            <!-- Tasks Menu -->
                            <li class="dropdown tasks-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- Inner menu: contains the tasks -->
                                        <ul class="menu">
                                            <li>
                                                <!-- Task item -->
                                                <a href="#">
                                                    <!-- Task title and progress text -->
                                                    <h3>
                                    Design some buttons
                                    <small class="pull-right">20%</small>
                                </h3>
                                                    <!-- The progress bar -->
                                                    <div class="progress xs">
                                                        <!-- Change the css width attribute to simulate progress -->
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <?php if($_SESSION['roads']['logo']!= ''): ?><img src="/public<?php echo (session('logo')); ?>" class="user-image" alt="User Image">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <?php else: ?>
                                        <img src="/Public/Uploads/userlogo/user-48.png" class="user-image" alt="User Image"><?php endif; ?>
                                    <span class="hidden-xs">Dear: <?php echo (session('sname')); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <?php if($_SESSION['roads']['logo']!= ''): ?><img src=" /public<?php echo (session('logo')); ?>" class="user-image" alt="User Image">
                                            <?php else: ?>
                                            <img src="/Public/Uploads/userlogo/user-48.png" class="user-image" alt="User Image"><?php endif; ?>
                                        <p>个人签名： </p>
                                        <small>面带微笑，不是因为快乐太长，是太长的时间忘了悲伤... </small>

                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">OAuth</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">权限</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">帮助</a>
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">设置</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo U('Login/logout');?>" class="btn btn-default btn-flat">注销</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>-->
                        </ul>
                    </div>
                </nav>
            </header>
        
        <!--菜单快-->
        
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!--<div class="user-panel">
            <div class="pull-left image">
                <?php if($_SESSION['roads']['logo']!= ''): ?><img src=" /public<?php echo (session('logo')); ?>" class="img-circle" alt="User Image">
                    <?php else: ?>
                    <img src="/Public/Uploads/userlogo/user-48.png" class="img-circle" alt="User Image"><?php endif; ?>
            </div>
            <div class="pull-left info">
                <?php echo (session('sniname')); ?>
                <p></p>
                <a href="#">Info:</a> <i class="fa fa-circle text-success"> </i> <a>创建者</a>
            </div>
        </div>-->
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
                        <!--<li class="header"></li>-->
                        <!-- Optionally, you can add icons to the links -->
                        <li class="active"><a href="index.html"><i class="fa fa-home"></i> <span>主页</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user"></i> <span>个人信息</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="userinfo.html"><i class="fa fa-cog"></i>基本管理</a></li>
                                <li><a href="edit_pwd.html"><i class="fa fa-lock"></i>密码管理</a></li>
                                <li><a href="#"><i class="fa fa-user-plus"></i>会员相关</a></li>
                                <li><a href="#"><i class="fa fa-bell-o"></i>通知提醒</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-diamond"></i> <span>账户服务</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-rmb"></i>兑换服务</a></li>
                                <li><a href="#"><i class="fa fa-calendar-o"></i>账户记录</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="javascript:;"><i class="fa fa-cloud"></i> <span>内容管理</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-at"></i>评论回复</a></li>
                                <li><a href="#"><i class="fa fa-navicon"></i>收藏记录</a></li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-share-alt-square"></i> <span>分享互动</span></a></li>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
        
        <!--内容快-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>       
            <small>
                <script src="/Roads/Public/member/dist/js/hellohi.js"></script>
            </small>
          </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-navicon"></i>主页</a></li>
                    <li class="active">Here</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                
        <div class="row">
            <div class="col-md-11">
                <div class="col-md-5">
                    <!-- Widget: user widget style 1 --> 
                    <div class="box box-widget widget-user-2">                  
                            <div class="widget-user-header bg-yellow">
                                <div class="widget-user-image">
                                    <?php if($info['userphoto'] != ''): ?><img class="img-circle" src="/Public<?php echo ($info["userphoto"]); ?>" alt="User Avatar">
                                    <?php else: ?> 
                                    <img class="img-circle" src="/Roads/Public/member/dist/img/photo1.png" alt="User Avatar"><?php endif; ?>
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username"><?php echo ($info["nickname"]); ?></h3>
                                <h5 class="widget-user-desc"><?php echo ($info["usersign"]); ?></h5>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a>账号： <span class="pull-right "><?php echo ($info["username"]); ?></span></a></li>
                                    <li><a>昵称： <span class="pull-right "><?php echo ($info["nickname"]); ?></span></a></li>
                                    <li><a>邮箱： <span class="pull-right  "><?php echo ($info["useremail"]); ?> </span></a></li>
                                    <li><a>手机： <span class="pull-right  "><?php echo ((isset($info["userphone"]) && ($info["userphone"] !== ""))?($info["userphone"]):"这家伙很懒，什么也没留下"); ?></span></a></li>
                                    <li><a>积分： <span class="pull-right  "><?php echo ((isset($user["nickname"]) && ($user["nickname"] !== ""))?($user["nickname"]):"暂无积分系统"); ?></span></a></li>
                                </ul>
                            </div>                      
                        </div>                    
                  </div>
                   <!-- Widget: user widget style 1  -->
                    <div class="col-md-6">   
                        <div class="box box-solid  box-info" style="">
                            <div class="box-header">
                                <h5 class="box-title"><i class="fa fa-bell-o"></i> 通知提醒</h5> 
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="box-ul">
                                 <li><i class="fa fa-commenting-o"></i> <a>您的主题《测定》有新的回帖</a></li>
                                 <li><i class="fa fa-commenting-o"></i> <a>您的主题《测定》有新的回帖</a></li>
                                 <li><i class="fa fa-paper-plane-o"></i> <a>恭喜亲，您的会员组续费成功</a></li>
                                 <li><i class="fa fa-paper-plane-o"></i> <a>该账户已被锁定</a></li>
                                 </ul>
                            </div>
                            <!-- /.box-body -->
                         </div>
                            <div class="box box-solid  box-success" style="border: 1px solid #f4f4f4;">
                            <div class="box-header with-border">
                                <h5 class="box-title"><i class="fa fa-pencil-square-o"></i>   热门评论</h5>
                                <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                方法大师傅大
                            </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        <!-- /.box -->
                                                <div class="box box-solid  box-info" style="">
                            <div class="box-header">
                                <h5 class="box-title"><i class="fa fa-bell-o"></i> 通知提醒</h5> 
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="box-ul">
                                 <li><i class="fa fa-commenting-o"></i> <a>您的主题《测定》有新的回帖</a></li>
                                 <li><i class="fa fa-commenting-o"></i> <a>您的主题《测定》有新的回帖</a></li>
                                 <li><i class="fa fa-paper-plane-o"></i> <a>恭喜亲，您的会员组续费成功</a></li>
                                 <li><i class="fa fa-paper-plane-o"></i> <a>该账户已被锁定</a></li>
                                 </ul>
                            </div>
                            <!-- /.box-body -->
                         </div>
                    </div>
            </div>      
            <div class="col-md-1">             
            </div>       
         </div>
          <!--two-->
         <div class="row">
             <div class="col-md-11">
                <div class="col-md-5">
                <div class="box  box-success" style="border: 1px solid #f4f4f4;">
                    <div class="box-header with-border">
                        <h2 class="box-title"><i class="fa fa-building-o"></i> 登录记录</h2>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        上次登录时间:   <?php echo (date("Y-m-d H:i:s",$info["entrdata"])); ?><br>
                        IP:    <?php echo ($info["entryip"]); ?><br>
                        系统:  <?php echo ($_SERVER['HTTP_USER_AGENT']); ?>
                          
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>
             </div>
                <div class="col-md-6">
                </div>
             <div class="col-md-1">
             </div> 
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
            <strong>Copyright &copy; 2015 <a href="#">72-Studio</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->


    <!-- jQuery 2.1.4 -->
    <script src="/Roads/Public/Js/jquery.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/Roads/Public/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/Roads/Public/member/dist/js/app.min.js"></script>
</body>

</html>