<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =========                                               *
*petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$mc = "";
$sqluserid=$_COOKIE["u"];
$sqlpassword=$_COOKIE["p"];
/*********
?>
<script>
document.write("Installing the Databases and Tables is now starting");
</script>
<?php
*********/
$fh = fopen("password.txt", 'wbt') or die("can't open file");
$stringData = "<?php\n";
fwrite($fh, $stringData);
$stringData = "\$user = \"".$sqluserid."\";\n";
fwrite($fh, $stringData);
$stringData = "\$password = \"".$sqlpassword."\";\n";
fwrite($fh, $stringData);
$stringData = "?>";
fwrite($fh, $stringData);
fclose($fh);
require_once "../includes/version.inc";
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("install.php Tab2 Active");
require_once "password.txt";
$log->logThis("Install started");
$log->logThis("Password file created and included");
$mysqli = new mysqli('localhost', $user, $password, '');
/*
$sql = "SET GLOBAL event_scheduler = ON;";
if ($mysqli->query($sql) == TRUE) {
    $log->logThis("mySQL Global Event Scheduler is turned ON");
} else {
     $log->logThis("Error setting global event scheduler on: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error setting global event scheduler on: ".$mysqli->error;
	exit(1);
}
*/
$sql = "CREATE DATABASE petclinicsys".$mc;
if ($mysqli->query($sql) == TRUE) {
    $log->logThis("DB petclinicsys created");
} else {
     $log->logThis("Error creating petclinicsys: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating system database: ".$mysqli->error;
     exit(1);
}
$sql = "CREATE TABLE `petclinicsys`.`logonallowed` (
	`status` char(1) NOT NULL DEFAULT \"Y\"
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table logonallowed created");
} else {
     $log->logThis("Error creating table logonallowed: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating logonallowed table" . $mysqli->error;
     exit(1);
}
$sql = "INSERT INTO `petclinicsys`.`logonallowed` (`status`) VALUES (\"Y\");";
if ($mysqli->query($sql) == TRUE) {
} else {
     $log->logThis("Error inserting into table logonallowed: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating logonallowed table" . $mysqli->error;
     exit(1);
}
$sql = "CREATE TABLE `petclinicsys`.`usersol` (
	`user` varchar(10) NOT NULL,
	`datetime` char(17) NOT NULL,
	`os` varchar(15) NOT NULL,
	`lastpage` varchar(20),
	`lastdatetime` integer(14)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table usersol created");
} else {
     $log->logThis("Error creating table userol: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating userol table" . $mysqli->error;
	exit(1);
}
/***********
?>
<script>
document.write("Created the Databases petclinicsys and Tables");
</script>
<?php
**********/
$sql = "CREATE DATABASE petclinicproc".$mc;
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicproc created");
} else {
     $log->logThis("Error creating DB petclinicproc: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating procedures database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicproc`.`procedures` (
	`proccode` varchar(10) NOT NULL,
	`procdesc` varchar(25) NOT NULL,
	`procbillcharge` decimal(5,2),
	`procstatus` char(1) NOT NULL DEFAULT \"A\",
	`changeid` integer(4) NOT NULL,
	PRIMARY KEY (`proccode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table procedures created");
} else {
     $log->logThis("Error creating table procedures: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating proc table" . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicproc`.`procinv` (
     `proctype` char(1) NOT NULL,
     `proccode` varchar(10) NOT NULL,
     `invtype` char(1) NOT NULL,
	`invid` integer (5) NOT NULL,
	`itemsused` integer (2) NOT NULL,
	`containused` integer(2) NOT NULL,
	`changeid` integer(4) NOT NULL,
	INDEX(`invid`),
	INDEX (`proccode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$sql = "CREATE DATABASE petclinic".$mc;
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table procedures created");
} else {
     $log->logThis("Error creating table procedures: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating procedures Table: " . $mysqli->error;
	exit(1);
}
/**********
?>
<script>
document.write("Created the Databases procedures and Tables");
</script>
<?php
***********/
$sql = "CREATE DATABASE petcliniccorp".$mc;
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petcliniccorp created");
} else {
     $log->logThis("Error creating petcliniccorp database: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating petcliniccorp database: " . $mysqli->error;
	exit(1);
}
$log->logThis("DB petcliniccorp created");
$sql = "CREATE TABLE `petcliniccorp`.`company` (
  `name` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `telephone` char(13) NOT NULL,
  `fax` char(13) NULL,
  `logo` varchar(25) NULL,
  `businesslic` varchar(15) NULL,
  `statetax` DECIMAL(4,2) NOT NULL,
  `weight` char(1) NOT NULL DEFAULT \"P\",
  `temp` char(1) NOT NULL DEFAULT \"F\",
  `lang` char(3) NOT NULL DEFAULT \"USE\",
  `changeid` integer(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table company created");
} else {
     $log->logThis("Error creating company table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating company table " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petcliniccorp`.`preferences` (
	`sequence` integer(2) NOT NULL,
	`pref1` varchar(50),
	`pref2` varchar(50),
	`pref3` varchar(50),
	`pref4` varchar(50),
	`pref5` varchar(50),
	`pref6` varchar(50),
	`pref7` varchar(50),
	`pref8` varchar(50),
	`pref9` varchar(50),
	`pref10` varchar(50),
	`changeid` integer(4) NOT NULL,
	PRIMARY KEY (`sequence`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table preferences created");
} else {
     $log->logThis("Error creating preferences table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating preferences table" . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petcliniccorp`.`employee` (
  `emplnumber` INTEGER(4) NOT NULL AUTO_INCREMENT,
  `uuserid` varchar(10) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `changepwd` char(1) NOT NULL DEFAULT \"Y\",
  `pwdhint` varchar(255),
  `hintans` varchar(255),
  `lname` varchar(40) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `prefix` varchar(5),
  `suffix` varchar(5),
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `telephone` char(13) NOT NULL,
  `email` varchar(25),
  `status` char(1) NOT NULL DEFAULT \"A\",
  `changeid` integer(4) NOT NULL,
  index(`uuserid`),
  PRIMARY KEY(`emplnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table employee created");
} else {$log->logThis("Error creating employee table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating employee table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petcliniccorp`.`seckeys` (
	`emplnumber` integer(4) NOT NULL,
	`sequence` integer(1) NOT NULL,
	`sk01` char(1) NOT NULL DEFAULT \"N\",
	`sk02` char(1) NOT NULL DEFAULT \"N\",
	`sk03` char(1) NOT NULL DEFAULT \"N\",
	`sk04` char(1) NOT NULL DEFAULT \"N\",
	`sk05` char(1) NOT NULL DEFAULT \"N\",
	`sk06` char(1) NOT NULL DEFAULT \"N\",
	`sk07` char(1) NOT NULL DEFAULT \"N\",
	`sk08` char(1) NOT NULL DEFAULT \"N\",
	`sk09` char(1) NOT NULL DEFAULT \"N\",
	`sk10` char(1) NOT NULL DEFAULT \"N\",
	`sk11` char(1) NOT NULL DEFAULT \"N\",
	`sk12` char(1) NOT NULL DEFAULT \"N\",
	`sk13` char(1) NOT NULL DEFAULT \"N\",
	`sk14` char(1) NOT NULL DEFAULT \"N\",
	`sk15` char(1) NOT NULL DEFAULT \"N\",
	`sk16` char(1) NOT NULL DEFAULT \"N\",
	`sk17` char(1) NOT NULL DEFAULT \"N\",
	`sk18` char(1) NOT NULL DEFAULT \"N\",
	`sk19` char(1) NOT NULL DEFAULT \"N\",
	`sk20` char(1) NOT NULL DEFAULT \"N\",
	`sk21` char(1) NOT NULL DEFAULT \"N\",
	`sk22` char(1) NOT NULL DEFAULT \"N\",
	`sk23` char(1) NOT NULL DEFAULT \"N\",
	`sk24` char(1) NOT NULL DEFAULT \"N\",
	`sk25` char(1) NOT NULL DEFAULT \"N\",
	`sk26` char(1) NOT NULL DEFAULT \"N\",
	`sk27` char(1) NOT NULL DEFAULT \"N\",
	`sk28` char(1) NOT NULL DEFAULT \"N\",
	`sk29` char(1) NOT NULL DEFAULT \"N\",
	`sk30` char(1) NOT NULL DEFAULT \"N\",
	`sk31` char(1) NOT NULL DEFAULT \"N\",
	`sk32` char(1) NOT NULL DEFAULT \"N\",
	`sk33` char(1) NOT NULL DEFAULT \"N\",
	`sk34` char(1) NOT NULL DEFAULT \"N\",
	`sk35` char(1) NOT NULL DEFAULT \"N\",
	`changeid` integer(4) NOT NULL,
	INDEX (`emplnumber`),
	PRIMARY KEY (`emplnumber`, `sequence`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table seckeys created");
} else {$log->logThis("Error creating seckeys table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating seckeys table" . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petcliniccorp`.`doctors` (
     `doctorid` integer(3) NOT NULL AUTO_INCREMENT,
	`doctordesc` char(50) NOT NULL,
     `doctorstatelic` varchar(255),
     `doctordealic` varchar(255),
     `doctorstatus` char(1),
     PRIMARY KEY (`doctorid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table doctors created");
} else {
     $log->logThis("Error creating doctors table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating doctors table\n" . $mysqli->error;
	exit(1);
}
/************
?>
<script>
document.write("Created the Databases petcliniccorp and Tables");
</script>
<?php
************/
$sql = "CREATE TABLE `petclinic`.`code_state` (
	`statecode` char(2) NOT NULL,
	`statedesc` varchar(20) NOT NULL,
	PRIMARY KEY (`statecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table code_state created");
} else {
     $log->logThis("Error creating code_state table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating code_state table\n" . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`code_species` (
  `speciescode` char(1) NOT NULL,
  `speciesdesc` varchar(15) NOT NULL,
  PRIMARY KEY (`speciescode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table code_species created");
} else {
     $log->logThis("Error creating code_species table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating species table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`code_breed` (
  `breedcode` char(3) NOT NULL,
  `breeddesc` varchar(40) NOT NULL,
  PRIMARY KEY (`breedcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table code_breed created");
} else {
     $log->logThis("Error creating code_breed table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating code_breed table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`code_phone` (
  `phonecode` char(1) NOT NULL,
  `phonedesc` varchar(15) NOT NULL,
  PRIMARY KEY (`phonecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table code_phone created");
} else {
     $log->logThis("Error creating code_phone table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating code_phone table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`client` (
    `clientnumber` INTEGER(4) NOT NULL AUTO_INCREMENT,
    `lname` varchar(40) NOT NULL,
    `soundex` CHAR(4) NOT NULL,
    `fname` varchar(25) DEFAULT NULL,
    `prefix` varchar(5),
    `suffix` varchar(5),
    `address` varchar(255) DEFAULT NULL,
    `address2` varchar(255) DEFAULT NULL,
    `city` varchar(255) DEFAULT NULL,
    `state` char(2) DEFAULT NULL,
    `zipcode` varchar(10) DEFAULT NULL,
    `userid` varchar(10) NULL,
    `password` varchar(255) NULL,
    `email` varchar(255) DEFAULT NULL,
    `email_remind` char(1) NOT NULL DEFAULT \"Y\",
    `email_followup` char(1) NOT NULL DEFAULT \"Y\",
    `email_advice` char(1) NOT NULL DEFAULT \"Y\",
    `email_special` char(1) NOT NULL DEFAULT \"Y\",
    `status` char(1) NOT NULL DEFAULT \"A\",
    `changeid` integer(4) NOT NULL,
    PRIMARY KEY (`clientnumber`),
    INDEX (`lname`),
    INDEX (`soundex`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table client created");
} else {
     $log->logThis("Error creating client table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating client table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`phone` (
  `clientnumber` integer(4) NOT NULL,
  `phonecode` char(1) NOT NULL,
  `phonenumber` numeric(13) NOT NULL,
  PRIMARY KEY (`clientnumber`, `phonecode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table phone created");
} else {
     $log->logThis("Error creating phone table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating phone table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`clientphone` (
  `clientnumber` INTEGER(4) NOT NULL,
  `phonecode` char(1) NOT NULL,
  `phonenumber` char(13),
  PRIMARY KEY (`clientnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table clientphone created");
} else {
     $log->logThis("Error creating clientphone table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating clientphone table: " . $mysqli->error;
	exit(1);
}
$sql="CREATE TABLE `petclinic`.`pet` (
  `petnumber` integer(4) NOT NULL AUTO_INCREMENT,
  `petname` varchar(15) NOT NULL,
  `petdob` char(8) NOT NULL,
  `petspecies` char(1) NOT NULL,
  `petbreed` char(2) NOT NULL,
  `petgender` char(1) NOT NULL,
  `petfixed` char(1) NOT NULL,
  `petcolor` varchar(20) NOT NULL,
  `petdesc` varchar(50) NOT NULL,
  `license` varchar(15) NULL,
  `microchip` varchar(18) NULL,
  `rabiestag` varchar(10) NULL,
  `tattoonumber` varchar(10) NULL,
  `picture` char(1) NOT NULL DEFAULT \"N\",
  `status` char(1) NOT NULL DEFAULT \"A\",
  `changeid` integer(4) NOT NULL,
  PRIMARY KEY (`petnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table pet created");
} else {
     $log->logThis("Error creating pet table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating pet table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`clientpet` (
	`petnumber` integer(4) NOT NULL,
	`clientnumber` integer(4) NOT NULL,
	INDEX (`petnumber`),
	INDEX (`clientnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table clientpet created");
} else {
     $log->logThis("Error creating clientpet table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating clientpet table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinic`.`visit` (
	`visitnumber` integer(4) NOT NULL AUTO_INCREMENT,
	`visitdate` integer(8) NOT NULL,
	`petnumber` integer(4) NOT NULL,
	`temp` DECIMAL(4,1),
	`weight` DECIMAL(4,1),
	`pulse` integer(2),
	`respiration` integer(3),
	`panting` char(1),
	`caprefill` integer(2),
	`mucous` varchar(20),
	`hydration` varchar(20),
	`clinicalstay` char(1),
	`clinicaldischarge` char(1),
	`status` char(1) NOT NULL DEFAULT \"A\",
	`changeid` INTEGER(4) NOT NULL,
	PRIMARY KEY (`visitnumber`),
	INDEX (`changeid`),
	INDEX(`petnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table visit created");
} else {$log->logThis("Error creating visit table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating visit table: " . $mysqli->error;
	exit(1);
}
/************
?>
<script>
document.write("Created the Databases petclinic and Tables");
</script>
<?php
*************/
$sql = "CREATE DATABASE petclinicinv".$mc;
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicinv created");
} else {
     $log->logThis("Error creating petclinicinv database: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating petclinicinv database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinv`.`invother` (
	`assetid` integer (5) NOT NULL AUTO_INCREMENT,
	`assetdesc` varchar(32) NOT NULL,
     `vendorid` integer(11),
	`wherebought` varchar(50),
	`purdate` integer(8) NOT NULL,
	`purcost` decimal(7,2),
	`location` varchar(30),
	`status` char(1) NOT NULL DEFAULT \"A\",
	`changeid` integer(4) NOT NULL,
	PRIMARY KEY (`assetid`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table invother created");
} else {
     $log->logThis("Error creating invother table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating invother table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinv`.`invsupplies` (
	`supplyid` integer (5) NOT NULL AUTO_INCREMENT,
	`supplydesc` varchar(32) NOT NULL,
     `vendorid` integer(11),
	`wherebought` varchar(50) NOT NULL,
	`purdate` integer(8) NOT NULL,
	`cartoncost` decimal(6,2) NOT NULL,
	`cartonspurch` integer(3) NOT NULL,
	`cartononhand` integer(3) NOT NULL,
	`containercost` decimal(6,2),
	`containercarton` integer(3) NOT NULL,
	`itemscontainer` integer(4) NOT NULL,
	`itemcost` decimal(5,2) NOT NULL,
	`itemmarkup` decimal(3,2) NOT NULL,
	`salesprice` decimal(5,2) NOT NULL,
	`location` varchar(30),
	`itemreorderlevel` integer(3) NOT NULL,
	`taxable` char(1) NOT NULL DEFAULT \"Y\",
	`status` char(1) NOT NULL DEFAULT \"A\",
	`changeid` integer(4) NOT NULL,
	PRIMARY KEY (`supplyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table invsupplies created");
} else {
     $log->logThis("Error creating invsupplies table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating invsupplies table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinv`.`invmedicine` (
	`medid` integer (5) NOT NULL AUTO_INCREMENT,
	`meddesc` varchar(32) NOT NULL,
     `vendorid` integer(11),
	`wherebought` varchar(50),
	`purdate` integer(8),
	`cartoncost` decimal(5,2),
	`cartonspurch` integer(3),
	`containercarton` integer(3) NOT NULL,
	`itemscontainer` integer(4) NOT NULL,
	`itemcost` decimal(5,2),
	`containercost` decimal(6,2),
	`itemreorderlevel` integer(3) NOT NULL,
	`itemmarkup` decimal(3,2) NOT NULL,
	`containermarkup` decimal(3,2) NOT NULL,
	`itemsalesprice` decimal(6,2) NOT NULL,
	`containersalesprice` decimal(6,2) NOT NULL,
	`taxable` char(1) NOT NULL DEFAULT \"Y\",
	`status` char(1) NOT NULL DEFAULT \"A\",
	`changeid` integer(4) NOT NULL,
	PRIMARY KEY (`medid`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table invmedicine created");
} else {
     $log->logThis("Error creating invmedicine table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating invmedicine table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinv`.`invtrans` (
	`invid` integer (5) NOT NULL,
     `vendorid` integer(11),
     `wherebought` varchar(50),
	`invtype` char(1) NOT NULL,
	`count` integer(5) NOT NULL,
	`counttype` char(1) NOT NULL,
	`plusminus` char(1) NOT NULL,
	`amount` decimal(6,2) NOT NULL DEFAULT 0.00,
	`transdate` integer(8) NOT NULL,
	`transtime` integer(4) NOT NULL,
	`changeid` integer(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table invtrans created");
} else {
     $log->logThis("Error creating invtrans table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating invtrans table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinv`.`vendor` (
     `vendorid` integer(10) NOT NULL AUTO_INCREMENT,
     `vendorname` varchar(50) NOT NULL,
     `vendorshortname` varchar(25),
     `vendorcontact` varchar(25),
     `vendoraddress1` varchar(255) NOT NULL,
     `vendoraddress2` varchar(255),
     `vendorcity` varchar(255) NOT NULL,
     `vendorstate` char(2) NOT NULL,
     `vendorzipcode` varchar(10) NOT NULL,
     `vendortele` varchar(13) NOT NULL,
     `vendorfax` varchar(13),
     `vendoremail` varchar(255),
     `vendorstatus` char(1) NOT NULL,
     PRIMARY KEY (`vendorid`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table vendor created");
} else {
     $log->logThis("Error creating vendor table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating vendor table: " . $mysqli->error;
	exit(1);
}
/**************
?>
<script>
document.write("Created the Databases petclinicinv and Tables");
</script>
<?php
***************/
$sql = "CREATE DATABASE petclinicapptclinic";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicapptclinic created");
} else {
     echo "Error creating petclinicapptclinic database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE DATABASE petclinicapptboard";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicapptboard created");
} else {
     echo "Error creating petclinicapptboard database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE DATABASE petclinicapptgroom";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicgroom created");
} else {
     echo "Error creating petclinicapptgroom database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE DATABASE petclinicdocmgmt";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicdocmgmt created");
} else {
     echo "Error creating petclinicdocmgmt database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE DATABASE petclinicinvoices";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicinvoices created");
} else {
     echo "Error creating petclinicinvoices database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicinvoices`.`options` (
     `retcheckfeetype` char(1) NOT NULL,
     `vretcheckfee` decimal(5,2) DEFAULT 0.00,
     `pastdue30type` char(1) NOT NULL,
     `pastdue30fee` decimal(5,2) DEFAULT 0.00,
     `pastdue60type` char(1) NOT NULL,
     `pastdue60fee` decimal(5,2) DEFAULT 0.00,
     `pastdue90type` char(1) NOT NULL,
     `pastdue90fee` decimal(5,2) DEFAULT 0.00,
     `pastdue120type` char(1) NOT NULL,
     `pastdue120fee` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table options created");
} else {
     $log->logThis("Error creating options table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating options table: " . $mysqli->error;
	exit(1);
}
$sql = "INSERT INTO `petclinic`.`code_state` (`statecode`, `statedesc`)
  VALUES (\"AK\",\"ALASKA\"),
         (\"AL\",\"ALABAMA\"),
         (\"AR\",\"ARKANSAS\"),
         (\"AZ\",\"ARIZONA\"),
         (\"CA\",\"CALIFORNIA\"),
         (\"CO\",\"COLORADO\"),
         (\"CT\",\"CONNECTICUT\"),
         (\"DC\",\"DISTRICT OF COLUMBIA\"),
         (\"DE\",\"DELAWARE\"),
         (\"FL\",\"FLORIDA\"),
         (\"GA\",\"GEORGIA\"),
         (\"HI\",\"HAWAII\"),
         (\"IA\",\"IOWA\"),
         (\"ID\",\"IDAHO\"),
         (\"IL\",\"ILLINOIS\"),
         (\"IN\",\"INDIANA\"),
         (\"KS\",\"KANSAS\"),
         (\"KY\",\"KENTUCKY\"),
         (\"LA\",\"LOUISIANA\"),
         (\"MA\",\"MASSACHUSETTS\"),
         (\"MD\",\"MARYLAND\"),
         (\"ME\",\"MAINE\"),
         (\"MI\",\"MICHIGAN\"),
         (\"MN\",\"MINNESOTA\"),
         (\"MO\",\"MISSOURI\"),
         (\"MS\",\"MISSISSIPPI\"),
         (\"MT\",\"MONTANA\"),
         (\"NC\",\"NORTH CAROLINA\"),
         (\"ND\",\"NORTH DAKOTA\"),
         (\"NE\",\"NEBRASKA\"),
         (\"NH\",\"NEW HAMPSHIRE\"),
         (\"NJ\",\"NEW JERSEY\"),
         (\"NM\",\"NEW MEXICO\"),
         (\"NV\",\"NEVADA\"),
         (\"NY\",\"NEW YORK\"),
         (\"OH\",\"OHIO\"),
         (\"OK\",\"OKLAHOMA\"),
         (\"OR\",\"OREGON\"),
         (\"PA\",\"PENNSYLVANIA\"),
         (\"PR\",\"PUERTO RICO\"),
         (\"RI\",\"RHODE ISLAND\"),
         (\"SC\",\"SOUTH CAROLINA\"),
         (\"SD\",\"SOUTH DAKOTA\"),
         (\"TN\",\"TENNESSEE\"),
         (\"TX\",\"TEXAS\"),
         (\"UT\",\"UTAH\"),
         (\"VA\",\"VIRGINIA\"),
         (\"VT\",\"VERMONT\"),
         (\"WA\",\"WASHINGTON\"),
         (\"WI\",\"WISCONSIN\"),
         (\"WV\",\"WEST VIRGINIA\"),
         (\"WY\",\"WYOMING\");";
if ($mysqli->query($sql) === TRUE) {
    $log->logThis("      Data insertion into Table code_state successful");
} else {
     $log->logThis("Error inserting into code_state table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
    echo "Table code_state data insertion failed" . $mysqli->error;
	exit(1);
}
$log->logThis("      code_state table insertion successful");
$sql = "INSERT INTO `petclinic`.`code_species` (`speciescode`, `speciesdesc`)
	VALUES (\"C\", \"Canine\"),
	       (\"F\", \"Feline\");";
if ($mysqli->query($sql) === TRUE) {
    $log->logThis("      Data insertion into Table code_species successful");
} else {
     $log->logThis("Error inserting into code_species table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error loading data into species table: " . $mysqli->error;
	exit(1);
}
$log->logThis("      code_species table insertion successful");
$file_handle = fopen("../data/dogbreeds.txt", "r");
while (!feof($file_handle)) {
   $line = fgets($file_handle);
   $code = substr($line,0,3);
   $text = substr($line,3);
   $sql = "INSERT INTO `petclinic`.`code_breed` (`breedcode`, `breeddesc`)
          VALUES(\"$code\", \"$text\");";
	if ($mysqli->query($sql) === TRUE) {
		
	} else {
          $log->logThis("Error inserting into code_breed (dogs) table: ".$mysqli->error);
          $log->logThis("     SQL: ".$sql);
		echo "Error inserting into breed table" . $mysqli->error;
	exit(1);
	} 
}
fclose($file_handle);
$log->logThis("      code_breed table insertion successful");
$file_handle = fopen("..\data\catbreeds.txt", "r");
while (!feof($file_handle)) {
   $line = fgets($file_handle);
   $code = substr($line,0,3);
   $text = substr($line,3);
   $sql = "INSERT INTO `petclinic`.`code_breed` (`breedcode`, `breeddesc`)
          VALUES(\"$code\", \"$text\");";
	if ($mysqli->query($sql) === TRUE) {
		
	} else {
          $log->logThis("Error inserting into code_breed (cats) table: ".$mysqli->error);
          $log->logThis("     SQL: ".$sql);
		echo "Error inserting into breed table" . $mysqli->error;
	exit(1);
} }
fclose($file_handle);
$log->logThis("      code_breeds table insertion successful");
$sql = "CREATE DATABASE petclinicmsgs";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("DB petclinicmsgs created");
} else {
     echo "Error creating petclinicmsgs database: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicmsgs`.`errormsgs` (
     `ecc` varchar(20) NOT NULL,
     `errormessage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table errormsgs created");
} else {
     $log->logThis("Error creating errormsgs table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating errormsgs table: " . $mysqli->error;
	exit(1);
}
$sql = "CREATE TABLE `petclinicmsgs`.`phonemsgs` (
     `emplnumber` INTEGER(4) NOT NULL,
     `read` char(1) NOT NULL,
     `call` char(1) NOT NULL,
     `callagain` char(1) NOT NULL,
     `retyourcall` char(1) NOT NULL,
     `cametosee` char(1) NOT NULL,
     `emergency` char(1) NOT NULL,
     `from` varchar(40) NOT NULL,
     `telephone` varchar(20) NOT NULL,
     `phonemessage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($mysqli->query($sql) == TRUE) {
     $log->logThis("   Table phonemsgs created");
} else {
     $log->logThis("Error creating phonemsgs table: ".$mysqli->error);
     $log->logThis("     SQL: ".$sql);
     echo "Error creating phonemsgs table: " . $mysqli->error;
	exit(1);
}
$log->logThis("Install completed");
$mysqli->close();
$file_handle = fopen("procdb.tmp", "wt");
fwrite ($file_handle , "NNPNN", 5);
fclose($file_handle);
$log->logThis("procedures.php Tab2 Active");
?>
<script type='text/javascript'>
     $("#tabs").tabs("option", "disabled", [ 0, 1, 3, 4, 5, 6, 7, 8, 9, 10 ] );
     $("#tabs" ).tabs("enable", 2 );
     $("#tabs").tabs("option", "active", 2 );
     $("#tab2").load("procedures.php");
</script>