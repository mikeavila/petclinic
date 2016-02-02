<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*Petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("f:nl");
$log->logThis("Install7 started");
unlink ("password.txt");
rename ("../index.php", "../index.php.installed");
rename ("../index.php.petclinic", "../index.php");
rename ("../install", "../xinstallx");
$log->logThis("Install7 completed");
header("Location:../xinstallx/completed.php");
?>