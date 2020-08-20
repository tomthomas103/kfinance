<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Customer Registration</title>	
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
<!------------------Pop Ups--------------->
<script src="dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="dist/sweetalert.css">
</head>

 <script>
   $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){

		//on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr><td><input type="text" name="product[]" placeholder="eg.chain" class="form-control"/> </td><td><input type="number" name="quantity[]" placeholder="In grams" class="form-control"></td></tr>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
    </script>
	<script>
	function ChangeCustID(){
			document.getElementById("cust_no").readOnly = 0;
		/*if(document.getElementById("cust_no").readOnly)
		{
				document.getElementById("cust_no").readOnly = 0;
		}
		else{
			document.getElementById("cust_no").readOnly = 1;
		}*/
		
		
		//window.open("page url",null,"height=200,width=400,status=no,toolbar=no,menubar=no,location=no,scrollbars=no,resizable=no;");
	}
	
	</script>

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
<?php 
		include("dboperation.php");
 		$objr1=new dboperation();
		$q="SELECT cust_id FROM tbl_customer ORDER BY cust_id DESC LIMIT 1";
		$t=$objr1->selectdata($q);
		$r=$objr1->fetch($t);
	?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="fa fa-pencil position-left"></i> Customer Registration</h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>				
				<li>Customer Management</li>
				<li>Customer Registration</li>
				<li class="active"><?php echo $r[0]+1; ?></li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		
		<!-- Wizard with validation -->
		<div class="panel panel-flat">
			<form class="form-validation" action="cust_reg_action.php" method="post" >
			<fieldset class="step" id="validation-step1">
					<h6 class="form-wizard-title">
						<span class="form-wizard-count" onclick='ChangeCustID();'><?php echo $r[0]+1;?></span>
						Customer info
						<small class="display-block">Details about customer</small>
					</h6>

					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Customer Number:</label>
								<input type="text" readOnly name="cust_no" id="cust_no" class="form-control" value='<?php echo $r[0]+1;?>'>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Customer name:</label>
								<input type="text" name="cust_name" id="cust_name" class="form-control" placeholder="Enter Customer Name">
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>House Name:</label>
								<input type="text" name="house_name" id="house_name" class="form-control" placeholder="Enter House Name" onclick="validateCustname()">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Address:</label>
								<textarea name="address" id="address" rows="4" cols="5" placeholder="Enter Full Customer Address" class="form-control"onclick="validateHousename()">NA</textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Phone :</label>
								<input type="text" name="tel" id="tel" class="form-control" placeholder="+99-123-456-7890" data-mask="+99-123-456-7890" value="0">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Nominee name:</label>
								<input type="text" name="nom_name" id="nom_name" class="form-control" placeholder="Enter Nominee Name" value="NA">
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Nominee Phone Number:</label>
								<input type="text" name="nom_tel" id="nom_tel" class="form-control" placeholder="+99-123-456-7890" data-mask="+99-123-456-7890" value="0" >
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Introducer name:</label>
								<input type="text" name="intro_name" id="intro_name" class="form-control" placeholder="Enter Introducer Name" value="NA">
							</div>
						</div>

						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Annual Income:</label>
								<input type="text" name="income" id="income" class="form-control" placeholder="Enter Annual Income" value="1000"> 
							</div>
						</div>
					</div>
				
				<div class="form-wizard-actions">
					<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-comments pos><i class="fa fa-comments position-left"></i> Register</button>
				</div>
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