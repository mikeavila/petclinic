<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =========                                               *
*petclinic Management Software                                   *
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
?>
<center>
<form id="phonemsg" name="phonemsg" method="post" action="phonemsg.php?">
<table class="phonemsgtable" id="phonemsgtable" name="phonemsgtable" width="25%" border="2" cellpadding="2" cellspacing="2">
<tr><td valign="top">Message For: <select id="msgfor" name="msgfor" size="3">
<?php
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT `emplnumber`, `lname`, `fname` FROM `petcliniccorp`.`employee` WHERE `status` = 'A';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Invalid Employee number");
     redirect("phonemsg.php");
     exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Invalid Employee number");
     redirect("phonemsg.php");
     exit();
}
while ( $row = $result->fetch_row() ) {
     echo '<option value='.$row[0].'>'.$row[1].', '.$row[2]."</option>";
}
$mysqli->close();
?>
</select></td></tr>
<tr><td>From: <input id="from" name="from" type="text" size="40" maxlength="40"></td></tr>
<tr><td>Telephone Number: <input id="from" name="from" type="text" size="20" maxlength="20"></td></tr>
<tr><td><input id="call" name="call" type="checkbox"> Call &nbsp; &nbsp; <input id="callagain" name="callagain" type="checkbox"> Will call again  &nbsp; &nbsp; <input id="retyourcall" name="retyourcall" type="checkbox"> Returned your call</TD></tr>
<tr><td></td></tr>
</table>
</form>
<br><br>
<div class="center">
    <form action="maintmenu.php" method="post"><input type="submit" value="Return to Maintenance Menu"></form>
</div>
</center>
</body></html>
<!------
     `read` char(1) NOT NULL,
     `cametosee` char(1) NOT NULL,
     `emergency` char(1) NOT NULL,
     `phonemessage` varchar(100) NOT NULL
     ---->