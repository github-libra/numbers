<!DOCTYPE html>
<?php 
// Starting the session 

session_start();
if(!isset($_SESSION['admin_name'])){
  echo "<script>
        alert('请先登录再操作');
        location.href='login.php';
        </script>";

}
if(isset($_SESSION['user_type'])){
  if($_SESSION['user_type'] == 1)
    echo "<script>
        location.href='audit.php';
        </script>";
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>管理员概览界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="homepage">
    <meta name="author" content="thj">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/datetimepicker.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;

        /*background-image: url(../img/bg.jpg); */
        /*background-color: #f4f4f4;*/
        background-attachment: fixed; 
        background-color: #efefef;
        /*color:#08c;*/
      }

      /* Custom container */
      .container {
        /*margin: 50px auto;*/
        max-width: 1100px;
        /*background-color: #333;*/
        /*opacity:0.99;*/
      }
      .container > hr {
        margin: 30px 0;
      }
            /* Customize the navbar links to be fill the entire space of the .navbar */
      .well{
        padding: 5px;
        margin-bottom: 5px;
      }
      

    
     #scrollUp {
       bottom: 20px;
       right: 20px;
       height: 38px;  /* Height of image */
       width: 38px; /* Width of image */
       background: url("../img/top.png") no-repeat;
     }
     .navbar-inner .brand{
      color: #fff;
      font-weight: bold;
      font-family:"Segoe print", serif;
      margin-right: 60px;

     }
     .navbar-inner .brand:hover{
        color:#fff;
      }
      .pane
      {
          position: relative;
          background-color: #ffffff;
          border: 1px solid #cfcfcf;
          border-radius: 3px;
          text-align: center;
          width: 1000px;
          min-height: 600px;
          padding: 50px;
          margin: 100px auto;
          box-shadow: 0px 1px 3px 0px #e3e3e3;
          box-shadow: 0px 1px 3px 0px rgba(112,112,112,0.05);
      }
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/grumble.min.css" rel="stylesheet">

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

  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="brand" href="numbers.php">Statistics 运营统计</a>
         <!--  <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="numbers.php">网站统计数据</a></li>
            </ul>
          </div><!--/.nav-collapse --> -->
          <div class="btn-group pull-right">
            <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#" id="admin_name">Action<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <!-- dropdown menu links -->
              <li><a href="javascript:logout()">登出</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

  <div class="container" style="margin:50px auto">
      <div class="row-fluid">
        <div class="span12">
            <div class="span4">
              <label for="datetime">选择统计日期</label>
              <input id="datetime" size="16" type="text" value="2013-12" readonly style="margin-bottom:0px;height:35px;font-weight: bold;font-size: large;"></input>  
              <a id="confirmdate1" onclick="loadDataByMonth()" class="btn btn-default btn-large">Go!</a>
            </div>

            <div class="span8">
              <label>选择起止日期</label>
              <input id="from_date" size="16" type="text" value="2013-12-01" readonly style="margin-bottom:0px;height:35px;font-weight: bold;
font-size: large;"></input>
              <input id="to_date" size="16" type="text" value="2013-12-30" readonly style="margin-bottom:0px;height:35px;font-weight: bold;
font-size: large;"></input>  
              <a id="confirmdate2" onclick="loadDataByTimespace()" class="btn btn-default btn-large">Go!</a>
            </div>
            
              <!-- <legend>用户区域分布</legend> -->
              <div class="pane" id="user_chart" ></div>
           
         
              <!-- <legend>手机型号分布</legend> -->
              <div class="pane" id="phone_chart"></div>
            
           
              <!-- <legend>安卓版本分布</legend> -->
              <div class="pane" id="os_chart" ></div>
          
        </div>
      </div>
  </div>
  <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.cookie.js"></script>
    <script src="../js/Chart.js"></script>
    <script src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script src="../js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="../js/knockout-3.0.0.js"></script>
    <script src="../js/globalize.min.js"></script>
    <script src="../js/dx.chartjs.js"></script>

    <script type="text/javascript">

    var ADMIN="";


    var operation1 = "load_user_chart_by_month"; 
    var operation2 = "load_phone_chart_by_month"; 
    var operation3 = "load_os_chart_by_month"; 
    var operation4 = "logout";

    var operation5 = "load_user_chart_by_timespace"; 
    var operation6 = "load_phone_chart_by_timespace"; 
    var operation7 = "load_os_chart_by_timespace";

    var from_date = new Date();
    var to_date = new Date();

    $(function(){
      ADMIN = "<?php  if(isset($_SESSION['admin_name']))
                           echo($_SESSION['admin_name']) 
                        ?>";
      $("#admin_name")[0].innerHTML = "你好，管理员"+ADMIN+"　<span class='caret'></span>";
      // set up datepicker.
       $("#datetime").datetimepicker({
            format: "yyyy-mm",
            autoclose: true,
            startDate: "2013-06",
            startView:3,
            minView:3,
            todayHighlight:true,
            viewSelect:3,
            language:'zh-CN',
            pickerPosition: "bottom",
            initialDate:new Date()
        });
       $("#from_date").datetimepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            startDate: "2013-06",
            startView:3,
            minView:2,
            todayHighlight:true,
            viewSelect:3,
            language:'zh-CN',
            pickerPosition: "bottom",
            initialDate:new Date()
        });
       $("#to_date").datetimepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            startDate: "2013-06",
            startView:3,
            minView:2,
            todayHighlight:true,
            viewSelect:3,
            language:'zh-CN',
            pickerPosition: "bottom",
            initialDate:new Date()
        });
       loadDataByMonth();
               
    });


  
    function loadDataByMonth(){
      $("#confirmdate1").attr("class","btn btn-primary btn-large");
      $("#confirmdate2").attr("class","btn btn-default btn-large");
      getUserDataByMonth();
      getPhoneChartByMonth();
      getOSChartByMonth();
    }

    function getFromToDate(){
      var from_date_string = $("#from_date").val();
      var to_date_string = $("#to_date").val();
      var from_date_m = new Date(from_date_string).getTime();
      var to_date_m = new Date(to_date_string).getTime();
      if(from_date_m>to_date_m){
        alert("截止日期不得大于起始日期");
        return false;
      }
      else{
        from_date = from_date_string;
        to_date = to_date_string;
        console.log(from_date+to_date);
        return true;
      }
    }
    function loadDataByTimespace(){
      $("#confirmdate2").attr("class","btn btn-primary btn-large");
      $("#confirmdate1").attr("class","btn btn-default btn-large");
      if(getFromToDate()){
        getUserDataByTimespace();
        getPhoneDataByTimespace();
        getOsDataByTimespace();
      }
    }

    function getUserDataByMonth(){
      var pickdate = $("#datetime").val();
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation1,
          'date':pickdate
        },
        success:function(data){
          console.log(data);
          var total = getTotal(data['data']);
          var height = data['data'].length*20;
          console.log("height:"+height);
          $("#user_chart").attr("style","height:"+ height+"px");
          $("#user_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "地区",
                type: "bar",
                color: '#996699'
            },
            title: "用户地区分布排行",
            tooltip:{
              enabled:true,
              customizeText: function () {
                          return this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }

            },
            valueAxis: {
                title: {
                    text: "人数"
                },
                position: "bottom"
            },
            rotated:true,
            legend:{
              position:'inside'
            }
          });
          
        }
      });
    }
    function getUserDataByTimespace(){
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation5,
          'from':from_date,
          'to':to_date
        },
        success:function(data){
          console.log(data);
          var height = data['data'].length*20;
          console.log("height:"+height);
          $("#user_chart").attr("style","height:"+ height+"px");
          var total = getTotal(data['data']);
          $("#user_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "地区",
                type: "bar",
                color: '#996699'
            },
            title: "用户地区分布排行",
            tooltip:{
              enabled:true,
              customizeText: function () {
                          return this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }

            },
            valueAxis: {
                title: {
                    text: "人数"
                },
                position: "left"
            },
            rotated: true,
            legend:{
              position:'inside'
            }

          });
          
        }
      });
    }
    function getPhoneChartByMonth(){

      var pickdate = $("#datetime").val();
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation2,
          'date':pickdate
        },
        success:function(data){
          console.log(data);
          var height = data['data'].length*20;
          console.log("height:"+height);
          $("#phone_chart").attr("style","height:"+ height+"px");
          var total = getTotal(data['data']);
          $("#phone_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "手机型号",
                type: "bar",
                // color: '#ffa500'
            },
            title: "手机型号分布排行",
            tooltip:{
              enabled:true,
              customizeText: function () {
                          return this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }

            },
            valueAxis: {
                title: {
                    text: "个数"
                },
                position: "left"
            },
            rotated: true,
            legend:{
              position:'inside'
            }
        
          });
          
        }
      });
    }
    function getPhoneDataByTimespace(){
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation6,
          'from':from_date,
          'to':to_date
        },
        success:function(data){
          console.log(data);
          var height = data['data'].length*20;
          console.log("height:"+height);
          $("#phone_chart").attr("style","height:"+ height+"px");
          var total = getTotal(data['data']);
          $("#phone_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "手机型号",
                type: "bar",
                // color: '#ffa500'
            },
            title: "手机型号分布排行",
            tooltip:{
              enabled:true,
              customizeText: function () {
                          return this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }

            },
            valueAxis: {
                title: {
                    text: "个数"
                },
                position: "left"
            },
            rotated: true,
            legend:{
              position:'inside'
            }


          });
          
        }
      });
    }

    function getOSChartByMonth(){
      var pickdate = $("#datetime").val();
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation3,
          'date':pickdate
        },
        success:function(data){
          console.log(data);
          var height = data['data'].length*30;
          console.log("height:"+height);
          $("#os_chart").attr("style","height:"+ height+"px");
          var total = getTotal(data['data']);
          $("#os_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "安卓版本",
                type: "bar",
                color: '#993300'
            },
            title: "安卓版本分布排行",
            tooltip:{
              enabled: true,
              customizeText: function () {
                          return "版本"+this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }
            },
             valueAxis: {
                title: {
                    text: "个数"
                },
                position: "left"
            },
            rotated: true,
            legend:{
              position:'inside'
            }

          });
          }
      });
    }
    function getOsDataByTimespace(){
      $.ajax({
        type:"POST",
        url:"admin_bg.php",
        dataType:"json",
        async:false,
        data:{
          'operation':operation7,
          'from':from_date,
          'to':to_date
        },
        success:function(data){
          console.log(data);
          var height = data['data'].length*30;
          console.log("height:"+height);
          $("#os_chart").attr("style","height:"+ height+"px");
          var total = getTotal(data['data']);
          $("#os_chart").dxChart({
            dataSource: data['data'],
            
            series: {
                argumentField: "phone",
                valueField: "sum",
                name: "安卓版本",
                type: "bar",
                color: '#993300'
            },
            title: "安卓版本分布排行",
            tooltip:{
              enabled: true,
              customizeText: function () {
                          return "版本"+this.argumentText + "占比例：" + Math.round((this.valueText/total)*10000)/100 +"%";
                      }
            },
             valueAxis: {
                title: {
                    text: "个数"
                },
                position: "left"
            },
            rotated: true,
            legend:{
              position:'inside'
            }

          });
          }
      });
    }

    function getTotal(list){
      var sum = 0;
      console.log(list.length);
      for (var i = list.length - 1; i >= 0; i--) {
        sum += parseInt(list[i]['sum']);
      };
      console.warn('sum：='+sum);
      return sum;
    }




    function logout(){
      $.ajax({
        type : "POST",
        url : "admin_bg.php",
        dataType : "json",
        async : false,
        data:{
         'operation':operation4,
        },
        success:function(data){
         if(data['state'] === false)
           alert(data['message']);
         else
           location.href = 'login.php';
          }  
      })
    }  
    
    </script>
    </body>
  </html>