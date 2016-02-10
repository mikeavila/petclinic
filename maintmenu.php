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
$emplnumber = $_COOKIE['employeenumber'];
$display ="Maintmenu:".$emplnumber;
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1 ;";
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
?>
<center><form action="maintnav.php" method="post"><table border="0" width="50%">
<?php
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"11\" ";
if ($row[21] == "N") echo "DISABLED ";
echo ">Client Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"12\" ";
if ($row[22] == "N") echo "DISABLED ";
echo ">Pet Add and Modify</td></tr>"; 

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"13\" ";
if ($row[23] == "N") echo "DISABLED ";
echo ">Procedures Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"14\" ";
if ($row[24] == "N") echo "DISABLED ";
echo ">Inventory Supplies Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"15\" ";
if ($row[25] == "N") echo "DISABLED ";
echo ">Inventory Medicine Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"16\" ";
if ($row[26] == "N") echo "DISABLED ";
echo ">Inventory Other Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"20\" ";
if ($row[8] == "N") echo "DISABLED ";
echo ">Inventory Vendor Add and Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"17\" ";
if ($row[27] == "N") echo "DISABLED ";
echo ">Employee Add and Modify</td></tr>"; 

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"18\" ";
if ($row[28] == "N") echo "DISABLED ";
echo ">Client/Pet/Visit Modify</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"3\" ";
if ($row[3] == "N") echo "DISABLED";
echo " >Add/Modify Doctors</td><td width=\"10%\">";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"19\" ";
if ($row[29] == "N") echo "DISABLED ";
echo ">Modify your Employee Information</td></tr>";   /* partial done */

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
$mysqli->close();
?>