<?php
//nothing
require_once 'mydb.php';
if(isset($_POST['operation']))
  $operation = $_POST['operation'];

switch ($operation) {

  case 'login':
    $result = login($_POST['phone'],$_POST['passwd'],$_POST['isChecked']);
    echo json_encode($result);
    break;

    case 'logout':
    $result2 = array();
    session_start();
    $result2['state'] = session_destroy();
    echo json_encode($result2);
    break;
    
    case 'load_user_chart_by_month':
    $result6 = loadPhoneChartByMonth($_POST['date'],"region");
    echo json_encode($result6);
    break;

    case 'load_phone_chart_by_month':
    $result6 = loadPhoneChartByMonth($_POST['date'],"buildkey");
    echo json_encode($result6);
    break;

    case 'load_os_chart_by_month':
    $result6 = loadPhoneChartByMonth($_POST['date'],"androidversion");
    echo json_encode($result6);
    break;

    case 'load_user_chart_by_timespace':
    $result6 = loadPhoneChartByTimespace($_POST['from'],$_POST['to'],"region");
    echo json_encode($result6);
    break;

    case 'load_phone_chart_by_timespace':
    $result6 = loadPhoneChartByTimespace($_POST['from'],$_POST['to'],"buildkey");
    echo json_encode($result6);
    break;

    case 'load_os_chart_by_timespace':
    $result6 = loadPhoneChartByTimespace($_POST['from'],$_POST['to'],"androidversion");
    echo json_encode($result6);
    break;

  default:
    # code...
    break;
}






    
function login($phone, $passwd, $isChecked){
  $return = array();
  $query1= sprintf("SELECT * FROM admin WHERE name='%s' and enabled = 1",mysql_real_escape_string($phone));
  $result1 = mysql_query($query1);

  $return = array();
  if (!$result1 || mysql_num_rows($result1)==0) {
        
          $return['value']=0;
          mysql_free_result($result1);
          return $return;
      }
 
      while($row = mysql_fetch_array($result1)){
          
       // echo "密码是".$row["passwd"]."<br/>";
        if($row['passwd']== $passwd){

          session_start();  

          $_SESSION['admin_name'] = $phone;
          $_SESSION['admin_passwd'] = $passwd;   
          $_SESSION['admin_userid'] = $row['id'];
              
          $return['value']=1;             
        }else//echo "密码不正确";
          $return['value']=-1;
      
      }
      return $return;    
}





function loadPhoneChartByMonth($yearMonthString, $column){

  $startDate = date('Y-m-1',strtotime("$yearMonthString"));
  $endDate = date('Y-m-t',strtotime("$yearMonthString"));
  // echo $startDate2.$endDate2;
  

  $return = array();
  $query = "SELECT count(t1.$column) as sum ,t1.$column as phone from (select distinct imeiplusmac,$column from userdata where accesstime <= '$endDate' and accesstime >= '$startDate') t1 group by phone order by sum ";
  $result1 = mysql_query($query);


  if(!$result1){
    $return['state'] = 0;
    $return['message'] = "获取数据失败";
  }

  // $each = array();
  // $phone = array();
  // $sum = array();
  $each = array();
  $data = array();
  $return['state'] = 1;
  $return['message'] = "获取数据成功";
  while($row = mysql_fetch_array($result1)){
    // array_push($sum, (int)$row['sum']);
    // array_push($phone,$row['phone']);
    $each['phone'] = $row['phone'];
    $each['sum'] = $row['sum'];
    array_push($data, $each);
  }

  $return['data'] = $data; 
  return $return;
}


function loadPhoneChartByTimespace($from, $to, $column){

  $return = array();
  $query = "SELECT count(t1.$column) as sum ,t1.$column as phone from (select distinct imeiplusmac,$column from userdata where accesstime <= '$to' and accesstime >= '$from') t1 group by phone order by sum ";
  $result1 = mysql_query($query);


  if(!$result1){
    $return['state'] = 0;
    $return['message'] = "获取数据失败";
  }

  // $each = array();
  // $phone = array();
  // $sum = array();
  $each = array();
  $data = array();
  $return['state'] = 1;
  $return['message'] = "获取数据成功";
  while($row = mysql_fetch_array($result1)){
    // array_push($sum, (int)$row['sum']);
    // array_push($phone,$row['phone']);
    $each['phone'] = $row['phone'];
    $each['sum'] = $row['sum'];
    array_push($data, $each);
  }

  $return['data'] = $data; 
  return $return;
}

?>