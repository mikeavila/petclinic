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
$editempnum = $_COOKIE["editempnum"];
$sk_yn = array_fill(1, 35, "N");
if(isset($_POST["sk"]))
{
	if(!empty($_POST['sk'])){
	// Loop to store and display values of individual checked checkbox.
		foreach($_POST['sk'] as $selected){
			$sk_yn[$selected] = "Y";
		}
	}
}

require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "UPDATE `petcliniccorp`.`seckeys` SET `sk01` = \"$sk_yn[1]\", `sk02` = \"$sk_yn[2]\", `sk03` = \"$sk_yn[3]\", `sk04` = \"$sk_yn[4]\", `sk05` =\"$sk_yn[5]\", `sk06` = \"$sk_yn[6]\", 
					`sk07` = \"$sk_yn[7]\", `sk08` = \"$sk_yn[8]\",	`sk09` = \"$sk_yn[9]\",	`sk10` = \"$sk_yn[10]\", `sk11` = \"$sk_yn[11]\",`sk12`= \"$sk_yn[12]\",
					`sk13` = \"$sk_yn[13]\", `sk14` = \"$sk_yn[14]\", `sk15` = \"$sk_yn[15]\", `sk16` = \"$sk_yn[16]\", `sk17` = \"$sk_yn[17]\",
					`sk18` = \"$sk_yn[18]\", `sk19` = \"$sk_yn[19]\", `sk20` = \"$sk_yn[20]\", `sk21` = \"$sk_yn[21]\",	`sk22` = \"$sk_yn[22]\", `sk23` = \"$sk_yn[23]\",
					`sk24` = \"$sk_yn[24]\",	`sk25` = \"$sk_yn[25]\", `sk26` = \"$sk_yn[26]\", `sk27` = \"$sk_yn[27]\", `sk28` = \"$sk_yn[28]\", `sk29` = \"$sk_yn[29]\",
					`sk30` = \"$sk_yn[30]\", `sk31` = \"$sk_yn[31]\", `sk32` = \"$sk_yn[32]\", `sk33` = \"$sk_yn[33]\", `sk34` = \"$sk_yn[34]\", `sk35` = \"$sk_yn[35]\" 
					WHERE `emplnumber` = \"$editempnum\" AND `sequence` = 1";

if ($mysqli->query($sql) === TRUE) {

} else {
	put_errormsg ("Employee security data1 Update failed" . $mysqli->error);
     redirect ("criticalerror.php?m=seckeys1.php&ec=0");
	exit(1);
}
$mysqli->close();
delete_errormsg();
redirect("seckeys.php"); 
?>