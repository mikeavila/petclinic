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
include "includes/common.inc";
$mysqlih = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT logo, name FROM `petcliniccorp`.`company`;";
$resulth = $mysqlih->query($sql);
$rowh = $resulth->fetch_row();
$coname = $rowh[1];
if (strlen($rowh[0]) > 0) {
	$logo = $rowh[0];
} else {
	$logo = "";
}
if (isset($_COOKIE["preload"])) {
	$prearray = array_fill(0, 25, "");
	$prearray = unserialize($_COOKIE["preload"]);
	$background = $prearray[$background];
} else {
	$sql = "SELECT pref1, pref2, pref3, pref4, pref5 FROM `petcliniccorp`.`preferences` WHERE sequence = 2;";
	$result = $mysqlih->query($sql);
	$row = $result->fetch_row();
	$background = $row[$background];
}
$mysqlih->close();
echo '<html><head><meta charset="utf-8">';
if (isset($refresh)) echo $refresh;
echo '<title>PetClinic Management Software</title>';
echo '<script src="js/jquery.js"></script>';
echo '<script src="js/jquery-ui.js"></script>';
echo '<script src="js/jquery.validate.js"></script>';
echo '<script src="js/additional-methods.js"></script>';
echo '<script src="js/jquery.cookie.js"></script>';
echo '<script src="js/i18next.js"></script>';
echo '<script src="js/petclinic.js"></script>';
echo '<link rel="stylesheet" href="css/jquery-ui.css" type="text/css">';
echo '<link rel="stylesheet" href="css/petclinic.css" type="text/css">';
?>