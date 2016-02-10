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
$emplnumber = $_COOKIE['employeenumber'];
$display = "ProcMaint:".$emplnumber;
require_once "includes/expire.inc";
if(isset($_COOKIE["proccode"])) {
     $proccode = $_COOKIE["proccode"];
} else {
     $proccode = "";
}
if ($proccode == "")
{
	echo "<center><form action=\"setupomaint.php\" method=\"get\">";
	echo "<table width = \"25%\" border = \"0\">";
	echo "<tr><td>Enter the Procedure Code to be edited.</td></tr>";
	echo "<tr><td><input type=\"text\" name=\"proccode\" size=\"10\" maxlength=\"10\"></td></tr>";
	echo "<tr><td><input type=\"submit\" value=\"Edit Requested Procedure Code\"></td></tr></table>";
	echo "</form><form action=\"setupomaint.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"proccode\" value=\"new\">";
	echo "<table width=\"25%\"><tr><td><input type=\"submit\" value=\"Create New Procedure Code\"></td></tr>";
	echo "</table></form></center>";
	require_once "includes/footer.inc";
	exit();
}

$mysqli = new mysqli('localhost', $user, $password, '');
if ($proccode <> "new")
{
	require_once "password.php";
	require_once "includes/key.inc";
	require_once "includes/de.inc";
	$sql = "SELECT proccode, procdesc, procbillcharge, procstatus, changeid";
	$sql = $sql." FROM `petclinicproc`.`procedures` WHERE proccode = ".$proccode;
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Invalid Procedure Code");
          redirect("procmaint.php");          
		exit();
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Invalid Procedure Code");
          redirect("procmaint.php");          
		exit();
	}
	setcookie("errormessage", " ", $expire10hr); 
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$proccode=$row[0];
		$procdesc=$row[1];
		$procbillcharge=$row[2];
		$procstatus=$row[3];
		$changeid=$row[4];
     }
}
if ($proccode == "new")
{
	if (strlen($errormsg) < 2)
	{
		//$proccode="";
		$procdesc="";
		$procbillcharge="";
		$procstatus="";
		$changeid="";
	}
}
?>
<form id="procform" name="procform" action="procmaint1.php" method="post"><center><table border="0" cellpading="5" cellspacing="5" width="50%">";
<tr><td align="right">Procedure Code</td><td><input type="text" name="proccode" size="10" maxlength="10" READONLY value="<?php echo $proccode; ?>"></td></tr>

<tr><td align="right">Procdure Description</td><td><input name="procdesc" type="text" size="25" maxlength="25" value = "<?php echo $procdesc; ?>"></td></tr>

<tr><td align="right">Billable Amount (with 2 decimal; enter deciaml point)</td>
<td><input name="procbillcharge" type="text" size="3" maxlength="3" value = "<?php echo $procbillcharge; ?>"></td>
<td align="right">Status</td><td><input name="status" type="text" size="1" maxlength="1" value = "<?php echo $procstatus; ?>"></td></tr>

<tr><td><input type="hidden" name="emplnumber" value="<?php echo $emplnumber; ?>"></td></tr></table>

<center><input type="submit" value="Create/Modify Procedure"></center></form>";

<form action="maintmenu.php" method="post"><center><input type="submit" value="Return to Maintenance Menu"></center></form>";
<?php
include "includes/display_errormsg.inc";
$mysqli->close();
require_once "includes/helpline.inc";
help("procmaint.php");
require_once "includes/footer.inc";
echo "</body></html>";
?>
