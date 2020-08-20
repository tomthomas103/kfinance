<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Customer Details</title>	
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
				<h4><i class="fa fa-th-large position-left"></i> Customer Details </h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Customer Management</li>
				<li class="active">Customer Details</li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<!-- Individual column searching (text fields) -->
				<div class="panel panel-flat">
					<!--<div class="panel-heading">
						<h4 class="panel-title">Individual column searching <span class="text-muted">(Text fields)</span></h4>						
					</div>
					<div class="panel-body">
						<p>Individual columns searching with <code>text inputs</code>. It can be used by adding <code>column().search()</code> method to the datatable.</p>
					</div>-->
					<?php
						include("dboperation.php");
						$obj=new dboperation();
						$query1="SELECT * FROM tbl_customer where cust_id in(SELECT distinct cust_id FROM tbl_stock where status=0)";
						$result1=$obj->selectdata($query1);
					?>
					<table class="table datatable datatable-column-search-inputs" id="">
						<thead>
							<tr>
								<th>Customer id</th>							
								<th>Customer Name</th>								
								<th>Address</th>
								<th>Phone number</th>
								<th>Nominee Name</th>		
								<th>Nominee Phone Number</th>
								<th>Introducers Name</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$n=0;
							while($r1=$obj->fetch($result1))
							{
								$n=$n+1;
							echo "<tr>
								<td>$r1[0]</td>							
								<td>
									<h6 class='no-margin'>
										<a href='cust_view_action.php?&id=$r1[0]'>$r1[1]</a>
									</h6>
								</td>								
								<td>
									$r1[3]
								</td>
								<td>
									$r1[4]
								</td>
								<td>
									$r1[5]
								</td>	
								<td>
									$r1[6]
								</td>	
								<td>
									$r1[8]
								</td>	
							</tr>";
							}
							?>
										
						</tbody>
						<tfoot>
							<tr>
								<td>Customer id</td>							
								<td>Customer Name</td>								
								<td>Address</td>
								<td>Phone number</td>
								<td>Nominee Name</td>		
								<td>Nominee Phone Number</td>
								<td>Introducers Name</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /Individual column searching (text fields) -->
				
				
			</div>										
		</div>
		
<script type='text/javascript'>
	$(document).ready(function() {				
		$(function() {
			
			// DataTable setup			
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				columnDefs: [{ 
					orderable: false,
					width: '100px',
					targets: [ 1 ]
				}],
				dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
				language: {
					search: '<span>Search:</span> _INPUT_',
					lengthMenu: '<span>Show:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
				},
				
				lengthMenu: [ 5, 10, 25, 50 ],
				displayLength: 5,				
				
			});
									
			
			
			// Individual column searching with text inputs
			$('.datatable-column-search-inputs tfoot td').not(':last-child').each(function () {
				var title = $('.datatable-column-search-inputs thead th').eq($(this).index()).text();
				$(this).html('<input type="text" class="form-control input-sm" placeholder="'+title+'" />');
			});
			var table = $('.datatable-column-search-inputs').DataTable();
			table.columns().every( function () {
				var that = this;
				$('input', this.footer()).on('keyup change', function () {
					that.search(this.value).draw();
				});
			});
			
			// Individual column searching with selects
			$('.datatable-column-search-selects').DataTable({
				retrieve: true,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="filter-select" data-placeholder="Filter"><option value=""></option></select>')
							.appendTo($(column.footer()).not(':last-child').empty())							
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);
		 
								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							} );
		 
						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});
			
			// Single row selection
			var singleSelect = $('.datatable-selection-single').DataTable();
			$('.datatable-selection-single tbody').on('click', 'tr', function() {
				if ($(this).hasClass('success')) {
					$(this).removeClass('success');
				}
				else {
					singleSelect.$('tr.success').removeClass('success');
					$(this).addClass('success');
				}
			});

			// Multiple rows selection
			$('.datatable-selection-multiple').DataTable();
			$('.datatable-selection-multiple tbody').on('click', 'tr', function() {
				$(this).toggleClass('success');
			});

			
			// Add placeholder to the datatable filter option
			$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');

			// Enable Select2 select for the length option
			$('.dataTables_length select').select2({
				minimumResultsForSearch: Infinity,
				width: 'auto'
			});

			// Enable Select2 select for individual column searching
			$('.filter-select').select2();
			
			$('.select').select2();
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