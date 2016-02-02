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
	setcookie("errormessage", "Pet Name cannot be blank", $expire1hr);
     redirect("petmaint.php"); 
	exit();
}
if ($dobm == "") {
	setcookie("errormessage", "Pet Date of Birg Month cannot be blank", $expire1hr);
	exit();
}
if ($dobd == "") {
	setcookie("errormessage", "Pet Date of Birth Date cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($doby == "") {
	setcookie("errormessage", "Pet Date of Birth Year cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petspecies == "") {
	setcookie("errormessage", "Pet Species cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petbreed == "") {
	setcookie("errormessage", "Pet Breed must be selected", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petgender == "") {
	setcookie("errormessage", "Pet Gender must be selected", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petfixed == "") {
	setcookie("errormessage", "Pet Fixed must be selected", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petcolor == "") {
	setcookie("errormessage", "Pet Color cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($petdesc == "") {
	setcookie("errormessage", "Pet Description cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($picture == "") {
	setcookie("errormessage", "Pet Picture cannot be blank", $expire1hr);
     redirect("petmaint.php");
	exit();
}
if ($status == "") {
	setcookie("errormessage", "Pet Status cannot be blank", $expire1hr);
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
	setcookie("errormessage", "Pet Update failed; ".$mysqli->error, $expire1hr);
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
		setcookie("errormessage", "ClientPat Insert client1 failed; ".$mysqli->error, $expire1hr);
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
		setcookie("errormessage", "ClientPat Insert client1 failed; ".$mysqli->error, $expire1hr);
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
		setcookie("errormessage", "ClientPat Insert client2 failed; ".$mysqli->error, $expire1hr);
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
		setcookie("errormessage", "ClientPat Insert client1 failed; ".$mysqli->error, $expire1hr);
          redirect("mainmenu.php");          
		exit();
		}
	}
}
$mysqli->close();
$petpic = $_POST["petpic"];
If ($petpic == "Y") {
	setcookie("errormessage", " ", $expire1hr);
	setcookie("petid", $petid, $expire1hr);
     redirect("petpicture.php");
	exit();
}	
setcookie("errormessage", " ", $expire1hr);
redirect("maintmenu.php"); 
?>