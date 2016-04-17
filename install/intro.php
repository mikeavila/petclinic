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
?>
<script type="text/javascript">
$(document).ready(function() {
     $("#tabs" ).tabs( "option", "disabled", [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ] );
     $("tabs").tabs("enable", 0 );
     $("#tabs").tabs("option", "active", 0);
});
function agree() {
     $("#tab1").load("mysql.php");
     $("#tabs" ).tabs( "option", "disabled", [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10 ] );
     $("#tabs" ).tabs("enable", 1 );
     $("#tabs").tabs("option", "active", 1);
     $("#stepprogress" ).progressbar({ value: 0 });
     $("#totalprogress" ).progressbar({ value: 10 });
}
</script>
<?php
require_once '../includes/version.inc';
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("intro.php Tab1 Active");
?>
<div>You are installing PetClinic Management Software Version
<?php
echo $version;
?>
 on your computer.</div>
<div>This software is &copy; Copyrighted 2015 by Michael Avila. However, the program is distributed
under the terms of the GNU General Public License. This application assists in the management of a
veterinary clinic. This application will allow the creation of customers, pets, visits, inventory,
procedures, and invoicing. Other features are planned.</div>
<div>I would like to acknowledge and thank the Open Source Projects that are integrated into PetClinic.</div>
<br>
<div id="softwareList">
<ul>
<li>Rapla - Appointment system</li>
<li>OpenDocMan - Document Management system</li>
<li>FPDF - Creates PDF files</li>
<li>JQuery - Packaged JavaScript funtions</li>
<li>Log.Class.php - PHP class to create log files</li>
</ul>
</div>
<br>
<div>This file is part of PetClinic Management Software.</div>
<div>PetClinic Management Software is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by the Free Software Foundation,
version 3 of the License.</div>
<div>PetClinic Management Software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.</div>
<div>You should have received a copy of the GNU General Public License
along with PetClinic Management Software.  If not, see http://www.gnu.org/licenses/.</div>
<div class="bold">Even though this software is copyrighted, you may use, modify it or do anything you want with it.
However, you must agree that the copyright statements and GNU license statements must remain in the software and in the
footer of each web page. They cannot be removed.
<br><br>
In addition, the VeNom codes cannot be altered in any way and can only be used with
this software. The individual files cannot be used for anything else or given to anyone.</div>
<br><div class="bold underline">If you do not agree, please delete all of the files and do not continue the installation.
</div><br>
<form><input class="submit" type="button" value="I AGREE" onClick="agree(); return false"></form>