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
echo $value;
switch ($value)
{
	case "1":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "2":
		setcookie("errormessage", " ", $expire10hr);
          redirect("notavail.php");
		exit();
		break;
	case "3":
		setcookie("errormessage", " ", $expire10hr); 
          redirect("invmedbase.php");
		exit();
		break;
	default:
		setcookie("errormessage", "You must make a selection", $expire10hr);
          redirect("invmedmenu.php");          
		exit();
		break;
}
?>