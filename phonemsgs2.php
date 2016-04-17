<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =========                                               *
*petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
session_start();
$msgfor = $_POST["msgfor"];
$fromname = $_POST["fromname"];
$tele = $_POST["tele"];
$message = $_POST["message"];
$emergency = "N";
$call = "N";
$callagain = "N";
$retyourcall = "N";
$cametosee = "N";
if($value == "00") {
     if(!empty($_POST['chkbxs']))
     {
          foreach($_POST['chkbxs'] as $sKey => $sValue);
          $value = $sValue;
          switch ($value) {
          	case "emergency":
          		$emergency = "Y";
          		break;
          	case "call":
          		$call = "Y";
          		break;
          	case "callagain":
          		$callagain = "Y";
          		break;
          	case "retyourcall":
          		$retyourcall = "Y";
          		break;
          	default:
          		break;
          }
     }
}
require_once "password.php";
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "INSERT INTO `petclinicmsgs`.`phonemsgs` (`emplnumber`, `read`, `call`, `callagain`, `retyourcall`, `cametosee`, `emergency`, `from`, `telephone`, `phonemessage`)
		VALUE('$msgfor', 'N', '$call', '$callagain', '$retyourcall', '$cametosee', '$emergency', '$fromname', '$tele', '$message');";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     echo "INSERT failed";
     exit();
}
$mysqli->close();
?>