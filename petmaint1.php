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
     put_errormsg("Pet Name cannot be blank");
     redirect("petmaint.php");     
	exit();
}
if ($dobm == "")
{
     put_errormsg("Date of Birth Month cannot be blank");
     redirect("petmaint.php");      
	exit();
}
if ($dobd == "")
{
     put_errormsg("Date of Birth Date cannot be blank");
     redirect("petmaint.php");      
	exit();
}
if ($doby == "")
{
     put_errormsg("Date of Birth Year cannot be blank");
     redirect("petmaint.php"); 
	exit();
}
if ($petspecies == "")
{
     put_errormsg("Pet Species cannot be blank");
     redirect("petmaint.php");      
	exit();
}
if ($petbreed == "")
{
     put_errormsg("Pet Breed must be selected");
     redirect("petmaint.php");      
	exit();
}
if ($petgender == "")
{
     put_errormsg("Pet gender must be selected");
     redirect("petmaint.php");      
	exit();
}
?>