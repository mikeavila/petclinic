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
echo "<form action=\"petpicupload.php\" method=\"post\" enctype=\"multipart/form-data\">";
echo "<table cellspacing=\"0\" align=\"center\" cellpadding=\"3\">";
echo "<tr><td>File:</td>";
echo "<td><input type=\"hidden\" name=\"petid\" value=\"";
$petid = $_COOKIE['petid'];
echo $petid;
echo "\"></td>";
echo "<td><input type=\"file\" name=\"myFile\" size=\"45\"></td>";
echo "</tr><tr>";
echo "<td colspan=\"2\"><p align=\"center\">";
echo "<input type=\"submit\" name=\"action\" value=\"Upload Picture\">";
echo "</td></tr></table>";
?>