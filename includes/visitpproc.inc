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
$sql = "SELECT * FROM `petclinicproc`.`procedures` WHERE `procstatus` = 'A' and `proctype` = 'R' ORDER BY `procdesc`";
$result = $mysqli->query($sql);
if ($result == TRUE)
{
	$row_cnt = $result->num_rows;
	if ($row_cnt > 0) {
		echo "<tr><td width='25%' align='right'> Reason For Visit <SELECT id='reasonvisit1' name='reasonvisit1' size='10'>";
		for ($i = 0; $i < $row_cnt; $i++) {
			$row = $result->fetch_row();
			echo "<OPTION value=$row[0]>$row[1]</OPTION>";
		}
		echo "</SELECT></td>";
		echo '<td><SELECT id="reasonvisit2" name="reasonvisit2[]" size="10" multiple="multiple"></select></td></tr>';
		echo '<tr><td width="25%" align="right"><input type="button" id="addreason" value="Add >>"></td><td><input type="button" id="removereason" value="<< Remove"></td></tr>';
		echo "<br><br><br>";
	}
}
$sql = "SELECT * FROM `petclinicproc`.`procedures` WHERE `procstatus` = 'A' and `proctype` = 'T' ORDER BY `procdesc`";
$result = $mysqli->query($sql);
if ($result == TRUE)
{
	$row_cnt = $result->num_rows;
	if ($row_cnt > 0) {
		echo "<tr><td width='25%' align='right'> Tests <SELECT id='tests1' name='tests1' size='10'>";
		for ($i = 0; $i < $row_cnt; $i++) {
			$row = $result->fetch_row();
			echo "<OPTION value=$row[0]>$row[1]</OPTION>";
		}
		echo "</SELECT></td>";
		echo '<td><SELECT id="tests2" name="tests2[]" size="10" multiple="multiple"></select></td></tr>';
		echo '<tr><td width="25%" align="right"><input type="button" id="addtest" value="Add >>"></td><td><input type="button" id="removetest" value="<< Remove"></td></tr>';
		echo "<br><br><br>";
	}
}
$sql = "SELECT * FROM `petclinicproc`.`procedures` WHERE `procstatus` = 'A' and `proctype` = 'D' ORDER BY `procdesc`";
$result = $mysqli->query($sql);
if ($result == TRUE)
{
	$row_cnt = $result->num_rows;
	if ($row_cnt > 0) {
		echo "<tr><td width='25%' align='right'> Diagnosis <SELECT id='diagnosis1' name='diagnosis1' size='10'>";
		for ($i = 0; $i < $row_cnt; $i++) {
			$row = $result->fetch_row();
			echo "<OPTION value=$row[0]>$row[1]</OPTION>";
		}
		echo "</SELECT></td>";
		echo '<td><SELECT id="diagnosis2" name="diagnosis2[]" size="10" multiple="multiple"></select></td></tr>';
		echo '<tr><td width="25%" align="right"><input type="button" id="adddiagnosis" value="Add >>"></td><td><input type="button" id="removediagnosis" value="<< Remove"></td></tr>';
		echo "<br><br><br>";
	}
}
$sql = "SELECT * FROM `petclinicproc`.`procedures` WHERE `procstatus` = 'A' and `proctype` = 'P' ORDER BY `procdesc`";
$result = $mysqli->query($sql);
if ($result == TRUE)
{
	$row_cnt = $result->num_rows;
	if ($row_cnt > 0) {
		echo "<tr><td width='25%' align='right'> Procedures <SELECT id='procedures1' name='procedures1' size='10'>";
		for ($i = 0; $i < $row_cnt; $i++) {
			$row = $result->fetch_row();
			echo "<OPTION value=$row[0]>$row[1]</OPTION>";
		}
		echo "</SELECT></td>";
		echo '<td><SELECT id="procedures2" name="procedures2[]" size="10" multiple="multiple"></select></td></tr>';
		echo '<tr><td width="25%" align="right"><input type="button" id="addproc" value="Add >>"></td><td><input type="button" id="removeproc" value="<< Remove"></td></tr>';
		echo "<br><br><br>";
	}
}
?>