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
$log->logThis("Install6 started");
?>
<br><br>
The following step of the installation need to be done manually. 
<br><br>
The step is an important step as it starts the Appointment subsystem. 
You must log on to the server and go to the following directory:
<br><br>
<b>/wamp/www/petclinic/appointments/rapla/</b>
<br><br>
Execute or click on the filename:
<br><br>
<b><u>Windows:</u></b> raplaserver.bat
<br><br>
<b><u>Linux:</u></b> raplaserver.sh
<br><br>
<b><u>Please remember:</u></b> If you ever turn off the server, you will need to redo the above to start the server again. 
If you do not, you will not be able to schedule appointments.
<br><br>
When you have completed the above, click on the continue button.
<?php
$log->logThis("Install6 completed");
?>
<form method="post" action="install7.php"><input class="submit" type="submit" value="Continue"></form>
