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
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
$editpetnum = $_COOKIE["editpetnum"];
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petlinic`.`code_species`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Internal error for code_species");
     redirect("mainmenu.php");      
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Internal error for code_species");
     redirect("mainmenu.php");      
	exit();
}
echo "<br><br><form method=\"get\" action=\"setuppmaint.php\"><center>";
echo "<br><SELECT name=\"speciescd\" size=\"2\">";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<option value=\"".$row[0].$row[1]."\">".$row[1]."</option>";
}
echo "</select><br><br><input type=\"hidden\" name=\"editpetnum\" value=\"new2\"><input type=\"submit\" value=\"Continue\"></center></form>";
$display = "Petmaint1(n):".$emplnumber;
require_once "includes/footer.inc";
$mysqli->close();
?>