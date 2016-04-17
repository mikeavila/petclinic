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
$log->logThis("user logged off");
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$empnum = $_SESSION["employeenumber"];
$sql = "SELECT `uuserid` FROM `petcliniccorp`.`employee` WHERE `emplnumber` = ".$empnum.";";
$result = $mysqli->query($sql);
$row = $result->fetch_row();
$userid = $row[0];
$sql = "DELETE FROM `petclinicsys`.`usersol` WHERE `user` = \"".$userid."\";";
$result = $mysqli->query($sql);
$mysqli->close();
delete_errormsg();
unset($_SESSION["employeenumber"]);
unset($_SESSION["up"]);
session_destroy();
redirect("index1.php");
?>