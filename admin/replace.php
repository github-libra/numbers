<?php
// $ip = $_SERVER['REMOTE_ADDR'];
require_once 'mydb.php';
$ip = "220.181.111.86";

//could search local db for region info first, if not exist,seacrh remote for region info,insert into local db for next request.
//table:ip2addr
//column:id, ip, addr
$query = "select * from ip2addr where ip = '$ip'";
$result = mysql_query($query);
if(!$result)
	die(mysql_error());
if(mysql_num_rows($result) == 1){
	while($row = mysql_fetch_array($result)){
		$region = $row['addr'];
	}
}
else{
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$region = $details->city; // -> "Mountain View"
}
$query1 = "INSERT INTO ip2addr (ip,addr) VALUES('$ip','$region')";
$result1 = mysql_query($query1);
if(!$result1)
	die(mysql_error());


@$PackageName=$_POST["name"];
@$Version=$_POST["version"];
@$BuildKey=$_POST["buildkey"];
@$AndroidVersion=$_POST["androidversion"];
@$Imei=$_POST["imei"];
@$MacAddress=$_POST["mac"];
$imeiplusmac = $Imei.$MacAddress;

date_default_timezone_set('PRC');
$currentTime = date('Y-m-d H:i:s',time());

$query = sprintf("INSERT INTO userdata (package,version,buildkey,androidversion,imeiplusmac,region,accesstime) VALUES ('%s','%s','%s','%s','%s','%s','%s')",$PackageName,$Version,$BuildKey,$AndroidVersion,$imeiplusmac,$region,$currentTime);
$result = mysql_query($query);
if(!$result)
	die(mysql_error());


?>
