<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE HTML>
<html>
<head>
<title> Panel Administrativo</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="css/clndr.css" type="text/css" />
<script src="js/underscore-min.js" type="text/javascript"></script>
<script src= "js/moment-2.2.1.js" type="text/javascript"></script>
<script src="js/clndr.js" type="text/javascript"></script>
<script src="js/site.js" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
<div class="main-content">
		
		 <?php include_once('includes/sidebar.php');?>
		
	<?php include_once('includes/header.php');?>
		<!-- main content start-->
		<div id="page-wrapper" class="row calender widget-shadow">
			<div class="main-page">
				
			
				<div class="row calender widget-shadow">
					<div class="row-one">
					<div class="col-md-4 widget">
						<?php $query1=mysqli_query($con,"Select * from tblcustomers");
$totalcust=mysqli_num_rows($query1);
?>
<?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left ">
							<h5>Total</h5>
							<h4>Clientes</h4>
						</div>
						<div class="stats-right"> 
							<label> <?php echo $totalcust;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
					<?php endif; ?>
						<?php $query2=mysqli_query($con,"Select * from tblappointment");
						
$totalappointment=mysqli_num_rows($query2);

?>
<?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left">
							<h5>Total</h5>
							<h4>Citas</h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $totalappointment;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
					<?php endif; ?>
						<?php $query3=mysqli_query($con,"Select * from tblappointment where Status='1'");
$totalaccapt=mysqli_num_rows($query3);
?>
<?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left">
							<h5>Total</h5>
							<h4>Citas Aceptadas</h4>
						</div>
						<div class="stats-right">
							<label><?php echo $totalaccapt;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
						
					</div>

				<div class="row calender widget-shadow">
					<div class="row-one">
					<div class="col-md-4 widget">
					<?php endif; ?>
						<?php $query4=mysqli_query($con,"Select * from tblappointment where Status='1'");
$totalrejapt=mysqli_num_rows($query4);
?>
<?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left ">
							<h5>Total</h5>
							<h4>CitasRechazadas</h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $totalrejapt;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
					<?php endif; ?>
						<?php $query5=mysqli_query($con,"Select * from  tblservices");
$totalser=mysqli_num_rows($query5);
?>
<?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left">
							<h5>Total</h5>
							<h4>Servicios</h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $totalser;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
					<?php endif; ?>
						<?php
//todays sale
 $query6=mysqli_query($con,"select tblinvoice.ServiceId as ServiceId, tblservices.Cost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)=CURDATE();");
while($row=mysqli_fetch_array($query6))
{
$todays_sale=$row['Cost'];
$todysale+=$todays_sale;

}
 ?>
 <?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left">
							<h5>Hoy</h5>
							<h4></h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $todysale;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
						
					</div>

				<div class="row calender widget-shadow">
					<div class="row-one">
					<div class="col-md-4 widget">
					<?php endif; ?>
						<?php
//Yesterday's sale
 $query7=mysqli_query($con,"select tblinvoice.ServiceId as ServiceId, tblservices.Cost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)=CURDATE()-1;");
while($row7=mysqli_fetch_array($query7))
{
$yesterdays_sale=$row7['Cost'];
$yesterdaysale+=$yesterdays_sale;

}
 ?>
 <?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
						<div class="stats-left ">
							<h5>Ayer</h5>
							<h4></h4>
						</div>
						<div class="stats-right">
							<label> <?php echo $yesterdaysale;?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
					<?php endif; ?>
						<?php
//Last Sevendays Sale
 $query8=mysqli_query($con,"select tblinvoice.ServiceId as ServiceId, tblservices.Cost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)>=(DATE(NOW()) - INTERVAL 7 DAY);");
while($row8=mysqli_fetch_array($query8))
{
$sevendays_sale=$row8['Cost'];
$tseven+=$sevendays_sale;

}
 ?>
	</div>
	<?php if ($_SESSION['userRole'] === 'Cliente') : ?>
       <div class="hero-wrap hero-wrap-2" 
                 style="background-image: url('../images/image_1.jpg'); 
                        background-size: cover; 
                        background-position: center; 
                        background-repeat: no-repeat; 
                        height: 100vh; 
                        width: 70vw; 
                        display: flex; 
                        align-items: center; 
                        justify-content: center;">
                <h1 style="color: white; font-size: 3rem; text-align: center;"></h1>
            </div>
<?php endif; ?>
<!--footer-->
<?php include_once('includes/footer.php');?>
        <!--//footer-->
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
   <br><br><br>   <br><br><br>   <br><br><br>
</body>
</html>