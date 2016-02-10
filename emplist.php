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
if(empty($_POST["pass"])) {
	echo "<form action=\"emplist.php\" method=\"post\"><table border=\"0\" width=\"100%\">";
	echo "<tr><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"01\">Active employees</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"02\">Inactive employees</td>";
	echo "<td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"03\">Deleted employees</td><td align=\"left\"><input type=\"radio\" name=\"menuel[]\" value=\"04\">All employees</td>";
	echo "<td><input type=\"radio\" name=\"menuel[]\" value=\"05\">employees that name starts with <input type=\"text\" name=\"namestarts\" size=\"3\" maxlength=\"3\"></td></tr>";
	echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Process Request\"></td></tr></table>";
	echo "<input type=\"hidden\" name=\"pass\" value=\"1\"></form>";
	echo "<form action=\"mainmenu.php\" method=\"post\">";
	echo "<center><input type=\"submit\" value=\"Return to Main Menu\"></center>";
	echo "</form></body></html>";
	exit();
}
require_once "includes/expire.inc";
foreach($_POST['menuel'] as $sKey => $sValue);
	$value = $sValue;
switch ($value)
{
	case "01":
		$sql1 = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode FROM petcliniccorp.employee WHERE status = \"A\" ORDER BY lname, fname";
		break;
	case "02":
		$sql1 = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode FROM petcliniccorp.employee WHERE status = \"I\" ORDER BY lname, fname";
		break;
	case "03":
		$sql1 = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode FROM petcliniccorp.employee WHERE status = \"D\" ORDER BY lname, fname";
		break;
	case "04":
		$sql1 = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode, status FROM petcliniccorp.employee ORDER BY lname, fname";
		break;
	case "05":
		$namestarts = $_POST["namestarts"];
		$sql1 = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode FROM petclinic.client WHERE lname = ".$namestarts."% ORDER BY lname, fname";
		break;
}
require_once "password.php";
$mysqlic = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE["employeenumber"];
$sql = "SELECT `sk27`, `sk32` FROM `petcliniccorp.seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$result = $mysqlic->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
$sk27 = $row[0];
$sk32 = $row[1];
require_once "includes/key.inc";
require_once "includes/de.inc";
$result = $mysqlic->query($sql1);
if ($result == FALSE)
{
	echo "<form action=\"mainmenu.php\" method=\"post\">";
	echo "<center>There are no employees.</center>";
	echo "<center><input type=\"submit\" value=\"Return to Main Menu\"></center>";
	echo "</form></body></html>";
	exit ();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	echo "<form action=\"mainmenu.php\" method=\"post\">";
	echo "<center>There are no employees.</center>";
	echo "<center><input type=\"submit\" value=\"Return to Main Menu\"></center>";
	echo "</form></body></html>";
	exit ();
}
if ($sk27 == "Y") {
	echo "Clicking on the Employee Number will take you to a display to edit that Employee.<hr>"; }
if ($sk32 == "Y") {
	echo "Clicking on the letters SK after the Employee Information will take you to a display to edit that Employee Security Keys.<hr>"; } 
delete_errormsg();
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$address = mc_decrypt($row[3], ENCRYPTION_KEY);
	if ($row[4] <> "")
		$address2 = mc_decrypt($row[4], ENCRYPTION_KEY);
	$row1 = "Employee # ";
	if ($sk27 == "Y") {
		$row1 = $row1."<a href=\"setupemaint.php?editempnum=".$row[0]."\">".$row[0]."</a>";
	} else {
		$row1 = $row1.[0];
	}
	$row1 = $row1." ".$row[2]." ".$row[1]." lives at ".$address;
	if ($row[4] <> "")
		$row1 = $row1.", ".$address2;
	$city = mc_decrypt($row[5], ENCRYPTION_KEY);
	$row1 = $row1." ".$city.", ".$row[6]." ".$row[7];
	if ($sk32 == "Y") {
	$row1 = $row1." <a href=\"setupsk.php?editempnum=".$row[0]."\">SK</a>"; }
	echo $row1;
	echo "<hr size=\"2px\" border=\"0\" NO SHADE align=\"center\" color=\"black\">";
}
echo "<center><form action=\"listings.php\" method=\"post\"><input type=\"submit\" value=\"Return to Listings Menu\"></form></center>";
$mysqlic->close();
$display ="emplist:".$emplnumber;
require_once "includes/footer.inc";
?>