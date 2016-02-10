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
if(isset($_GET["menu"])) {
     $value = $_GET["menu"];
}
if($value == "00") {
     if(!empty($_POST['menu']))
     {
          foreach($_POST['menu'] as $sKey => $sValue);
          $value = $sValue;
     }
}
$emplnumber = $_COOKIE['employeenumber'];
$ecc = $_COOKIE["ecc"];
delete_errormsg();
switch ($value)
{
	case "01":
          redirect("appt.php");
		exit();
		break;
	case "02":
          redirect("visits.php");          
		exit();
		break;
	case "03":
          redirect("notavail.php");
		exit();
		break;
	case "04":
          redirect("listings.php");
		exit();
		break;
	case "05":
          redirect("maintmenu.php");
		exit();
		break;
	case "06":
          redirect("notavail.php");
		exit();
		break;
	case "07":
          redirect("notavail.php");
		exit();
		break;
	case "08":
          redirect("notavail.php");
		exit();
		break;
	case "09":
          redirect("notavail.php");
		exit();
		break;
	case "10":
          redirect("corpmenu.php");
		exit();
		break;
	case "11":
          redirect("logoff.php");
		exit();
	case "12":
          redirect("sysadmin.php");
		exit();
	case "33":
          redirect("search.php");
		exit();
     case "mo":
          redirect("mainoptions.php");
		exit();
	default:
          put_errormsg("You must make a selection");
          redirect("mainmenu.php");          
		exit();
		break;
}
?>