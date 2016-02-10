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
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$display ="Maintmenu:".$emplnumber;
?>
<center><form action="invmednav.php" method="post"><table border="0" width="25%">
<tr><td><input type="radio" name="menu[]" value="1">Medicine Inventory Transaction</td></tr>
<tr><td><input type="radio" name="menu[]" value="2">Medicine Inventory Base Record - Modify</td></tr>
<tr><td><input type="radio" name="menu[]" value="3">Medicine Inventory Base Record - Create</td></tr>
</table><br><br><center><input type="submit" value="Process Selection"></center></form>
<?php include "includes/display_errormsg.inc"; ?>
<form action="maintmenu.php"><input type="submit" value="Return to Maint Menu"></form></body></html>