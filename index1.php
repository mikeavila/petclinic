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
$display = "Login";
$background = "0";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$log->logThis($logdatetimeecc."user at login display");
$emplnumber = '';
if (isset($_COOKIE['employeenumber'])) {
    $emplnumber = $_COOKIE['employeenumber'];
}
$errormessage = get_errormsg();
delete_errormsg();
?>
<form action="login.php" method="post">
	<div id="loginPage" class="center">
	   <div id="loginLeft" class="left">
	      <img class="loginImg" src="pictures/dog.jpg"><br>
	      <img src="pictures/dog1.jpg">
	   </div>
	   <div id="loginMiddle">
	      <div class="fieldSet">
	          <div class="fieldLabel">Employee Number</div><input type="text" name="emplnumber" value="" size="20" maxlength="10">
	      </div>
	      <div class="fieldSet">
	          <div class="fieldLabel">User ID</div><input type="text" name="userid" value="" size="20" maxlength="20">
	      </div>
	      <div class="fieldSet">
	          <div class="fieldLabel">Password</div><input type="password" name="password" value="" size="20" maxlength="20">
	      </div>
	   </div>
	   <div id="loginRight" class="right">
	      <img class="loginImg" src="pictures/dogcat.jpg"><br>
	      <img src="pictures/dog2.jpg">
	   </div>
	</div>
    <div class="center"><input type="submit" value="Login"></div>
</form>
<?php
require_once "includes/display_errormsg.inc";
?>
<div class="center">
   If you do not know your password but you know your Employee Number, your User ID, and have a Password reset question, <a href="pwdreset.php">click here</a>.
</div>
<?php
require_once "includes/helpline.inc";
help("logon.php");
require_once "includes/footer.inc";
?>