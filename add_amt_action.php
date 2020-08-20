<?php 
include("dboperation.php");
$cust_id=$_POST['cust_id'];
$sd=$_POST['sd'];
$cur_amt=$_POST['cur_amt'];
$amt=$_POST['tot_amt'];
$dec="loan to customer id:".$cust_id;
$dec2="amount from customer id:".$cust_id;
$ob= new dboperation(); 
$qry="update tbl_stock  set stock_date='$sd',amount_given='$amt' WHERE cust_id='$cust_id'";
$query2="INSERT INTO `credit_debit`(`t_date`, `dec`, `flag`, `amt`) VALUES ('$sd','$dec','d',$amt)";
$query3="INSERT INTO `credit_debit`(`t_date`, `dec`, `flag`, `amt`) VALUES ('$sd','$dec2','c',$cur_amt)";
$ob->Ex_query($query2);
$ob->Ex_query($query3);
$res=$ob->Ex_query($qry);
header("location:cust_view_action.php?&id=$cust_id");
?>