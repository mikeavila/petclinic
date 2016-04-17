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
$background = "3";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
require_once "includes/common.inc";
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT `pref1` FROM `petcliniccorp`.`preferences` WHERE `sequence` = 4;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - preferences4 pref1 missing");
	redirect("criticalerror.php?m=visitsnew.php&ec=-0");
	exit();
}
$row = $result->fetch_row();
if(substr($row[0],3,1) == "N") {
	echo "<br><br><center>You have not selected a default procedure database to use. You cannot create a visit unless a procedure database is selected.<br><br>";
	echo "To select a default procedure database, <a href='corpdef.php'>click here</a>.<br><br></center>";
	include "includes/returnmainmenu.inc";
	$mysqli->close();
	exit();
} else {
	$procdb = substr($row[0],3,1);
}
if($procdb == "P") {
	/*
	 * "CREATE TABLE `petclinicproc`.`procedures` (
	`proccode` varchar(10) NOT NULL,
	`procdesc` varchar(25) NOT NULL,
	`proctype` char(1) NOT NULL,
	`procstatus` char(1) NOT NULL DEFAULT \"A\",
	 */
	$sql = "SELECT * FROM `petclinicproc`.`procedures` WHERE `procstatus` = 'A';";
	$result = $mysqli->query($sql);
	$row_cnt = $result->num_rows;
	if($row_cnt < 5) {
		echo "<br><br><center>You have must have at least 5 Procedures created in the Procedures Database. These Procedures are your own created Procedures.<br><br>";
		echo "If you want to change the default Procedure Database and have selected the VeNom Procedures to be loaded during the Installation Process, you can do so now.<br><br>";
		echo "To select a default procedure database, <a href='corpdef.php'>click here</a>.<br><br></center>";
		include "includes/returnmainmenu.inc";
		$mysqli->close();
		exit();
	}
}
$mysqli->close();
$client = "";
if (!isset($_POST["client"])) {
	echo "<form method=\"post\" action=\"visitsnew.php\">";
	echo "<center>Enter a Client Number <input type=\"text\" name=\"client\" size=\"5\" maxlength=\"5\">";
	echo "<tr><td><center><a href=\"petmaintc.php\" target=\"_blank\"> Click Here </a> to get a list of Clients</td></tr>";
	echo "<tr><td><input type='hidden' name='procdb' value='".$procdb."'>";
	echo "<br><br><input type=\"submit\" value=\"Continue\"></form>";
	echo "<br><br><center>";
    $errormsg = get_errormsg();
	echo $errormsg;
	echo "</center>";
	exit();
}
if (!isset($_POST["client"])) {
         put_errormsg("You must enter a Client Number");
         redirect("visitsnew.php");
		 exit();
} else {
	$client = $_POST["client"];
}
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `petclinic`.`clientpet` WHERE `clientnumber` = ".$client.";";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("That Clients has no Pets");
     redirect("visitsnew.php");
     $mysqli->close();
	 exit();
}
echo "<br><br>";
if(isset($_POST["procdb"])) {
	$procdb = $_POST["procdb"];
} else {
	$procdb = "N";
}
$row_cnt = $result->num_rows;
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$row[1].";";
	$result2 = $mysqli->query($sql);
	if ($result2 == TRUE) {
		$row2 = $result2->fetch_row();
		$species = substr($row2[3], 0, 1);
		$sql = "SELECT `speciesdesc` FROM `petclinic`.`code_species` WHERE `speciescode` = \"".$species."\";";
		$result3 = $mysqli->query($sql);
		$row3 = $result3->fetch_row();
		echo "Pet # ".$row[1]." is a ".$row3[0]." named ".$row2[1]." who is ".$row2[7]." and is ".$row2[8]." ";
		echo "<a href=\"visitspre.php?client=".$client."&procdb=".$procdb."&petid=".$row[1]."\">Screening Form </a> or ";
		echo "<a href=\"visitsnew1.php?client=".$client."&procdb=".$procdb."&petid=".$row[1]."\"> Doctor Form</a>";
	} else {
		echo "Error selecting Pet" . $mysqli->error;
		exit(1);
	}
}
$mysqli->close();
echo "<br><br>Select the correct Pet by clicking on the Form wanted after the Pet information";
?>