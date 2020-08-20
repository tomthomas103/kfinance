<html>
<head>
<meta charset="utf-8">
<script src="dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="dist/sweetalert.css">
</head>
<body>   
<?php 
		include("dboperation.php");
 		$objf=new dboperation();
		$objr1 = new dboperation();	
		//echo "ss";
			$no=$_POST['cust_no'];
			$name=$_POST['cust_name'];
			$hname=$_POST['house_name'];
			$address=$_POST['address'];
			$phoneno=$_POST['tel'];
			$nname=$_POST['nom_name'];
			$nphoneno=$_POST['nom_tel'];
			$iname=$_POST['intro_name'];
			$income=$_POST['income'];
			
			$q="SELECT cust_id FROM tbl_customer where cust_id=$no";
			$t=$objr1->selectdata($q);
			$r=$objr1->fetch($t);
			if(sizeof($r)>0){
			echo "<script>alert('duplicate value'); window.location='cust_reg.php'; </script>";

			}
			
			
			if($name==''||$hname==''||$address==''||$phoneno==''||$nname==''||$nphoneno==''||$iname==''||$income=='')
			{
					echo "<script>swal({   title: 'Please fill the fields first!',   
    text: '',   
    type: 'warning',   
    showCancelButton: false,   
    confirmButtonColor: '#DD6B55',   
    confirmButtonText: 'OK',  
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        window.location='cust_reg.php';  
        } 
        else {     
            window.location='cust_reg.php';   
            } });</script>";
			}
			else{
				
			$query="INSERT INTO tbl_customer( `cust_id`,`cust_name`, `cust_housename`, `cust_address`, `cust_phone`, `nomi_name`, `nomi_phone`, `income`, `intro_name`) VALUES ('$no','$name','$hname','$address',$phoneno,'$nname',$nphoneno,$income,'$iname')";
			
			if($objf->Ex_query($query))	
			{
				$q="select cust_id from tbl_customer order by cust_id DESC limit 1";
				$t=$objr1->selectdata($q);
				$r=$objr1->fetch($t);
				echo "<script type='text/javascript'>swal({   title: 'Customer registered successfully!',   
    text: '',   
    type: 'success',   
    showCancelButton: false,   
    confirmButtonColor: '#DD6B55',   
    confirmButtonText: 'OK',  
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        window.location='cust_security.php?&id=$r[0]';  
        } 
        else {     
            window.location='cust_security.php?&id=$r[0]';   
            } }); 
    </script>";
			
			}
			else
			{
				echo "<script type='text/javascript'>swal({   title: 'Customer registration Unsuccessful!',   
    text: '',   
    type: 'error',   
    showCancelButton: false,   
    confirmButtonColor: '#DD6B55',   
    confirmButtonText: 'OK',  
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        window.location='cust_reg.php';  
        } 
        else {     
            window.location='cust_reg.php';   
            } }); 
    </script>";
			}
			
			
			}
			
			
			
?>
</body>
</html>