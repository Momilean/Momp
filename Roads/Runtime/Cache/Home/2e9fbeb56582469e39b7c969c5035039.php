<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="/Roads/Public/Css/style.css" rel="stylesheet">
        <link href="/Roads/Public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="/Roads/Public/Js/jquery.js"></script>
        <script src="/Roads/Public/Js/respond.min.js"></script>
        <script src="/Roads/Public/bootstrap/js/bootstrap.js"></script> 
        <script src="/Roads/Public/Js/jquery.form.js"></script> 
    </head>
    <body>
<!--
 
                    
                    <span class="h_login">
                        <a href="<?php echo U('Home/Login/index');?>" >登录</a>
                    </span>
                       
                    <span class="h_regis">
                        <a href="<?php echo U('/Home/Login/Register');?>">注册</a>
                    </span>
  
-->
<!--    bootstarp head    -->
 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
     <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
              Maxi Sutido
          </a>
        </div>
        <div id="navbar" class="navbar-collapse  collapse " role="navigation">
          <ul class="nav navbar-nav ">
            <li class="active"><a href="#">主页</a></li>
            <li><a href="#about">贴吧</a></li>
            <li><a href="#contact"></a></li>
            <li><a href="#contact"></a></li>
          </ul>
          <!-- user -->
            <ul class="nav navbar-nav navbar-right ">
              <?php if($_SESSION['roads']['sid']!= ''): ?><li class="nnavli">
                    <!--hello js--><?php echo (session('sname')); ?>
                <script language="javaScript">
                                now = new Date();
                                hour = now.getHours();
                                if(hour < 6){document.write("凌晨好！")} 
                                else if (hour < 9){document.write("早上好！")} 
                                else if (hour < 12){document.write("上午好！")} 
                                else if (hour < 14){document.write("中午好！")} 
                                else if (hour < 17){document.write("下午好！")} 
                                else if (hour < 19){document.write("傍晚好！")} 
                                else if (hour < 22){document.write("晚上好！")} 
                                else {document.write("夜里好！")}
                </script>
                </li>
                 <?php if($_SESSION['roads']['logo']!= ''): ?><li  >                 
                <div class="dropdown">
                    <img src="/Public<?php echo (session('logo')); ?>" style="width:48px; height:48px;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true" class="img-circle" alt="Responsive image">
                    <span class="caret"></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo U('User/index');?>">个人中心</a></li>
                        <li><a href="#">帮助中心</a></li>
                        <li role="separator" class="divider divider-warning"></li>
                        <li><a href="<?php echo U('Login/logout');?>">注销账号</a> </li>
                    </ul>
                </div>
                </li>
                <?php else: ?>
                <li class="nnavli">
                    <div class="dropdown">
                        <img src="/Public/Uploads/userlogo/null.jpg" style="width:48px; height:48px;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true" class="img-circle" alt="Responsive image">
                        <span class="caret"></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo U('User/index');?>">个人中心</a></li>
                            <li><a href="#">帮助中心</a></li>
                            <li role="separator" class="divider divider-warning"></li>
                            <li><a href="<?php echo U('Login/logout');?>">注销账号</a> </li>
                        </ul>
                    </div>
                </li><?php endif; ?>
      
                <?php else: ?>
                <li  >
                  <button type="button" class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#ligModal">
                    登录
                  </button>
                </li>
                <li>
                  <button type="button" class="btn btn-warning navbar-btn" data-toggle="modal" data-target="#signModal">
                    注册
                  </button>
                </li><?php endif; ?>
            
            </ul>
          
        </div><!--/.nav-collapse -->
      </div>
</nav>

 <!-- login Modal -->

        
<div class="modal fade bs-example-modal" id="ligModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">

    <div class="modal-content zxmc">
 
      
          <!--<form class="form-signin" method="POST" action="<?php echo U('Login/login');?>" accept-charset="UTF-8">
    <div class="col-xs-8">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">用户名</span>
            <label for="username" class="sr-only">user</label>
            <input type="text" class="form-control" name="ajaxu" required oninvalid="setCustomValidity('用户名必填')" />
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">密&nbsp; &nbsp;码</span>
            <label for="passwd" class="sr-only">Passwd</label>
            <input name="ajaxp" class="form-control" required="" type="password">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">验证码</span>
            <input type="text" class="form-control" data-validate="required:必填" placeholder="验证码" name="scode" />
        </div>
        <br>
        <img src="<?php echo U('Login/verify');?>" alt="验证码" onClick="this.src=this.src+'?'+Math.random()" />

    </div>
    <div class="col-xs-4">
        <div class="login-qrcode">
            <div id="login_container">
                <iframe scrolling="no" src="https://open.weixin.qq.com/connect/qrconnect?appid=wxfeec4534d2eaddaa&amp;scope=snsapi_login&amp;redirect_uri=http://account.shafa.com/oauth/callback?provider=weixin&amp;state=f2f45d4432d69da006539ea907c4bc74&amp;login_type=jssdk&amp;style=black&amp;href=https://assets.sfcdn.org/web/css/qrcode.css"
                frameborder="0" height="100px" width="100px"></iframe>
                <p><i class="fa fa-weixin"></i> 微信登录 </p>
            </div>


        </div>
    </div>
    <br>
    <button id="bth" class="btn btn-lg  btn-block" type="submit" style="background-color:#FAA700;">登录</button>
    <div class="checkbox">
        <label>
            <input value="remember-me" type="checkbox">永久记住我!
        </label>
        <a class="pull-right active" href="/p /reset">?忘记密码</a>
    </div>
</form>-->
<script>
$(function(){
	$('#flogin').ajaxForm({
		beforeSubmit: logcheckForm, // 此方法主要是提交前执行的方法，根据需要设置
		success: logcomplete, // 这是提交后的方法
        type: 'post',
		dataType: 'json'
	});
	
	function logcheckForm(){
		$('#loginresult').attr("class", "high");
 
		if( '' == $.trim($('#ajaxu').val())){
			$('#loginresult').html('登入用户名不能为空').show();
			$('#ajaxu').focus(); 
			return false;
		}
 
		if( '' == $.trim($('#ajaxp').val())){
			$('#loginresult').html('登入密码不能为空').show();
			$('#ajaxp').focus(); 
			return false;
		}
        if( ''== $.trim($('#scode').val())){
            $('#loginresult').html('验证码不能为空').show();
            $('#scode').focus();
            return false;
        }
 }
	function logcomplete(data){
		if(data.status==1){
			window.location.href="<?php echo U('Index/index');?>";
			return false;
		}else{
			$('#loginresult').html(data.info).show();
			return false;	
		}
	}
 
});
</script>
<form class="form-signin" name="flogin" id="flogin" method="POST" action="<?php echo U('Login/login');?>">
<p id="loginresult" class="loginnone"></p>
    <div class="col-xs-8">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">用户名</span>
            <label for="username" class="sr-only">user</label>
            <input type="text" class="form-control" id="ajaxu" name="ajaxu" />
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">密&nbsp; &nbsp;码</span>
            <label for="passwd" class="sr-only">Passwd</label>
            <input name="ajaxp" id="ajaxp" class="form-control"   type="password">
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">验证码</span>
            <input type="text" class="form-control"  placeholder="验证码" id="scode" name="scode" />
        </div>
        <br>
        <img src="<?php echo U('Login/verify');?>" alt="验证码" onClick="this.src=this.src+'?'+Math.random()" />

    </div>
    <div class="col-xs-4">
        <div class="login-qrcode">
            <div id="login_container">
                <!--<iframe scrolling="no" src="https://open.weixin.qq.com/connect/qrconnect?appid=wxfeec4534d2eaddaa&amp;scope=snsapi_login&amp;redirect_uri=http://account.shafa.com/oauth/callback?provider=weixin&amp;state=f2f45d4432d69da006539ea907c4bc74&amp;login_type=jssdk&amp;style=black&amp;href=https://assets.sfcdn.org/web/css/qrcode.css"
                frameborder="0" height="100px" width="100px"></iframe>
                <p><i class="fa fa-weixin"></i> 微信登录 </p>-->
            </div>


        </div>
    </div>
    <br>
    <button id="bth" class="btn btn-lg  btn-block" type="submit" style="background-color:#FAA700;">登录</button>
    <div class="checkbox">
        <label>
            <input value="remember-me" type="checkbox">永久记住我!
        </label>
        <a class="pull-right active" href="/p /reset">?忘记密码</a>
    </div>
</form>




 
       
    <div class="zx-modal-footer">
        <button id="btn-signup-close" type="button" data-dismiss="modal" class="btn btn-danger">关闭</button>
    </div>
    </div>
  </div>
</div> 
 <!-- signin Modal -->
    <script type="text/javascript">
        $(document).ready(function(){
            //alert(1111);
        });
    </script>
<div class="modal fade  bs-example-modal-sm" id="signModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
      
<div class="modal-content">
    
    <form id="register_from" action="<?php echo U('Login/register');?>" role="form" method="post">
        <div class="alert alert-success" role="alert" id="msg"><p ></p></div>
        <div style="padding-top: 10px" class="modal-body padding-40">
            <div></div>
            <div class="form-group input-group">
                <input placeholder="电子邮箱" value="" id="signup-email" class="form-control" type="text">
                <div class="input-group-addon"><i class="fa fa-envelope-o min-width-30"></i></div>
            </div>
            <div class="form-group input-group">
                <input placeholder="用户名(4-20位字母、数字)" value="" name="name" class="form-control" type="text">
                <div class="input-group-addon" id="namets"><p ></p></div>
            </div>
            <div class="form-group input-group">
                <input placeholder="密码(6-16位字母、数字、无空格)"" name="pwd"  class="form-control" type="password">
                <div class="input-group-addon" id="pwdts"><p ></p></div>
            </div>
            <div class="form-group input-group">
                <input placeholder="确认登录密码"  name="pwds" class="form-control" type="password">
                <div class="input-group-addon" id="pwdsts"><p ></p></div>
            </div>
            <div class="text-center">创建一个免费帐号，意味着你接受<a href="#" class="a-blue"> Maix stiudo 用户协议</a>。</div>
        </div>
        <div class="modal-footer">
            <button id="btn" type="button" class="btn btn-primary">创建新账号</button>
            <button id="btn-signup-close" type="button" data-dismiss="modal" class="btn btn-danger">关闭</button>
        </div>
    </form>
</div>
<!--<script>
    $(function(){
        $('#btn').click(function(data){
             var action = $('#register_from').attr('action');
             var postform = $('#register_from').serialize();
             var msg = $("#msg"),$("#msg"),$("#msg");
             var request = $.ajax({
                  url: action,
                  method: "POST",
                  data: postform,
                  dataType: "json",
                  complete:function(){location.href ="default.aspx"}//跳转页面         
            });
             request.done(function (data) {
                 $("#msg").html("");
             });



             request.fail(function (data) {
$('#namets').html(data['username']);
                 alert("Request failed: " + textStatus);

             });


            
        });     
    });
    
</script>-->
  <script>
    $(function(){        
     $('#btn').click(function(){
         var action = $('#register_from').attr('action');
         var postform = $('#register_from').serialize();
         
         $.post(action, postform, function(data){
             // 提示
             $('#namets').html('');
             $('#pwdts').html('');
             $('#pwdsts').html('');
             $('#msg').html(data['info']) 
        if(!!data){ //验证
                $('#namets').html(data['username']);
                $('#pwdts').html(data['password']);
                $('#pwdsts').html(data['passwords']);
        }if(data['status']==1){ //执行跳转
                //document.location.href= '<?php echo U('User/uscenter');?>';
                window.setTimeout(function(){
                location.href= data['url']  }, 3000);
            }  
        else{          
              return 'flase';
        }
     },'json');
     });
     });

</script> 
 

         


 
   
  </div>
</div>
        
<!-- side -->
<script>
    $(function(){
       $('#myCarousel').carousel({
  interval: 4000
});
      
    });
</script> 
<div id="myCarousel" class="carousel slide">
   <!-- 轮播（Carousel）指标 -->
   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
   </ol>  
   <!-- 轮播（Carousel）项目 -->
   <div class="carousel-inner">
      <div class="item active">
         <img src="/Public/Adds/gero.jpg" alt="First slide">
         <div class="carousel-caption"></div>
      </div>
      <div class="item">
         <img src="/Public/Adds/one.jpg" alt="Second slide">
         <div class="carousel-caption"></div>
      </div>
      <div class="item">
         <img src="/Public/Adds/two.jpg" alt="Third slide">
         <div class="carousel-caption"></div>
      </div>
   </div>
   <!-- 轮播（Carousel）导航 -->
  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 



    </body>
</html>