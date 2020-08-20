
<?php
session_start();
$u=$_POST["username"];
$p=$_POST["password"];
$_SESSION["username"]=$u;
$_SESSION["password"]=$p;
include("dboperation.php");
$obj=new dboperation();
$count=0;
if($u==''||$p=='')
{
	echo "<script type='text/javascript'>alert('Please Enter fields first!');window.location='index.php'</script>";
}
else
{
	$query="select * from tbl_login";
	$result=$obj->selectdata($query);
	while($r=$obj->fetch($result))
	 {	
	   if($r[0]==$u && $r[1]==$p )
	   {
		   $count=$count+1;
		   $_SESSION["a"]=$r['user_name'];
		   echo '<script> window.location="home-admin.php"</script>';
		   
	   }
	 }
	 
	  if($count==0)
	  {
		 echo '<script> alert("sorry invalid login try again !!!!"); window.location="index.php";</script>'; 
	  }

}
?>
