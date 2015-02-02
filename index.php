<?php
ini_set('display_errors',1);
include_once 'config.php';
include_once 'lisaa_ruokalista.php';

if(isset($_GET['d']) && is_numeric($_GET['d']) && isset($_GET['m']) && is_numeric($_GET['m']) && isset($_GET['y']) && is_numeric($_GET['y'])){
	$date = $_GET['y']."-".$_GET['m']."-".$_GET['d'];
}
else{
	$date = date("Y-m-d");
}
$week = new DateTime($date);
$prev_week = new DateTime(date('Y-m-d',strtotime($date.' - 7 days')));
$next_week = new DateTime(date('Y-m-d',strtotime($date.' + 7 days')));
$this_week = new DateTime();

$prev_url = $root."fi/".date('Y/m/d', strtotime($date. ' - 7 days'));
$next_url = $root."fi/".date('Y/m/d', strtotime($date. ' + 7 days'));
$this_url = $root."fi/".date('Y/m/d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.png">

    <title>HBC Menu</title>
  <!-- Custom styles for this template -->
    <link href="<?php echo $root;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $root;?>css/StyleSheet.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="icon" href="<?php echo $root;?>images/favicon.png">
</head>

<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="<?php echo $root;?>images/hbcmenu200x130.png" alt="HBC Menu" width="57" height="29"></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?php echo $prev_url?>">Edellinen viikko  <?php echo $prev_week->format("W")+0;?></a></li>
					<li><a href="<?php echo $next_url?>">Seuravaa viikko  <?php echo $next_week->format("W")+0;?></a></li>
					<li<?php if($this_week->format("W")+0 == $week->format("W")+0){echo " class=\"active\"";}?>><a href="<?php echo $this_url?>">Tämä viikko <?php echo $this_week->format("W")+0;?></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Päivä<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Koko viikko</a></li>
							<li><a href="#">Maanantai</a></li>
							<li><a href="#">Tiistai</a></li>
							<li><a href="#">Keskiviikko</a></li>
							<li><a href="#">Torstai</a></li>
							<li><a href="#">Perjantai</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">

		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-3">
				<h2><span class="glyphicon glyphicon-chevron-left"></span>Edellinen päivä</h2>
			</div>
			<div class="col-lg-3">
				<h2>
					Seuraava päivä
					<span class="glyphicon glyphicon-chevron-right"></span>
				</h2>
			</div>
		</div>
	</div>
	<div class="container">

		<!-- Main component for a primary marketing message or call to action -->
		<div class="row">
			<div class="col-sm-4 col-sm-push-8">
				<div class="jumbotron">

					<h3><strong>MÄKELÄN KOULU (ENT. SUOMEN LIIKEMIESTEN KAUPPAOPISTO)</strong></h3>
					<ul>
						<li><strong>Lounasajat</strong></li>
						<li><strong>Ma-Pe 10.30 - 14.00</strong></li>
						<li><strong>La-Su suljettu</strong></li>
						<li><strong>Special lunch on tarjolla klo 10.30-13.00 2-3 kertaa viikossa           </strong> </li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8 col-sm-pull-4">
				<?php include 'ruokalista.php';?>
			</div>
		</div>



	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
