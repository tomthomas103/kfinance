<?php
	$cust_id=$_GET['cust_id'];
	$stock_id=$_GET['stock_id'];
	$amt=$_GET['amt'];
	include("dboperation.php");
	$dec="Amount customer id:".$cust_id;
	$obj = new dboperation();
		$query="INSERT INTO tbl_release( `cust_id`, `r_date`,`stockid`) VALUES ('$cust_id',CURDATE(),$stock_id)";
		$obj->Ex_query($query);
		$query1="UPDATE tbl_stock SET status=1 WHERE cust_id='$cust_id'";
		$obj->Ex_query($query1);
		$query2="INSERT INTO `credit_debit`(`t_date`, `dec`, `flag`, `amt`) VALUES (CURDATE(),'$dec','c',$amt)";
		$obj->Ex_query($query2);
		echo "<script type='text/javascript'>alert('Gold Released successfully!');window.location='view-customers.php'</script>";
?>