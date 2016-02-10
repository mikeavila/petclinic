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
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
if(isset($_COOKIE["editpetnum"])) {
     $editpetnum = $_COOKIE["editpetnum"];
} else {
     $editpetnum = "";
}
if ($editpetnum == "")
{
	echo "<center><form action=\"setuppmaint.php\" method=\"get\">";
	echo "<table width = \"25%\" border = \"0\">";
	echo "<tr><td>Enter the Pet Number to be edited.</td></tr>";
	echo "<tr><td><input type=\"text\" name=\"editpetnum\" size=\"5\" maxlength=\"5\"></td></tr>";
	echo "<tr><td><input type=\"submit\" value=\"Edit Requested Pet\"></td></tr></table>";
	echo "</form><form action=\"setuppmaint.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"editpetnum\" value=\"new\">";
	echo "<table width=\"25%\"><tr><td><input type=\"submit\" value=\"Create New Pet\"></td></tr>";
	echo "</table></form></center>";
	$display = "Petmaint:".$emplnumber;
	require_once "includes/footer.inc";
	exit();
}

if ($editpetnum == "new") {
     redirect("petmaint1new.php");
	exit();
}
if ($editpetnum == "new1") {
     redirect("petmaint1new1.php");
	exit();
}
if ($editpetnum == "new2") {
     redirect("petmaint1new1.php");
	exit();
}
$errormessage = get_errormsg();
delete_errormsg();
if (empty($errormessage)) {
	include "password.php";
	$mysqli = new mysqli('localhost', $user, $password, '');
	$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = $editpetnum;";
	$result = $mysqli->query($sql);
	if ($mysqli->query($sql) === FALSE) {
          put_errormsg("Error selecting Pet Information".$mysqli->error);
          redirect("criticalerror.php?m=petmaint.php&ec=0");
		exit(1);
	}
	$row = $result->fetch_row();
	if ($row == 0) {
          put_errormsg("Invalid Pet Number".$mysqli->error);
          redirect("criticalerror.php?m=petmaint.php&ec=0");
		exit(1);
	}
	$petnumber = $row[0];
	$petname = $row[1];
	$dob = $row[2];
	$doby = substr($dob, 0, 4);
	$dobm = substr($dob, 4, 2);
	$dobd = substr($dob, 6, 2);
	$petspecies = $row[3];
	$petbreed = $row[4];
	$petgender = $row[5];
	$petfixed = $row[6];
	$petcolor = $row[7];
	$petdesc = $row[8];
	$license = $row[9];
	$microchip = $row[10];
	$rabiestag = $row[11];
	$tattoonumber = $row[12];
	$picture = $row[13];
	$status = $row[14];
	$changeid = $row[15];
}
echo "<form method=\"post\" action=\"petmaintupd.php\">";
require_once "petmaintform.php";
$mysqli->close();
?>