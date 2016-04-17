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
$background = '3';
$logFileName = 'user';
$headerTitle='USER LOG';
require_once 'includes/header1.inc';
require_once 'includes/header2.inc';;
require_once 'includes/common.inc';
$step= '0';
$emplnumber = $_SESSION['employeenumber'];
$docnumber = 'new';
$doctordesc = '';
$docstatelic = '';
$doctordea = '';
$doctorstatus = 'A';

echo '<div class="center"><h2>Doctor Entry</h2></div>';
echo '<div id="formContainer">';
echo '<div id="formLeftSide"><br>';
echo '<div>Current list of Doctors</div><br>';
echo '<select name="doclist" size="5">';

$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
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
          while ( $row = $result->fetch_row() ) {
               echo '<option value="'.$row[0].'">'.sprintf("%3s",$row[0])." ".$row[1].'</option>';
          }
     }
}
$mysqli->close();
echo '</select></div>';
echo '<div id="formRightSide"><br>';
echo '<form id="docform0" name="docform0" action="doctors1.php" method="post">';
echo '<table class="center" width="100%">';
echo '<tr><td>Enter the Doctor Number to be edited.</td></tr>';
echo '<tr><td><input type="text" name="editdocnum" size="5" maxlength="5"></td></tr>';
echo '<tr><td><input type="submit" value="Edit Requested Doctor"></td></tr></table></form><br>';

echo '<form id="docform1" name="docform1" action="doctors1.php" method="post">';
echo '<input type="hidden" name="editdocnum" value="new">';
echo '<table class="center" width="100%"><tr><td><input type="submit" value="Create New Doctor"></td></tr>';
echo '</table></form><br>';
include "includes/returnmaintmenu.inc";
include 'includes/display_errormsg.inc';
$display = 'doctor: ';

require_once 'includes/footer.inc';
