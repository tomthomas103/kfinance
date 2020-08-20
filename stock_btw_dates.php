<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Stock btw Dates</title>	
	<link href="assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="assets/images/favicon.ico" rel="apple-touch-icon" type="image/png">
	<link href="assets/images/favicon.ico" rel="icon" type="image/png">
	<link href="assets/images/favicon.ico" rel="shortcut icon">

	<!-- Global stylesheets -->
	<link href="fonts/fonts.css" rel="stylesheet" type="text/css">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-extended.css" rel="stylesheet" type="text/css">
	<link href="css/plugins.css" rel="stylesheet" type="text/css">
	<link href="css/color-system.css" rel="stylesheet" type="text/css">
	<link href="css/media.css" rel="stylesheet" type="text/css">
	<link type="text/css" rel="stylesheet"  id="style">
	<link type="text/css" rel="stylesheet"  id="theme">
	<!-- /global stylesheets -->

	<!-- Core JS files -->	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/fancybox.min.js"></script>	
	<script src="js/app.js"></script><script src="js/fancybox.min.js"></script>
<script src="js/forms/uniform.min.js"></script>
<script src="js/forms/select2.min.js"></script>
<script src="js/datatables/datatables.min.js"></script>
<script src="date.js"></script>
<script>
function hello()
{
	//getDates1(1,1,2016,2,1,2016);
	var dt1=document.getElementById("dt1").value;
	var dt2=document.getElementById("dt2").value;
	var x = document.getElementsByTagName("tr");
	  for(var i=0;i<x.length;i++)
	  {
		if((x[i].className)!="")
		{
			 val=getDates1(dt1.substring(8,10),dt1.substring(5,7),dt1.substring(0,4),dt2.substring(8,10),dt2.substring(5,7),dt2.substring(0,4),x[i].className);
			if(val==1)
			{
			}
			else
			{x[i].hidden="true";}
		}	
	  }
}	
</script>
</head>
<style>
.tdata th, td {
    padding: 10px;
    text-align: center;
}</style>
<body>
<!-- Main navbar -->
<?php include("navigation.php"); ?>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container" style="min-height:700px">

	<!-- Page content -->
	<div class="page-content">
	<!-- Main sidebar -->
<?php include("menu.php"); ?>
<!-- /main sidebar -->
<!-- Main content -->
<div class="content-wrapper">

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="fa fa-th-large position-left"></i> Customer Details </h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Stock Management</li>
				<li class="active">Stock Between Dates</li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<!-- Individual column searching (text fields) -->
				<div class="panel panel-flat"><br>
					<form method="post" action="stock_btw_dates.php" class="form-validation"> 
	<table id="table" align="center">
    <tr>
    	<td>Select Dates :</td>
    	<td><input  type="date" id="dt1" name="dt1" class="form-control" value="<?php if(isset($_POST["submit"])){$dat1=$_POST['dt1'];echo $dat1;}
			   ?>" ></td>
		<td><input  type="date"  id="dt2"  name="dt2" class="form-control" value="<?php if(isset($_POST["submit"])){$dat2=$_POST['dt2'];echo $dat2;}
			   ?>" ></td> 
     </tr>
     
     <tr>
     	<td>&nbsp;</td>
     </tr>
     <tr>
     	<td></td>
	    <td><input  type="submit" name="submit" value="Search"><input  type="button" name="gg" value="Hide" onClick="hello()"></td>
		<td>&nbsp;</td>
    </tr>
    </table> 
	<br>
    <?php
		     error_reporting(0);
              include("dboperation.php");
			  $obj=new dboperation();
			  if(isset($_POST["submit"]))
			  {
				echo "<div align='center'>";
					echo "<table id='example' border='2' class='tdata' >
    <thead>
        <tr bgcolor='#cfcfcf'>
            <th rowspan='2'>Date</th>
            <th rowspan='2'>Opening Balance</th>
            <th colspan='2'>Gold Received</th>
            <th rowspan='2'>Total Received (Weight)</th>
            <th colspan='2'>Gold Released</th>
            <th rowspan='2'>Total Received (Weight)</th>
            <th rowspan='2'> Closing Balance</th>
        </tr>
         <tr bgcolor='#a1a1a1'>
            <th> GL No. </th>
            <th> Weight </th>
			<th> GL No. </th>
			<th> Weight </th>
        </tr>
    </thead>
    <tbody>";
	
									$Startdat1='2011-06-17';
									$opBal=0;
									$clsBal=0;
									$total=0;
									$f="0";
									//$queryd="SELECT distinct stock_date FROM tbl_stock WHERE stock_date between '$dat1' and '$dat2'";
									
									$queryd="SELECT stock_date FROM v_dayOrder WHERE stock_date between '$Startdat1' and '$dat2'";
									
									$resultd=$obj->selectdata($queryd);
									$srr[0]='';
									$rss[0]='';
									$stock_received[0]='';
									$stock_released[0]='';
									while($rd=$obj->fetch($resultd))
									{
										$queryS="SELECT stockid FROM tbl_stock WHERE stock_date='".$rd['stock_date']."'";
										$resultS=$obj->selectdata($queryS);
										$i=0;
										while($rS=$obj->fetch($resultS))
										{   //echo "<pre>L:".$rS[0];
											//print_r($rS);
											$stock_received[$i]=$rS[0];
											$qyeryWeight="SELECT SUM(`sec_weight`) FROM `tbl_gold_security` WHERE stock_id=".$rS[0];
											//echo "<br>".$qyeryWeight."|";
											$resultWeight=$obj->selectdata($qyeryWeight);
											$rWeight=$obj->fetch($resultWeight);
											//print_r($rWeight);
											$rss[$i]=$rWeight[0];
											//echo " $stock_received[$i] ";
											$i++;
										}
									
										//print_r($rss);
										$querySum="SELECT SUM(sec_weight) FROM tbl_gold_security as g inner JOIN tbl_stock as s on g.stock_id=s.stockid AND s.stock_date='".$rd['stock_date']."'";
										$resultSum=$obj->selectdata($querySum);		
										$rSum=$obj->fetch($resultSum);
										
										//echo "<br>";
										$queryR="SELECT cust_id,stockid FROM tbl_release WHERE r_date='".$rd['stock_date']."'";
										$resultR=$obj->selectdata($queryR);
										$j=0;
										while($rR=$obj->fetch($resultR))
										{
											$stock_released[$j]=$rR[1];
											$qW="SELECT SUM(`sec_weight`) FROM `tbl_gold_security` WHERE stock_id=".$rR[1];
											$resW=$obj->selectdata($qW);
											$rW=$obj->fetch($resW);
											$srr[$j]=$rW[0];
											//echo "$stock_released[$j] ";
											$j++;
										}
										
										$qS="SELECT SUM(sec_weight) FROM tbl_gold_security as g inner JOIN tbl_release as s on g.stock_id=s.stockid AND s.r_date='".$rd['stock_date']."'";
										$resS=$obj->selectdata($qS);		
										$reSum=$obj->fetch($resS);
									
										if($i>$j){$c=$i;}
										else {$c=$j;}
										$clsBal=$opBal+$rSum[0]-$reSum[0];?>
										<tr class="<?=$rd[0]?>">
										<?php
										echo "<td> $rd[0] </td>";
										echo "<td> ".$opBal." </td>";
										for($k=0;$k<$c;$k++)
										{
										if($k>0)
										{ 
										?>
										<tr class="<?=$rd[0]?>">
										<?php
										echo "<td></td><td></td>";}
											
											echo "<td> ".$stock_received[$k]." </td>";
											echo "<td> ".$rss[$k]." </td>";
											echo "<td></td>";
											echo "<td> $stock_released[$k] </td>";
											echo "<td> $srr[$k] </td>";
											echo "<td></td>";
											echo "<td></td>";
										if($k>1){ echo "</tr>";}
										}
										$opBal+=$rSum[0]-$reSum[0];
										$stock_received="";
										$stock_released="";
										$rss='';
										$ssr='';
										$srr='';

										echo "</tr>"; ?>
										<tr bgcolor='#d9ffb3' class="<?=$rd[0]?>">
									<?php	echo "<td colspan='2'> </td><td></td><td><b> Total: </b></td><td bgcolor='#d9ffb3'> $rSum[0] </td><td></td><td><b> Total: </b></td><td bgcolor='#d9ffb3'> $reSum[0] </td><td> $clsBal </td></tr>";
										
									}
									
	echo "
    </tbody>
</table>";

				}
	?>
</form> <br>
				</div>
				<!-- /Individual column searching (text fields) -->
				
				
			</div>										
		</div>
		

					<!-- Footer -->
					<div class="footer pt-20">
						&copy; 2016 K Finance - Developed by <a href="www.oliutech.com" target="_blank">OLIU</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->
		
		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
</body>
</html>