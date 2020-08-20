<?php
include("dboperation.php");
 		$obj=new dboperation();
		$obj1= new dboperation();
		$objr = new dboperation();
		$objx = new dboperation();	
		
			$cust_id=$_GET['id'];
			$stock_date=$_POST['sd'];
			$amt=$_POST['amt'];
			$f_rate=$_POST['f_rate'];
			$max_amt=$_POST['max_amt'];
			$close_date=$_POST['cd'];
			$dec="loan to customer id:".$cust_id;
			
			$query="INSERT INTO `tbl_stock`(`stock_date`, `max_amont`, `amount_given`, `gov_interest`, `fin_interest`, `cust_id`, `stock_close_date`, `status`) VALUES ('$stock_date',$max_amt,$amt,18,$f_rate,$cust_id,'$close_date',0)";
            $query2="INSERT INTO `credit_debit`(`t_date`, `dec`, `flag`, `amt`) VALUES ('$stock_date','$dec','d',$amt)";
$obj->Ex_query($query2);			
			if($obj->Ex_query($query))	
			{
				$q="select stockid from tbl_stock order by stockid DESC limit 1";
				$t=$objr->selectdata($q);
				$r=$objr->fetch($t);
				$n=$_POST['in'];
							$quantity=$_POST['quantity'];
							$product=$_POST['product'];
							
								$count=0;
								foreach( $quantity as $key => $n ) 
								{
								  $count++;
								}
								
								for($x=0;$x<$count;$x++)
							    {
									 $query4="insert into `tbl_gold_security` values('','$product[$x]','$quantity[$x]','$r[0]')";
      								 $obj1->Ex_query($query4);
									
								}
								
						//$query1="INSERT INTO tbl_gold_stock( `cust_id`, `date`, `opening_balance`, `received_weight`, `released_weight`, `closing_balance`) VALUES ('$cust_id',CURDATE(),0000,0000,0000,0000)";
						//$objx->Ex_query($query1);
						
						
							header('location:view-customers.php');
							
					
						
							
				
		  
			
			}
			?>
			