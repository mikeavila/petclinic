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
require_once "includes/expire.inc";
if (!empty($_POST["desc"])) {
	$desc = $_POST["desc"];
} else {
     put_errormsg("The Description cannot be blank");
	header("Location:invmedbase.php");
	exit();
}
if (!empty($_POST["acctg"])) {
	$acctg = $_POST["acctg"];
} else {
	$acctg = "N";
}
if (!empty($_POST["desc"])) {
	$desc = $_POST["desc"];
} else {
	$desc = "";
}
if (!empty($_POST["purchdate"])) {
	$purchdate = $_POST["purchdate"];
} else {
	$purchdate = "";
}
if (!empty($_POST["cartoncost1"])) {
	$cartoncost1 = $_POST["cartoncost1"];
} else {
	$cartoncost1 = "";
}
if (!empty($_POST["cartoncost2"])) {
	$cartoncost2 = $_POST["cartoncost2"];
} else {
	$cartoncost2 = "";
}
if (!empty($_POST["contcost1"])) {
	$contcost1 = $_POST["contcost1"];
} else {
	$contcost1 = "";
}
if (!empty($_POST["contcost2"])) {
	$contcost2 = $_POST["contcost2"];
} else {
	$contcost2 = "";
}
if (!empty($_POST["cartonspurch"])) {
	$cartonspurch = $_POST["cartonspurch"];
} else {
	$cartonspurch = "";
}
if (!empty($_POST["contcarton"])) {
	$contcarton = $_POST["contcarton"];
} else {
     put_errormsg("The Containers Per Carton cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["itemcont"])) {
	$itemcont= $_POST["itemcont"];
} else {
     put_errormsg("The Items Per Container cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["itemcost1"])) {
	$itemcost1 = $_POST["itemcost1"];
} else {
	$itemcost1 = "";
}
if (!empty($_POST["itemcost2"])) {
	$itemcost2 = $_POST["itemcost2"];
} else {
	$itemcost2 = "";
}
if (!empty($_POST["itemreorder"])) {
	$itemreorder = $_POST["itemreorder"];
} else {
     put_errormsg("The Item Reorder Level cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["itemmarkup1"])) {
	$itemmarkup1 = $_POST["itemmarkup1"];
} else {
     put_errormsg("The Item Markup cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["itemmarkup2"])) {
	$itemmarkup2 = $_POST["itemmarkup2"];
} else {
     put_errormsg( "The Item Markup cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["contmarkup1"])) {
	$contmarkup1 = $_POST["contmarkup1"];
} else {
     put_errormsg("The Container Markup cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["contmarkup2"])) {
	$contmarkup2 = $_POST["contmarkup2"];
} else {
     put_errormsg("The Container Markup cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if (!empty($_POST["itemsales1"])) {
	$itemsales1 = $_POST["itemsales1"];
} else {
	$itemsales1 = "";
}
if (!empty($_POST["itemsales2"])) {
	$itemsales2 = $_POST["itemsales2"];
} else {
	$itemsalest2 = "";
}
if (!empty($_POST["contsales1"])) {
	$contsales1 = $_POST["contsales1"];
} else {
	$contsales1 = "";
}
if (!empty($_POST["contsales2"])) {
	$contsales2 = $_POST["contsales2"];
} else {
	$contsales2 = "";
}
if (!empty($_POST["taxable"])) {
	$taxable = $_POST["taxable"];
} else {
     put_errormsg("If the Item is Taxable cannot be blank");
     redirect("invmedbase.php");
	exit();
}
if(isset($_POST['wherebought']))
{
     $listbox = $_POST['wherebought'];
} else {
     put_errormsg("A Vendor must be selected for where bought");
     redirect("invmedbase.php");
	exit();
}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "USE vetclinicinv;";
if ($mysqli->query($sql) == TRUE) {

} else {
     put_errormsg("Error selecting to use vetclinicinv" . $mysqli->error);
     redirect("criticalerror.php?m=invmedbase1.php&ec=0");
	exit(1);
}
$cartoncost = $cartoncost1.".".$cartoncost2;
$contcost = $contcost1.".".$contcost2;
$cartoncost = $cartoncost1.".".$cartoncost2;
$itemcost = $itemcost1.".".$itemcost2;
$itemmarkup = $itemmarkup1.".".$itemmarkup2;
$contmarkup = $contmarkup1.".".$contmarkup2;
$itemsales = $itemsales1.".".$itemsales2;
$contsales = $contsales1.".".$contsales2;
$emplnumber = $_COOKIE["employeenumber"];
$quesmark = strpos(wherebought, "?");
$vendorid = substr($wherebought, 0, $quesmark - 1);
$wherebought = substr($wherebought, $quesmark + 1);
$sql = "INSERT INTO `invmedicine` (`meddesc`, `vendorid`, `wherebought`, `purdate`, `cartoncost`,  `cartonspurch`, `containercarton`, ";
$sql = $sql."`itemscontainer`, `itemcost`, `containercost`, `itemreorderlevel`, `itemmarkup`, `containermarkup`, `itemsalesprice`, ";
$sql = $sql."`containersalesprice`, `taxable`, `status`, `changeid`) ";
$sql = $sql." VALUES('$desc', '$vendorid', '$wherebought', '$purchdate', '$cartoncost', '$cartonspurch', '$contcarton', ";
$sql = $sql."'$itemcont', '$itemcost', '$contcost', '$itemreorder', '$itemmarkup', '$contmarkup', '$itemsales', ";
$sql = $sql."'$contsales', '$taxable', 'A', $emplnumber;";
if ($mysqli->query($sql) === TRUE) {

} else {
     put_error("Table invmedicine data insertion failed" . $mysqli->error);
     redirect("invmedbase.php");
	exit(1);
}
$mysqli->close();
delete_errormsg();
redirect("invmedbase.php");
?>