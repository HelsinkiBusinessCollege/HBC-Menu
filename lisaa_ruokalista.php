<?php
function lisaa_ruoka($date){
	$ruoka = date("Y-m-d", strtotime(date('Y-m-d',strtotime($date.' this week'))));
	$loppu = strtotime(date("Y-m-d", strtotime($ruoka,' + 5 days')));

	while(strtotime($ruoka) <= $loppu){
		$url = "http://www.sodexo.fi/ruokalistat/output/daily_json/90/" . date("Y/m/d",strtotime($ruoka)) . "/fi";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result, true);

		$ruuat = [];
		$ruuat_en = [];
		foreach($json['courses'] as $course){
			if($course['title_fi'] == ""){$course['title_fi'] == 'Ravintola Suljettu';}
			if($course['title_en'] == ""){$course['title_en'] == 'Restaurant Closed';}
			
			$query = $conn->prepare("INSERT IGNORE INTO ruokalajit set kieli='fi', ruuanNimi = ?, kategoria = ?, tiedot = ?");
			$query->bind_param('sss',htmlentities($course['title_fi'], ENT_COMPAT, 'UTF-8'),$course['category'],$course['properties']);
			$query->execute();
			$query = $conn->prepare("INSERT IGNORE INTO ruokalajit set kieli='en', ruuanNimi = ?, kategoria = ?, tiedot = ?;");
			$query->bind_param('sss',htmlentities($course['title_en'], ENT_COMPAT, 'UTF-8'),$course['category'],$course['properties']);
			$query->execute();
			$query->close();

			$query = $conn->prepare("SELECT ruokaID from ruokalajit where ruuanNimi = ? and kieli = 'fi';");
			$query->bind_param('s',htmlentities($course['title_fi'], ENT_COMPAT, 'UTF-8'));
			$query->execute();
			$row = $query->get_result()->fetch_assoc();
			$ruuat[] = $row['ruokaID'];
			$query->close();
			
			$query = $conn->prepare("SELECT ruokaID from ruokalajit where ruuanNimi = ? and kieli = 'en';");
			$query->bind_param('s',htmlentities($course['title_en'], ENT_COMPAT, 'UTF-8'));
			$query->execute();
			$row = $query->get_result()->fetch_assoc();
			$ruuat_en[] = $row['ruokaID'];
			$query->close();
		}
		if(count($ruuat)){
			$query =$conn->prepare("insert into ruokalista (ruokaID,ruokaID_en,paiva) values (?,?,?)");
			$query->bind_param('sss',implode(',',$ruuat),implode(',',$ruuat_en),$ruoka);
			$query->execute();
			$query->close();
		}
		$ruoka = date("Y-m-d", strtotime($ruoka." + 1 days"));
	}
	$conn->close();
}
?>