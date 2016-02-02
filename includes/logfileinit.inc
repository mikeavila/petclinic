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
if ($logFileName == "user") {
     $logDir = "logfiles";
} else {
     $logDir="../logfiles/";
}
//$logFileName=$logfilename;
$logMode="oneFile";
$counterFile=$logFileName.".counter";
require_once 'Log.class.php';
$log=new Log($logDir,$logFileName,$headerTitle, $logMode, $counterFile);
?>