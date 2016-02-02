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
echo '</head><body';
if ($background <> "") {
	echo ' background="/petclinic/pictures/' . $background . '"';
}
if (isset($body)) echo $body;
echo '><div id="appHeader"><div id="appImg" class="left"><img src="/petclinic/pictures/petclinic.png"></div>';
echo '<div id="clinicName" class="center"><h2>' . $coname . '</h2></div><div id="logoImg" class="right">';

if (strlen($logo > 0)) {
	echo '<img src="/petclinic/pictures/' . $logo . '">';
}
else {
	echo '&nbsp;';
}
echo '</div></div>';
?>