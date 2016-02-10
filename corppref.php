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
$sql = "USE petcliniccorp;";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql="SELECT * FROM `petcliniccorp`.`preferences` WHERE `sequence` = 2";
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
echo "<form method=\"post\" action=\"corppref1.php\">";
echo "<center><font size=\"+2\"><b><u>Background Color Preferences</u></b></font>";
echo "<br>Application Web Page Background Colors</center><br>";
echo "<table border=\"0\" width=\"90%\">";
$filelist = glob("./pictures/bg.*.png");
for ($i = 0; $i < 15; $i++) {
	if (!empty($filelist[$i])) {
		$filename = substr($filelist[$i], 14);
		$filename = substr($filename, 0, strlen($filename) -4);
		$filelist[$i] = $filename;
	} else {
		$maxcount = $i;
		break;
	}
}
if ($maxcount > 11) $maxcount = 11;
echo "<tr><td>";
for ($i = 0; $i < $maxcount; $i++) {
	echo $filelist[$i];
	echo "</td><td>";
}
echo "</td></tr><tr><td>";
for ($i = 0; $i < $maxcount; $i++) {
	echo "<img src=\"./pictures/bg.".$filelist[$i].".png\" width=\"100\" height=\"100\"></td><td>";
}
echo "</td></tr></table>";
echo "<br><center>Below are the current color settings. If you change them enter the EXACT spelling and case. On Linux systems file names are case sensitive.";
echo "If the entry is blank there is no background color selected for the type of display.</center>";
echo "<table border=\"0\" width=\"90%\">";
echo "<tr><td align=\"right\">Logon and related displays</td><td><input type=\"text\" name=\"pref1\" value=\"";
if (strlen($row[1]) > 0) {
	$filename = substr($row[1], 3);
	$filename = substr($filename, 0, strlen($filename) -4);
	echo $filename;
} else {
	echo "";
}
echo "\"></td><td align=\"right\">Menus</td><td>";
echo "<input type=\"text\" name=\"pref2\" value=\"";
if (strlen($row[2]) > 0) {
	$filename = substr($row[2], 3);
	$filename = substr($filename, 0, strlen($filename) -4);
	echo $filename;
} else {
	echo "";
}
echo "\"></td><td align=\"right\">Help displays</td><td><input type=\"text\" name=\"pref3\" value=\"";
if (strlen($row[3]) > 0) {
	$filename = substr($row[3], 3);
	$filename = substr($filename, 0, strlen($filename) -4);
	echo $filename;
} else {
	echo "";
}
echo "\"></td><td align=\"right\">Other displays</td><td><input type=\"text\" name=\"pref4\" value=\"";
if (strlen($row[4]) > 0) {
	$filename = substr($row[4], 3);
	$filename = substr($filename, 0, strlen($filename) -4);
	echo $filename;
} else {
	echo "";
}
echo "\"></td><td align=\"right\">Financial displays</td><td><input type=\"text\" name=\"pref5\" value=\"";
if (strlen($row[5]) > 0) {
	$filename = substr($row[5], 3);
	$filename = substr($filename, 0, strlen($filename) -4);
	echo $filename;
} else {
	echo "";
}
echo "\"></td></tr></table><br><br><center><input type=\"submit\" value=\"Update Preferences\"></center></form>";
echo "<form action=\"corpmenu.php\"><br><br><center><input type=\"submit\" value=\"Return to Company Information menu\"></center</form>";
require_once "includes/helpline.inc";
help("corppref.php");
$display = "corppref";
require_once "includes/footer.inc";
?>