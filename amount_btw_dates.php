<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Amount Between Dates</title>	
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
				<h4><i class="fa fa-th-large position-left"></i> Amount Details </h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Amount Management</li>
				<li class="active">Amount Between Dates</li>
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
					<form method="post" action="amount_btw_dates.php" class="form-validation"> 
			<table id="table" align="center">
				<tr>
					<td>Select Dates :</td>
					<td><input  type="date" id="dt1" name="dt1" class="form-control" value="<?php if(isset($_POST["submit"])){$dat1=$_POST['dt1'];echo $dat1;} ?>" ></td>
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
		</form>
		<?php
			//error_reporting(0);
            include("dboperation.php");
			$obj=new dboperation();
			if(isset($_POST["submit"]))
			{
				?>
				<table border=1 align="center">
					<tr>
						<th>Date</th>
						<!--<th>Date</th>-->
						<th>Sl No</th>
						<th>Desc</th>
						<th>Credit</th>
						<th>debit</th>				
					</tr>				
				<?php
				$Startdat1='2011-06-17';
				$queryd="select distinct t_date from credit_debit where t_date between '$Startdat1' and '$dat2'  ORDER by t_date";
				$resultd=$obj->selectdata($queryd);
				//echo $queryd;//print_r($resultd);
				$sum=0;
				while($rd=$obj->fetch($resultd))
				{
					$queryS="SELECT * FROM credit_debit WHERE  t_date='".$rd['t_date']."'";
					$resultS=$obj->selectdata($queryS);
					$cr=0;
					$de=0;
					$sn=0;
					while($rd1=$obj->fetch($resultS))
					{ 	
				$sn++;
						echo "<tr>
								<td>".$rd1['t_date']."</td>
								<!--<td>21</td>-->
								<td>$sn</td>
								<td>".$rd1['dec']."</td>";
						if($rd1['flag']=='c')
						{
							echo "  <td>".$rd1['amt']."</td>
									<td></td>";
									$cr=$cr+$rd1['amt'];
						}
						else{
							echo "  <td></td>
							<td>".$rd1['amt']."</td>";
							$de=$de+$rd1['amt'];
						}
						echo "</tr>";
					}
					echo 	"<tr>
								<td colspan=3></td>
								<td>$cr</td>
								<td>$de</de>
							</tr>";
						if($cr>$de)
						{
							$re=$cr-$de;
							$sum=$sum+$re;
						}
						else
						{$re=$de-$cr;
					    $sum=$sum-$re;
					}
					echo	"<tr>
								<td colspan=3>Total</td>
								<td>$re</td>
								<td></td>
							</tr>";
							
							echo	"<tr>
								<td colspan=3>carry over</td>
								<td>$sum</td>
								<td></td>
							</tr>";
					
				}
				echo "</table>";
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