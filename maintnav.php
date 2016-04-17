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

$value = "00";
if(!empty($_POST['menu']))
{
	foreach($_POST['menu'] as $sKey => $sValue);
	$value = $sValue;
}
$errormsg='';
$emplnumber = $_SESSION['employeenumber'];
delete_errormsg();
switch ($value)
{
	case "11":
          redirect("clientmaint.php");
		exit();
		break;
	case "12":
		  unset($_SESSION["editpetnum"]);
          redirect("petmaint.php");
		exit();
		break;
	case "13":
          redirect("procmaint.php");
		exit();
		break;
	case "14":
          redirect("notavail.php");
		exit();
		break;
	case "15":
          redirect("invmedmenu.php");
		exit();
		break;
	case "16":
          redirect("notavail.php");
		exit();
		break;
	case "17":
		unset($_SESSION["editempnum"]);
        redirect("emplmaint.php");
		exit();
		break;
	case "18":
          redirect("notavail.php");
		exit();
		break;
	case "19":
		$editempnum = $_SESSION['employeenumber'];
          redirect("emplmaint.php?editempnum=".$editempnum);
		exit();
		break;
     case "3":
          redirect("doctors.php");
		exit();
          break;
     case "20":
          redirect("vendors.php");
		exit();
          break;
	default:
          put_errormsg("You must make a selection");
          redirect("maintmenu.php");
		exit();
		break;
}
?>