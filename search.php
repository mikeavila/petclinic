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
$background = "3";
include "includes/header1.inc";
include "includes/header2.inc";

echo '<div class="center"><h2 class="royalBlue">Search</h2></div>';
echo '<form method="post" action="search1.php">';
echo '<div class="center">';
echo '<fieldset><legend class="bold">Client Info:</legend>';
echo '<div class="fieldLabel searchLabel">Last name:</div><div class="searchField">Last Name</div><br>';
echo '<div class="fieldLabel searchLabel">Phone Number:</div><div class="searchField">Phone</div><br>';
echo '<div class="fieldLabel searchLabel">Zip Code:</div><div class="searchField">Zip Code</div>';
echo '</fieldset>';
echo '<fieldset><legend class="bold">Pet Info:</legend>';
echo '<div class="fieldLabel searchLabel">By Client Last Name:</div><div class="searchField">Pet Client Last</div><br>';
echo '<div class="fieldLabel searchLabel">By Name:</div><div class="searchField">Pet Name</div>';
echo '</fieldset>';
echo '<br><input type="submit" value="Process Request"></div>';
echo '</div></form><br>';
echo '<form method="post" action="mainmenu.php">';
echo '   <div class="center"><input type="submit" value="Return to Main menu"></div>';
echo '</form><br>';

$display="search: ";
include "includes/footer.inc";
?>