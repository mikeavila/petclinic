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
	echo "<form action=\"clientlist.php\" method=\"post\"><table border=\"0\" width=\"100%\">";
	echo "<tr><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"01\">Active Clients</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"02\">Inactive Clients</td>";
	echo "<td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"03\">Deleted Clients</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"04\">All Clients</td>";
	echo "<td><input type=\"radio\" name=\"menuel[]\" value=\"05\">Clients that Last Name starts with <input type=\"text\" name=\"namestarts\" size=\"3\" maxlength=\"3\"></td>";
	echo "<td><input type=\"radio\" name=\"menuel[]\" value=\"06\">Clients that Last Name sounds like <input type=\"text\" name=\"namesounds\" size=\"6\" maxlength=\"6\"></td></tr></table>";
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
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` WHERE status = \"A\" ORDER BY lname, fname";
		break;
	case "02":
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` WHERE status = \"I\" ORDER BY lname, fname";
		break;
	case "03":
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` WHERE status = \"D\" ORDER BY lname, fname";
		break;
	case "04":
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email, status FROM `petclinic`.`client` ORDER BY lname, fname";
		break;
	case "05":
		$namestarts = $_POST["namestarts"];
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` WHERE lname LIKE \"".$namestarts."%\" ORDER BY lname, fname";
		break;
	case "06":
		$namesounds = $_POST["namesounds"];
		$soundex = soundex($namesounds);
		$sql1 = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` WHERE soundex = ";
		$sql1 = $sql1."\"".$soundex."\" ORDER BY `lname`, `fname` ;";
		break;
	}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE["employeenumber"];
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT `sk21` FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$resultc = $mysqlic->query($sql);
$row_cnt_c = $resultc->num_rows;
$rowc = $resultc->fetch_row();
$sk21 = $rowc[0];
$mysqlic->close();
require_once "includes/key.inc";
require_once "includes/de.inc";
require_once "includes/expire.inc";
$result = $mysqli->query($sql1);
if ($result == FALSE)
{
     put_errormsg("There are no Clients (false)");
	header ("Location:listings.php");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("There are no Clients (count)");
     redirect("listings.php");
	exit();
}
if ($sk21 == "Y") {
	echo "Clicking on the Client Number will take you to a display to edit that Client.<hr>"; }
delete_errormsg();
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$address = mc_decrypt($row[3], ENCRYPTION_KEY);
	if ($row[4] <> "") {
		$address2 = mc_decrypt($row[4], ENCRYPTION_KEY);
	} else {
		$address2 = "";
	}
	$row1 = "Client # ";
	if ($sk21 == "Y") {
		$row1 = $row1."<a href=\"setupcmaint.php?editclientnum=".$row[0]."\">".$row[0]."</a> ";	
	} else {
		$row1 = $row1.$row[0]." ";
	}
	$row1 = $row1.$row[1].", ".$row[2]." lives at ".$address." ";
	if ($address2 <> "")
	{
		$row1 = $row1.$address2." ";
	}
	if ($row[4] <> "")
		$row1 = $row1.", ".$address2;
	$city = mc_decrypt($row[5], ENCRYPTION_KEY);
	$row1 = $row1.", ".$city.", ".$row[6]." ".$row[7];
	echo $row1;
	echo "<hr size=\"2px\" border=\"0\" NO SHADE align=\"center\" color=\"black\">";
}
echo "<center><form action=\"listings.php\" method=\"post\"><input type=\"submit\" value=\"Return to Listings Menu\"></form></center>";
$mysqli->close();
$display ="clientlist:".$emplnumber;
require_once "includes/footer.inc";
?>