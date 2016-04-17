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
?>
<script type="text/javascript">
function addnumber(form) {
	numbtoadd = document.getElementById("proccode").value;
	form.action = "procmaint.php?proccode=" + numbtoadd;
	alert(form.action);
	return true;
}
</script>
<?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
$emplnumber = $_SESSION['employeenumber'];
$display = "ProcMaint:".$emplnumber;
if(isset($_GET["proccode"])) {
     $proccode = $_GET["proccode"];
} else {
     $proccode = "";
}
if ($proccode == "")
{
	echo "<center><form id='submitnumb' action='procmaint.php' method='post' onSubmit='return addnumber(this);'>";
	echo "<table width = '25%' border = '0'>";
	echo "<tr><td>Enter the Procedure Code to be edited.</td></tr>";
	echo "<tr><td><input type='text' id='proccode' name='proccode' size='10' maxlength='10' ></td></tr>";
	echo "<tr><td><input type='submit' value='Edit Requested Procedure Code' ></td></tr></table>";
	echo "</form><form action='procmaint.php?proccode=new' method='post'>";
	echo "<table width='25%'><tr><td><input type='submit' value='Create New Procedure Code'></td></tr>";
	echo "</table></form></center>";
	include "includes/display_errormsg.inc";
	include "includes/returnmaintmenu.inc";
	require_once "includes/footer.inc";
	exit();
}
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
if ($proccode <> "new")
{
	$sql = "SELECT proccode, procdesc, proctype, procstatus, changeid";
	$sql = $sql." FROM `petclinicproc`.`procedures` WHERE proccode = ".$proccode;
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Invalid Procedure Code ".$proccode." / ".$mysqli->error);
          redirect("procmaint.php");
		exit();
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Invalid Procedure Code");
          redirect("procmaint.php");
		exit();
	}
	delete_errormsg();
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$proccode=$row[0];
		$procdesc=$row[1];
		$procbillcharge=$row[2];
		$procstatus=$row[3];
		$changeid=$row[4];
     }
}
$errormsg = get_errormsg();
if ($proccode == "new")
{
	if (strlen($errormsg) < 2)
	{
		//$proccode="";
		$procdesc="";
		$procstatus="A";
		$changeid=$emplnumber;
	}
}
?>
<form id="procform" name="procform" action="procmaint1.php" method="post"><center><table border="0" cellpading="5" cellspacing="5" width="50%">
<tr><td align="right">Procedure Code</td><td><input type="text" name="proccode" size="10" maxlength="10" READONLY value="<?php echo $proccode; ?>"></td></tr>
<tr><td></td></tr>
<tr><td align="right">Procedure Description</td><td><input name="procdesc" type="text" size="25" maxlength="25" value = "<?php echo $procdesc; ?>"></td></tr>
<tr><td></td></tr>
<tr><td align="right">Type of Procedure</td>
<td><SELECT id="proctype" name="proctype" size="5">
<option value="R">Reason/Complaint for Visit</option>
<option value="D">Diagnosis</option>
<option value="T">Test</option>
<option value="P">Procedure</option>
<option value="A">Admin Tasks</option></SELECT></td></tr>
<tr><td></td></tr>
<tr><td align="right">Status A(ctive), I(nactive)</td><td><input name="procstatus" type="text" size="1" maxlength="1" value = "<?php echo $procstatus; ?>"></td></tr>
<tr><td><input type="hidden" name="emplnumber" value="<?php echo $emplnumber; ?>"></td></tr></table>
<center><input type="submit" value="Create/Modify Procedure"></center></form>
<?php
include "includes/returnmaintmenu.inc";
include "includes/display_errormsg.inc";
$mysqli->close();
require_once "includes/helpline.inc";
help("procmaint.php");
require_once "includes/footer.inc";
echo "</body></html>";
?>