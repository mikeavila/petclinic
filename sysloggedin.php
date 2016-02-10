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
$refresh = "<meta http-equiv=\"refresh\" content=\"30\";>";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
echo "<br><br><center>This page will automatically refresh every 30 seconds</center>";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petclinicsys`.`usersol`;";
$result = $mysqli->query($sql);
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("There are no Users Logged In");
     redirect("sysadmin.php");     
	exit();
}
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<br>".$row[0]." ".$row[1]." ".$row[2];
}
echo "<form method=\"post\" action=\"sysadmin.php\"><center><input type=\"submit\" value=\"Return to Sys Admin Menu\"></center></form>";
$display = "sysloggedin";
require_once "includes/footer.inc";
?>