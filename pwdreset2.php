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
$question=$_COOKIE["Q"];
$answer=$_COOKIE["A"];
$pass = "";
$pass=$_COOKIE["P"];
if (isset($_GET["pass"]))
	$pass = $_GET["pass"];
require_once "includes/expire.inc";
require_once "key.php";
require_once "includes/de.inc";
if($pass == 2)
{
	$background = "0";
	require_once "includes/header1.inc";
     require_once "includes/header2.inc";
	echo "<center><form action=\"pwdreset2.php?pass=3\" method=\"post\"><table border=\"0\" width=\"60%\">";
	echo "<tr><td>";
	$question = mc_decrypt($question, ENCRYPTION_KEY);
	echo $question;
	echo "</td><td><input type=\"text\" name=\"answer\" size=\"40\" maxlength=\"40\"></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Submit Answer\"></td></tr>";
	echo "</table></form></center>";
	$display = "Pwdreset2";
	require_once "includes/footer.inc";
	exit();
}
if ($pass == 3)
{
	$hashanswer = mc_decrypt($answer, ENCRYPTION_KEY);
	$answer = $_POST["answer"];
	if ($answer <> $hashanswer)
	{
          put_errormsg("Your answer is not correct");
          redirect("pwdreset.php");
		exit();
	}
}
delete_errormsg();
redirect("newpassword.php");
?>?