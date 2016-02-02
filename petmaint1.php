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
$editpetnum=$_POST["editpetnum"];
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
if ($petname == "")
{
	setcookie("errormessage", "Pet Name cannot be blank", $expire1hr);
     redirect("petmaint.php");     
	exit();
}
if ($dobm == "")
{
	setcookie("errormessage", "Date of Birth Month cannot be blank", $expire1hr);
     redirect("petmaint.php");      
	exit();
}
if ($dobd == "")
{
	setcookie("errormessage", "Date of Birth Date cannot be blank", $expire1hr);
     redirect("petmaint.php");      
	exit();
}
if ($doby == "")
{
	setcookie("errormessage", "Date of Birth Year cannot be blank", $expire1hr);
     redirect("petmaint.php"); 
	exit();
}
if ($petspecies == "")
{
	setcookie("errormessage", "Pet Species cannot be blank", $expire1hr);
     redirect("petmaint.php");      
	exit();
}
if ($petbreed == "")
{
	setcookie("errormessage", "Pet Breed must be selected", $expire1hr);
     redirect("petmaint.php");      
	exit();
}
if ($petgender == "")
{
	setcookie("errormessage", "Pet gender must be selected", $expire1hr);
     redirect("petmaint.php");      
	exit();
}
?>