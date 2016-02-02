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
?>
<html><head>
  <meta charset="utf-8">
  <title>PetClinic Management Application</title>
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/jquery.validate.js"></script>
  <script src="../js/additional-methods.js"></script>
  <script src="../js/jquery.cookie.js"></script>
  <script src="../js/i18next.js"></script>
  <script src="../js/petclinic.js"></script>
  <link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
  <link rel="stylesheet" href="../css/install.css" type="text/css">
  <script>
    $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
$(document).ready(function() {
     $("#tabs" ).tabs("option", "disabled", [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ] );
     $("#tab0").load("intro.php");
     $("#tabs" ).tabs( "enable", 0 );
     $("#tabs").tabs("option", "active", 0);
 }); 
</script>
<style>
  .ui-tabs-vertical { width: 100em; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 15em; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 80em;}
</style>
</head><body>
<div id="totalprogress">Total Progress</div>
<script>
$( "#totalprogress" ).progressbar({
  max: 100
});
$( "#totalprogress" ).progressbar({
  value: 0
});
</script>
<?php
require_once "../includes/version.inc";
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("PetClinic $version");
$log->logThis("index.php Tabs Active");
?>
<div id="tabs">
  <ul>
    <li><a href="#tab0">Introduction</a></li>
    <li><a href="#tab1">Database Information</a></li>
    <li><a href="#tab2">Create Databases<br>Create Tables</a></li>
    <li><a href="#tab3">Company Information</a></li>
    <li><a href="#tab4">Create Company Record</a></li>
    <li><a href="#tab5">Employee Information</a></li>
    <li><a href="#tab6">Create Employee Record</a></li>
    <li><a href="#tab7">Computer and<br>Server Information</a></li>
    <li><a href="#tab8">Continue</a></li>
    <li><a href="#tab9">Final Steps</a></li>
    <li><a href="#tab10">Completed</a></li>
  </ul>
  <div id="tab0">
    <h2>Introduction</h2>
  </div>
  <div id="tab1">
    <h2>Database Information</h2>
  </div>
  <div id="tab2">
    <h2>Create Databases and Tables</h2>
  </div>
  <div id="tab3">
    <h2>Company Information</h2>
  </div>
  <div id="tab4">
    <h2>Create Company Record</h2>
  </div>
  <div id="tab5">
    <h2>Employee Information</h2>
  </div>
  <div id="tab6">
    <h2>Create Employee Record</h2>
  </div>
  <div id="tab7">
    <h2>Computer and Server Information</h2>
  </div>
  <div id="tab8">
    <h2>Continue</h2>
  </div>
  <div id="tab9">
    <h2>Final Steps</h2>
  </div>
  <div id="tab10">
    <h2>Completed</h2>
  </div>
</div>
</body>
</html>