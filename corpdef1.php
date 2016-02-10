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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
if (!empty($_POST["preload"])) {
	$pref1 = $_POST["preload"];
} else {
	$pref1="";
}
if (!empty($_POST["state"])) {
	$pref2 = $_POST["state"];
} else {
	$pref2="";
}
if (!empty($_POST["autosalesprice"])) {
	$pref3 = $_POST["autosalesprice"];
} else {
	$pref3="";
}
if (!empty($_POST["timezone"])) {
	$pref4 = $_POST["timezone"];
} else {
	$pref4="";
}
/*
if (!empty($_POST["pref4"])) {
	$pref4 = "bg.".$_POST["pref4"].".png";
} else {
	$pref4="";
}
if (!empty($_POST["pref5"])) {
	$pref5 = "bg.".$_POST["pref5"].".png";
} else {
	$pref5="";
}
*/
if(!empty($_POST['defproc']))
{
	foreach($_POST['defproc'] as $sKey => $sValue);
	$value = $sValue;
}
require_once "includes/expire.inc";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
//$sql="UPDATE `petcliniccorp`.`preferences` SET `pref1` = \"".$pref1."\", `pref2` = \"".$pref2."\", `pref3` = \"".$pref3."\", `pref4` = \"".$pref4."\", `pref5` = \"".$pref5."\" WHERE `sequence` = 3";
$sql="UPDATE `petcliniccorp`.`preferences` SET `pref1` = \"".$pref1."\", `pref2` = \"".$pref2."\", `pref3` = \"".$pref3."\", `pref4` = \"".$pref4."\" WHERE `sequence` = 3";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Pref Seq 3 Update failed");
     redirect("corpmenu.php");
	exit();
}
$sql="SELECT `pref1` FROM `petcliniccorp`.`preferences` WHERE `sequence` = 4";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Cannot access preferences table");
} else {
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
          put_errormsg("Internal Error");
          redirect("criticalerror.php?m=corpdef1.php&ec=0");
          exit(0);
     } else {
               $row = $result->fetch_row();
               $pref1 = $row[0];
               $pref1 = substr($pref1, 0, 3).$value.$value;
               $sql="UPDATE `petcliniccorp`.`preferences` SET `pref1` = \"".$pref1."\" WHERE `sequence` = 4";
               $result = $mysqli->query($sql);
          }
     }
}
$mysqli->close();
delete_errormsg();
redirect("corpmenu.php");
?>