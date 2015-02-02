<?php
/*
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
*/

?>
<div class="container">
	<h1>Viikko <?php echo $week->format("W")+0?></h1>
		<?php
		
		$paivat = ['Maanantai','Tiistai','Keskiviikko','Torstai','Perjantai'];
		
		$alku = date("Y-m-d", strtotime($date." this week"));
		$loppu = date("Y-m-d", strtotime($alku." + 5 days"));
		
		$i = 0;
		//echo "<script>prompt('','SELECT ruokaID from ruokalista where paiva between \'".$alku."\' and \'".$loppu."\'')</script>";
		foreach($conn->query("SELECT ruokaID from ruokalista where paiva between '".$alku."' and '".$loppu."'") as $row) {
			echo "<h3>".$paivat[$i]."</h3>";
			//echo "<p>".$row['ruokaID']."</p>";
			foreach(explode(',',$row['ruokaID']) as $ruokaID){
				foreach($conn->query("SELECT ruuanNimi from ruokalajit where ruokaID = ".$ruokaID) as $r) {
					echo "<p>".$r['ruuanNimi']."</p>";
				}
			}
			$i++;
		}
		

		
		/*		for($i = 0; $i >= 5; $i++){
			
				echo "<h3>".$paivat[$i]."</h3>";
				foreach($json['courses'] as $course){
					echo htmlentities($course['title_fi'], ENT_COMPAT, 'UTF-8')."<br>\n";
				}
			}*/
		$conn = NULL;
		?>
    </div>