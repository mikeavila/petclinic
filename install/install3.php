<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
if (isset($_POST["computer"])) {
     $computer=$_POST["computer"];
} else {
     $computer = "";
}
if (isset($_POST["email"])) {
     $email=$_POST["email"];
} else {
     $email = "";
}
if (isset($_POST["domain"])) {
     $domain=$_POST["domain"];
} else {
     $domain = "";
}
require_once "password.txt";
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("Install3 started");
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`) 
  VALUES (1, \"$email\", \"$domain\", \"$computer\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data1 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 1 insertion successful");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
	VALUES (2, \"bg.DesertSand.png\", \"bg.LightSkyBlue.png\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data2 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 2 insertion successful");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
  VALUES (3, \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data3 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 3 insertion successful");
$file_handle = fopen("procdb.tmp", "rt");
$pref1 = fread ($file_handle, 5);
fclose($file_handle);
unlink ("procdb.tmp");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
  VALUES (4, \"$pref1\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data2 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 4 insertion successful");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
  VALUES (5, \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data2 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 5 insertion successful");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
  VALUES (6, \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data2 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 6 insertion successful");
$sql = "INSERT INTO `petcliniccorp`.`preferences` (`sequence`, `pref1`, `pref2`, `pref3`, `pref4`, `pref5`, `pref6`, `pref7`, `pref8`,
	`pref9`, `pref10`, `changeid`)
  VALUES (7, \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"\", \"0000\");";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Table preferences data2 insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("preferences 7 insertion successful");
$sql = "drop user 'pcmsuser'@'localhost';";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Drop User failed" . $mysqli->error;
}
$sql = "CREATE USER 'pcmsuser'@'localhost' IDENTIFIED BY 'pcmspwd';";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Create User failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicsys.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (1) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinic.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (1) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, Delete ON petcliniclang.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (2) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicproc.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (3) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicinv.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (4) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicappt.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (5) failed" . $mysqli->error;
	exit(1);
}
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petcliniccorp.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (5) failed" . $mysqli->error;
	exit(1);
}
$log->logThis("granting user privileges successful");
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicinvoices.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (5) failed" . $mysqli->error;
	exit(1);
}
$log->logThis("granting user privileges successful");
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON snomedvts.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (6) failed" . $mysqli->error;
	exit(1);
}
$log->logThis("granting user privileges successful");
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON venom.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (7) failed" . $mysqli->error;
	exit(1);
}
$log->logThis("granting user privileges successful");
$sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON petclinicmsgs.* TO pcmsuser@localhost;";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Grant (8) failed" . $mysqli->error;
	exit(1);
}
$log->logThis("granting user privileges successful");
/*
GRANT ALL PRIVILEGES ON rapla.* TO db_user@localhost IDENTIFIED BY 'rapla';
GRANT ALL PRIVILEGES ON rapla.* TO db_user@127.0.0.1 IDENTIFIED BY 'rapla';
*/
$sql = "FLUSH PRIVILEGES";
if ($mysqli->query($sql) === TRUE) {

} else {
    echo "Error Flushing the User Privileges" . $mysqli->error;
	exit(1);
}
$mysqli->close();
$log->logThis("Install3 completed");
?>
<script type='text/javascript'>
     $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ] );
     $("#tabs" ).tabs("enable", 9 );
     $("#tabs").tabs("option", "active", 9 );
     $("#tab9").load("install4.php");
</script>