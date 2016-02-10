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
require_once "includes/expire.inc";

$client = "";
if (!isset($_POST["client"])) {
	echo "<form method=\"post\" action=\"visitsnew.php\">";
	echo "<center>Enter a Client Number <input type=\"text\" name=\"client\" size=\"5\" maxlength=\"5\">";
	echo "<tr><td><center><a href=\"petmaintc.php\" target=\"_blank\"> Click Here </a> to get a list of Clients</td></tr>";
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

require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petclinic`.`clientpet` WHERE `clientnumber` = ".$client.";";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("That Clients has no Pets");
     redirect("visitsnew.php");      
	exit();
}
echo "<br><br>";
$row_cnt = $result->num_rows;
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$row[1].";";
	$result2 = $mysqli->query($sql);
	if ($result2 == TRUE) {
		$row2 = $result2->fetch_row();
		$sql = "SELECT `petclinic`.`speciesdesc` from `code_species` WHERE `speciescode` = \"".$row2[3]."\";";
		$result3 = $mysqli->query($sql);
		$row3 = $result3->fetch_row();
		echo "Pet # ".$row[1]." is a ".$row3[0]." named ".$row2[1]." who is ".$row2[7]." and is ".$row2[8]." ";
		echo "<a href=\"visitspre.php?client=".$client."&petid=".$row[1]."\">Screening Form </a> or ";
		echo "<a href=\"visitsnew1.php?client=".$client."&petid=".$row[1]."\"> Doctor Form</a>";
	} else {
		echo "Error selecting Pet" . $mysqli->error;
		exit(1);
	}
}
$mysqli->close();
echo "<br><br>Select the correct Pet by clicking on the Form wanted after the Pet information";
?>