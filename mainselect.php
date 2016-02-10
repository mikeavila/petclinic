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
$emplnumber = $_COOKIE['employeenumber'];
$display ="MMenu:".$emplnumber;
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$result = $mysqlic->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
?>
<center><form action="mmnav.php" method="post"><table border="0" width="25%">
<?php
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"01\" ";
if ($row[1] == "N") echo "DISABLED ";
echo ">Appointments</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"03\" ";
echo ">Phone Messages</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"33\" ";
if ($row[33] == "N") echo "DISABLED ";
echo ">Search</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"02\" ";
if ($row[2] == "N") echo "DISABLED ";
echo ">Visits - Existing Client</td></tr>";
 
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"04\" ";
if ($row[4] == "N") echo "DISABLED ";
echo ">Listings</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"05\" ";
if ($row[5] == "N") echo "DISABLED ";
echo ">Maintenance</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"06\" ";
if ($row[6] == "N") echo "DISABLED ";
echo ">Grooming</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"07\" ";
if ($row[7] == "N") echo "DISABLED ";
echo ">Boarding</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"10\" ";
if ($row[10] == "N") echo "DISABLED ";
echo ">Company Information</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"12\" ";
if ($row[35] == "N") echo "DISABLED ";
echo ">Software Administration</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"mo\">Main Menu Options</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"11\" ";
echo ">Logoff</td></tr>";

echo "<tr><td><input type=\"submit\" value=\"Go to Sub Menu or Logoff\"></td></tr>";
echo "<tr><td><input type=\"hidden\" name=\"emplnumber\" value=\"";
echo $emplnumber;
echo "\">";
echo "</td></tr></table></form><font size=\"+2\" color=\"red\">";
include "includes/display_errormsg.inc";
echo "</font></center>";
$mysqlic->close();
require_once "includes/helpline.inc";
help("mainselect.php");
require_once "includes/footer.inc";
?>