<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*PetClinic Management Software                                   *
*Copyrighted 2015 by Michael Avila                       *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
session_start();
$background="3";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
require_once "includes/errormsg_functions.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$client = $_GET["client"];
$petid = $_GET["petid"];
$errormsg = $_COOKIE["errormessage"];
require_once "includes/expire.inc";
echo $subjective = "";
$date = date('Ymd');
$temp = "";
$weight = "";
$pulse = "";
$pant = "N";
$resp = "";
$caprefill = "";
$mucous = "";
$hydration = "";
echo "<br><br>";
echo "<form method=\"post\" action=\"visitspre1.php\">";
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
echo "\">";
echo "<center><b><u>Subjective Observations</u></b>";
echo "<br><br><textarea name=\"subjective\" rows=\"5\" cols=\"200\">";
echo $subjective;
echo "</textarea></center>";
echo "<input type=\"hidden\" name=\"client\" value=\"";
echo $client;
echo "\"><input type=\"hidden\" name=\"petid\" value=\"";
echo $petid;
echo "\">";
echo "<center><input type=\"submit\" value=\"Save Report\"></center></form>";
?>