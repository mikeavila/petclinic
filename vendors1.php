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
$editvendornum = $_POST["editvendornum"];
$emplnumber=$_POST["emplnumber"];
$vendorid=$_POST["vendorid"];
$vendorname=$_POST["vendorname"];
$vendorshortname=$_POST["vendorshortname"];
$vendorcontact=$_POST["vendorcontact"];
$vendoraddress1=$_POST["vendoraddress1"];
$vendoraddress2=$_POST["vendoraddress2"];
$vendorcity=$_POST["vendorcity"];
$vendorstate=$_POST["vendorstate"];
$vendorzipcode=$_POST["vendorzipcode"];
$vendortele=$_POST["vendortele"];
$vendorfax=$_POST["vendorfax"];
$vendoremail=$_POST["vendoremail"];
require_once "includes/expire.inc";
$emplnumber = $_COOKIE['employeenumber'];
require_once "password.php";
require_once "includes/key.inc";
$mysqli = new mysqli('localhost', $user, $password, '');
require_once "includes/en.inc";
$address1 = mc_encrypt($vendoraddress1, ENCRYPTION_KEY);
if (strlen($vendoraddress2) > 0)
{
	$address2 = mc_encrypt($vendoraddress2, ENCRYPTION_KEY);
} else {
	$address2 = "";
}
$city = mc_encrypt($vendorcity, ENCRYPTION_KEY);
if ($editvendornum <> "new")
{
	$sql = "UPDATE `petclinicinc`.`vendor SET `vendorname` = \"".$vendorname."\", `vendorshortname` = \"".$vendorshortnamename."\", `vendorcontact` = \"".$vendorcontact."\", ";
	$sql = $sql."`vendoraddress1` = \"".$address1."\", `vendoraddress2` = \"".$address2."\", `vendorcity` = \"".$city."\", `vendorstate` = \"".$vendorstate."\", `vendorzipcode` = \"".$vendorzipcode."\", ";
     $sql = $sql."`vendortele` = \"".$vendortele."\", `vendorfax` = \"".$vendorfax."\", `vendoremail` = \"".$vendoremail."\" WHERE vendorid = \"".$editvendornum."\";";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table vendor data update failed" . $mysqli->error;
		exit(1);
	}
} else{
	$sql = "INSERT INTO `petclinicinc`.`vendor` (`vendorid`, `vendorname`, `vendorshortname`, `vendorcontact`, `vendoraddress``, `vendoraddress2`, `vendorcity`, `vendorstate`, `vendorzipcode`, `vendortele`, `vendorfax`, `vendoremail`)
	   VALUES (\"$vendorid\", \"$vendorname\", \"$vendorshortname\", \"$vendorcontact\", \"$address1\", \"$address2\", \"$city\", \"$vendorstate\", \"$vendorzipcode\", \"vendor$email\");";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table vendor data insertion failed" . $mysqli->error;
		exit(1);
	}
}
$mysqli->close();
put_errormsg("Vendor Added");
//setcookie("errormessage", "Vendor Added", $expire10hr); 
redirect("vendors.php"); 
?>