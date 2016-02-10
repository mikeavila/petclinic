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
$display = "PwdReset";
$background = "0";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
if (isset($_POST["pass"]))
{
	$pass = $_POST["pass"];
} else {
	$pass = "";
}
if ($pass == "")
{
	echo "<center>You must know your Employee Number and User ID in order to use the Password Reset. In addition, you must have a Password Reset Question and Answer completed.";
	echo "If you do not know or have any other these items, you will need to have the System Administrator change your password.</center>";
	echo "<form action=\"pwdreset1.php\" method=\"post\"><center><table border=\"0\" width=\40%\">";
	echo "<tr><td width=\"25%\" align=\"right\">Enter your Employee Number</td><td><input type=\"text\" name=\"empnum\" size=\"4\" maxlength=\"4\"></td></tr>";
	echo "<tr><td width=\"25%\" align=\"right\">Enter your User ID</td><td><input type=\"text\" name=\"userid\" size=\"10\" maxlength=\"10\"></td></tr>";
	echo "<tr><td><input type=\"hidden\" name=\"pass\" value=\"1\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Continue\"></td></tr>";
	echo "</table></form>";
	echo "<center><font size=\"+2\" color=\"red\">";
     include "includes/display_errormsg.inc";
	echo "</center>";
}
require_once "includes/footer.inc";
?>