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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
require_once "includes/common.inc";
if(isset($_GET["a"])) {
	$action = $_GET["a"];
	if($action == "d") {
		unlink("temp/reg.php");
	}
}
?>
<br><br><H1>Registration</H1>
<br><br>Save this page to a PDF file and send to petclinic.email@gmail.com
<br><br>
<?php
$mysqli = new mysqli('localhost', $user, mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT * FROM `petcliniccorp`.`company`;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	put_errormsg("Cannot access petcliniccorp.company table");
} else {
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		put_errormsg("The Company Information is missing");
	} else {
		while ( $row = $result->fetch_row() ) {
			$coname = $row[0];
			$address =  mc_decrypt($row[1], ENCRYPTION_KEY);
			$city =  mc_decrypt($row[3], ENCRYPTION_KEY);
			$state = $row[5];
			$zipcode = $row[6];
			$telephone = $row[9];
		}
	}
}
$mysqli->close();
$errormsg = get_errormsg();
echo "<br><br>";
echo $coname."<br>".$address."<br>".$city."<br>".$state."<br>".$zipcode."<br>".$telephone."<br><br>";
echo "<br><br><br>";
include "includes/returnmainmenu.inc";
?>