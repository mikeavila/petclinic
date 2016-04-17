<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*PetClinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
session_start();
require_once "includes/common.inc";

if ( array_key_exists('done', $_GET) ) {
	unset($_GET['done']);
	redirect("doctors.php");
}

$logFileName = "user";
$headerTitle="USER LOG";
$emplnumber = 0;
if(isset($_POST["emplnumber"])) {
     $emplnumber=$_POST["emplnumber"];
} else {
     $emplnumber = 0;
}
if(isset($_POST["docnumber"])) {
     $docnumber=$_POST["docnumber"];
} else {
     $docnumber = "new";
}
if(isset($_POST["doctorinfo"])) {
     $doctorinfo=$_POST["doctorinfo"];
} else {
     $doctorinfo = "";
}
if(isset($_POST["docstatelic"])) {
     $docstatelic=$_POST["docstatelic"];
} else {
     $docstatelic = "";
}
if(isset($_POST["docdea"])) {
     $docdea=$_POST["docdea"];
} else {
     $docdea="";
}
if(isset($_POST["doctorstatus"])) {
     $doctorstatus=$_POST["doctorstatus"];
} else {
     $doctorstatus = "A";
}

$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
if ($docnumber <> "new")
{
	$sql = "UPDATE `petcliniccorp`.`doctors` SET `doctordesc` = '$doctorinfo', `doctorstatelic` = '$docstatelic', `doctordealic` = '$docdea', `doctorstatus` = '$doctorstatus' WHERE `doctorid` = '$docnumber';";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		put_errormessage("Table employee data update failed" . $mysqli->error);
          redirect("criticalerror.php?m=doctors2.php&ec=0");
		exit(1);
	}
} else{
	$sql = "INSERT INTO `petcliniccorp`.`doctors` (`doctordesc`, `doctorstatelic`, `doctordealic`, `doctorstatus`) VALUES ('$doctorinfo', '$docstatelic', '$docdea', '$doctorstatus');";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		put_errormsg("Table employee data insertion failed" . $mysqli->error);
          redirect("criticalerror.php?m=doctors2.php&ec=0");
		exit(1);
	}
}
$mysqli->close();
delete_errormsg();
?>