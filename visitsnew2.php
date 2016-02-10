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
if (!empty($_POST["date"])) {
	$date = $_POST["date"];
} else {
	$date = "";
}
if (!empty($_POST["temp"])) {
	$temp = $_POST["temp"];
} else {
	$temp = "";
}
if (!empty($_POST["weight"])) {
	$weight = $_POST["weight"];
} else {
	$weight = "";
}
if (!empty($_POST["pulse"])) {
	$pulse = $_POST["pulse"];
} else {
	$pulse = "";
}
if (!empty($_POST["resp"])) {
	$resp = $_POST["resp"];
} else {
	$resp = "";
}
if (!empty($_POST["pant"])) {
	$pant = $_POST["pant"];
} else {
	$pant = "";
}
if (!empty($_POST["caprefill"])) {
	$caprefill = $_POST["caprefill"];
} else {
	$caprefill = "";
}
if (!empty($_POST["mucous"])) {
	$mucous = $_POST["mucous"];
} else {
	$mucous = "";
}
if (!empty($_POST["hydration"])) {
	$hydration = $_POST["hydration"];
} else {
	$hydration = "";
}
if (!empty($_POST["stay"])) {
	$stay = $_POST["stay"];
} else {
	$stay = "";
}
if (!empty($_POST["discharge"])) {
	$discharge = $_POST["discharge"];
} else {
	$discharge = "";
}
if (!empty($_POST["appear"])) {
	$appear = $_POST["appear"];
} else {
	$appear = "";
}
if (!empty($_POST["abnappear"])) {
	$abnappear = $_POST["abnappear"];
} else {
	$abnappear = "";
}
if (!empty($_POST["integument"])) {
	$integument = $_POST["integument"];
} else {
	$integument = "";
}
if (!empty($_POST["abninteg"])) {
	$abninteg = $_POST["abninteg"];
} else {
	$abninteg = "";
}
if (!empty($_POST["eyes"])) {
	$eyes = $_POST["eyes"];
} else {
	$eyes = "";
}
if (!empty($_POST["abneyes"])) {
	$abneyes = $_POST["abneyes"];
} else {
	$abneyes = "";
}
if (!empty($_POST["ears"])) {
	$ears = $_POST["ears"];
} else {
	$ears = "";
}
if (!empty($_POST["abnears"])) {
	$abnears = $_POST["abnears"];
} else {
	$abnears = "";
}
if (!empty($_POST["dental"])) {
	$dental = $_POST["dental"];
} else {
	$dental = "";
}
if (!empty($_POST["abndental"])) {
	$abndental = $_POST["abndental"];
} else {
	$abndental = "";
}
if (!empty($_POST["digestive"])) {
	$digestive = $_POST["digestive"];
} else {
	$digestive = "";
}
if (!empty($_POST["abndigestive"])) {
	$abndigestive = $_POST["abndigestive"];
} else {
	$abndigestive = "";
}
if (!empty($_POST["genitour"])) {
	$genitour = $_POST["genitour"];
} else {
	$genitour = "";
}
if (!empty($_POST["abngenitour"])) {
	$abngenitour = $_POST["abngenitour"];
} else {
	$abngenitour = "";
}
if (!empty($_POST["lymph"])) {
	$lymph = $_POST["lymph"];
} else {
	$lymph = "";
}
if (!empty($_POST["abnlymph"])) {
	$abnlymph = $_POST["abnlymph"];
} else {
	$abnlymph = "";
}
if (!empty($_POST["cardio"])) {
	$cardio = $_POST["cardio"];
} else {
	$cardio = "";
}
if (!empty($_POST["abncardio"])) {
	$abncardio = $_POST["abncardio"];
} else {
	$abncardio = "";
}
if (!empty($_POST["respir"])) {
	$respir = $_POST["respir"];
} else {
	$respir = "";
}
if (!empty($_POST["abnrespir"])) {
	$abnrespir = $_POST["abnrespir"];
} else {
	$abnrespir = "";
}
if (!empty($_POST["neurologic"])) {
	$neurologic = $_POST["neurologic"];
} else {
	$neurologic = "";
}
if (!empty($_POST["abnneuro"])) {
	$abnneuro = $_POST["abnneuro"];
} else {
	$abnneuro = "";
}
if (!empty($_POST["mskel"])) {
	$mskel = $_POST["mskel"];
} else {
	$mskel = "";
}
if (!empty($_POST["abnmskel"])) {
	$abnmskel = $_POST["abnmskel"];
} else {
	$abnmskel = "";
}
if (!empty($_POST["subjective"])) {
	$subjective = $_POST["subjective"];
} else {
	$subjective = "";
}
if (!empty($_POST["objective"])) {
	$objective = $_POST["objective"];
} else {
	$objective = "";
}
if (!empty($_POST["assessment"])) {
	$assessment = $_POST["assessment"];
} else {
	$assessment = "";
}
if (!empty($_POST["plan"])) {
	$plan = $_POST["plan"];
} else {
	$plan = "";
}
if (!empty($_POST["save"])) {
	$save = $_POST["save"];
} else {
	$save = "";
}
if (!empty($_POST["prefilename"])) {
	$prefilename = $_POST["prefilename"];
} else {
	$prefilename = "";
}
if (!empty($_POST["petid"])) {
	$petid = $_POST["petid"];
} else {
	$petid = "";
}
if (!empty($_POST["client"])) {
	$client = $_POST["client"];
} else {
	$client = "";
}
require_once "includes/expire.inc";
require_once "visitarraykeys.php";
$visitarray = array_fill(0, 40, "");
$visitarray[$vak_date] = $date;
$visitarray[$vak_temp] = $temp;
$visitarray[$vak_weight] = $weight;
$visitarray[$vak_pulse] = $pulse;
$visitarray[$vak_resp] = $resp;
$visitarray[$vak_pant] = $pant;
$visitarray[$vak_caprefill] = $caprefill;
$visitarray[$vak_mucous] = $mucous;
$visitarray[$vak_hydration] = $hydration;
$visitarray[$vak_stay] = $stay;
$visitarray[$vak_discharge] = $discharge;
$visitarray[$vak_appear] = $appear;
$visitarray[$vak_abnappear] = $abnappear;
$visitarray[$vak_inegument] = $integument;
$visitarray[$vak_abninteg] = $abninteg;
$visitarray[$vak_eyes] = $eyes;
$visitarray[$vak_abneyes] = $abneyes;
$visitarray[$vak_ears] = $ears;
$visitarray[$vak_abnears] = $abnears;
$visitarray[$vak_dental] = $dental;
$visitarray[$vak_abndental] = $abndental;
$visitarray[$vak_digestive] = $digestive;
$visitarray[$vak_abndigestive] = $abndigestive;
$visitarray[$vak_genitour] = $genitour;
$visitarray[$vak_abngenitour] = $abngenitour;
$visitarray[$vak_lymph] = $lymph;
$visitarray[$vak_abnlymph] = $abnlymph;
$visitarray[$vak_cardio] = $cardio;
$visitarray[$vak_abncardio] = $abncardio;
$visitarray[$vak_respir] = $respir;
$visitarray[$vak_abnrespir] = $abnrespir;
$visitarray[$vak_neurologic] = $neurologic;
$visitarray[$vak_abnneuro] = $abnneuro;
$visitarray[$vak_mskel] = $mskel;
$visitarray[$vak_abnmskel] = $abnmskel;
$visitarray[$vak_subjective] = $subjective;
$visitarray[$vak_objective] = $objective;
$visitarray[$vak_assessment] = $assessment;
$visitarray[$vak_plan] = $plan;
$visitserialarray = serialize($visitarray);
setcookie("visitarray", $visitserialarray, $expire1hr);
if (strlen($date) <> 8) {
     put_errormsg("The Date must be entered";
     redirect("visitsnew1.php"); 
	exit();
}
if ($save == "draft") {
	$filename = "draftPet".$petid.".txt";
	$fh = fopen("./notes/".$filename, "wbt");
	fwrite($fh, $visitserialarray."\n");
	fclose($fh);
	if ($prefilename <> "") {
		unlink("./notes/".$prefilename);
	}
     put_errormsg("The Draft file has been created (".$filename.")");
     redirect("visits.php"); 
	exit();
}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$emplnumber = $_COOKIE["employeenumber"];
$sql = "INSERT INTO `petclinic`.`visit` (`visitdate`, `petnumber`, `temp`, `weight`, `pulse`, `respiration`, `panting`, `caprefill`, `mucous`, `hydration`, ";
$sql = $sql."`clinicalstay`, `clinicaldischarge`, `changeid`) ";
$sql = $sql."VALUES (\"".$date."\", \"".$petid."\", \"".$temp."\", \"".$weight."\", \"".$pulse."\", \"".$resp."\", \"".$pant."\", \"".$caprefill."\", ";
$sql = $sql."\"".$mucous."\", \"".$hydration."\", \"".$stay."\", \"".$discharge."\", ".$emplnumber.");";
if ($mysqli->query($sql) === TRUE) {

} else {
	echo "Table visit data insertion failed" . $mysqli->error;
	exit(1);
}
$filename = "prePet".$petid.".txt";
if (file_exists("./notes/".$filename)) {
	unlink("./notes/".$filename);
}
$filename = "draftPet".$petid.".txt";
if (file_exists("./notes/".$filename)) {
	unlink("./notes/".$filename);
}
$sql = "SELECT * FROM `petcliniccorp`.`company`;";
if ($mysqli->query($sql) == TRUE) {
} else {
	echo "Error selecting company data" . $mysqli->error;
	exit(1);
}
$result = $mysqli->query($sql);
$row = $result->fetch_row();
require_once "includes/key.inc";
require_once "includes/de.inc";
$coname = $row[0];
$address1 = mc_decrypt($row[1], ENCRYPTION_KEY);
if ($row[2] <> "") {
	$address2 = mc_decrypt($row[2], ENCRYPTION_KEY);
} else {
	$address2 = "";
}
$city = mc_decrypt($row[3], ENCRYPTION_KEY);
$state = $row[4];
$zipcode = $row[5];
$fulladdress = $address1;
if ($address2 <> "") {
	$fulladdress = $fulladdress.", ".$address2;
}
$fulladdress = $fulladdress.",  ".$city.", ".$state."  ".$zipcode;
$telephone = "(".substr($row[6], 0, 3).") ".substr($row[6], 3,3)."-".substr($row[6], 6);
$sql = "SELECT * FROM `petclinic`.`client` WHERE `clientnumber` = ".$client.";";
if ($mysqli->query($sql) == TRUE) {
} else {
	echo "Error get client information" . $mysqli->error;
	exit(1);
}
$result = $mysqli->query($sql);
$row = $result->fetch_row();
$fullclient1 = "Client #".$client." ".$row[3]." ".$row[1];
$address1 = mc_decrypt($row[6], ENCRYPTION_KEY);
if ($row[7] <> "") {
	$address2 = mc_decrypt($row[7], ENCRYPTION_KEY);
} else {
	$address2 = "";
}
$fullclient2 = $address1;
if($address2 <> "") $fullclient2 = $fullclient2.",  ".$address2.", ";
$fullclient3 = $city.", ".$state." ".$zipcode;
$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$petid.";";
$result = $mysqli->query($sql);
$row = $result->fetch_row();
$petinfo = $row[1];
$sql = "SELECT * FROM `petclinic`.`code_species` WHERE `speciescode` = \"".$row[3]."\";";
if ($mysqli->query($sql) == TRUE) {
} else {
	echo "Error get species information" . $mysqli->error;
	exit(1);
}
$resultx = $mysqli->query($sql);
$rowx = $resultx->fetch_row();
$speciesdesc = $rowx[1];
$gender = $row[5];
If ($gender == "M") $gender = "male";
If ($gender == "F") $gender = "female";
$mysqli->close();
$date = substr($date, 0, 4)."/".substr($date, 4,2)."/".substr($date,6);
/*
$filename = "./notes/visit".$petid.".txt";
$fh = fopen($filename, 'wbt');
fwrite($fh, $coname."\n");
fwrite($fh, $fulladdress."\n");
fwrite($fh, $telephone."\n");
fwrite($fh, "\n\n");
fwrite($fh, $fullclient1."\n");
fwrite($fh, $fullclient2."\n");
fwrite($fh, $fullclient3."\n");
fwrite($fh, "\n\n");
fwrite($fh, "Pet ID # ".$petid." A ".$gender." ".$speciesdesc." named ".$petinfo."\n");
fwrite($fh, "Date of Visit: ".$date."  \n");
fwrite($fh, "Temperature was ".$temp."   Weight was ".$weight."   Pulse was ".$pulse."\n");
fclose($fh);
*/
$filename = "./notes/visit".$petid.".pdf";
require_once './fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(10,10,10);
$pdf->SetFont('Courier','B',16);
$pdf->Cell(0,5,$coname,0,1,"C");
$pdf->SetFont('Courier','B',14);
$pdf->Cell(0,5,$fulladdress,0,1,"C");
$pdf->Cell(0,5,$telephone,0,1,"C");
$pdf->Ln(5);
$pdf->Ln(5);
$pdf->SetFont('Courier','',12);
$pdf->Cell(0,5,$fullclient1,0,1,"L");
$pdf->Cell(0,5,$fullclient2,0,1,"L");
$pdf->Cell(0,5,$fullclient3,0,1,"L");
$pdf->Ln(5);
$pdf->Ln(5);
$pdf->Cell(0,5,"Pet ID # ".$petid." A ".$gender." ".$speciesdesc." named ".$petinfo,0,1,"L");
$pdf->Cell(0,5,"Date of Visit: ".$date,0,1,"L");
$pdf->SetFont('Courier','',8);
$pdf->Cell(0,5, "Temperature was ".$temp."   Weight was ".$weight."   Pulse was ".$pulse."  Respiration was ".$resp,0,1,"L");
$pdf->Cell(0,5, "Capularry Refill Was ".$caprefill."  Mucous was ".$mucous."  Hydration was ".$hydration,0,1,"L");
$pdf->Cell(0,5, "Appearance: ".$appear." Notes: ".$abnappear,0,1,"L");
$pdf->Cell(0,5, "Integument: ".$integument." Notes: ".$abninteg,0,1,"L");
$pdf->Cell(0,5, "Eyes: ".$eyes." Notes: ".$abneyes,0,1,"L");
$pdf->Cell(0,5, "Ears: ".$ears." Notes: ".$abnears,0,1,"L");
$pdf->Cell(0,5, "Dental: ".$dental." Notes: ".$abndental,0,1,"L");
$pdf->Cell(0,5, "Digestive: ".$digestive." Notes: ".$abndigestive,0,1,"L");
$pdf->Cell(0,5, "Genitour: ".$genitour." Notes: ".$abngenitour,0,1,"L");
$pdf->Cell(0,5, "Lymph: ".$lymph." Notes: ".$abnlymph,0,1,"L");
$pdf->Cell(0,5, "Cardiovascular: ".$cardio." Notes: ".$abncardio,0,1,"L");
$pdf->Cell(0,5, "Respiration: ".$respir." Notes: ".$abnrespir,0,1,"L");
$pdf->Cell(0,5, "Neurologic: ".$neurologic." Notes: ".$abnneuro,0,1,"L");
$pdf->Cell(0,5, "Musculoskeletal: ".$mskel." Notes: ".$abnmskel,0,1,"L");
$pdf->Cell(0,5, "Was Pet Recommended to Stay in the Clinic? ".$stay."  Was this a Discharge Visit? ".$discharge,0,1,"L");
$pdf->Ln(5);
$pdf->Cell(0,5, "SOAP Notes",0,1,"C");
$pdf->Cell(0,5, "Subjective Notes",0,1,"L");
$pdf->Cell(0,5, $subjective,0,1,"L");
$pdf->Ln(5);
$pdf->Cell(0,5, "Objective Notes",0,1,"L");
$pdf->Cell(0,5, $objective,0,1,"L");
$pdf->Ln(5);
$pdf->Cell(0,5, "Assessment Notes",0,1,"L");
$pdf->Cell(0,5, $assessment,0,1,"L");
$pdf->Ln(5);
$pdf->Cell(0,5, "Plan Notes",0,1,"L");
$pdf->Cell(0,5, $plan,0,1,"L");
$pdf->Ln(5);
$pdf->Output($filename, "F");
delete_errormsg();
redirect("visits.php"); 
?>