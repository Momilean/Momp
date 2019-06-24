<?php if (!defined('THINK_PATH')) exit();?>  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Seventy-two</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/Roads/Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Roads/Public/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Roads/Public/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/Roads/Public/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/Roads/Public/admin/dist/css/Aglob.css">
    <link rel="stylesheet" href="/Roads/Public/admin/dist/css/skins/skin-red.min.css">
 <link href="/Roads/Admin/public/css/templatemo_style.css" rel="stylesheet" type="text/css">	

  </head>
  <body class="hold-transition lockscreen  templatemo-bg-image-3" style="color:#FFF !important;">
    <!-- Automatic element centering -->
    <div class="container">
    </div>
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <h3>会话超时锁定</h3>
      </div>
      <!-- User name -->
      <div class="lockscreen-name">
           <a style="color:#FFF"> <?php echo (session('sname')); ?></a>
          </div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->          
        <if condition="$Think.session.logo neq ''">
        <div class="lockscreen-image">
          <img src="/Roads/Public/admin/dist/img/user1-128x128.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="password">
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center" style="color:#FFF !important;">
        请输入您的密码验证此会话！
      </div>
      <div class="text-center">
        <a href="login.html" style="color:#852142 !important;">或注销此会话！</a>
      </div>
      <div class="lockscreen-footer text-center" style="color:#999">
          <br>
       <b >  Copyright &copy; 2015 <a style="color:#999" href="http://almsaeedstudio.com" >seventy-two Studio</a></b>

      </div>
    </div><!-- /.center -->
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="/Roads/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/Roads/Public/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/Roads/Public/admin/dist/js/app.min.js"></script>
    <script src="/Roads/Public/layer/layer.js"></script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>