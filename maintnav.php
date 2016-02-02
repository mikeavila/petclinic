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
$errormsg='';
$emplnumber = $_COOKIE['employeenumber'];
switch ($value)
{
	case "11":
		setcookie("errormessage", " ", $expire10hr);
		setcookie("editclientnum", " ", $expire2hr);
          redirect("clientmaint.php");
		exit();
		break;
	case "12":
		setcookie("errormessage", " ", $expire10hr);
		setcookie("editpetnum", " ", $expire2hr);
          redirect("petmaint.php");
		exit();
		break;
	case "13":
		setcookie("errormessage", " ", $expire10hr); 
          redirect("procmaint.php");
		exit();
		break;
	case "14":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "15":
		setcookie("errormessage", " ", $expire10hr);
          redirect("invmedmenu.php");
		exit();
		break;
	case "16":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "17":
		setcookie("errormessage", " ", $expire10hr);
		setcookie("editempnum", " ", $expire2hr);
          redirect("emplmaint.php");
		exit();
		break;
	case "18":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "19":
		setcookie("errormessage", " ", $expire10hr);
		$editempnum = $_COOKIE['employeenumber'];
		setcookie("editempnum", $editempnum, $expire1hr);
          redirect("emplmaint.php");
		exit();
		break;
     case "3":
          setcookie("errormessage", " ", $expire10hr);
          redirect("doctors.php");
		exit();
          break;
     case "20":
          setcookie("errormessage", " ", $expire10hr);
          redirect("vendors.php");
		exit();
          break; 
	default:
		setcookie("errormessage", "You must make a selection", $expire10hr);
          redirect("maintmenu.php");
		exit();
		break;
}
?>