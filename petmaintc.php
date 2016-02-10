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
require_once "includes/expire.inc";
require_once "includes/key.inc";
require_once "includes/de.inc";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT clientnumber, lname, fname, address, address2, city, state, zipcode, email FROM `petclinic`.`client` ";
$sql = $sql."WHERE `status` = \"A\" ORDER BY `lname`, `fname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("There are no Clients");
     redirect("listings.php");      
	exit();
}
$row_cnt = $result->num_rows;
delete_errormsg();
echo "<center><b><u><font size=\"+2\">Client List to Select Pet Owners</font></u></b></center><br><br>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$address = mc_decrypt($row[3], ENCRYPTION_KEY);
	if ($row[4] <> "") {
		$address2 = mc_decrypt($row[4], ENCRYPTION_KEY);
	} else {
		$address2 = "";
	}
	$row1 = "Client # ".$row[0]." ".$row[1].", ".$row[2]." lives at ".$address." ";
	if ($address2 <> "")
	{
		$row1 = $row1.$address2." ";
	}
	if ($row[4] <> "")
		$row1 = $row1.", ".$address2;
	$city = mc_decrypt($row[5], ENCRYPTION_KEY);
	$row1 = $row1.", ".$city.", ".$row[6]." ".$row[7];
	echo $row1;
}
$mysqli->close();
echo "<br><br><center><a href=\"javascript:window.opener='x';window.close();\">Close Window</a></center>";
?>