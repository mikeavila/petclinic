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
require_once "includes/key.inc";
require_once "includes/de.inc";
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petclinic`.`visit` ORDER BY `visitdate` DESC";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("There are no Previous Visits");
     redirect("visits.php");      
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("There are no Previous Visits");
     redirect("visits.php"); 
	exit();
}
echo "<table border=\"0\" width=\"90%\">";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	$sqlcp = "SELECT * FROM `petclinic`.`clientpet` WHERE `petnumber` = ".$row[2].";";
	$resultcp = $mysqli->query($sqlcp);
	if ($resultcp == FALSE)
	{
          put_errormsg("Internal Error (clientpet)");
          redirect("visits.php"); 
		exit();
	}
	$rowcp_cnt = $resultcp->num_rows;
	if ($rowcp_cnt == 0) {
          put_errormsg("Internal Error (clientpet)";
          redirect("visits.php");           
		exit();
	}
	$rowcp = $resultcp->fetch_row();
	$sqlc = "SELECT * FROM `petclinic`.`client` WHERE `clientnumber` = ".$rowcp[0].";";
	$resultc = $mysqli->query($sqlc);
	if ($resultc == FALSE)
	{
          put_errormsg("Internal Error (clientpet)";
          redirect("visits.php"); 
		exit();
	}
	$rowc = $resultc->fetch_row();
	for ($i = 0; $i < $row_cnt; $i++) {
		$row1 = "Client # ".$rowc[0]." ";
		$address1 = mc_decrypt($rowc[6], ENCRYPTION_KEY);
		$row1 = $row1.$rowc[1].", ".$rowc[3]." lives at ".$address1." ";
		if ($rowc[7] <> "")
		{
			$address2 = mc_decrypt($rowc[7], ENCRYPTION_KEY);
			$row1 = $row1.$address2." ";
		}
		$city = mc_decrypt($rowc[8], ENCRYPTION_KEY);
		$row1 = $row1.", ".$city.", ".$rowc[9]." ".$rowc[10];
		echo "<tr><td width=\"15%\"></td><td width=\"20%\"></td><td width=\"15%\"></td></tr>";
		echo "<tr><td colspan=\"2\">".$row1."</td></tr>";
	}
	$sqlp = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$rowcp[1].";";
	$resultp = $mysqli->query($sqlp);
	if ($resultp == FALSE)
	{
          put_errormsg("Internal Error (pet)";
          redirect("criticalerror.php?m=visitprev.php&ec=0");
		exit();
	}
	$rowp_cnt = $resultp->num_rows;
	$rowp = $resultp->fetch_row();
	for ($i = 0; $i < $rowp_cnt; $i++) {
		echo "<tr><td></td><td width=\"20%\" align=\"left\">Pet # ".$rowp[0]." named ".$rowp[1]."</td></tr>";
		$sqlv = "SELECT * FROM `petclinic`.`visit` WHERE `petnumber` = ".$rowp[0].";";
		$resultv = $mysqli->query($sqlv);
		if ($resultv == FALSE)
		{
               put_errormsg("Internal Error (visit)";
               redirect("visits.php");                
			exit();
		}
		$rowv_cnt = $resultv->num_rows;
		$rowv = $resultv->fetch_row();
		for ($i = 0; $i < $rowv_cnt; $i++) {
			echo "<tr><td></td><td>Visit Date <a href=\"visitsprev1.php?visit=".$rowv[0]."\">".$rowv[1]."</td></tr>";
		}
	}
	/*****************************************************************/
	echo "<tr><td colspan=\"3\"><hr size=\"2px\" border=\"0\" NO SHADE align=\"center\" color=\"black\"></td></tr>";
}
echo "</table>";
$mysqli->close();
echo "<form method=\"post\" action=\"visits.php\"><center><input type=\"submit\" value=\"Return to Visits Menu\"></center></form>";
?>