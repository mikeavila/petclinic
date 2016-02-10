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

if (empty($_POST["pass"]))
{
	$pass = "";
	echo "<form action=\"petlist.php\" method=\"post\"><table border=\"0\" width=\"100%\">";
	echo "<tr><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"01\">Active Pets</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"02\">Inactive Pets</td>";
	echo "<td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"03\">Deleted Pets</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"04\">All Pets</td>";
	echo "<td><input type=\"radio\" name=\"menuel[]\" value=\"05\">Pets that name starts with <input type=\"text\" name=\"namestarts\" size=\"3\" maxlength=\"3\"></td>";
	echo "</tr></table>";
	echo "<center><table border=\"0\" width=\"10%\"><tr><td colspan=\"5\" align=\"right\"><input type=\"submit\" value=\"Process Request\"></td></tr></table>";
	echo "<input type=\"hidden\" name=\"pass\" value=\"1\"></table></center></form>";
	echo "<form action=\"mainmenu.php\" method=\"post\">";
	echo "<center><input type=\"submit\" value=\"Return to Main Menu\"></center>";
	echo "</form></body></html>";
	exit();
}
foreach($_POST['menuel'] as $sKey => $sValue);
	$value = $sValue;
switch ($value)
{
	case "01":
		$sql1 = "SELECT petnumber, petname, petspecies, petbreed, petgender, petcolor, petdesc FROM `petclinic`.`pet` WHERE status = \"A\" ORDER BY petname;";
		break;
	case "02":
		$sql1 = "SELECT petnumber, petname, petspecies, petbreed, petgender, petcolor, petdesc FROM `petclinic`.`pet` WHERE status = \"I\" ORDER BY petname;";
		break;
	case "03":
		$sql1 = "SELECT petnumber, petname, petspecies, petbreed, petgender, petcolor, petdesc FROM `petclinic`.`pet` WHERE status = \"D\" ORDER BY petname;";
		break;
	case "04":
		$sql1 = "SELECT petnumber, petname, petspecies, petbreed, petgender, petcolor, petdesc FROM `petclinic`.`pet` ORDER BY petname;";
		break;
	case "05":
		$namestarts = $_POST["namestarts"];
		$sql1 = "SELECT petnumber, petname, petspecies, petbreed, petgender, petcolor, petdesc FROM `petclinic`.`pet` WHERE petname LIKE \"".$namestarts."%\" ORDER BY petname;";
		break;
		}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE["employeenumber"];
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT `sk22` FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$resultc = $mysqlic->query($sql);
$row_cnt_c = $resultc->num_rows;
$rowc = $resultc->fetch_row();
$sk22 = $rowc[0];
$mysqlic->close();
require_once "includes/key.inc";
require_once "includes/de.inc";
require_once "includes/expire.inc";
$result = $mysqli->query($sql1);
if ($result == FALSE)
{
     put_errormsg("There are no Pets (false)");
     redirect("listings.php");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("There are no Pets (count)");
     redirect("listings.php");
	exit();
}
if ($sk22 == "Y") {
	echo "Clicking on the Pet Number will take you to a display to edit that Pet.<hr>"; }
delete_errormsg();
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$row1 = "Pet # ";
	if ($sk22 == "Y") {
		$row1 = $row1."<a href=\"setuppmaint.php?editpetnum=".$row[0]."\">".$row[0]."</a> ";	
	} else {
		$row1 = $row1.$row[0]." ";
	}
	$row1 = $row1.", Name is ".$row[1]." which is a ";
     $sql2 = "SELECT `speciesdesc` FROM `petclinic`.`code_species` WHERE `speciescode` = \"".$row[2]."\";";
     $result = $mysqli->query($sql2);
     if ($result == TRUE) {
     } else {
          put_errormsg("Error getting species from code_species" . $mysqli->error);
          redirect("criticalerror.php?m=petlist.php&ec=0");
          exit(1);
     }
     $rows = $result->fetch_row();
     $row1 = $row1.$rows[0]." ";
     $sql2 = "SELECT breeddesc FROM `petclinic`.`code_breed` WHERE breedcode = \"".$row[2].$row[3]."\";";
     $result = $mysqli->query($sql2);
     if ($result == TRUE) {
     } else {
          put_errormsg("Error getting species from code_species" . $mysqli->error);
          redirect("criticalerror.php?m=petlist.php&ec=0");
          exit(1);
     }
     $rows = $result->fetch_row();
     $row1 = $row1.$rows[0];
	echo $row1;
	echo "<hr size=\"2px\" border=\"0\" NO SHADE align=\"center\" color=\"black\">";
}
echo "<center><form action=\"listings.php\" method=\"post\"><input type=\"submit\" value=\"Return to Listings Menu\"></form></center>";
$mysqli->close();
$display ="clientlist:".$emplnumber;
require_once "includes/footer.inc";
?>