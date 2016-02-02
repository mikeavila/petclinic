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
require_once "includes/errormsg_functions.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
require_once "petarraykeys.php";
$editpetnum = $_COOKIE["editpetnum"];
$errormsg=$_COOKIE["errormessage"];
if (strlen($errormsg) < 3) {
	$petname="";
	$petdob="";
	$dobm="";
	$dobd="";
	$doby="";
	$petspecies="";
	$petbreed="";
	$petgender="";
	$petfixed="";
	$petcolor="";
	$petdesc="";
	$license="";
	$microchip="";
	$rabiestag="";
	$tattoonumber="";
	$picture="N";
	$status="A";
	$changeid=$emplnumber;
	$speciescd="";
	$speciesname="";
	$client1 = "";
	$client2 = "";
} else {
	$petarray = unserialize($_COOKIE["petarray"]);
	$petname = $petarray[$pak_petname];
	$dobm = $petarray[$pak_dobm];
	$dobd = $petarray[$pak_dobd];
	$doby = $petarray[$pak_doby];
	$petspecies = $petarray[$pak_petspecies];
	$petbreed = $petarray[$pak_petbreed];
	$petbreed = $petarray[$pak_petbreed];
	$petgender = $petarray[$pak_petgender];
	$petfixed = $petarray[$pak_petfixed];
	$petcolor = $petarray[$pak_petcolor];
	$petdesc = $petarray[$pak_petdesc];
	$picture = $petarray[$pak_picture];
	$status = $petarray[$pak_status];
	$license = $petarray[$pak_license];
	$microchip = $petarray[$pak_microchip];
	$rabiestag = $petarray[$pak_rabiestag];
	$tattoonumber = $petarray[$pak_tattoonumber];
	$client1 = $petarray[$pak_client1];
	$client2 = $petarray[$pak_client2];
}
?>
<html><head>
<meta charset="utf-8">
<title>PetClinic Management Application</title>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/additional-methods.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/i18next.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="css/install.css" type="text/css">
<script>
/* petform validation goes here */
</script>
<form id="petform" name="petform" action="petmaint1a.php" method="post"></form>
<?php
require_once "petmaintform.php";
$display ="Petmaint(1n1):".$emplnumber;
require_once "includes/footer.inc";
?>