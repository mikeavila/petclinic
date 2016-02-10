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
require_once "password.php";
$dbname="vetclinic";
$mysqlic = new mysqli('localhost', $user, $password, '');
require_once "includes/key.inc";
require_once "includes/de.inc";
$emplid = $_COOKIE['employeenumber'];
$sql = "SELECT emplnumber, lname, fname, address, address2, city, state, zipcode FROM `petcliniccorp`.`employee` WHERE emplnumber = ".$emplid;
$result = $mysqlic->query($sql);
require_once "includes/expire.inc";
if ($result == FALSE)
{
     put_errormsg("You are not listed. Internal error.");
     redirect("listings.php");      
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("You are not listed. Internal error.");
     redirect("listings.php");      
	exit();
}
echo "Clicking on your Employee Number will take you to a display to edit yoour information.<hr>";
delete_errormsg();
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$address = mc_decrypt($row[3], ENCRYPTION_KEY);
	if ($row[4] <> "")
		$address2 = mc_decrypt($row[4], ENCRYPTION_KEY);
	$row1 = "Employee # <a href=\"setupcmaint.php?editclientnum=".$row[0]."\">".$row[0]."</a> ".$row[2]." ".$row[1]." lives at ".$address;
	if ($row[4] <> "")
		$row1 = $row1.", ".$address2;
	$city = mc_decrypt($row[5], ENCRYPTION_KEY);
	$row1 = $row1." ".$city.", ".$row[6]." ".$row[7];
	echo $row1;
	echo "<center><form action=\"listings.php\" method=\"post\"><input type=\"submit\" value=\"Return to Listings Menu\"></form></center>";
}
$mysqlic->close();
?>