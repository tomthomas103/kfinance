<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>K Finance - Customer Profile</title>	
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
	<link type="text/css" rel="stylesheet" href="cust_view_action.php" id="style">
	<link type="text/css" rel="stylesheet" href="cust_view_action.php" id="theme">
	<!-- /global stylesheets -->

	<!-- Core JS files -->	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/fancybox.min.js"></script>	
	<script src="js/app.js"></script><script src="js/fancybox.min.js"></script>
<script src="js/forms/uniform.min.js"></script>
<script src="js/forms/select2.min.js"></script>
<script src="js/datatables/datatables.min.js"></script>

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
				<h4><i class="fa fa-users position-left"></i> Customer Profile</h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="home-admin.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Customer Management</li>
				<li class="active">Profile</li>
			</ul>					
		</div>
	</div>
	<!-- /page header -->

	<!-- Content area -->
	<div class="content">
		<div class="row">
			<div class="col-lg-3 col-sm-4">
			<?php
				$cust_id=$_GET['id'];
						include("dboperation.php");
						$obj=new dboperation();
						$query1="SELECT cust_name,cust_housename,cust_phone FROM tbl_customer where cust_id=$cust_id";
						$result1=$obj->selectdata($query1);
						$r1=$obj->fetch($result1)
			?>
				<!-- User thumbnail -->
				<div class="thumbnail">
					<div class="thumb thumb-rounded thumb-slide">
						<img src="assets/images/users/user1.png" alt="">						
					</div>				
					<div class="caption text-center">
						<h4 class="text-semibold no-margin"><?php echo $r1[0]; ?> <small class="display-block"><?php echo $r1[1]; ?></small><small class="display-block"><?php echo $r1[2]; ?></small></h4>
						<ul class="icons-list mt-15">
							<li><a href="user_profile.html#" data-popup="tooltip" title="" data-original-title="Google Drive"><i class="icon-google-drive"></i></a></li>
							<li><a href="user_profile.html#" data-popup="tooltip" title="" data-original-title="Twitter"><i class="icon-twitter"></i></a></li>
							<li><a href="user_profile.html#" data-popup="tooltip" title="" data-original-title="Github"><i class="icon-github"></i></a></li>
						</ul>
					</div>
				</div>
				<!-- /user thumbnail -->
				<?php
						$query2="SELECT stockid, stock_date,amount_given,fin_interest,stock_close_date,status FROM tbl_stock WHERE cust_id=".$cust_id.""; 
	  					$result2=$obj->selectdata($query2); 
	    				$f=$obj->fetch($result2);
						$stock_id=$f[0];
						$date1 = new DateTime($f[1]);
						$date2 = new DateTime(date('Y-m-d'));
						$diff = $date2->diff($date1)->format("%a");
						$in=($f[2]*(($f[3]/100)/365)*$diff);
						$newp=$f[2]+$in;
					?>

				<!-- Navigation -->
				<div class="panel panel-flat">					
					<div class="list-group list-group-borderless">
						<a href="user_profile.html#" class="list-group-item"><i class="icon-cash3"></i> Current Amount :<font color="#FF0000"> <?php echo $newp; ?></font></a>
						<!--<a href="user_profile.html#" class="list-group-item"><i class="icon-tree7"></i> Connections <span class="badge bg-danger pull-right">19</span></a>
						<a href="user_profile.html#" class="list-group-item"><i class="icon-users"></i> Friends</a>
						<div class="list-group-divider"></div>
						<a href="user_profile.html#" class="list-group-item"><i class="icon-calendar3"></i> Events <span class="badge bg-teal-400 pull-right">20</span></a>
						<a href="user_profile.html#" class="list-group-item"><i class="icon-cog3"></i> Account settings</a>-->
					</div>
				</div>
				<!-- /navigation -->

			</div>
			
			<div class="col-lg-9 col-sm-8">
				
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="fa fa-user position-left"></i>Loan Details of <?php echo $r1[0]; ?></h4>
					</a>
					</div>
					<div class="panel-body">
						<table class="table table-borderless table-striped">
						<tbody>
						<tr>
						<td style="width: 20%;"><strong>Stock ID</strong></td>
						<td><?php echo $f[0]; ?> </td>
						</tr>
						<tr>
						<td><strong>Stock Date</strong></td>
						<td><a href="javascript:void(0)"><?php echo $f[1]; ?></a></td>
						</tr>
						<tr>
						<td><strong>Rate</strong></td>
						<td><?php echo $f[3]; ?></td>
						</tr>
						<tr>
						<td><strong>Credit Amount</strong></td>
						<td><?php echo $f[2]; ?></td>
						</tr>
						<tr>
						<td><strong>Number of Days</strong></td>
						<td>
						<?php echo $diff; ?>
						</td>
						</tr>
						<tr>
						<td><strong>Current Interest</strong></td>
						<td><?php echo $in; ?></td>
						</tr>
						</tbody>
						</table>
						<br>
						<div>
                        <table>
                        <tr>
                        <td>
						<form action="edit_amt.php?cust_id=<?php echo $cust_id;?>&amp;i=<?php echo $in;?>" method="post">
							<button type="submit" class="btn bg-teal-400 btn-labeled btn-rounded"><b><i class="fa fa-hand-o-right"></i></b>Edit Details</button>
						</form>
                        </td>
                        <td>&nbsp;</td>
                        
                        </tr>
                        </table>
                        </div>
					</div>
				</div>
				<?php
					$query3="SELECT sec_type,sec_weight FROM  tbl_gold_security WHERE stock_id=".$stock_id.""; 
	  				$result3=$obj->selectdata($query3); 
				?>
				<div class="panel panel-flat">
					<div class="panel-body">
						<div class="media">
							<div class="media-body">
								<table class="table datatable datatable-column-search-inputs" id="">
						<thead>
							<tr>
								<th>No.</th>
								<th>Item</th>							
								<th>Weight (in gms)</th>	
							</tr>
						</thead>
						<tbody>
						<?php
							$n=0;
							while($r3=$obj->fetch($result3))
							{
								$n=$n+1;
							echo "<tr>
								<td>$n</td>
								<td>$r3[0]</td>									
								<td>
									$r3[1]
								</td>
							</tr>";
							}
							?>
										
						</tbody>
						<tfoot>
							<tr>
								<td>No.</td>
								<td>Item</td>							
								<td>Weight(in gms)</td>
							</tr>
						</tfoot>
					</table>
							</div>							
						</div>
													
					</div>
				</div>
				
				
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
						&copy; 2016 K Finance - Developed by <a href="www.oliutech.com" target="_blank">OLIU</a>
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