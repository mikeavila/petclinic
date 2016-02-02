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
$log->logThis("Install4 started");
require_once "password.txt";
chdir ("..\docmgmt");
$readfilename = "config.php.skeleton";
$writefilename = "config.php";
$fhread = fopen($readfilename, "r");
$fhwrite = fopen($writefilename, "wbt");
$sigcount = 1;
while (!feof($fhread)) {
     $record = fgets($fhread, 1024);
     $signal = substr($record, 0, 7);
     if ($signal == "//@@@@@") {
          $record = fgets($fhread, 1024);
          switch ($sigcount) {
               case 1:
                    $record = "define('DB_NAME', 'petclinicdocmgmt');\n";
                    $sigcount = 2;
                   break;
               case 2:
                    $record = "define('DB_USER', '$user');\n";
                    $sigcount = 3;
                    break;
               case 3:
                    $record = "define('DB_PASS', '$password');";
               default:
                    break;
          }
     }
     fwrite($fhwrite, $record, 1024);
}
fclose($fhread);
fclose($fhwrite);
$log->logThis("Install4 completed");
?>
<script type="text/javascript">
     window.open ("/petclinic/docmgmt/install/petclinic-odm.php","_blank");
     $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 10 ] );
     $("#tabs" ).tabs("enable", 9 );
     $("#tabs").tabs("option", "active", 9 );
     $("#tab9").load("install6.php");
</script>
