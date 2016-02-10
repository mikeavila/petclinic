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
$display = "PwdReset";
$background = "0";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$empnum = $_POST["empnum"];
$userid = $_POST["userid"];
$display = "Emplmaint:".$empnum;
require_once "includes/expire.inc";
$mysqli = new mysqli('localhost', $user, $password, '');
require_once "includes/key.inc";
require_once "includes/de.inc";
$sql = "SELECT uuserid, pwdhint, hintans FROM employee WHERE `petcliniccorp`.`emplnumber` = \"".$empnum."\"";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Invalid Employee number");
     redirect("pwdreset.php");     
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Invalid Employee number");
     redirect("pwdreset.php");
	exit();
}
$row = $result->fetch_row();
if ($row[0] <> $userid)
{
     put_errormsg("Invalid information"); 
     redirect("pwdreset.php");
	exit();
}
if (strlen($row[1]) == 0)
{
     put_errormsg("You do not have a Password Reset Question");
     redirect("pwdreset.php");
	exit();
}

setcookie("Q", $row[1], $expire1hr);
setcookie("A", $row[2], $expire1hr);
setcookie("P", "2", $expire1hr);
delete_errormsg();
$mysqli->close();
redirect("pwdreset2.php");
?>