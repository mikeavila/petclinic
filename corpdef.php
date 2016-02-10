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
require_once "includes/expire.inc";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql="SELECT * FROM `petcliniccorp`.`preferences` WHERE `sequence` = 3";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Internal Error");
     redirect("corpmenu.php");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Internal Error");
     redirect("corpmenu.php");     
	exit();
}
$row = $result->fetch_row();
$preload = $row[1];
$state = $row[2];
$autosalesprice = $row[3];
$row = $result->fetch_row();
$sql="SELECT `pref1` FROM `petcliniccorp`.`preferences` WHERE `sequence` = 4";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	//setcookie("errormessage", "Internal Error", $expire1hr); 
     put_errormsg("Internal Error");
     redirect("corpmenu.php");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Internal Error");
     redirect("criticalerror.php?m=corpdef.php&ec=0");
	exit();
}
$row = $result->fetch_row();
$procedures = $row[0];
echo "<form method=\"post\" action=\"corpdef1.php\">";
echo "<center><font size=\"+2\"><b><u>Preferences</u></b></font>";
echo "<br>Application Default Settings</center><br>";
echo "<center><table width=\"60%\">";
echo "<tr><td align=\"right\"> Preload Defaults </td><td><select name=\"preload\" size=\"2\"><option value=\"Y\">Yes</option><option value=\"N\">No</option></td></tr>";
echo "<tr><td align=\"right\">Default State for Data Entry </td><td><select name=\"state\" size = \"5\">";
$mysqlis = new mysqli('localhost', $user, $password, '');
$sqlstate = "SELECT * FROM `petclinic`.`code_state` ORDER BY `statedesc`";
$resultstate = $mysqlis->query($sqlstate);
if ($resultstate == FALSE)
{
     put_errormsg("Acquiring States Error");
     redirect("corpmenu.php");     
	exit();
}
$row_cnt_state = $resultstate->num_rows;
if ($row_cnt_state == 0) {
     put_errormsg("Acquiring States Error");
     redirect("corpmenu.php");     
	exit();
}
for ($i = 0; $i < $row_cnt_state; $i++) {
echo $i;
	$rowstate = $resultstate->fetch_row();
	echo '<option value=".$rowstate[0]."';
	if (strlen($state) > 0) {
		if ($rowstate[0] == $state)
			echo " SELECTED ";
	}
	echo " >".$rowstate[1]."</option>";
}
echo "\"></select>";
echo "</td></tr>";
echo "<tr><td align=\"right\"> Automatically Update Medicine Sales Price</td><td> <select name=\"autosalesprice\" size=\"2\">";
echo "<option value=\"Y\">Yes</option><option value=\"N\">No</select></td></tr>";
echo "<tr><td align=\"right\"> Time Zone</td><td> <select name=\"timezone\" size=\"4\">";
$file_handle = fopen("data/timezones.txt", "r");
while (!feof($file_handle)) {
   $line = fgets($file_handle);
   echo "<option value=\"".$line."\">".$line."</option>";
}
fclose($file_handle);
echo "</select></td></tr>";
echo "<tr><td>Which Procedures Database do you want to be the default</td><td>";
if(substr($procedures,0,1) == "S")
     echo "<input type='radio' name='defproc[]' value='S'> SNOMED-VTS ";
if(substr($procedures,1,1) == "V")
     echo "<input type='radio' name='defproc[]' value='V'> VeNom ";
if(substr($procedures,2,1) == "P")
     echo "<input type='radio' name='defproc[]' value='P'> Your Own Procedures ";
echo "<br>PLEASE NOTE: The Default Procedure will be the only Procedure to be displayed. However, you can change the Default Procedure any time.</tr>";
echo "</table></center><br><br><center><input type=\"submit\" value=\"Update Preferences\"></center></form>";
echo "<form action=\"corpmenu.php\"><br><br><center><input type=\"submit\" value=\"Return to Company Information menu\"></center</form>";
require_once "includes/helpline.inc";
help("corpdef.php");
$display = "corpdef";
require_once "includes/footer.inc";
?>