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
$value = "00";
if(!empty($_POST['menu']))
{
	foreach($_POST['menu'] as $sKey => $sValue);
	$value = $sValue;
}
delete_errormsg();
$emplnumber = $_COOKIE['employeenumber'];
switch ($value)
{
	case "11":
          redirect("clientlist.php");
		exit();
		break;
	case "12":
          redirect("petlist.php");
		exit();
		break;
	case "13":
          redirect("notavail.php");
		exit();
		break;
	case "14":
          redirect("notavail.php");
		exit();
		break;
	case "15":
          redirect("notavail.php");
		exit();
		break;
	case "16":
          redirect("notavail.php");
		exit();
		break;
	case "17":
          redirect("emplist.php");
		exit();
		break;
	case "18":
          redirect("notavail.php");
		exit();
		break;
	case "19":
          redirect("yourlist.php");
		exit();
		break;
	default:
          put_errormsg("You must make a selection");
          redirect("listings.php");
		exit();
		break;
}
?>