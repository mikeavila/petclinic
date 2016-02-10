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
require_once "includes/expire.inc";
require_once "petarraykeys.php";
$petarray = array_fill(0, 25, "");
$petarray = unserialize($_COOKIE["petarray"]);
$petname = $petarray[$pak_petname];
$dobm = $petarray[$pak_dobm];
$dobd = $petarray[$pak_dobd];
$doby = $petarray[$pak_doby];
$petspecies = $petarray[$pak_petspecies];
$petbreed = $petarray[$pak_petbreed];
$petgender = $petarray[$pak_petgender];
$petfixed = $petarray[$pak_petfixed];
$petcolor = $petarray[$pak_petcolor];
$petdesc = $petarray[$pak_petdesc];
$picture = $petarray[$pak_picture];
$status = $petarray[$pak_status];
$license = $petarray[$pak_license];
$microchip = $petarray[$pak_microchip];
$rabiestag = $petarray[$pak_rabiestag];
$tattoonumber = $petarray[$pak_tattoonumber];
$client1 = $petarray[$pak_client1];
$client2 = $petarray[$pak_client2];
$dob = $doby.$dobm.$dobd;

if ($petname == "") {
     put_erormsg("Pet Name cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($dobm == "") {
     put_errormsg("Pet Date of Birth Month cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($dobd == "") {
     put_errormsg("Pet Date of Birth Date cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($doby == "") {
     put_errormsg("Pet Date of Birth Year cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($petspecies == "") {
     put_errormsg("Pet Species cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($petbreed == "") {
     put_errormsg("Pet Breed must be selected");
     redirect("petmaint1new1.php");
	exit();
}
if ($petgender == "") {
     put_errormsg("Pet Gender must be selected");
     redirect("petmaint1new1.php");
	exit();
}
if ($petfixed == "") {
     put_errormsg("Pet Fixed must be selected");
     redirect("petmaint1new1.php");
	exit();
}
if ($petcolor == "") {
     put_errormsg("Pet Color cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($petdesc == "") {
     put_errormsg("Pet Description cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($picture == "") {
     put_errormsg("Pet Picture cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}
if ($status == "") {
     put_errormsg("Pet Status cannot be blank");
     redirect("petmaint1new1.php");
	exit();
}

require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE['employeenumber'];
$sql = "INSERT INTO `petclinic`.`pet` (`petname`, `petdob`, `petspecies`, `petbreed`, `petgender`, `petfixed`, `petcolor`, `petdesc`, `license`,";
$sql = $sql." `microchip`, `rabiestag`, `tattoonumber`, `picture`, `status`, `changeid`) ";
$sql = $sql." VALUES (\"$petname\", \"$dob\", \"$petspecies\", \"$petbreed\", \"$petgender\", \"$petfixed\", \"$petcolor\", \"$petdesc\",";
$sql = $sql." \"$license\", \"$microchip\", \"$rabiestag\",  \"$tattoonumber\", \"$picture\", \"$status\", $emplnumber);";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Pet Insert failed; ".$mysqli->error);
     redirect("mainmenu.php");     
	exit();
}
$petid = $mysqli->insert_id;
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
		//setcookie("errormessage", "ClientPat Insert client1 failed; ".$mysqli->error, $expire1hr);
          put_errormsg("ClientPat Insert client1 failed; ".$mysqli->error);
          redirect("mainmenu.php");          
		exit();
		}
	}
}
$mysqli->close();
delete_errormsg();
redirect("maintmenu.php"); 
?>