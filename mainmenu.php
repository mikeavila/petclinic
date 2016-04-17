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
$log->logThis($logdatetimeecc."determining user's choice of menu");
$duration = "S";
if (isset($_SESSION["ecc"])) {
     $ecc = $_SESSION["ecc"];
     if (isset($_COOKIE[$ecc."menu"])) {
          $duration = substr($_COOKIE[$ecc."menu"], 0, 1);
          $menu = substr($_COOKIE[$ecc."menu"], 1);
     } else {
          $menu = "select";
     }
} else {
     $menu = "select";
}
if ($duration == "P") {
     setcookie($ecc."menu", "P".$menu, time() + 2592000);
}
switch ($menu) {
     case "icon":
          $log->logThis($logdatetimeecc."menu choice is icon");
          redirect("mainicon.php");
          exit();
          break;
     case "bar":
          $log->logThis($logdatetimeecc."menu choice is bar");
          redirect("mainbar.php");
          exit();
          break;
     default:
          $log->logThis($logdatetimeecc."menu choice is default (select)");
          redirect("mainselect.php");
          exit();
          break;
}
?>