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
if (isset($_GET["s"])) {
     $step = $_GET["s"];
} else {
     $step = 0;
}
if ($step == 0) {
     $background = "1";
     require_once "includes/header1.inc";
     require_once "includes/header2.inc";
     ?>
     <br><br><center>Main Menu Options
     <br><br>
     To use the Selection Menu for this session only, <a href="mainoptions.php?s=2&d=s&m=s">click here</a>.
     <br><br>
     To use the Selection Menu permanently, <a href="mainoptions.php?s=2&d=p&m=s">click here</a>.
     <br><br>
     To use the Icon Menu for this session only, <a href="mainoptions.php?s=2&d=s&m=i">click here</a>.
     <br><br>
     To use the Icon Menu permanently, <a href="mainoptions.php?s=2&d=p&m=i">click here</a>.
     <br><br>
     To Delete your currently setting so it can be changed, <a href="mainoptions.php?s=2&d=d&m=d">click here</a>.
     <br><br>
     To return to the Main Menu, <a href="mainmenu.php">click here</a>.
     </center>
     <?php
     exit(0);
}
$duration = $_GET["d"];
$menu = $_GET["m"];
if (isset($_COOKIE["ecc"])) {
     $ecc = $_COOKIE["ecc"];
     if (isset($_COOKIE[$ecc."menu"])) {     
     }
}
switch ($menu) {
    case "i":
          if ($duration == "p") {
               setcookie($ecc."menu", "Picon", time() + 2592000);
          } else {
               setcookie($ecc."menu", "Sicon");
          }
          break;
     case "s":
          if ($duration == "p") {
               setcookie($ecc."menu", "Pselect", time() + 2592000);
          } else {
               setcookie($ecc."menu", "Sselect");
          }
          break;     
     case "d":
          if ($duration == "d") {
               setcookie($ecc."menu", "Pselect", time() - 2592000);
          }
          break;     
}
redirect("mainmenu");
?>