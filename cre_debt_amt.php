<?php 
include("dboperation.php");
$type=$_POST['type'];
$cddate=$_POST['cddate'];
$cre_debt_amt=$_POST['cre_debt_amt'];
$desc=$_POST['desc'];
$ob= new dboperation(); 
$qry="INSERT INTO `credit_debit`(`t_date`, `dec`, `flag`, `amt`) VALUES ('$cddate','$desc','$type','$cre_debt_amt')";
$res=$ob->Ex_query($qry);
header("location:home-admin.php");
?>