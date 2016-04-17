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
/*
 * $localpath=getenv("SCRIPT_NAME");
2
	$absolutepath=realpath($localPath);
3
	// a fix for Windows slashes
4
	$absolutepath=str_replace("\\","/",$absolutepath);
5
	$docroot=substr($absolutepath,0,strpos($absolutepath,$localpath));
6
	// as an example of use
7
	include($docroot."/includes/config.php");
 */
$docroot = getenv("DOCUMENT_ROOT");
// echo "<br>dr=".$docroot;
// $localpath=getenv("SCRIPT_NAME");
// echo "<br>lp=".$localpath;
// $absolutepath = realpath($localpath);
// if($absolutepath == FALSE){
// 	echo "<br>ap ret false";
// }
// echo "<br>ap=".$absolutepath;
// $absolutepath=str_replace("\\","/",$absolutepath);
// $docroot=substr($absolutepath,0,strpos($absolutepath,$localpath));
// echo "<br>lp=".$localpath;
// echo "<br>ap=".$absolutepath;
// echo "<br>dr=".$docroot;
// exit();
if(!isset($logFileName)) {
     $logFileName = "user";
}
$logDir=$docroot."petclinic/logfiles";
$logDir = substr($logDir, 2);
//$logFileName=$logfilename;
$logMode="oneFile";
$counterFile=$logFileName.".counter";
require_once 'Log.class.php';
$log=new Log($logDir,$logFileName,$headerTitle, $logMode, $counterFile);
?>