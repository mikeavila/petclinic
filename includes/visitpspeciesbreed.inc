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
echo "<br><br>Species is a ";
$mysqlip = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$petid.";";
if ($mysqlip->query($sql) == TRUE) {
} else {
	echo "Error selecting company data" . $mysqlip->error;
	exit(1);
}
$resultp = $mysqlip->query($sql);
$row = $resultp->fetch_row();
switch ($row[4]) {
	case "F":
		echo "female ";
		break;
	case "M":
		echo "male ";
	default:
		echo "unknown ";
		break;
}
$listname = $row[1];
$listspecies = substr($row[3], 0,1);
$listbreed = substr($row[3], 1);
$sql = "SELECT `speciesdesc` FROM `petclinic`.`code_species` WHERE `speciescode` = '".$listspecies."';";
$resultp = $mysqlip->query($sql);
$row = $resultp->fetch_row();
echo " ".$row[0]." ";
$sql = "SELECT `breeddesc` FROM `petclinic`.`code_breed` WHERE `speciescode` = '".$listspecies."' and `breedcode` = '".$listbreed."';";
$resultp = $mysqlip->query($sql);
$row = $resultp->fetch_row();
echo $row[0]." named ".$listname;
?>