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
if (!empty($_POST["pref1"])) {
	$pref1 = "bg.".$_POST["pref1"].".png";
} else {
	$pref1="";
}
if (!empty($_POST["pref2"])) {
	$pref2 = "bg.".$_POST["pref2"].".png";
} else {
	$pref2="";
}
if (!empty($_POST["pref3"])) {
	$pref3 = "bg.".$_POST["pref3"].".png";
} else {
	$pref3="";
}
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
require_once "includes/expire.inc";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql="UPDATE 'petcliniccorp`.`preferences' SET `pref1` = \"".$pref1."\", `pref2` = \"".$pref2."\", `pref3` = \"".$pref3."\", `pref4` = \"".$pref4."\", `pref5` = \"".$pref5."\" WHERE `sequence` = 2";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Pref Seq 2 Update failed");
     redirect("corpmenu.php");
	exit();
}
$mysqli->close();
delete_errormsg();
redirect("corppref.php"); 
?>