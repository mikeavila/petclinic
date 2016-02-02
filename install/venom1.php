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
echo "Creating VeNom database and tables (Step 1)";
ob_flush();
flush();
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("VeNom1 started");
require_once "password.txt";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "CREATE DATABASE venom";
if ($mysqli->query($sql) === TRUE) {
$log->logThis("DB venom created");
} else {
     $log->logThis("Error creating the venom database: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error the venom database: ".$mysqli->error;
	exit(1);
}
//Current Status,Previous Status,Date created/of last status change,DDID of Superseding Term,Label           ,Database Dictionary Id,Term name                 ,Top level modelling
//Active Both   ,               ,                                  ,                        ,Species         ,15461                 ,Dog (Canine - Domestic),
//   15         ,               ,                                  ,                        ,   15           ,      10              ,  100
//0,4,5,6 = 1,5,6,7
$sql = "CREATE TABLE `venom`.`species` (
  `status` varchar(15) NOT NULL,
  `label`  varchar(15) NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(50) NOT NULL,
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table species created");
} else {
     $log->logThis("Error creating species table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating species table: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/species.txt", "rt");
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
   $sql = "INSERT INTO `venom`.`species` (`status`, `label`, `ddid`,  `termname`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for species is ".$linectr);
//Current Status,Previous Status,Date created/of last status change,DDID of Superseding Term,Label           ,Database Dictionary Id,Term name                 ,Top level modelling
//Active Both   ,               ,                                  ,                        ,Canine breed    ,14760                 ,Shepherd Dog - Bedouin,
//    15        ,               ,                                  ,                        ,   25           ,      10              ,  60 
// 0,4,5,6 = 1,5,6,7
$sql = "CREATE TABLE `venom`.`breed` (
  `status` varchar(15) NOT NULL,
  `label`  varchar(25) NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(60) NOT NULL,
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table breed created");
} else {
     $log->logThis("Error creating breed table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating breed table: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/breed.txt", "rt");
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
   $sql = "INSERT INTO `venom`.`breed` (`status`, `label`, `ddid`, `termname`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for breed is ".$linectr);
//Current Status,Previous Status,Date created/of last status change,DDID of Superseding Term,Label           ,Database Dictionary Id,Term name                 ,Top level modelling
//Active Both   ,               ,                                  ,                        ,Reason for visit,18796                 ,Breathing difficulty,   Reason for visit
//   15         ,               ,                                  ,                        ,    20          ,  10                  ,       100          ,       20
//0,4,5,6,7 = 1,5,6,7,8
$sql = "CREATE TABLE `venom`.`reasonforvisit` (
  `status` varchar(15) NOT NULL DEFAULT 0,
  `label`  varchar(20)  NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(100) NOT NULL,
  `toplevelmodel` varchar(20),
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table reasonforvisit created");
} else {
     $log->logThis("Error creating reasonforvisit: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating reasonforvisit: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/reasonforvisit.txt", "rt");
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
   $sql = "INSERT INTO `venom`.`reasonforvisit` (`status`, `label`, `ddid`,  `termname`, `toplevelmodel`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\", \"$field8\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for reasonforvisit is ".$linectr);
//Current Status     ,Previous Status,Date created/of last status change,DDID of Superseding Term,Label              ,Database Dictionary Id,Term name                          ,Top level modelling
//Active Non-referral,               ,                                  ,                        ,Administrative task,7499                  ,Admin task - Prescription diet sale,
//   15              ,               ,                                  ,                        ,    20             ,  10                  ,       100                         ,
//0,4,5,6 = 1,5,6,7
$sql = "CREATE TABLE `venom`.`admintasks` (
  `status` varchar(15) NOT NULL,
  `label`  varchar(25) NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(60) NOT NULL,
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table admintasks created");
} else {
     $log->logThis("Error creating admintasks table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating admintasks table: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/admintasks.txt", "rt");
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
   $sql = "INSERT INTO `venom`.`admintasks` (`status`, `label`, `ddid`,  `termname`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for admintasks is ".$linectr);
$sql = "CREATE TABLE `venom`.`complaint` (
  `status` varchar(15) NOT NULL,
  `label`  varchar(25) NOT NULL,
  `ddid`   numeric(10) NOT NULL,
  `termname` varchar(60) NOT NULL,
  `toplevelmodelling` varchar(60),
  PRIMARY KEY (`ddid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table complaint created");
} else {
     $log->logThis("Error creating complaint table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating complaint table: " . $mysqli->error;
	exit(1);
}
$file_handle = fopen("../data/venom/complaint.txt", "rt");
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
   $sql = "INSERT INTO `venom`.`complaint` (`status`, `label`, `ddid`,  `termname`, `toplevelmodelling`)
          VALUES(\"$field1\", \"$field5\", \"$field6\", \"$field7\", \"$field8\");";
   if ($mysqli->query($sql) === TRUE) {
		
     } else {
               
     }
}
fclose($file_handle);
$log->logThis("        Record Count for complaint is ".$linectr);
$log->logThis("VeNom1 completed");
ini_set('display_errors', 1);
?>
<script>
window.close();
</script>