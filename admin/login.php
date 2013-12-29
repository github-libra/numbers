
<!DOCTYPE html>
<?php 
// Starting the session 

session_start();


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>管理员登录界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="login">
    <meta name="author" content="thj">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.bootcss.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <div class="form-signin">
        <h2 class="form-signin-heading">管理员登录</h2>
        <input type="text" class="input-block-level" placeholder="管理员账号" id="phone">
        <input type="password" class="input-block-level" placeholder="密码" id="passwd">
        <input type="password" style="display:none" placeholder="密码" id="passwd_hidden">
        <!-- <input type="text" class="input-block-level" placeholder="验证码" id="code"> -->
        <label class="checkbox">
          <input type="checkbox" value="remember-me" id="remember"> 记住我
        </label>
        <button class="btn btn-large btn-inverse" onclick="login()" id="login">登　录</button>
        <!-- <a href="register.php">还没有账号？点击去注册</a> -->
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/md5.js"></script>

    <script type="text/javascript">
  
   var operation = 'login';


    $(function(){
      var isChecked = $.cookie('admin_isChecked');
      console.log(isChecked);
      if(isChecked == "true"){
     
        $("#phone").val($.cookie('admin_name'));
        $("#passwd").val("********");
        $("#passwd_hidden").val($.cookie('admin_passwd'));
        $("#remember").attr("checked",true);
      }
    });


   function login(){
      var passwd = $("#passwd").val();
      var phone = $("#phone").val();

      if (phone == "" || passwd == "") {
        alert("用户名或密码不能为空！");
      }
      else if(passwd !== "********"){
        //user input
        $("#passwd_hidden").val(hex_md5(passwd));
      }
      else{

      }
      var md5passwd = $("#passwd_hidden").val();
      var isChecked = $("#remember").prop("checked");
    //   var phone = $("#phone").val();
    //   var passwd = $("#passwd").val();
    // //alert(name+""+passwd);
    //   var isChecked = $("#remember").prop("checked");
    //   // console.log(document.cookie);
        
    //   if (phone == "" || passwd == "") {
    //     alert("用户名或密码不能为空！");
    //   }
    //   else {
    //     var md5passwd = hex_md5(passwd);
    //     $("#passwd_hidden").val(md5passwd);
    //     console.log(passwd);
            $.ajax({         
              type : "POST",
              url : "admin_bg.php",
              dataType : "json",
              async : false,
              //data : qs,
              data : {
                'operation':operation,
                'phone' : phone,
                'passwd' : md5passwd,
                'isChecked':isChecked
              },
              success:function(data){
                  if(data.value == 1){
                    if(isChecked){
                      $.cookie("admin_name",phone,{ expires : 10 });
                      $.cookie("admin_passwd",md5passwd,{ expires : 10 });
                    }
                    $.cookie("admin_isChecked",isChecked,{ expires : 10 });
                    window.location = "numbers.php";
                  }
                  else if(data.value == -1){
                      alert("用户名或密码错误");
                      
                  }else
                      alert("用户不存在");
                }       
                });
            
            }
    
    

 
    </script>

  </body>
</html>
