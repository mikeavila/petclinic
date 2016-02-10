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
$emplnumber=$_POST["emplnumber"];
$status=$_POST["status"];
require_once "includes/expire.inc";
if (empty($_POST["proccode"]))
{
     put_errormsg("Procedure Code cannot be blank");
     redirect("procmaint.php");     
	exit();
}
if (empty($_POST["procdesc"]))
{
     put_errormsg("Procedure Description cannot be blank");
     redirect("procmaint.php");     
	exit();
}
if (empty($_POST["procbillcharge"]))
{
     put_errormsg("Procedure Billing Charge cannot be blank (it can be zero)");
     redirect("procmaint.php");     
	exit();
}
if (empty($_POST["procstatus"]))
{
     put_errormsg("Status cannot be blank");
     redirect("procmaint.php");     
	exit();
}
if ($status <> "A") {
	
}
$emplnumber = $_COOKIE['employeenumber'];
$proccode = $_COOKIE["proccode"];
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
if ($proccode <> "new")
{
	$sql = "UPDATE procedure SET `petclinicproc`.`proccode` = \"".$proccode."\", `procdesc` = \"".$procdesc."\", `procbillcharge` = \"".$procbillcharge."\", `procstatus` = \"".$procstatus."\", ";
	$sql = $sql."`changeid` = ".$emplnumber." WHERE proccode = \"".$proccode."\";";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table procedure data update failed" . $mysqli->error;
		exit(1);
	}
} else{
	$sql = "INSERT INTO `petclinicproc`.`procedure` (`procdesc`, `procbillcharge`, `procstatus`, `changeid`)
	   VALUES (\"$procdesc\", \"$procbillcharge\", \"$procstatus\", $emplnumber);";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table procedure data insertion failed" . $mysqli->error;
		exit(1);
	}
	$newproccode = $mysqli->insert_id;
     if(isset($_POST["billable"])) {
          $billable = $_POST["billable"];   
          }
     }
}
$mysqli->close();
delete_errormsg();
redirect("procmaint.php"); 

?>