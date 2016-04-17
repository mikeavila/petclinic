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
$headerTitle = "User";
include "common.inc";
$feature = $_SESSION["SF"];
//$mysqlir = new mysqli('localhost', mc_decrypt($_SESSION["su"], ss_key), mc_decrypt($_SESSION["sp"], sx_key), '');
$mysqlir = new mysqli('localhost', 'superman', 'pcsman<99>!', '');
$sql = "SELECT `name` from `petcliniccorp`.`company`;";
$resultr = $mysqlir->query($sql);
if ($resultr === FALSE) {
	$mysqlir->close();
	put_errormsg("Internal error - Company Record not available");
	$_SESSION["SF"] = "xx";
}
$row = $resultr->fetch_row();
$coname = $row[0];
$sql = "SELECT * FROM `petclinicreg`.`registration`";
if ($mysqlir->query($sql) === FALSE) {
	$mysqlir->close();
	put_errormsg("This software is not Registered");
	$_SESSION["SF"] = "xx";
} else {
	$resultr = $mysqlir->query($sql);
	$row_cnt_r = $resultr->num_rows;
	if ($row_cnt_r === 0) {
		$mysqlir->close();
		put_errormsg("This software is not Registered");
		$_SESSION["SF"] = "xx";
	} else {
		$row = $resultr->fetch_row();
		$regnumber = $row[0];
		$regcode = $row[1];
		$regverifier = $row[2];
		$regkey = $row[3];
		$regverifier2 = mc_encrypt($regnumber.$coname, ps_key);
		echo "#".$regnumber."; ".$coname." <br>1=".$regverifier."; <br>2=".$regverifier2;
		echo "<br>z2=".mc_decrypt($regnumber.$coname, ps_key);
		if($regverifier != $regverifier2) {
			$mysqlir->close();
			put_errormsg("This software validation is corrupted or tampered with (regverifier)");
			$_SESSION["SF"] = "xx";
		} else {
			$regkey2 = crypt("0".$regnumber.$regnumber."9", $regkey);
			if($regkey != $regkey2) {
				$mysqlir->close();
				put_errormsg("This softwre validation is corrupted or tampered with (regkey)");
				$_SESSION["SF"] = "xx";
			} else {
				$sql = "SELECT `* FROM `petclinicreg`.`featurereg` WHERE `featurecode` = '".$_SESSION["SF"]."';";
				if ($mysqlir->query($sql) === FALSE) {
					$mysqlir->close();
					put_errormsg("This software Feature is not Registered");
					$_SESSION["SF"] = "xx";
				} else {



				}
			$mysqlir->close();
			$_SESSION["SF"] = "in";
			}
		}
	}
}
?>