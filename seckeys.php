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
/*
Record 1
Main Menu access to Sub Menus:
1	Appointments
2	Visits - Existing Clients	
4	Listings
5	Maintenance
6	Grooming
7	Boarding
8	Vendor
9	Import / Export Data
10	Company Information
Listing Sub Menu access to:
11	Client Listing
12	Pet Listing
13	Procedures
14	Inventory - Supplies
15	Inventory - Medicine
16	Inventory - Other
17	Employee
18	Client/Pet/Visit
19	Your Information
3    Add/Modify doctors
Maintenance Sub Menu access to:
21	Client Add/Modify
22	Pet Add/Modify
23	Procedures Add/Modify
24	Inventory Supplies Add/Modify
25	Inventory Medicine Add/Modify
26	Inventory Other Add/Modify
27	Employee Add/Modify
28	Client/Pet/Visit Add/Modify
29	Your Information Modify	
Company Sub Menu access to Modify:
30	Company Information Modify
31	Company Preferences Modify
Special:
32	Employee Security Keys Modify
33   Search
34
35 Software Updates
Record 2
1  
*/
session_start();
$display ="SecKeys:".$emplnumber;
$background = "3";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$editempnum = $_COOKIE["editempnum"];
$errormsg = "";
$errormsg = get_errormsg();
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $editempnum and `sequence` = 1;";
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
echo "<form method=\"post\" action=\"seckeys1.php\">";
echo "<table width=\"90%\" border=\"0\">";
echo "<tr><td colspan=\"9\" align=\"center\">Sequence 1</td></tr>";
echo "<tr><td colspan=\"9\" align=\"center\"><font size=\"-1\">Main Menu access to following Sub Menus</font></td></tr>";
echo "<tr><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"1\" ";
if ($row[2] == "Y") echo "CHECKED";
echo " >Appointments</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"2\" ";
if ($row[4] == "Y") echo "CHECKED";
echo " >New Client Visits</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"4\" ";
if ($row[5] == "Y") echo "CHECKED";
echo " >Listings</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"5\" ";
if ($row[6] == "Y") echo "CHECKED";
echo " >Maintenance</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"6\" ";
if ($row[7] == "Y") echo "CHECKED";
echo " >Grooming</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"7\" ";
if ($row[8] == "Y") echo "CHECKED";
echo " >Boarding</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"8\" ";
if ($row[9] == "Y") echo "CHECKED";
echo " >Vendorl</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"9\" ";
if ($row[10] == "Y") echo "CHECKED";
echo " >Import / Export Data</td></tr>";

echo "<tr><td><input type=\"checkbox\" name=\"sk[]\" value=\"10\" ";
if ($row[11] == "Y") echo "CHECKED";
echo " >Company Information</td></tr>";

echo "<tr><td colspan=\"9\" align=\"center\"><font size=\"-1\">Listing Sub Menu Access to following listings</font></td></tr>";
echo "<tr><td><input type=\"checkbox\" name=\"sk[]\" value=\"11\" ";
if ($row[12] == "Y") echo "CHECKED";
echo " >Client Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"12\" ";
if ($row[13] == "Y") echo "CHECKED";
echo " >Pet Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"13\" ";
if ($row[14] == "Y") echo "CHECKED";
echo " >Procedures Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"14\" ";
if ($row[15] == "Y") echo "CHECKED";
echo " >Supplies Inventory Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"15\" ";
if ($row[16] == "Y") echo "CHECKED";
echo " >Medicine Inventory Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"16\" ";
if ($row[17] == "Y") echo "CHECKED";
echo " >Other Inventory Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"17\" ";
if ($row[18] == "Y") echo "CHECKED";
echo " >Employee Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"18\" ";
if ($row[19] == "Y") echo "CHECKED";
echo " >Client/Pet/Vist Listing</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"19\" ";
if ($row[20] == "Y") echo "CHECKED";
echo " >Your Information Listing</td></tr>";

echo "<tr><td><input type=\"checkbox\" name=\"sk[]\" value=\"20\" ";
if ($row[21] == "Y") echo "CHECKED";
echo " >Not Assigned</td></tr>";

echo "<tr><td colspan=\"9\" align=\"center\"><font size=\"-1\">Maintenance Sub Menu Access to following areas</font></td></tr>";
echo "<tr><td><input type=\"checkbox\" name=\"sk[]\" value=\"21\" ";
if ($row[22] == "Y") echo "CHECKED";
echo " >Client Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"22\" ";
if ($row[23] == "Y") echo "CHECKED";
echo " >Pet Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"23\" ";
if ($row[24] == "Y") echo "CHECKED";
echo " >Procedures Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"24\" ";
if ($row[25] == "Y") echo "CHECKED";
echo " >Supplies Inventory Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"25\" ";
if ($row[26] == "Y") echo "CHECKED";
echo " >Medicine Inventory Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"26\" ";
if ($row[27] == "Y") echo "CHECKED";
echo " >Other Inventory Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"27\" ";
if ($row[28] == "Y") echo "CHECKED";
echo " >Employee Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"28\" ";
if ($row[29] == "Y") echo "CHECKED";
echo " >Client/Pet/Visit Add/Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"29\" ";
if ($row[3] == "Y") echo "CHECKED";
echo " >Doctors Add/Modify</td><td width=\"10%\"><input type=\"checkbox\" name=\"sk[]\" value=\"3\" ";
if ($row[30] == "Y") echo "CHECKED";
echo " >Your Information Modify</td></tr>";

echo "<tr><td colspan=\"9\" align=\"center\"><font size=\"-1\">Special Access</font></td></tr>";
echo "<tr><td><input type=\"checkbox\" name=\"sk[]\" value=\"30\" ";
if ($row[31] == "Y") echo "CHECKED";
echo " >Company Information Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"31\" ";
if ($row[32] == "Y") echo "CHECKED";
echo " >Company Preferences Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"32\" ";
if ($row[33] == "Y") echo "CHECKED";
echo " >Employee Security Keys Modify</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"33\" ";
if ($row[34] == "Y") echo "CHECKED";
echo " >Search</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"34\" ";
if ($row[35] == "Y") echo "CHECKED";
echo " >Not Assigned</td><td><input type=\"checkbox\" name=\"sk[]\" value=\"35\" ";
if ($row[36] == "Y") echo "CHECKED";
echo " >Not Assigned</td></tr>";
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $editempnum and `sequence` = 2;";
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
echo "<tr><td colspan=\"9\" align=\"center\">Sequence 2</td></tr>";
echo "</table><center><input type=\"submit\" value=\"Update Security Keys\"></form>";
echo "<form method=\"post\" action=\"mainmenu.php\"><center><input type=\"submit\" value=\"Return to Main mnu\"></center></form>";

?>