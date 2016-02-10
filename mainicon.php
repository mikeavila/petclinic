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
$background = "1";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$display = 'MMenu: ' . $emplnumber;
$mysqlic = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`seckeys` WHERE `emplnumber` = $emplnumber and `sequence` = 1;";
$result = $mysqlic->query($sql);

if (!$result === FALSE)
{
    $row_cnt = $result->num_rows;
    $row = $result->fetch_row();
}
else {
	$row = array();
}

$mysqlic->close();

$apptOpt    = isset($row[1])  ? ( $row[1]  == 'Y' ?  1 : 0 ) : 0;
$phoneOpt   = 3;
$searchOpt  = isset($row[33]) ? ( $row[33] == 'Y' ? 33 : 0 ) : 0;
$clientOpt  = isset($row[2])  ? ( $row[2]  == 'Y' ?  2 : 0 ) : 0;
$listOpt    = isset($row[4])  ? ( $row[4]  == 'Y' ?  4 : 0 ) : 0;
$maintOpt   = isset($row[5])  ? ( $row[5]  == 'Y' ?  5 : 0 ) : 0;
$groomOpt   = isset($row[6])  ? ( $row[6]  == 'Y' ?  6 : 0 ) : 0;
$boardOpt   = isset($row[7])  ? ( $row[7]  == 'Y' ?  7 : 0 ) : 0;
$companyOpt = isset($row[10]) ? ( $row[10] == 'Y' ? 10 : 0 ) : 0;
$adminOpt   = isset($row[35]) ? ( $row[35] == 'Y' ? 12 : 0 ) : 0;
$menuOpt    = 'mo';
$logoffOpt  = 11;

echo '<div class="center">Petclinic Management</div>';
echo '<form method="post">';
echo '<div class="center">';
echo '<div class="mainItem"><div title="Appointments" id="appointmentImg" class="mainImg" data-menu="' . $apptOpt . '" onclick="sendmmnav(this); return false;"></div><div>Appointments</div></div>';
echo '<div class="mainItem"><div title="Phone Messages" id="phonemsgImg" class="mainImg" data-menu="' . $phoneOpt . '" onclick="sendmmnav(this);"></div><div>Phone Messages</div></div>';
echo '<div class="mainItem"><div title="Search" id="searchImg" class="mainImg" data-menu="' . $searchOpt . '" onclick="sendmmnav(this); return false;"></div><div>Search</div></div>';
echo '<div class="mainItem"><div title="Clients" id="clientsImg" class="mainImg" data-menu="' . $clientOpt . '" onclick="sendmmnav(this); return false;"></div><div>Clients</div></div>';
echo '<div class="mainItem"><div title="Listings" id="listingsImg" class="mainImg" data-menu="' . $listOpt . '" onclick="sendmmnav(this); return false;"></div><div>Listings</div></div>';
echo '<div class="mainItem"><div title="Maintenance" id="maintImg" class="mainImg" data-menu="' . $maintOpt . '" onclick="sendmmnav(this); return false;"></div><div>Maintenance</div></div>';
echo '<div class="mainItem"><div title="Grooming" id="groomingImg" class="mainImg" data-menu="' . $groomOpt . '" onclick="sendmmnav(this); return false;"></div><div>Grooming</div></div>';
echo '<div class="mainItem"><div title="Boarding" id="boardingImg" class="mainImg" data-menu="' . $boardOpt . '" onclick="sendmmnav(this); return false;"></div><div>Boarding</div></div>';
echo '<div class="mainItem"><div title="Company" id="companyImg" class="mainImg" data-menu="' . $companyOpt . '" onclick="sendmmnav(this); return false;"></div><div>Company</div></div>';
echo '<div class="mainItem"><div title="System Admin" id="systemadminImg" class="mainImg" data-menu="' . $adminOpt . '" onclick="sendmmnav(this); return false;"></div><div>System Admin</div></div>';
echo '<div class="mainItem"><div title="Main Menu" id="menuImg" class="mainImg" data-menu="' . $menuOpt . '" onclick="sendmmnav(this); return false;"></div><div>Main Menu</div></div>';
echo '<div class="mainItem"><div title="Logoff" id="logoffImg" class="mainImg" data-menu="' . $logoffOpt . '" onclick="sendmmnav(this);"></div><div>Logoff</div></div>';
echo '</div></form>';
echo '<div><font size="+2" color="red">';
include "includes/display_errormsg.inc";
echo '</font></div>';
require_once "includes/helpline.inc";
help("mainicon.php");
require_once "includes/footer.inc";
?>