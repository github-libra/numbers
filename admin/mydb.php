<?php
	
	$con = mysqldb();
	 function mysqldb()
	{
		# code...
		// add a line of comment for test.
		asdf;
		 $connect = mysql_pconnect("localhost","root");
		if (!$connect)
		  {
		  die('Could not connect: ' . mysql_error());
		  
		  debug_print_backtrace();
		  }
		  
		    mysql_select_db("numbers", $connect);
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET CHARACTER_SET_CLIENT=utf8");
			mysql_query("SET CHARACTER_SET_RESULTS=utf8");
		    return $connect;
	}
?>
