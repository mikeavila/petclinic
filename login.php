<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*petclinic Management Software                                   *
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
$log->logThis($logdatetimeecc."user logging in");
include "includes/expire.inc";
$errormsg = '';
setcookie( "errormessage", " ", $expire10hr );
if (!empty($_POST["emplnumber"]))
{
	$emplnumber = $_POST["emplnumber"];
} else {
	setcookie( "errormessage", "You must enter your Employee Number", $expire10hr);
     redirect("index1.php");
	exit();
}
if (!empty($_POST["userid"]))
{
	$uuserid = $_POST["userid"];
} else {
	setcookie( "errormessage", "You must enter your User ID", $expire10hr );
     redirect("index1.php");     
	exit();
}
if (!empty($_POST["password"]))
{
	$userpassword = $_POST["password"];
} else {
	setcookie( "errormessage", "You must enter your Password", $expire10hr);
     redirect("index1.php");     
	exit();
}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petclinicsys`.`logonallowed`;";
if ($mysqli->query($sql) == TRUE) {

} else {
    echo "Error selecting logon status information. " . $mysqli->error;
	exit(1);
}
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
if ($row[0] == "N") {
	setcookie( "errormessage", "Logons have been disabled", $expire10hr );
     redirect("index1.php");
}
$sql = "SELECT uuserid, upassword, status, changepwd FROM petcliniccorp.employee WHERE emplnumber = ".$emplnumber;
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	setcookie( "errormessage", "You have entered an incorrect Employee Number", $expire10hr ); 
     redirect("index1.php");	
}
$row = $result->fetch_row();
if ($row[2] == "I" or $row[2] == "D") {
	setcookie( "errormessage", "Your Userid is Inactive or Deleted", $expire10hr); 
     redirect("index1.php");
}
if (strcasecmp($uuserid, $row[0]) <> 0) {
	$errormsg = "Incorrect information entered";
	require_once "index1.php";
	exit();
}
require_once "includes/key.inc";
require_once "includes/de.inc";
$userpwd = mc_decrypt($row[1], ENCRYPTION_KEY);
if ($userpwd <> $userpassword) {
	$errormsg = "Incorrect information entered";
	require_once "index1.php";
	exit();
}
$ecc = $uuserid.$emplnumber;
$newpassword=$row[3];
if ($newpassword == "Y") 
{
	setcookie("errormessage", " ", $expire10hr);
	setcookie( "employeenumber", $emplnumber, $expire10hr );
     redirect("newpassword.php");
	exit();
}
$sql = "SELECT * FROM `petcliniccorp`.`preferences` ORDER BY `sequence`";
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
$row = $result->fetch_row();
$bg0 = $row[1];
$bg1 = $row[2];
$bg2 = $row[3];
$bg3 = $row[4];
$bg4 = $row[5];
$row = $result->fetch_row();
$preload = $row[1];
if ($preload == "Y") {
	$state = $row[2];
	require_once "preloadarraykeys.php";
	$prearray = array_fill(0, 25, "");
	$prearray[$preak_bg0] = $bg0;
	$prearray[$preak_bg1] = $bg1;
	$prearray[$preak_bg2] = $bg2;
	$prearray[$preak_bg3] = $bg3;
	$prearray[$preak_bg4] = $bg4;
	$prearray[$preak_state] = $state;
	setcookie( "preload", serialize($prearray), $expire10hr);
}
require_once "includes/userlog.inc";
$log->logThis($logdatetimeecc." user log in successful");
$datetime = date('Ymd H:i:s');
$os = $_COOKIE["OS"];
$log->logThis($logdatetimeecc."    empnum: ".$emplnumber."; user: ".$uuserid."; @ ".$datetime."; OS: ".$os);
date_default_timezone_set('America/Detroit');
$datetime = date('Ymd H:i:s');
$sql = "INSERT INTO `petclinicsys`.`usersol` (`user`, `datetime`, `os`) VALUES ('$uuserid', '$datetime', '$os');";
if ($mysqli->query($sql) == TRUE) {

} else {
    echo "Error inserting into petclinicsys" . $mysqli->error;
	exit(1);
}
$mysqli->close();
setcookie( "employeenumber", $emplnumber, $expire10hr);
setcookie("ecc", $ecc, $expire10hr);
setcookie( "errormessage", " ", $expire10hr );
redirect("mainmenu.php");
?>