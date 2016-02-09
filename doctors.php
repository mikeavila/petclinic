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
$background = "3";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$step= "0";
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
if(isset($_POST["step"])) {
     $step = $_POST["step"];
} else {
     $step = 0;
}
$docnumber = "new";
$doctordesc = "";
$docstatelic = "";
$doctordea = "";
$doctorstatus = "A";
?>
<form class="center" id="docformpre" name="docformx" method="post" action="doctors.php">
<div id="formContainer">
<div><h2>Doctor Entry</h2></div>
<div id="formLeftSide">
<br>
<div>Current list of Doctors</div>
<br>
<select name="doclist" size="5">
<?php
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`doctors`;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Cannot access doctors table");
} else {
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
          put_errormsg("There are no Doctors in the database");
     } else {
          for ($i = 0; $i < $row_cnt; $i++) {
               $row = $result->fetch_row();
               echo '<option value="'.$row[0].'">'.sprintf("%3s",$row[0])." ".$row[1].'</option>';
          } 
     }
}
$mysqli->close();
echo "</select></div>";
echo '<div id="formRightSide"><br>';
echo "<center><form id='docform0` name='docform0' action=\"doctors1.php\" method=\"post\">";
echo "<table width = \"50%\" border = \"0\">";
echo "<tr><td>Enter the Doctor Number to be edited.</td></tr>";
echo "<tr><td><input type=\"text\" name=\"editdocnum\" size=\"5\" maxlength=\"5\"></td></tr>";
echo "<tr><td><input type=\"submit\" value=\"Edit Requested Doctor\"></td></tr></table></form>";

echo "<form id='docform1' name='docform1' action=\"doctors1.php\" method=\"post\">";
echo "<input type=\"hidden\" name=\"editdocnum\" value=\"new\">";
echo "<table width=\"50%\"><tr><td><input type=\"submit\" value=\"Create New Doctor\"></td></tr>";
echo "</table></form></center>";

echo '<form id="docformreturn" name="docformreturn" action="maintmenu.php" method="post"><center><table width="100%"><tr><td align="center"><input type="submit" value="Return to Maintenance Menu"></td></tr></table></center></form>';
include "includes/display_errormsg.inc";
$display = "doctor:";
require_once "includes/footer.inc";
echo '<form class="center" action="maintmenu.php"><input type="submit" value="Return to Maint Menu"></form></body></html>';