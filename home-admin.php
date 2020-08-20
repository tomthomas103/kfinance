<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance</title>	
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
	<link href="assets/weather/weather-icons.min.css" rel="stylesheet" type="text/css">
	<link href="assets/weather/weather-icons-wind.min.css" rel="stylesheet" type="text/css">
	<link type="text/css" rel="stylesheet" href="home-admin.php" id="style">
	<link type="text/css" rel="stylesheet" href="home-admin.php" id="theme">
	<!-- /global stylesheets -->

	<!-- Core JS files -->	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/fancybox.min.js"></script>	
	<script src="js/app.js"></script>
	<script src="js/forms/uniform.min.js"></script>
	<script src="js/dashboard.js"></script>
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
				<h4><i class="fa fa-home position-left"></i> <span>Dashboard</span></h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>
				<li class="active">Dashboard</li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->


	<!-- Content area -->
	<div class="content">

		<div class="row">			
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-flat bg-indigo">
					
					<div class="p-10">
						<div class="chart" id="google-area"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-flat bg-pink">
					
					<div class="p-10">
						<div class="chart" id="google-area-intervals"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="panel panel-flat bg-purple">
					
					<div class="p-10">
						<div class="chart" id="google-column"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
						include("dboperation.php");
						$obj=new dboperation();
						$query1="SELECT * FROM tbl_customer where cust_id in(SELECT distinct cust_id FROM tbl_stock where status=0)";
						$result1=$obj->selectdata($query1);
					?>
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<div class="panel panel-flat border-left-xlg border-left-info">
					<div class="panel-heading pt-20 pl-20">
						<h4 class="panel-title"><i class="fa fa-users position-left"></i>Customer Details</h4>				
					</div>
					<div class="table-responsive">
						<table class="table datatable datatable-column-search-inputs">
							<thead>
								<tr>
									<th>Customer id</th>
									<th>Customer Name</th>
									<th>Address</th>
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
							</tr>";
							}
							?>
							</tbody>
							<tfoot>
							<tr>
								<td>Customer id</td>							
								<td>Customer Name</td>								
								<td>Address</td>
							</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>	
<div class="col-md-4 col-sm-4">
				<div class="panel panel-flat bg-teal-300 no-margin" align="center">
					<article class="clock">
					  <div class="hours-container">
						<div class="hours"></div>
					  </div>
					  <div class="minutes-container">
						<div class="minutes"></div>
					  </div>
					  <div class="seconds-container">
						<div class="seconds"></div>
					  </div>
					</article>
				</div>
				<div class="panel panel-flat no-margin mb-20 pb-5">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="pl-20 pt-5 pb-5 text-teal-300">
							<?php
								$now = new DateTime();
								$year = $now->format("Y");
								$month=$now->format("M");
								$day=$now->format("D");
								$cur_date=$now->format("d");
								
							?>
								<h3 class="no-padding no-margin"><?php echo "$month $cur_date"; ?></h3>
								<p class="text-left no-padding no-margin"><?php echo "$year, $day"; ?></p>
								<p class="text-left no-padding no-margin"><?php echo ""; ?></p>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-right text-teal-300 pr-20 pt-10 pb-5">
							<i class="fa fa-clock-o fa-5x"></i>
						</div>
					</div>
				</div>
			</div>				
			<div class="col-md-4 col-sm-4">
				
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