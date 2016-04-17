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
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `venom`.`reasonforvisit` ORDER BY `termname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom reasonforvisit missing");
	redirect("criticalerror.php?m=visitvproc.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom reasonforvisit");
	redirect("criticalerrort.php?m=visitvproc.inc&ec=0");
	exit();
}
echo "<tr><td width='25%' align='right'> Reason For Visit <SELECT id='reasonvisit1' name='reasonvisit1' size='10'>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
echo '<td><SELECT id="reasonvisit2" name="reasonvisit2[]" size="10" multiple="multiple"></select></td></tr>';
echo '<tr><td width="25%" align="right"><input type="button" id="addreason" value="Add >>"></td><td><input type="button" id="removereason" value="<< Remove"></td></tr>';
echo "<br><br><br>";
$sql = "SELECT * FROM `venom`.`complaint` ORDER BY `termname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom complaint missing");
	redirect("criticalerror.php?m=visitvproc.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom complaint");
	redirect("criticalerrort.php?m=visitvproc.inc&ec=0");
	exit();
}
echo "<tr><td width='25%' align='right'> Complaint <SELECT id='complaint1' name='complaint1' size='10'>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
echo '<td><SELECT id="complaint2" name="complaint2[]" size="10" multiple="multiple"></select></td></tr>';
echo '<tr><td width="25%" align="right"><input type="button" id="addcomplaint" value="Add >>"></td><td><input type="button" id="removecomplaint" value="<< Remove"></td></tr>';
echo "<br><br><br>";
$sql = "SELECT * FROM `venom`.`diagnosis` ORDER BY `termname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom diagnosis missing");
	redirect("criticalerror.php?m=visitvproc.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom diagnosis");
	redirect("criticalerrort.php?m=visitvproc.inc&ec=0");
	exit();
}
echo "<tr><td width='25%' align='right'> Diagnosis <SELECT id='diagnosis1' name='diagnosis1' size='10'>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
echo '<td><SELECT id="diagnosis2" name="diagnosis2[]" size="10" multiple="multiple"></select></td></tr>';
echo '<tr><td width="25%" align="right"><input type="button" id="adddiagnosis" value="Add >>"></td><td><input type="button" id="removediagnosis" value="<< Remove"></td></tr>';
echo "<br><br><br>";
$sql = "SELECT * FROM `venom`.`diagnostictest` ORDER BY `termname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom diagnostictest missing");
	redirect("criticalerror.php?m=visitvproc.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom diagnostictest");
	redirect("criticalerrort.php?m=visitvproc.inc&ec=0");
	exit();
}
echo "<tr><td width='25%' align='right'> Diagnostic Test <SELECT id='diagnostictest1' name='diagnostictest1' size='10'>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
echo '<td><SELECT id="diagnostictest2" name="diagnostictest2[]" size="10" multiple="multiple"></select></td></tr>';
echo '<tr><td width="25%" align="right"><input type="button" id="adddiagnostictest" value="Add >>"></td><td><input type="button" id="removediagnostictest" value="<< Remove"></td></tr>';
echo "<br><br><br>";
$mysqli->close();
?>