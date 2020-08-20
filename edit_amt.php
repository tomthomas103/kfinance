<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Credit</title>	
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
	<link type="text/css" rel="stylesheet" href="cust_reg.php" id="style">
	<link type="text/css" rel="stylesheet" href="cust_reg.php" id="theme">
	<!-- /global stylesheets -->

	<!-- Core JS files -->	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/fancybox.min.js"></script>	
	<script src="js/app.js"></script><script src="js/core.min.js"></script>
<script src="js/forms/form.min.js"></script>
<script src="js/forms/form_wizard.min.js"></script>
<script src="js/forms/select2.min.js"></script>
<script src="js/forms/uniform.min.js"></script>

</head>

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
				<h4><i class="fa fa-pencil position-left"></i>Edit Customer</h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>				
				<li>Edit Option</li>
				<li>Customer Details</li>
				<li class="active">Edit</li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
	<?php
$cust_id=$_GET['cust_id'];
$in=$_GET['i'];
include("dboperation.php");
$obj1 = new dboperation(); 
				$query="SELECT stockid, stock_date,amount_given,fin_interest,stock_close_date,status FROM tbl_stock WHERE cust_id=".$cust_id.""; 
	  					$result=$obj1->selectdata($query); 
	    				while($f=$obj1->fetch($result))
       					{
						$fr=$f[3];
						$newp=$f[2]+$in;
						$amt_gvn=$f[2];
						$sdate=$f[1];
						}
						$query2="SELECT cust_name FROM tbl_customer WHERE cust_id=".$cust_id.""; 
						$result2=$obj1->selectdata($query2);
						$f2=$obj1->fetch($result2)
?>	
<div class="panel panel-flat">
			<form class="form-validation" action="edit_amt_action.php" method="post">
				<fieldset class="step" id="validation-step1">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Customer Name:</label>
								<input type="text" name="cust_name" class="form-control" value="<?php echo $f2[0]; ?>">
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Customer id:</label>
								<input type="text" name="cust_id" class="form-control" value="<?php echo $_REQUEST['cust_id']; ?>" readonly >
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Current Credit Amount :</label>
								<input type="text" name="cur_amt"  id="cur_amt" value="<?php echo $amt_gvn.' + '.round($in,2); ?>" class="form-control" readonly>
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Stock Date:</label>
								<input type="date" name="sd" class="form-control" value="<?php echo $sdate?>"  />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Interest:</label>
								<input type="text" name="f_rate" value="<?php echo $fr; ?>" class="form-control">
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>New Credit Amount:</label>
								<input type="number" id="new_amt" name="new_amt" id="t_amt" class="form-control" value="<?php echo $amt_gvn;?>" >
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_theme_danger">Credit</button>
								<!--<button type="submit" class="form-control">Credit</button>-->
							</div>
						</div>
					</div>
					<!-- Danger modal -->
		<div id="modal_theme_danger" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content bg-danger">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Do You Really want to edit ?</h4>
					</div>

					<div class="modal-body">
						<p></p>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Yes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /default modal -->
				</fieldset>
				</form>
				</div>
		<!-- /wizard with validation -->

	<!-- Content area -->
		
<script type='text/javascript'>
	$(document).ready(function() {		
		$(function() {			
			// Wizard examples
			// ------------------------------
			// Basic setup
			$(".form-basic").formwizard({
				disableUIStyles: true,
				disableInputFields: false,
				inDuration: 150,
				outDuration: 150
			});

			// Cancel the post
			$(".form-post-cancel").formwizard({
				disableUIStyles: true,
				disableInputFields: false,
				formPluginEnabled: true,
				inDuration: 150,
				outDuration: 150,
				formOptions: {
					success: function(data){
						swal({title: "Congratulations!", text: "You are registered now!", type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
					},
					dataType: 'json',
					resetForm: true, 
					beforeSubmit: function(){
						return confirm("This is the beforeSubmit callback, do you want to submit?");
					},
					beforeSend: function(){
						return confirm("This is the beforeSend callback, do you want to submit?");
					},
					beforeSerialize: function(){
						return confirm("This is the beforeSerialize callback, do you want to submit?");
					}
				}
			});

			// With validation
			$(".form-validation").formwizard({
				disableUIStyles: true,
				validationEnabled: true,
				inDuration: 150,
				outDuration: 150,
				validationOptions: {
					ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
					errorClass: 'validation-error-label',
					successClass: 'validation-valid-label',
					highlight: function(element, errorClass) {
						$(element).removeClass(errorClass);
					},
					unhighlight: function(element, errorClass) {
						$(element).removeClass(errorClass);
					},

					// Different components require proper error label placement
					errorPlacement: function(error, element) {

						// Styled checkboxes, radios, bootstrap switch
						if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
							if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
								error.appendTo( element.parent().parent().parent().parent() );
							}
							 else {
								error.appendTo( element.parent().parent().parent().parent().parent() );
							}
						}

						// Unstyled checkboxes, radios
						else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
							error.appendTo( element.parent().parent().parent() );
						}

						// Input with icons and Select2
						else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
							error.appendTo( element.parent() );
						}

						// Inline checkboxes, radios
						else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
							error.appendTo( element.parent().parent() );
						}

						// Input group, styled file input
						else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
							error.appendTo( element.parent().parent() );
						}

						else {
							error.insertAfter(element);
						}
					},
					rules: {
						email: {
							email: true
						}
					}
				}
			});

			// Update single file input state
			$(".form-validation").on("step_shown", function(event, data) {
				$.uniform.update();
			});

			// AJAX form submit
			$(".form-ajax").formwizard({
				disableUIStyles: true,
				formPluginEnabled: true,
				disableInputFields: false,
				inDuration: 150,
				outDuration: 150,
				formOptions :{
					success: function(data){
						swal({title: "Congratulations!", text: "You are registered now!", type: "success", timer: 2000, confirmButtonColor: "#43ABDB"})
					},
					beforeSubmit: function(data){
						$("#ajax-data").css({borderTop: '1px solid #ddd', padding: 15}).html("<span class='text-semibold'>Data sent to the server:</span> " + $.param(data));
					},
					dataType: 'json',
					resetForm: true
				}
			});

			// Add steps dynamically
			// Initialize wizard
			$(".form-add-steps").formwizard({
				disableUIStyles: true,
				disableInputFields: false,
				inDuration: 150,
				outDuration: 150
			});

			// Append step on button click
			$("#add-step").on('click', function(){
				$(".step-wrapper").append($(".extra-steps .step:first"));
				$(".form-add-steps").formwizard("update_steps");  
				return false;
			});

			// Select2 selects
			$('.select').select2();

			// Simple select without search
			$('.select-simple').select2({
				minimumResultsForSearch: Infinity
			});

			// Styled checkboxes and radios
			$('.styled').uniform({
				radioClass: 'choice'
			});

			// Styled file input
			$('.file-styled').uniform({
				wrapperClass: 'bg-danger',
				fileButtonHtml: '<i class="fa fa-plus"></i>'
			});

			// Uncomment if you use styled checkboxes/radios to update them dynamically when step changed
			$(".form-basic, .form-validation, .form-add-steps, .form-ajax").on("step_shown", function(event, data){
				//$.uniform.update();
			});
		});
	});
</script>
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