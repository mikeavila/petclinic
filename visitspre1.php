q<?php
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
$subjective = $_POST["subjective"];
$client = $_POST["client"];
$petid = $_POST["petid"];
$date = date('Ymd');
$temp = $_POST["temp"];
$weight = $_POST["weight"];
$pulse = $_POST["pulse"];
$pant = $_POST["pant"];
$resp = $_POST["resp"];
$caprefill = $_POST["caprefill"];
$mucous = $_POST["mucous"];
$hydration = $_POST["hydration"];
$filename = "prePet".$petid.".txt";
$fh = fopen("./notes/".$filename, 'wbt') or die("can't open file");
fwrite($fh, "d ".$date."\n");
fwrite($fh, "t ".$temp."\n");
fwrite($fh, "w ".$weight."\n");
fwrite($fh, "p ".$pulse."\n");
fwrite($fh, "a ".$pant."\n");
fwrite($fh, "r ".$resp."\n");
fwrite($fh, "c ".$caprefill."\n");
fwrite($fh, "m ".$mucous."\n");
fwrite($fh, "h ".$hydration."\n");
fwrite($fh, "s ".$subjective);
fclose($fh);
put_errormsg("The Screening file has been created (".$filename.")";
redirect("visits.php"); 
?>