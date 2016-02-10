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
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$display ="Listings:".$emplnumber;
require_once "password.php";
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp.seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$result = $mysqlic->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
?>
<center><form action="listnav.php" method="post"><table border="0" width="25%">
<?php
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"11\" ";
if ($row[11] == "N") echo "DISABLED ";
echo ">Client Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"12\" ";
if ($row[12] == "N") echo "DISABLED ";
echo ">Pet Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"13\" ";
if ($row[13] == "N") echo "DISABLED ";
echo ">Procedures Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"14\" ";
if ($row[14] == "N") echo "DISABLED ";
echo ">Inventory Supplies Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"15\" ";
if ($row[15] == "N") echo "DISABLED ";
echo ">Inventory Medicine Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"16\" ";
if ($row[16] == "N") echo "DISABLED ";
echo ">Inventory Other Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"17\" ";
if ($row[17] == "N") echo "DISABLED ";
echo ">Employee Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"18\" ";
if ($row[18] == "N") echo "DISABLED ";
echo ">Client/Pet/Visit Listing</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"19\" ";
if ($row[19] == "N") echo "DISABLED ";
echo ">List your Employee Information</td></tr>";

echo "</table><center><input type=\"submit\" value=\"Process Request\"></center>";
echo "<input type=\"hidden\" name=\"emplnumber\" value=\"";
echo $emplnumber;
echo "\">";
echo "</form><form action=\"mainmenu.php\" method=\"post\">";
echo "<center><input type=\"submit\" value=\"Return to Main Menu\"></center></form>";
echo "</table><center><font size=\"+2\" color=\"red\">";
include "includes/display_errormsg.inc";
echo "</font></center>";
require_once "includes/footer.inc";
$mysqlic->close();
?>