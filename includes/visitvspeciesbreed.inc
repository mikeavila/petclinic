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
$sql = "SELECT * FROM `venom`.`species` ORDER BY `termname`;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - Venom Species missing");
	redirect("criticalerror.php?m=visitvspeciesbreed.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
    put_errormsg("Internal error - No VeNom Species");
    redirect("criticalerrort.php?m=visitvspeciesbreed.inc&ec=0");
	exit();
	}
echo "<tr><td width='25%' align='right'> Species <SELECT id='species' name='species' size='10'>";
echo "<OPTION value=0>Use Pet Profile Default</OPTION>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT></td>";
$sql = "SELECT * FROM `venom`.`breed` ORDER BY `termname`;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Internal error - VeNom Breeds missing");
	redirect("criticalerror.php?m=visitvspeciesbreed.inc&ec=-0");
	exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
	put_errormsg("Internal error - No VeNom Breeds");
	redirect("criticalerrort.php?m=visitspeciesbreed.inc&ec=0");
	exit();
}
echo "<td width='25%' align='right'> Breed <SELECT id='breeds' name='breeds' size='10'>";
echo "<OPTION value=0>Use Pet Profile Default</OPTION>";
for ($i = 0; $i < $row_cnt; $i++) {
	$row = $result->fetch_row();
	echo "<OPTION value=$row[2]>$row[3]</OPTION>";
}
echo "</SELECT>";
echo "<td></select></td></tr>";
$mysqli->close();
?>