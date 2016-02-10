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
include 'password.php';
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT status FROM `petclinicsys`.`logonallowed`;";
$errmsg = ' ';
if ( $result = $mysqli->query($sql) ) {
	if ( 1 == $result->num_rows ) {
		$row = $result->fetch_row();

		if ($row[0] == "Y") {
			$sql = "UPDATE `petclinicsys`.`logonallowed` SET `status` = 'N'";
		} else {
			$sql = "UPDATE `petclinicsys`.`logonallowed` SET `status` = 'Y'";
		}
		if ( !$mysqli->query($sql) === TRUE ) {
			$errmsg = 'Failed to update logon status information: ' . $mysqli->error;
               put_errormsg($errmsg);
		}
		else {
               put_errormsg($errmsg);
		}
	}
	else {
		$errmsg = 'Query success, but no rows found?';
          put_errormsg($errmsg);
	}
}
else {
	$errmsg = 'Could not query logon status information: ' . $mysqli->error;
     put_errormsg($errmsg);
}
$mysqli->close();
redirect("sysadmin.php");
?>