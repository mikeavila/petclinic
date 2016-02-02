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
require_once "../includes/version.inc";
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once "../includes/logfileinit.inc";
$log->logThis("f:nl");
$log->logThis("Install1 started");
?>
<script>
document.write("Starting the installation of databases and tables");
</script> 
<?php
$coname=$_POST["coname"];
$addr=$_POST["addr"];
if(isset($_POST["addr2"])) {
     $addr2=$_POST["addr2"];
} else {
     $addr2 = ""; 
}
$city=$_POST["city"];
$state=$_POST["state"];
$zip=$_POST["zip"];
$htele=$_POST["htele"];
if(isset($_POST["ftele"])) {
       $ftele=$_POST["ftele"];
} else {
     $ftele = ""; 
}
if(isset($_POST["logo"])) {
       $logo=$_POST["logo"];
} else {
     $logo = ""; 
}
if(isset($_POST["lic"])) {
       $lic=$_POST["lic"];
} else {
     $lic = ""; 
}
$tax=$_POST["tax"];
$weight=$_POST["weight"];
$temp=$_POST["temp"];
require_once "password.txt";
$mysqli = new mysqli('localhost', $user, $password, '');
$log->logThis("Encrypting company information");
require_once "../includes/key.inc";
require_once "../includes/en.inc";
$hashaddress = mc_encrypt($addr, ENCRYPTION_KEY);
if (strlen($addr2) > 0) {
	$hashaddress2 = mc_encrypt($addr2, ENCRYPTION_KEY);
} else {
	$hashaddress2 = "";
}
$hashcity = mc_encrypt($city, ENCRYPTION_KEY);
$sql = "INSERT INTO `petcliniccorp`.`company` (`name`, `address`, `address2`, `city`, `state`, `zipcode`, `telephone`, `fax`,
                               `logo`, `businesslic`, `statetax`, `weight`, `temp`, `lang`, `changeid`) 
  VALUES (\"$coname\", \"$hashaddress\", \"$hashaddress2\", \"$hashcity\", \"$state\", \"$zip\", \"$htele\",
          \"$ftele\", \"$logo\", \"$lic\", \"$tax\", \"$weight\", \"$temp\", \"USE\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("Company table insertion successful");
} else {
     $log->logThis("Error inserting into company table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Table company data insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("Install1 completed");
$mysqli->close();