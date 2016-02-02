<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*Petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$euserid=$_POST["euserid"];
$epassword = $_POST["epassword"];
$lname = $_POST["lname"];
$fname = $_POST["fname"];
if(isset($_POST["prefix"])) {
     $prefix = $_POST["prefix"];
} else {
     $prefix = "";
}
if(isset($_POST["suffix"])) {
     $suffix = $_POST["suffix"];
} else {
     $suffix = "";
}
$address = $_POST["address"];
if(isset($_POST["address2"])) {
     $address2 = $_POST["address2"];
} else {
     $address2 = "";
}
$city = $_POST["city"];
$state=$_POST["state"];
$zipcode = $_POST["zipcode"];
if(isset($_POST["tele"])) {
     $tele = $_POST["tele"];
} else {
     $tele = "";
}
require_once "../includes/key.inc";
require_once "../includes/en.inc";
$hashpwd = mc_encrypt($epassword, ENCRYPTION_KEY);
$hashaddress = mc_encrypt($address, ENCRYPTION_KEY);
if (strlen($address2) > 0) {
	$hashaddress2 = mc_encrypt($address2, ENCRYPTION_KEY);
} else {
	$hashaddress2 = '';
}
$hashcity = mc_encrypt($city, ENCRYPTION_KEY);
$logFileName = "install";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("Install2 started");
require_once "password.txt";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "INSERT INTO `petcliniccorp`.`employee` (`uuserid`, `upassword`, `lname`, `fname`, `address`, `address2`, `city`, `state`, `zipcode`, 
       `telephone`, `status`, `changeid`)
	   VALUES (\"$euserid\", \"$hashpwd\", \"$lname\", \"$fname\", \"$hashaddress\", \"$hashaddress2\", \"$hashcity\",
	   \"$state\", \"$zipcode\", \"$tele\", \"A\", 0000);";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table employee data insertion failed" . $mysqli->error;
	exit(1);
}

$result = $mysqli->insert_id;
$sql = "INSERT INTO `petcliniccorp`.`seckeys` (`emplnumber`, `sequence`, `sk01`, `sk02`,	`sk03`,	`sk04`,	`sk05`,	`sk06`,	`sk07`,
	                `sk08`,	`sk09`,	`sk10`,	`sk11`,	`sk12`,	`sk13`,	`sk14`,	`sk15`,	`sk16`,	`sk17`,
					`sk18`,	`sk19`,	`sk20`,	`sk21`,	`sk22`,	`sk23`,	`sk24`,	`sk25`, `sk26`, `sk27`, `sk28`, `sk29`, 
					`sk30`, `sk31`, `sk32`, `sk33`, `sk34`, `sk35`, `changeid`)
		VALUES($result, 1, \"Y\", \"Y\",	\"Y\",	\"Y\",	\"Y\",	\"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	
			\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\",
			\"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table employee security data1 insertion failed" . $mysqli->error;
	exit(1);
}
$sql = "INSERT INTO `petcliniccorp`.`seckeys` (`emplnumber`, `sequence`, `sk01`, `sk02`,	`sk03`,	`sk04`,	`sk05`,	`sk06`,	`sk07`,
	                `sk08`,	`sk09`,	`sk10`,	`sk11`,	`sk12`,	`sk13`,	`sk14`,	`sk15`,	`sk16`,	`sk17`,
					`sk18`,	`sk19`,	`sk20`,	`sk21`,	`sk22`,	`sk23`,	`sk24`,	`sk25`, `sk26`, `sk27`, `sk28`, `sk29`, 
					`sk30`, `sk31`, `sk32`, `sk33`, `sk34`, `sk35`, `changeid`)
		VALUES($result, 2, \"Y\", \"Y\",	\"Y\",	\"Y\",	\"Y\",	\"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	
			\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\",	\"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\",
			\"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"Y\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table employee security data2 insertion failed" . $mysqli->error;
	exit(1);
}
$mysqli->close();
$log->logThis("Install2 completed");