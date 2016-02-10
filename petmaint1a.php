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
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
require_once "petarraykeys.php";
$editpetnum = $_COOKIE["editpetnum"];
delete_errormsg();
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
$petarray = array_fill(0, 25, "");
$petarray[$pak_petname] = $petname;
$petarray[$pak_dobm] = $dobm;
$petarray[$pak_dobd] = $dobd;
$petarray[$pak_doby] = $doby;
$petarray[$pak_petspecies] = $petspecies;
$petarray[$pak_petbreed] = $petbreed;
$petarray[$pak_petgender] = $petgender;
$petarray[$pak_petfixed] = $petfixed;
$petarray[$pak_petcolor] = $petcolor;
$petarray[$pak_petdesc] = $petdesc;
$petarray[$pak_picture] = $picture;
$petarray[$pak_status] = $status;
$petarray[$pak_license] = $license;
$petarray[$pak_microchip] = $microchip;
$petarray[$pak_rabiestag] = $rabiestag;
$petarray[$pak_tattoonumber] = $tattoonumber;
$petarray[$pak_client1] = $client1;
$petarray[$pak_client2] = $client2;
setcookie("petarray", serialize($petarray), $expire1hr);
redirect("petmaintins.php"); 
?>