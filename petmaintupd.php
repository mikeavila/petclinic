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
if (!empty($_POST["petname"]))
{
	$petname = $_POST["petname"];
} else {
	$petname = "";
}
if (!empty($_POST["dobm"]))
{
	$dobm = $_POST["dobm"];
} else {
	$dobm = "";
}
if (!empty($_POST["dobd"]))
{
	$dobd = $_POST["dobd"];
} else {
	$dobd = "";
}
if (!empty($_POST["doby"]))
{
	$doby = $_POST["doby"];
} else {
	$doby = "";
}
if (!empty($_POST["petspecies"]))
{
	$petspecies = $_POST["petspecies"];
} else {
	$petspecies = "";
}
if (!empty($_POST["petbreed"]))
{
	$petbreed = $_POST["petbreed"];
} else {
	$petbreed = "";
}
if (!empty($_POST["petgender"]))
{
	$petgender = $_POST["petgender"];
} else {
	$petgender = "";
}
if (!empty($_POST["petfixed"]))
{
	$petfixed = $_POST["petfixed"];
} else {
	$petfixed = "";
}
if (!empty($_POST["petcolor"]))
{
	$petcolor = $_POST["petcolor"];
} else {
	$petcolor = "";
}
if (!empty($_POST["petdesc"]))
{
	$petdesc = $_POST["petdesc"];
} else {
	$petdesc = "";
}
if (!empty($_POST["picture"]))
{
	$picture = $_POST["picture"];
} else {
	$picture = "";
}
if (!empty($_POST["status"]))
{
	$status = $_POST["status"];
} else {
	$status = "";
}
if (!empty($_POST["license"]))
{
	$license = $_POST["license"];
} else {
	$license = "";
}
if (!empty($_POST["microchip"]))
{
	$microchip = $_POST["microchip"];
} else {
	$microchip = "";
}
if (!empty($_POST["rabiestag"]))
{
	$rabiestag = $_POST["rabiestag"];
} else {
	$rabiestag = "";
}
if (!empty($_POST["tattoonumber"]))
{
	$tattoonumber = $_POST["tattoonumber"];
} else {
	$tattoonumber = "";
}
if (!empty($_POST["petid"]))
{
	$petid = $_POST["petid"];
} else {
	$petid = "";
}
if (!empty($_POST["client1"]))
{
	$client1 = $_POST["client1"];
} else {
	$client1 = "";
}
if (!empty($_POST["client2"]))
{
	$client2 = $_POST["client2"];
} else {
	$client2 = "";
}
if ($petname == "") {
     put_errormsg("Pet Name cannot be blank");
     redirect("petmaint.php"); 
	exit();
}
if ($dobm == "") {
     put_errormsg("Pet Date of Birg Month cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($dobd == "") {
     put_errormsg("Pet Date of Birth Date cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($doby == "") {
     put_errormsg("Pet Date of Birth Year cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($petspecies == "") {
     put_errormsg("Pet Species cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($petbreed == "") {
     put_errormsg("Pet Breed must be selected");
     redirect("petmaint.php");
	exit();
}
if ($petgender == "") {
     put_errormsg("Pet Gender must be selected");
     redirect("petmaint.php");
	exit();
}
if ($petfixed == "") {
     put_errormsg("Pet Fixed must be selected");
     redirect("petmaint.php");
	exit();
}
if ($petcolor == "") {
     put_errormsg("Pet Color cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($petdesc == "") {
     put_errormsg("Pet Description cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($picture == "") {
     put_errormsg("Pet Picture cannot be blank");
     redirect("petmaint.php");
	exit();
}
if ($status == "") {
     put_errormsg("Pet Status cannot be blank");
     redirect("petmaint.php");
	exit();
}
$dob = $doby.$dobm.$dobd;
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE['employeenumber'];
$editpetnum = $_POST["editpetnum"];
$sql = "UPDATE `petclinic`.`pet` SET `petname` = \"".$petname."\", `petdob` = \"".$dob."\", `petspecies` = \"".$petspecies."\", `petbreed` = \"".$petbreed."\",";
$sql = $sql." `petgender` = \"".$petgender."\", `petfixed` = \"".$petfixed."\", `petcolor` = \"".$petcolor."\", `petdesc` = \"".$petdesc."\",";
$sql = $sql." `license` = \"".$license."\", `microchip` = \"".$microchip."\", `rabiestag` = \"".$rabiestag."\",";
$sql = $sql." `tattoonumber` = \"".$tattoonumber."\", `picture` = \"".$picture."\", `status` = \"".$status."\", `changeid` = \"".$emplnumber."\"";
$sql = $sql." WHERE `petnumber` = \"".$editpetnum."\";";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Pet Update failed; ".$mysqli->error);
     redirect("mainmenu.php");     
	exit();
}

if ($client1 <> "") {
	$sql = "SELECT * FROM `petclinic`.`clientpet` WHERE `clientnumber` = ".$client1." AND `petnumber` = ".$petid.";";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
		$sql = "INSERT INTO `petclinic`.`clientpet` (`clientnumber`, `petnumber`) VALUES (".$client1.", ".$petid.");";
		$result = $mysqli->query($sql);
		if ($result == FALSE)
		{
          put_errormsg("ClientPat Insert client1 failed; ".$mysqli->error);
          redirect("mainmenu.php");          
		exit();
		}
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		$sql = "INSERT INTO `petclinic`.`clientpet` (`clientnumber`, `petnumber`) VALUES (".$client1.", ".$petid.");";
		$result = $mysqli->query($sql);
		if ($result == FALSE)
		{
          put_errormsg("ClientPat Insert client1 failed; ".$mysqli->error);
          redirect("mainmenu.php");          
		exit();
		}
	}
}
if ($client2 <> "") {
	$sql = "SELECT * FROM `petclinic`.`clientpet` WHERE `clientnumber` = ".$client2." AND `petnumber` = ".$petid.";";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
		$sql = "INSERT INTO `petclinic`.`clientpet` (`clientnumber`, `petnumber`) VALUES (".$client2.", ".$petid.");";
		$result = $mysqli->query($sql);
		if ($result == FALSE)
		{
          put_errormsg("ClientPat Insert client2 failed; ".$mysqli->error);
          redirect("mainmenu.php");          
		exit();
		}
	}	
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		$sql = "INSERT INTO `petclinic`.`clientpet` (`clientnumber`, `petnumber`) VALUES (".$client1.", ".$petid.");";
		$result = $mysqli->query($sql);
		if ($result == FALSE)
		{
          put_errormsg("ClientPat Insert client1 failed; ".$mysqli->error);
          redirect("mainmenu.php");          
		exit();
		}
	}
}
$mysqli->close();
$petpic = $_POST["petpic"];
If ($petpic == "Y") {
     delete_errormsg();
	setcookie("petid", $petid, $expire1hr);
     redirect("petpicture.php");
	exit();
}	
delete_errormsg();
redirect("maintmenu.php"); 
?>