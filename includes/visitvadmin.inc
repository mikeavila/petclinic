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
$sql = "SELECT * FROM `venom`.`admintasks` ORDER BY `termname`";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom admintasks missing");
	redirect("criticalerror.php?m=visitvadmin.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom admintasks");
	redirect("criticalerrort.php?m=visitvadmin.inc&ec=0");
	exit();
}
echo "<tr><td width='25%' align='right'> Admin Tasks <SELECT id='admintasks1' name='admintasks1' size='10'>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
echo '<td><SELECT id="admintasks2" name="admintasks2[]" size="10" multiple="multiple"></select></td></tr>';
echo '<tr><td width="25%" align="right"><input type="button" id="addadmin" value="Add >>"></td><td><input type="button" id="removeadmin" value="<< Remove"></td></tr>';
echo "<br><br><br>";
?>