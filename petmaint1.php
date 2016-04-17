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
$log->logThis($logdatetimeecc."insert/update pet");
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$emplnumber ="";
$editpetnum = "";
$petname = "";
$petdob = "";
$petbreed = "";
$petgender = "";
$petfixed = "";
$petcolor = "";
$petdesc = "";
$picture = "";
$status = "";
$license = "";
$microchip = "";
$rabiestag = "";
$tattoonumber = "";
$client1 = "";
$client2 = "";

if (!empty($_POST["emplnumber"]))
{
	$emplnumber = $_POST["emplnumber"];
}
if (!empty($_POST["editpetnum"]))
{
	$editpetnum = $_POST["editpetnum"];
}
if (!empty($_POST["petname"]))
{
	$petname = $_POST["petname"];
}
if (!empty($_POST["petdob"]))
{
	$petdob = $_POST["petdob"];
}
if (!empty($_POST["petbreed"]))
{
	$petbreed = $_POST["petbreed"];
}
if (!empty($_POST["petgender"]))
{
	$petgender = $_POST["petgender"];
}
if (!empty($_POST["petfixed"]))
{
	$petfixed = $_POST["petfixed"];
}
if (!empty($_POST["petcolor"]))
{
	$petcolor = $_POST["petcolor"];
}
if (!empty($_POST["petdesc"]))
{
	$petdesc = $_POST["petdesc"];
}
if (!empty($_POST["picture"]))
{
	$picture = $_POST["picture"];
}
if (!empty($_POST["status"]))
{
	$status = $_POST["status"];
}
if (!empty($_POST["license"]))
{
	$license = $_POST["license"];
}
if (!empty($_POST["microchip"]))
{
	$microchip = $_POST["microchip"];
}
if (!empty($_POST["rabiestag"]))
{
	$rabiestag = $_POST["rabiestag"];
}
if (!empty($_POST["tattoonumber"]))
{
	$tattoonumber = $_POST["tattoonumber"];
}
if (!empty($_POST["client1"]))
{
	$client1 = $_POST["client1"];
}
if (!empty($_POST["client2"]))
{
	$client2 = $_POST["client2"];
}

if ($petname == "") {
     put_errormsg("Pet Name cannot be blank");
	exit();
}
if ($petdob == "") {
     put_errormsg("Pet Date of Birth cannot be blank");
	exit();
}
if ($petbreed == "") {
     put_errormsg("Pet Breed must be selected");
	exit();
}
if ($petgender == "") {
     put_errormsg("Pet Gender must be selected");
	exit();
}
if ($petfixed == "") {
     put_errormsg("Pet Fixed must be selected");
	exit();
}
if ($petcolor == "") {
     put_errormsg("Pet Color cannot be blank");
	exit();
}
if ($petdesc == "") {
     put_errormsg("Pet Description cannot be blank");
	exit();
}
if ($picture == "") {
     put_errormsg("Pet Picture cannot be blank");
	exit();
}
if ($status == "") {
     put_errormsg("Pet Status cannot be blank");
	exit();
}

if ( 'new' == $editpetnum ) { // insert
	$sql = "INSERT INTO `petclinic`.`pet` (`petname`, `petdob`, `petbreed`, `petgender`, `petfixed`, `petcolor`, `petdesc`, `license`,";
	$sql = $sql." `microchip`, `rabiestag`, `tattoonumber`, `picture`, `status`, `changeid`) ";
	$sql = $sql." VALUES (\"$petname\", \"$petdob\", \"$petbreed\", \"$petgender\", \"$petfixed\", \"$petcolor\", \"$petdesc\",";
	$sql = $sql." \"$license\", \"$microchip\", \"$rabiestag\",  \"$tattoonumber\", \"$picture\", \"$status\", $emplnumber);";
	$result = $mysqli->query($sql);

	if ($result == FALSE) {
	     put_errormsg("Pet Insert failed; ".$mysqli->error);
		 exit();
	}
	$editpetnum = $mysqli->insert_id;
}
else { // update
	$sql = "UPDATE `petclinic`.`pet` SET `petname` = \"".$petname."\", `petdob` = \"".$petdob."\", `petbreed` = \"".$petbreed."\",";
	$sql = $sql." `petgender` = \"".$petgender."\", `petfixed` = \"".$petfixed."\", `petcolor` = \"".$petcolor."\", `petdesc` = \"".$petdesc."\",";
	$sql = $sql." `license` = \"".$license."\", `microchip` = \"".$microchip."\", `rabiestag` = \"".$rabiestag."\",";
	$sql = $sql." `tattoonumber` = \"".$tattoonumber."\", `picture` = \"".$picture."\", `status` = \"".$status."\", `changeid` = \"".$emplnumber."\"";
	$sql = $sql." WHERE `petnumber` = \"".$editpetnum."\";";
	$result = $mysqli->query($sql);

	if ($result == FALSE) {
	     put_errormsg("Pet Update failed; ".$mysqli->error);
		exit();
	}
}
if ($client1 <> "") {
	$sql = "REPLACE INTO `petclinic`.`clientpet` VALUES (" . $client1 . "," . $editpetnum . ")";
	$result = $mysqli->query($sql);

	if ($result == FALSE) {
          put_errormsg("ClientPet Insert client1 failed; ".$mysqli->error);
		exit();
	}
}

if ($client2 <> "") {
	$sql = "REPLACE INTO `petclinic`.`clientpet` VALUES (" . $client2 . "," . $editpetnum . ")";
	$result = $mysqli->query($sql);

	if ($result == FALSE) {
          put_errormsg("ClientPet Insert client2 failed; ".$mysqli->error);
		exit();
	}
}

$petpic = $_POST["petpic"];

if ($petpic == "Y") {
    delete_errormsg();
	$_SESSION["petid"] = $editpetnum;
	exit();
}

$mysqli->close();
delete_errormsg();
$_SESSION['pet_data']=array('petname' => $petname, 'pid' => $editpetnum);
echo "petmaint.php";
?>