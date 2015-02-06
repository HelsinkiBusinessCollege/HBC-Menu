<?php
$root = "/ruokalista/";
$sql_host = "localhost";
$sql_db = "s1300736";
$sql_user = "root";
$sql_pass = "";

$conn = new PDO('mysql:host='.$sql_host.';dbname='.$sql_db, $sql_user, $sql_pass);


$conn->query('CREATE TABLE IF NOT EXISTS `ruoka-arvostelut` (`arvosteluID` int(11) NOT NULL AUTO_INCREMENT,`ruokaID` int(10) NOT NULL,`arvosana` int(1) NOT NULL,`pvm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`arvosteluID`),UNIQUE KEY `arvosteluID` (`arvosteluID`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			  CREATE TABLE IF NOT EXISTS `ruokalajit` (`ruokaID` int(10) NOT NULL AUTO_INCREMENT,`kategoria` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,`ruuanNimi` varchar(200) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,`tiedot` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,`kieli` varchar(2) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,PRIMARY KEY (`ruokaID`),UNIQUE KEY `ruuanNimi` (`ruuanNimi`),UNIQUE KEY `ruokaID` (`ruokaID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			  CREATE TABLE IF NOT EXISTS `ruokalista` (`listaID` int(10) NOT NULL AUTO_INCREMENT, `paiva` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,`ruokaID` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,`ruokaID_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,`lisayspvm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`listaID`),UNIQUE KEY `paiva` (`paiva`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

?>