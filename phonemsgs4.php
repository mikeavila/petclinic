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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
require_once "includes/common.inc";
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
echo "<div id='phonemsgdiv' name='phonemsgdiv'><h1 id='phonemsgtitle' name='phonemsgtitle'>Phone Message</h1><br>";
echo "<table id='phonemsgtable' name='phonemsgtable' cellpadding='2' cellspacing='2'>";
echo "<tr><td valign='top'>Message For: ";
$msgnum = $_GET["msg"];
$sql = "SELECT * FROM `petclinicmsgs`.`phonemsgs` WHERE `messagenumber` = '".$msgnum."';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Invalid Message Number");
	redirect("phonemsgs3.php");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Invalid Message Number");
	redirect("phonemsgs3.php");
	exit();
}
$row = $result->fetch_row();
$sql = "SELECT `lname`, `fname` FROM `petcliniccorp`.`employee` WHERE `emplnumber` = '".$row[1]."';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Invalid Employee Number");
	redirect("phonemsgs3.php");
	exit();
}
$row_cnt = $result->num_rows;
$rowe = $result->fetch_row();
echo $rowe[0].", ".$rowe[1];
?>
</td></tr>
<tr><td><br>From: <?php echo $row[8] ?></td></tr>
<tr><td><br>Telephone Number: <?php echo $row[9] ?></td></tr>
<tr><td><br>
<input name="emergency" type="checkbox"
<?php
if ($row[7] == "Y") echo " CHECKED "
?>
DISABLED> Emergency &nbsp; &nbsp; &nbsp; <input name="cametosee" type="checkbox"
<?php
if ($row[6] == "Y") echo " CHECKED "
?>
DISABLED> Came to see you
<br><input name="call" type="checkbox"
<?php
if ($row[3] == "Y") echo " CHECKED "
?>
DISABLED> Call &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input name="willcallagain" type="checkbox"
<?php
if ($row[4] == "Y") echo " CHECKED "
?>
DISABLED> Will call again<br>
<input name="retyourcall" type="checkbox"
<?php
if ($row[5] == "Y") echo " CHECKED "
?>
DISABLED> Returned your call
</td></tr>
<tr><td><br>Message: Limited to 100 chars</td></tr>
<tr><td>
<?php echo $row[10] ?>
</td></tr>
</table>
</div>
<br>
<br>
<?php
$sql = "UPDATE `petclinicmsgs`.`phonemsgs` SET `read` = 'Y' WHERE `messagenumber` = '".$msgnum."';";
$result = $mysqli->query($sql);
$mysqli->close();
$ret = $_GET["ret"];
echo "<center>";
echo '<form method="post" action="phonemsgs3.php?ret='.$ret.'"><input type="submit" value="Return"></form>';
echo '<form method="post" action="'.$ret.'"><input type="submit" value="Return to Previous Work"></form>';
echo "</center>";
include "includes/returnmaintmenu.inc";
$display = "phonemsgs4";
require_once 'includes/footer.inc';
?>