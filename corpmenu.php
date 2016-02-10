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
$display ="CorpInfo:".$emplnumber;
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$result = $mysqlic->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
echo "<center><form action=\"corpnav.php\" method=\"post\"><table border=\"0\" width=\"25%\">";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"01\" ";
if ($row[30] == "N") echo "DISABLED ";
echo ">Company Information</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"02\" ";
if ($row[31] == "N") echo "DISABLED ";
echo ">Company Preferences: Background Colors</td></tr>";

echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"03\" ";
if ($row[31] == "N") echo "DISABLED ";
echo ">Company Preferences: Default Settings</td></tr>";

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