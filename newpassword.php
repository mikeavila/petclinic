<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*VetClinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
session_start();
$display = "Newpassword";
$background="0";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
?>
<form action="newpassword1.php" method="post"><center><table border="0" width="33%"><tr><td>This display is being shown to you because:</td></tr>
<tr><td>Someone else created your password.</td></tr>
<tr><td>Because you forgot your password.</td></tr>
<tr><td>Because only you should know your password, you are being asked to enter a new password.</td></tr>
<tr><td>New Password <input type="password" name="newpwd1"></td></tr>
<tr><td>Re-enter to confirm <input type="password" name="newpwd2"></td></tr>
<tr><td><input type="submit" value="Submit Change"></td></tr>
<tr><td><font size="+2" color="red">
<?php
include "includes/display_errormsg.inc";
?>
</font></td></tr></table></center></form>
<?php
require_once "includes/footer.inc";
?>