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
if (empty($_POST["proccode"]))
{
     put_errormsg("Procedure Code cannot be blank");
     redirect("procmaint.php");
	exit();
} else {
	$proccode = $_POST["proccode"];
}
if (empty($_POST["procdesc"]))
{
     put_errormsg("Procedure Description cannot be blank");
     redirect("procmaint.php");
	exit();
} else {
	$procdesc = $_POST["procdesc"];
}
if (empty($_POST["proctype"]))
{
     put_errormsg("Procedure Type cannot be blank");
     redirect("procmaint.php");
	exit();
} else {
	$proctype = $_POST["proctype"];
}
if (empty($_POST["procstatus"]))
{
     put_errormsg("Status cannot be blank");
     redirect("procmaint.php");
	exit();
} else {
	$procstatus = $_POST["procstatus"];
}
//if ($status <> "A") {
//}
$emplnumber = $_SESSION['employeenumber'];
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
if ($proccode <> "new")
{
	$sql = "UPDATE procedures SET `petclinicproc`.`proccode` = \"".$proccode."\", `procdesc` = \"".$procdesc."\", `proctype` = \"".$proctype."\", `procstatus` = \"".$procstatus."\", ";
	$sql = $sql."`changeid` = ".$emplnumber." WHERE proccode = \"".$proccode."\";";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table procedure data update failed" . $mysqli->error;
		exit(1);
	}
} else{
	$sql = "INSERT INTO `petclinicproc`.`procedures` (`procdesc`, `proctype`, `procstatus`, `changeid`)
	   VALUES (\"$procdesc\", \"$proctype\", \"$procstatus\", $emplnumber);";
	if ($mysqli->query($sql) === TRUE) {

	} else {
		echo "Table procedure data insertion failed" . $mysqli->error;
		exit(1);
	}
}
$mysqli->close();
delete_errormsg();
redirect("procmaint.php");

?>