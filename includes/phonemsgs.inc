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
$scriptname = basename($_SERVER['SCRIPT_FILENAME']);
$mysqlipm = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `petclinicmsgs`.`phonemsgs` WHERE  `emplnumber` = '$emplnumber';";
$resultpm = $mysqlipm->query($sql);
if ($resultpm == FALSE)
{
     $mysqlipm->close();
     exit();
}
$row_cntpm = $resultpm->num_rows;
if ($row_cntpm == 0) {
     $mysqlipm->close();
     exit();
}
$rowpm = $resultpm->fetch_row();
//echo "<div id='phonemsgalert'><a href='phonemsgs3.php'>You have Phone Messages. Click on this line to read them.</a></div>";
echo '<center><div><a href="phonemsgs3.php?ret='.$scriptname.'">You have Phone Messages. Click on this line to read them.</a></div></center>';
$mysqlipm->close();
?>