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
ini_set('display_errors', 0);
echo "Creating VeNom database and tables (Step 2)";
ob_flush();
flush();
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("VeNom2 started");
require_once "password.txt";
$mysqli = new mysqli('localhost', $user, $password, '');
//Current Status     ,Previous Status,Date created/of last status change,DDID of Superseding Term,Label              ,Database Dictionary Id,Term na                ,Top level modelling
//Active Both        ,               ,                                  ,                        ,Diagnosis          ,328                   ,Abscess                ,Inflammatory disorder finding
//0,4,5,6,7 = 1,5,6,7,8
$sql = "CREATE TABLE `venom`.`diagnosis` (
  `status` varchar(15) NOT NULL,
  `label`  varchar(25) NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(60) NOT NULL,
  `toplevelmodelling` varchar(60),
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table diagnosis created");
} else {
     $log->logThis("Error creating diagnosis table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating diagnosis table: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/diagnosis.txt", "rt");
$linectr = 0;
$inactive = 0;
$fields = array();
while (!feof($file_handle)) {
   $linectr++;
   $line = fgets($file_handle);
   $fields =  explode ( "," , $line, 8 );
   $field1 = $fields[0];
   $field2 = $fields[1];
   $field3 = $fields[2];
   $field4 = $fields[3];
   $field5 = $fields[4];
   $field6 = $fields[5];
   $field7 = $fields[6];
   $field8 = $fields[7];
   $field9 = $fields[8];
   $sql = "INSERT INTO `venom`.`diagnosis` (`status`, `label`, `ddid`,  `termname`, `toplevelmodelling`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\", \"$field8\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for diagnosis is ".$linectr);
$mysqli->close();
$log->logThis("VeNom2 completed");
ini_set('display_errors', 1);
?>
<script>
window.close();
</script>