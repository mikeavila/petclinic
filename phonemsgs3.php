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
$scriptname = $_GET["ret"];
$employeenumber = $_SESSION["employeenumber"];
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `petclinicmsgs`.`phonemsgs` WHERE  `emplnumber` = '$employeenumber';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     $mysqli->close();
     put_errormsg("Invalid Employee Number (1)");
     redirect("clientmaint.php");
     exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     $mysqli->close();
     put_errormsg("Invalid Employee Number (2)");
     redirect("clientmaint.php");
     exit();
}
echo "<br><br><center><b>Click on the message number that you want to view.</b></center><br><br>";
echo '<center><table id="msgtable" width="98%"><tr>
		<th width="10%">Msg #</th>
		<th width="10%">From</th>
		<th width="10%">Telephone Number</th>
		<th width="10%">Emergency</th>
		<th width="10%">Call</th>
		<th width="10%">Will Call Again</th>
		<th width="10%">Returned Your Call</th>
		<th width="10%">Came to See You</th>
		<th width="10%">Message Read</th></tr>';
$i = 0;
while ($i < $row_cnt) {
     $row = $result->fetch_row();
     echo '<tr class="center">
     		<td width="10%"><a href="phonemsgs4.php?ret=' . $scriptname . '&amp;msg=' . $row[0] . '">' . $row[0] . '</a></td>
     		<td width="10%">'.$row[8].'</td>
     		<td width="10%">'.$row[9].'</td>
     		<td width="10%">'.$row[7].'</td>
     		<td width="10%">',$row[3].'</td>
     		<td width="10%">'.$row[4].'</td>
     		<td width="10%">'.$row[5].'</td>
     		<td width="10%">'.$row[6].'</td>
     		<td width="10%">'.$row[2].'</td></tr>';
     $i++;
}
echo "</table></center>";
$mysqli->close();
echo "<center><form id='phoneform' name='phoneform' method='post' action=".$scriptname."><input type='submit' value='Return'></form></center>";
require_once "includes/display_errormsg.inc";
?>