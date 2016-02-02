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
echo "Creating the SNOMED-VTS database, tables, and loading data";
flush();
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("SNOMED-VTS started");
require_once "password.txt";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "CREATE DATABASE snomedvts";
if ($mysqli->query($sql) === TRUE) {
$log->logThis("DB snomedvts created");
} else {
     $log->logThis("Error creating the snomedvts database: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error the snomedvts database: ".$mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_concept` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `definitionStatusId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_concept created");
} else {
     $log->logThis("Error creating sct2_concept table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_concept table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_concept_inactive` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `definitionStatusId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_concept_inactive created");
} else {
     $log->logThis("Error creating sct2_concept_inactive table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_concept_inactive table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_description` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `conceptId` BIGINT NOT NULL DEFAULT 0,
  `languageCode` VARCHAR(3) NOT NULL DEFAULT '',
  `typeId` BIGINT NOT NULL DEFAULT 0,
  `Term` VARCHAR(255) NOT NULL DEFAULT '',
  `caseSignificanceId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `sct2_description_concept` (`conceptId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_description created");
} else {
     $log->logThis("Error creating sct2_description table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_description table: " . $mysqli->error;
	exit(1);
}
//ADD INDEX ix_sct2_description_3 ON sct2_description(`conceptId`,`typeId`,`languageCode`)

$sql = "CREATE TABLE `snomedvts`.`sct2_description_inactive` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `conceptId` BIGINT NOT NULL DEFAULT 0,
  `languageCode` VARCHAR(3) NOT NULL DEFAULT '',
  `typeId` BIGINT NOT NULL DEFAULT 0,
  `Term` VARCHAR(255) NOT NULL DEFAULT '',
  `caseSignificanceId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `sct2_description_concept` (`conceptId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_description_inactive created");
} else {
     $log->logThis("Error creating sct2_description_inactive table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_description_inactive table: " . $mysqli->error;
	exit(1);
}

$sql = "CREATE TABLE `snomedvts`.`sct2_relationship` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `sourceId` BIGINT NOT NULL DEFAULT 0,
  `destinationId` BIGINT NOT NULL DEFAULT 0,
  `relationshipGroup` INT NOT NULL DEFAULT 0,
  `typeId` BIGINT NOT NULL DEFAULT 0,
  `characteristicTypeId` BIGINT NOT NULL DEFAULT 0,
  `modifierId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `sct2_relationship_source` (`sourceId`,`characteristicTypeId`,`typeId`,`destinationId`),
  KEY `sct2_relationship_dest` (`destinationId`,`characteristicTypeId`,`typeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_relationship created");
} else {
     $log->logThis("Error creating sct2_relationship table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_relationship table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_relationship_inactive` (
  `id` BIGINT NOT NULL DEFAULT 0,
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `sourceId` BIGINT NOT NULL DEFAULT 0,
  `destinationId` BIGINT NOT NULL DEFAULT 0,
  `relationshipGroup` INT NOT NULL DEFAULT 0,
  `typeId` BIGINT NOT NULL DEFAULT 0,
  `characteristicTypeId` BIGINT NOT NULL DEFAULT 0,
  `modifierId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `sct2_relationship_source` (`sourceId`,`characteristicTypeId`,`typeId`,`destinationId`),
  KEY `sct2_relationship_dest` (`destinationId`,`characteristicTypeId`,`typeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_relationship_inactive created");
} else {
     $log->logThis("Error creating sct2_relationship_inactive table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_relationship_inactive table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_identifier` (
  `identifierSchemeId` BIGINT NOT NULL DEFAULT 0,
  `alternateIdentifier` VARCHAR(255) NOT NULL DEFAULT '',
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `referencedComponentId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`identifierSchemeId`,`alternateIdentifier`,`effectiveTime`),
  KEY `sct2_relationship_sctid` (`referencedComponentId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_identifier created");
} else {
     $log->logThis("Error creating sct2_identifier table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_identifier table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_identifier_inactive` (
  `identifierSchemeId` BIGINT NOT NULL DEFAULT 0,
  `alternateIdentifier` VARCHAR(255) NOT NULL DEFAULT '',
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `referencedComponentId` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`identifierSchemeId`,`alternateIdentifier`,`effectiveTime`),
  KEY `sct2_relationship_sctid` (`referencedComponentId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_identifier_inactive created");
} else {
     $log->logThis("Error creating sct2_identifier_inactive table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_identifier_inactive table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_refset_c` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `refsetId` BIGINT NOT NULL DEFAULT 0,
  `referencedComponentId` BIGINT NOT NULL DEFAULT 0,
  `sctId1` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `refset_c_id` (`refsetId`,`referencedComponentId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_refset_c created");
} else {
     $log->logThis("Error creating sct2_refset_c table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_refset_c table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `snomedvts`.`sct2_refset_c_inactive` (
  `id` binary(16) NOT NULL DEFAULT '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0',
  `effectiveTime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` TINYINT NOT NULL DEFAULT 0,
  `moduleId` BIGINT NOT NULL DEFAULT 0,
  `refsetId` BIGINT NOT NULL DEFAULT 0,
  `referencedComponentId` BIGINT NOT NULL DEFAULT 0,
  `sctId1` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`,`effectiveTime`),
  KEY `refset_c_id` (`refsetId`,`referencedComponentId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) === TRUE) {
     $log->logThis("   Table sct2_refset_c_inactive created");
} else {
     $log->logThis("Error creating sct2_refset_c_inactive table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating sct2_refset_c_inactive table: " . $mysqli->error;
	exit(1);
}
// false = 0; true = -1 (or any non-zero value is true  active =1 (one).

$log->logThis("     Table sct2_concept start data insertion");
$file_handle = fopen("../data/snomedvts/sct2_Concept_Full_VTS_20151001.txt", "rt");
$line = fgets($file_handle);   // skip heading line
$linectr = 0;
$inactive = 0;
$fields = array();
while (!feof($file_handle)) {
   $linectr++;
   $line = fgets($file_handle);
   $fields =  explode ( "\t" , $line, 6 );
   $field1 = $fields[0];
   $field2 = $fields[1];
   $field3 = $fields[2];
   $field4 = $fields[3];
   $field5 = $fields[4]; 
   if(!empty($fields[5]))
        $field6 = $fields[5];
   if(!empty($fields[6]))
        $field7 = $fields[6];
   if($field3 == 0) {
        $sql = "INSERT INTO `snomedvts`.`sct2_concept_inactive` (`id`, `effectiveTime`, `active`, `moduleId`,  `definitionStatusId`)
          VALUES(\"$field1\", \"$field2\", \"$field3\", \"$field4\", \"$field5\");";
        if ($mysqli->query($sql) === TRUE) {
		
          } else {
               
          }
   } else {
          $sql = "INSERT INTO `snomedvts`.`sct2_concept` (`id`, `effectiveTime`, `active`, `moduleId`,  `definitionStatusId`)
               VALUES(\"$field1\", \"$field2\", \"$field3\", \"$field4\", \"$field5\");";
          if ($mysqli->query($sql) === TRUE) {
		
          } else {
               $errmsg = $mysqli->error;
               $errmsg = strtolower ($errmsg);
               $pos = strpos($errmsg, "duplicate");
               if($pos === FALSE) {
                    $log->logThis("Error inserting into sct2_concept table (data line ".$linectr.") : ".$mysqli->error);
                    $log->logThis("     SQL: ".$sql);
               }	
          }
     }    
}
fclose($file_handle);
$log->logThis("        Record Count for sct2_concept is ".$linectr);
$log->logThis("        Record Count for sct2_concept_inactive is ".$inactive);
$log->logThis("     Table sct2_description start data insertion");
set_time_limit ( 60 );
$file_handle = fopen("../data/snomedvts/sct2_Description_Full_en_VTS_20151001.txt", "rt");
$line = fgets($file_handle);   // skip heading line
$linectr = 0;
$inactive = 0;
$fields = array();
while (!feof($file_handle)) {
   $linectr++;
   $line = fgets($file_handle);
   $fields =  explode ( "\t" , $line, 10 );
   $field1 = $fields[0];
   $field2 = $fields[1];
   $field3 = $fields[2];
   $field4 = $fields[3];
   $field5 = $fields[4]; 
   $field6 = $fields[5];
   $field7 = $fields[6];
   if(!empty($fields[7]))
        $field8 = $fields[7];
   if(!empty($fields[8]))
        $field9 = $fields[8];
   $sql = "INSERT INTO `snomedvts`.`sct2_description` (`id`, `effectiveTime`, `active`, `moduleId`,  `conceptId`, `languageCode`, `typeId`,  `Term`, `caseSignificanceId`)
          VALUES(\"$field1\", \"$field2\", \"$field3\", \"$field4\", \"$field5\", \"$field6\", \"$field7\", \"$field8\", \"$field9\");";
	if ($mysqli->query($sql) === TRUE) {
		
	} else {
          $errmsg = $mysqli->error;
          $errmsg = strtolower($errmsg);
          $pos = strpos($errmsg, "duplicate");
          if($pos === FALSE) {
               $pos = strpos($errmsg, "undefined offset");
               if($pos === FALSE) {
                    $log->logThis("Error inserting into sct2_description table (data line ".$linectr.") : ".$mysqli->error);
                    $log->logThis("     SQL: ".$sql);
               }
          } 
     } 
}
fclose($file_handle);
$log->logThis("Record Count for sct2_description is ".$linectr);
$log->logThis("     Table sct2_relationship start data insertion");
$file_handle = fopen("../data/snomedvts/sct2_Relationship_Full_VTS_20151001.txt", "rt");
$line = fgets($file_handle);   // skip heading line
$linectr = 0;
$inactive = 0;
$fields = array();
while (!feof($file_handle)) {
   $linectr++;
   $line = fgets($file_handle);
   $fields =  explode ( "\t" , $line, 10 );
   $field1 = $fields[0];
   $field2 = $fields[1];
   $field3 = $fields[2];
   $field4 = $fields[3];
   $field5 = $fields[4]; 
   $field6 = $fields[5];
   $field7 = $fields[6];
   $field8= $fields[7];
   $field9 = $fields[8];
   $field10 = $fields[9];
   $sql = "INSERT INTO `snomedvts`.`sct2_relationship` (`id`, `effectiveTime`, `active`, `moduleId`,  `sourceId`, `destinationId`, `relationshipGroup`,  `TypeId`, `characteristicTypeId`, `modifierId`)
          VALUES(\"$field1\", \"$field2\", \"$field3\", \"$field4\", \"$field5\", \"$field6\", \"$field7\", \"$field8\", \"$field9\", \"field10\");";
	if ($mysqli->query($sql) === TRUE) {
		
	} else {
          $errmsg = $mysqli->error;
          $errmsg = strtolower($errmsg);
          $pos = strpos($errmsg, "duplicate");
          if($pos === FALSE) {
               $pos = strpos($errmsg, "undefined offset");
               if($pos === FALSE) {
                    $log->logThis("Error inserting into sct2_relationship table (data line ".$linectr.") : ".$mysqli->error);
                    $log->logThis("     SQL: ".$sql);
               }
          } 
     } 
}
fclose($file_handle);
$log->logThis("Record Count for sct2_relationship is ".$linectr);
ini_set('display_errors', 1);
$file_handle = fopen("procdb.tmp", "rt");
$pref1 = fread ($file_handle, 5);
fclose($file_handle);
$pref1 = "S".substr($pref1,1);
$file_handle = fopen("procdb.tmp", "wt");
fwrite ($file_handle , $pref1, 5);
fclose($file_handle);
$log->logThis("SNOMED-VTS completed");
echo "SNOMED-VTS creation has been completed. Please close this window.";
?>
<script>
window.close();
</script>