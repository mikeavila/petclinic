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
$display = "CriticalError:";
$background = "0";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$errorcode = "0";
$module = "";
$errormsg = "";
$errorcode = $_GET["ec"];
$module = $_GET["m"];
$errormsg = get_errormsg();
delete_errormsg();
$datenow = date('D y/m/d')
$timenow = date('H:i:s');
?>
<h2>Critical Error</h2>
<br><br>
Please make note or print out this error and report it so it can be fixed. For how to report problems <a href="support.php">click here</a>.
<br><br><center>
A citical error occured. The information is as follows:
<p>Date: <?php echo $datenow; ?>
<p>Time: <?php echo $timenow; ?>
<p>User id:
<p>Module: <?php echo $module ?>
<p>Error Code: <?php echo $errorcode ?>
<br><br>
<?php echo $errormsg ?>
<br><br>
<form medthod="post" action="mainmenu.php"><input type="submit" value="Return to the Main menu"></form></center></body></html>