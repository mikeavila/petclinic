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
echo "<form method=\"post\" action=\"visitsnav.php\">";
echo "<center>";
echo "<table border=\"0\" width=\"25%\">";
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"01\">Create New Visit</td></tr>";
echo "<tr><td><input type=\"radio\" name=\"menu[]\" value=\"02\">View Previous Visits</td></tr>";
echo "<tr><td><input type=\"submit\" value=\"Submit Request\"></td></tr></table></form>";
echo "<br><br><center><form method=\"post\" action=\"mainmenu.php\"><input type=\"submit\" value=\"Return to Main Menu\"></form></center>";
echo "<br><br><center><font size=\"+2\" color=\"red\">";
include "includes/display_errormsg.inc";
echo "</font></center>";
$display = "visits";
require_once "includes/footer.inc";
?>