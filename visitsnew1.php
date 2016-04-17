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
session_start();
$background="3";
$logFileName = "user";
$headerTitle="USER LOG";
$body = ' onload="hideall()";';
require_once "includes/header1.inc";
?>
<link rel='stylesheet' href='css/jquery-ui.css'>
     <script src='js/jquery.js'></script>
     <script src='js/jquery-ui.js'></script>
     <style>.body { font-size:4 } </style>
     <script> $(function() { $( '#tabs' ).tabs(); }); </script>
<script>
function show(id)
{
     if (document.getElementById(id).style.display == 'none')
     {
          document.getElementById(id).style.display = '';
     }
}
function hide(id)
{
          document.getElementById(id).style.display = 'none';
}
function hideall()
{
	document.getElementById(`idappear`).style.display = 'none';
	document.getElementById(`idinteg`).style.display = 'none';
	document.getElementById(`ideyes`).style.display = 'none';
	document.getElementById(`idears`).style.display = 'none';
	document.getElementById(`iddental`).style.display = 'none';
	document.getElementById(`iddigest`).style.display = 'none';
	document.getElementById(`idgenitour`).style.display = 'none';
	document.getElementById(`idlymph`).style.display = 'none';
	document.getElementById(`idcardio`).style.display = 'none';
	document.getElementById(`idrespir`).style.display = 'none';
	document.getElementById(`idneuro`).style.display = 'none';
	document.getElementById(`idmskel`).style.display = 'none';
}
$(function() {
	$('#addreason').click(function() {
		return !$('#reasonvisit1 option:selected').appendTo('#reasonvisit2');
	});
	$('#removereason').click(function() {
		return !$('#reasonvisit2 option:selected').appendTo('#reasonvisit1');
	});
	$('#addcomplaint').click(function() {
		return !$('#complaint1 option:selected').appendTo('#complaint2');
	});
	$('#removecomplaint').click(function() {
		return !$('#complaint2 option:selected').appendTo('#complaint1');
	});
	$('#adddiagnosis').click(function() {
		return !$('#diagnosis1 option:selected').appendTo('#diagnosis2');
	});
	$('#removediagnosis').click(function() {
		return !$('#diagnosis2 option:selected').appendTo('#diagnosis1');
	});
	$('#adddiagnostictest').click(function() {
		return !$('#diagnostictest1 option:selected').appendTo('#diagnostictest2');
	});
	$('#removediagnostictest').click(function() {
		return !$('#diagnostictest2 option:selected').appendTo('#diagnostictest1');
	});
	$('#addadmin').click(function() {
		return !$('#admintasks1 option:selected').appendTo('#admintasks2');
	});
	$('#removeadmin').click(function() {
		return !$('#admintasks2 option:selected').appendTo('#admintasks1');
	});
	$('#addtest').click(function() {
		return !$('#tests1 option:selected').appendTo('#tests2');
	});
	$('#removetest').click(function() {
		return !$('#tests2 option:selected').appendTo('#tests1');
	});
	$('#adddiagnosis').click(function() {
		return !$('#diagnosis1 option:selected').appendTo('#diagnosis2');
	});
	$('#removediagnosis').click(function() {
		return !$('#diagnosis2 option:selected').appendTo('#diagnosis1');
	});
	$('#addproc').click(function() {
		return !$('#procedures1 option:selected').appendTo('#procedures2');
	});
	$('#removeproc').click(function() {
		return !$('#procedures2 option:selected').appendTo('#procedures1');
	});
});
function selectitems(procdb) {
if (procdb == "V") {
	var list = document.getElementById('reasonvisit2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('complaint2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('diagnosis2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('diagnostictest2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('admintasks2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    return;
}
if (procdb == "P") {
	var list = document.getElementById('reasonvisit2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('tests2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('diagnosis2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('procedures2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    var list = document.getElementById('admintasks2');
    for(var i = 0; i < list.options.length; ++i) {
        list.options[i].selected = true; }
    return;
}
return;
}
</script>
<?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
if(isset($_GET["procdb"])) {
	$procdb = $_GET["procdb"];
} else {
	$procdb = "";
}
$client = $_GET["client"];
$petid = $_GET["petid"];
$errormsg = get_errormsg();
require_once "visitarraykeys.php";
if (strlen($errormsg) < 3) {
	$date = date('Ymd');
	$temp = "";
	$weight = "";
	$pulse = "";
	$resp = "";
	$pant = "";
	$caprefill = "";
	$mucous = "";
	$hydration = "";
	$stay = "";
	$discharge = "";
	$abnappear = "";
	$abninteg = "";
	$abneyes = "";
	$abnears = "";
	$abndental = "";
	$abndigestive = "";
	$abngenitour = "";
	$abnlymph = "";
	$abncardio = "";
	$abnrespir = "";
	$abnneuro = "";
	$abnmskel = "";
	$subjective = "";
	$objective = "";
	$assessment = "";
	$plan = "";
	$prefilename = "prePet".$petid.".txt";
	if (file_exists("./notes/".$prefilename)) {
		$file_handle = fopen("./notes/".$prefilename, "r");
		while (!feof($file_handle)) {
			$line = fgets($file_handle);
			$code = substr($line, 0 ,1);
			switch ($code) {
				case "d":
					$date = substr($line, 2);
					break;
				case "t":
					$temp = substr($line, 2);
					break;
				case "w":
					$weight = substr($line, 2);
					break;
				case "p":
					$pulse = substr($line, 2);
					break;
				case "a":
					$pant = substr($line, 2);
					break;
				case "r":
					$resp = substr($line, 2);
					break;
				case "c":
					$caprefill = substr($line, 2);
					break;
				case "m":
					$mucous = substr($line, 2);
					break;
				case "h":
					$hydration = substr($line, 2);
					break;
				case "s":
					$subjective = substr($line, 2);
					break;
				default:
					break;
			}
		}
		fclose($file_handle);
	}
	$visitarray = array_fill(0, 40, "");
	$filename = "draftPet".$petid.".txt";
	if (file_exists("./notes/".$filename)) {
		$line = fgets($file_handle);
		fclose($file_handle);
		$visitarray = unserialize($line);
		require_once "visitspopulate.php";
	}
} else {

	$visitarray = array_fill(0, 40, "");
	$visitarray = unserialize($_COOKIE["visitarray"]);
	require_once "visitspopulate.php";
}
?>
<div id="tabs">
<ul>
<li><a href="#soap">SOAP</a></li>
<li><a href="#proc">Procedures</a></li>
<li><a href="#save">Save Information</a></li>
<li><a href="#cancel">Return to Main Menu</a></li>
</ul>
<div id="soap">
<form method="post" action="visitsnew2.php"><center>
<font size="+2" color="Blue">Pet Visit</font><br><br>
<?php
if($procdb == "V") {
	include "includes/visitvspeciesbreed.inc";
}
if($procdb == "P") {
	include "includes/visitpspeciesbreed.inc";
}
?>
<br><br><font size="+1">SOAP Information</font>
<br><br><table width="90%">
<!-- <font size="4"> -->
<?php
echo "<tr><td>Date as YYYYMMDD <input type=\"text\" name=\"date\" size=\"8\" maxlength=\"8\" value=\"";
echo $date;
echo "\"></td><td> Temperature (can be one decimal) <input type=\"text\" name=\"temp\" size=\"5\" maxlength=\"5\" value=\"";
echo $temp;
echo "\"></td><td> Weight (can be one decimal) <input type=\"text\" name=\"weight\" size=\"5\" maxlength=\"5\" value=\"";
echo $weight;
echo "\"></td><td> Pulse <input type=\"text\" name=\"pulse\" size=\"2\" maxlength=\"2\" value=\"";
echo $pulse;
echo "\"></td><td> Respiration <input type=\"text\" name=\"resp\" size=\"3\" maxlength=\"3\" value=\"";
echo $resp;
echo "\"></td><td> Panting <SELECT name=\"pant\" size=\"2\"><option value=\"N\"";
if ($pant == "N") echo " SELECTED ";
echo ">No<option value=\"Y\"";
if ($pant == "Y") echo " SELECTED ";
echo ">Yes</select>";
echo "<input type=\"hidden\" name=\"client\" value=\"";
echo $client;
echo "\"><input type=\"hidden\" name=\"petid\" value=\"";
echo $petid;
echo "\"></td></tr>";
echo "<tr><td> Capillary Refill Time in Seconds <input type=\"text\" name=\"caprefill\" size=\"2\" maxlength=\"2\" value=\"";
echo $caprefill;
echo "\"></td><td> Mucous <input type=\"text\" name=\"mucous\" size=\"20\" maxlength=\"20\" value=\"";
echo $mucous;
echo "\"></td><td> Hydration <input type=\"text\" name=\"hydration\" size=\"20\" maxlength=\"20\" value=\"";
echo $hydration;
echo "\"></td><td> Will Pet be staying at Clinic for treatment <SELECT name=\"stay\" size=\"2\"><option value=\"N\"";
if ($stay == "N") echo " SELECTED ";
echo ">No</option><option value=\"Y\" ";
if ($stay == "Y") echo " SELECTED ";
echo ">Yes</option></select></td>";
echo "<td> Is this a Clinic Discharge visit <SELECT name=\"discharge\" size=\"2\"><option value=\"N\"";
if ($discharge == "N") echo " SELECTED ";
echo ">No</option><option value=\"Y\" ";
if ($discharge == "Y") echo " SELECTED ";
echo ">Yes</option></select></td></tr></table>";
echo "<br><br><center><b>Subjective Information</b></center>";
echo "<br><textarea name=\"subjective\" rows=\"5\" cols=\"200\">";
echo $subjective;
echo "</textarea>";
?>
<br><br><center><b>Objective Information</b></center>
<table width="90%">
<tr><td>Appearance: <input type="radio" name="appear" onClick="hide('idappear');" value="Normal"> Normal
<input type="radio" name="appear" value="Abnormal" onClick="show(`idappear`);"> Abnormal </td>
<td>Integument: <input type="radio" name="integument" onClick="hide(`idinteg`);" value="Normal"> Normal
<input type="radio" name="integument" value="Abormal" onClick="show(`idinteg`);"> Abnormal </td>
<td>Eyes: <input type="radio" name="eyes"  onClick="hide(`ideyes`);" value="Normal"> Normal
<?php
echo "<input type=\"radio\" name=\"eyes\" value=\"Abormal\" onClick=\"show(`ideyes`);\"> Abnormal </td>";
echo "<td>Ears: <input type=\"radio\" name=\"ears\" value=\"Normal\" onClick=\"hide(`idears`);\"> Normal ";
echo "<input type=\"radio\" name=\"ears\" value=\"Abnormal\" onClick=\"show(`idears`);\"> Abnormal </td>";
echo "<td>Dental: <input type=\"radio\" name=\"dental\" value=\"Normal\" onClick=\"hide(`iddental`);\"> Normal ";
echo "<input type=\"radio\" name=\"dental\" value=\"Abnormal\" onClick=\"show(`iddental`);\"> Abnormal </td></tr>";
?>
<tr><td><div id="idappear">If Abnormal<br>Appearance explain<textarea name="abnappear" rows="3" cols="10">
<?php
echo $abnappear;
echo "</textarea></div></td>";
echo "<td><div id=\"idinteg\">If Abnormal<br>Integument explain<textarea name=\"abninteg\" rows=\"3\" cols=\"10\">";
echo $abninteg;
echo "</textarea></div></td></td>";
echo "<td><div id=\"ideyes\">If Abnormal<br>Eyes explain<textarea name=\"abneyes\" rows=\"3\" cols=\"10\">";
echo $abneyes;
echo "</textarea></div></td>";
echo "<td><div id=\"idears\">If Abnormal<br>Ears explain<textarea name=\"abnears\" rows=\"3\" cols=\"10\">";
echo $abnears;
echo "</textarea></div></td>";
echo "<td><div id=\"iddental\">If Abnormal<br>Dental explain<textarea name=\"abndental\" rows=\"3\" cols=\"10\">";
echo $abndental;
echo "</textarea></div></td></tr>";
echo "<tr><td></td></tr>";

echo "<tr><td>Digestive: <input type=\"radio\" name=\"digestive\" value=\"Normal\" onClick=\"hide(`iddigest`);\"> Normal ";
echo "<input type=\"radio\" name=\"digestive\" value=\"Abormal\" onClick=\"show(`iddigest`);\"> Abormal </td>";
echo "<td>Genitourinary: <input type=\"radio\" name=\"genitour\" value=\"Normal\" onClick=\"hide(`idgenitour`);\"> Normal ";
echo "<input type=\"radio\" name=\"genitour\" value=\"Abormal\" onClick=\"show(`idgenitour`);\"> Abormal </td>";
echo "<td>Lymph: <input type=\"radio\" name=\"lymph\" value=\"Normal\" onClick=\"hide(`idlymph`);\"> Normal ";
echo "<input type=\"radio\" name=\"lymph\" value=\"Abormal\" onClick=\"show(`idlymph`);\"> Abormal </td>";
echo "<td>Cardiovascular: <input type=\"radio\" name=\"cardio\" value=\"Normal\" onClick=\"hide(`idcardio`);\"> Normal ";
echo "<input type=\"radio\" name=\"cardio\" value=\"Abormal\" onClick=\"show(`idcardio`);\"> Abormal </td>";
echo "<td>Respiratory: <input type=\"radio\" name=\"respir\" value=\"Normal\" onClick=\"hide(`idrespir`);\"> Normal ";
echo "<input type=\"radio\" name=\"respir\" value=\"Abormal\" onClick=\"show(`idrespir`);\"> Abormal </td></tr>";

echo "<tr><td><div id=\"iddigest\">If Abnormal<br>Digestive explain<textarea name=\"abndigestive\" rows=\"3\" cols=\"25\">";
echo $abndigestive;
echo "</textarea></div></td>";
echo "<td><div id=\"idgenitour\">If Abnormal<br>Genitour explain<textarea name=\"abngenitour\" rows=\"3\" cols=\"10\">";
echo $abngenitour;
echo "</textarea></div></td>";
echo "<td><div id=\"idlymph\">If Abnormal Lymph<br>explain<textarea name=\"abnlymph\" rows=\"3\" cols=\"10\">";
echo $abnlymph;
echo "</textarea></div></td>";
echo "<td><div id=\"idcardio\">If Abnormal<br>Cardiovascular explain<textarea name=\"abncardio\" rows=\"3\" cols=\"10\">";
echo $abncardio;
echo "</textarea></div></td>";
echo "<td><div id=\"idrespir\">If Abnormal<br>Respiratory explain<textarea name=\"abnrespir\" rows=\"3\" cols=\"10\">";
echo $abnrespir;
echo "</textarea></div></td></tr>";

echo "<tr><td>Neurologic: <input type=\"radio\" name=\"neurologic\" value=\"Normal\" onClick=\"hide(`idneuro`);\"> Normal ";
echo "<input type=\"radio\" name=\"neurologic\" value=\"Abormal\" onClick=\"show(`idneuro`);\"> Abormal </td>";
echo "<td>Musculoskeletal: <input type=\"radio\" name=\"mskel\" value=\"Normal\" onClick=\"hide(`idmskel`);\"> Normal ";
echo "<input type=\"radio\" name=\"mskel\" value=\"Abormal\" onClick=\"show(`idmskel`);\"> Abormal </td></tr>";

echo "<tr><td><div id=\"idneuro\">If Abnormal<br>Neurologic explain<textarea name=\"abnneuro\" rows=\"3\" cols=\"10\">";
echo $abnneuro;
echo "</textarea></div></td>";
echo "<td><div id=\"idmskel\">If Abnormal<br>Musculoskeletal explain<textarea name=\"abnmskel\" rows=\"3\" cols=\"10\">";
echo $abnmskel;
echo "</textarea></div></td></tr>";

echo "</table>";
echo "<br><textarea name=\"objective\" rows=\"5\" cols=\"200\">";
echo $objective;
echo "</textarea>";
echo "<center>Assessment Information</center>";
echo "<br><textarea name=\"assessment\" rows=\"5\" cols=\"200\">";
echo $assessment;
echo "</textarea>";
echo "<br><br><center>Plan Information</center>";
echo "<br><textarea name=\"Plan\" rows=\"5\" cols=\"200\">";
echo $plan;
echo "</textarea>";
echo "<input type=\"hidden\" name=\"prefilename\" value=\"";
echo $prefilename;
echo "\">";
?>
</div>
<!-- -->
<div id="proc">
<br><center><font size="+2"><b><u>Select Procedures Performed during this Visit</u></b></font></center>
<br><br>
If there were no Procedures performed, check this box <input type="checkbox" name="noprocs">
<br><br>
PLEASE NOTE: Procedures are only saved if this is a Final Report. Procedures are not saved for a Draft Report.
<br><br>
Add Procedures from the left listbox to the right listbox that you have performed during this Visit
<center><table width="50%">
<?php
switch($procdb) {
	case "V":
		include "includes/visitvproc.inc";
		break;
	case "P":
		include "includes/visitpproc.inc";
		break;
	case "N";
		break;
	default:
		put_errormsg("Internal error - Invalid Procedure DB Code");
		redirect("criticalerror.php?m=visitsnew1.php&ec=$procdb");
		exit();
		break;
}
?>
</table>
</div>
<div id="save">
<?php
if($procdb == "V") {
	include "includes/visitvadmin.inc";
}
if($procdb == "P") {
	include "includes/visitpadmin.inc";
}
?>
<input type="hidden" name="procdb" value="<?php echo $procdb;?>">
<br><br><center><input type="radio" name="save" value="draft">Save as Draft
<input type="radio" name="save" value="perm" CHECKED>Save as Final Report</center>
<br><br><center><input type="submit" value="Save Visit" onClick="selectitems($procdb)"></center><br><br>
</div><div id="cancel">
<center>Cancel and Return to the Main Menu</center>
</form><form method="post" action="mainmenu.php"><br><br><center><input type="submit" value="Return to the Main menu"></form>
</center></div>
<?php
require_once "includes/version.inc";
$emplnumber = $_SESSION["employeenumber"];
$display ="visitsnew:".$emplnumber;
require_once "includes/footer.inc";
echo "</body></html>";