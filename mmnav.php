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
$errormsg="";
$emplnumber = $_COOKIE['employeenumber'];
$ecc = $_COOKIE["ecc"];
switch ($value)
{
	case "01":
		setcookie("errormessage", " ", $expire10hr);
          redirect("appt.php");
		exit();
		break;
	case "02":
		setcookie("errormessage", " ", $expire10hr);
          redirect("visits.php");          
		exit();
		break;
	case "03":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "04":
		setcookie("errormessage", " ", $expire10hr);
          redirect("listings.php");
		exit();
		break;
	case "05":
		setcookie("errormessage", " ", $expire10hr);
          redirect("maintmenu.php");
		exit();
		break;
	case "06":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "07":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "08":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "09":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "10":
		setcookie("errormessage", " ", $expire10hr);
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
		setcookie("errormessage", "You must make a selection", $expire10hr);
          redirect("mainmenu.php");          
		exit();
		break;
}
?>