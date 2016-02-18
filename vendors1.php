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
if(isset($_POST["editvendornum"])) {
     $editvendornum = $_POST["editvendornum"];
} else {
      put_errormsg("POST editvendornum not set");
     redirect("vendors.php"); 
     exit(1);
}
if(isset($_POST["emplnumber"])) {
     $emplnumber=$_POST["emplnumber"];
} else {
     put_errormsg("POST emplnum not set");
     redirect("vendors.php"); 
     exit(1);
}
require_once "includes/key.inc";
require_once "includes/en.inc";
$vendorid=$_POST["vendorid"];
$vendorname=$_POST["vendorname"];
$vendorshortname=$_POST["vendorshortname"];
$vendorcontact=$_POST["vendorcontact"];
$vendoraddress1=$_POST["vendoraddress1"];
$vendoraddress1 = mc_encrypt($vendoraddress1, ENCRYPTION_KEY);
$vendoraddress2=$_POST["vendoraddress2"];
if ($vendoraddress2 <> "")
     $vendoraddress2 = mc_encrypt($vendoraddress2, ENCRYPTION_KEY);
$vendorcity=$_POST["vendorcity"];
$vendorcity = mc_encrypt($vendorcity, ENCRYPTION_KEY);
$vendorstate=$_POST["vendorstate"];
$vendorzipcode=$_POST["vendorzipcode"];
$vendortele=$_POST["vendortele"];
$vendorfax=$_POST["vendorfax"];
$vendoremail=$_POST["vendoremail"];
$vendoremail = mc_encrypt($vendoremail, ENCRYPTION_KEY);
$vendorstatus=$_POST["vendorstatus"];
require_once "includes/expire.inc";
$emplnumber = $_COOKIE['employeenumber'];
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
if ($editvendornum <> "new")
{
	$sql = "UPDATE `petclinicinv`.`vendor` SET `vendorname` = \"".$vendorname."\", `vendorshortname` = \"".$vendorshortname."\", `vendorcontact` = \"".$vendorcontact."\", ";
	$sql = $sql."`vendoraddress1` = \"".$vendoraddress1."\", `vendoraddress2` = \"".$vendoraddress2."\", `vendorcity` = \"".$vendorcity."\", `vendorstate` = \"".$vendorstate."\", `vendorzipcode` = \"".$vendorzipcode."\", ";
     $sql = $sql."`vendortele` = \"".$vendortele."\", `vendorfax` = \"".$vendorfax."\", `vendoremail` = \"".$vendoremail."\", `vendorstatus` = \"".$vendorstatus."\" WHERE vendorid = \"".$editvendornum."\";";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		put_errormsg("Table vendor data update failed" . $mysqli->error);
          redirect("vendors.php"); 
		exit(1);
	}
} else{
	$sql = "INSERT INTO `petclinicinv`.`vendor` (`vendorname`, `vendorshortname`, `vendorcontact`, `vendoraddress1`, `vendoraddress2`, `vendorcity`, `vendorstate`, `vendorzipcode`, `vendortele`, `vendorfax`, `vendoremail`, `vendorstatus`)
	   VALUES (\"$vendorname\", \"$vendorshortname\", \"$vendorcontact\", \"$vendoraddress1\", \"$vendoraddress2\", \"$vendorcity\", \"$vendorstate\", \"$vendorzipcode\", \"$vendortele\", \"$vendorfax\", \"$vendoremail\", \"$vendorstatus\");";
	if ($mysqli->query($sql) === TRUE) {

	} else {
          put_errormsg("Table vendor data insertion failed" . $mysqli->error);
          redirect("vendors.php"); 
		exit(1);
	}
}
$mysqli->close();
put_errormsg("Vendor Added/Modified"); 
setcookie( "editvendornum", "");
redirect("vendors.php"); 
?>