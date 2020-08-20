<?php
class dboperation
{
var $con;
var $result;
var $r;
function Ex_query($query)
{
$con=mysqli_connect("localhost","root","","k_finance");
$this->result=mysqli_query($con,$query);
if($this->result>0)
{
return 1;
}
else
{
return 0;
}
}
function selectdata($query)
{
$con=mysqli_connect("localhost","root","","k_finance");
if($result=mysqli_query($con,$query))
{return $result;}
}

function fetch($result)
{
$r=mysqli_fetch_array($result,MYSQLI_BOTH);
return $r;
}

}
?>
