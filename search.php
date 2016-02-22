<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*PetClinic Management Software                                   *
*Copyrighted 2015-2016 by Paul Thursby                           *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$background = '3';

require_once 'includes/header1.inc';
require_once 'includes/header2.inc';

$clientLast   = empty($_POST['clientLast'])   ? '' : $_POST['clientLast'];
$clientPhone  = empty($_POST['clientPhone'])  ? '' : $_POST['clientPhone'];
$clientZip    = empty($_POST['clientZip'])    ? '' : $_POST['clientZip'];
$petName      = empty($_POST['petName'])      ? '' : $_POST['petName'];
$petLicense   = empty($_POST['petLicense'])   ? '' : $_POST['petLicense'];
$petMicrochip = empty($_POST['petMicrochip']) ? '' : $_POST['petMicrochip'];
$petRabies    = empty($_POST['petRabies'])    ? '' : $_POST['petRabies'];
$petTattoo    = empty($_POST['petTattoo'])    ? '' : $_POST['petTattoo'];

$searchResults = '';

if ( !empty($_POST) ) {
    $mysqli = new mysqli('localhost', $user, $password, '');

    $sql = "SELECT lname, phonenumber, zipcode, petname, license, microchip, rabiestag, tattoonumber,
                   petclinic.clientpet.clientnumber, petclinic.clientpet.petnumber
            FROM petclinic.clientpet JOIN petclinic.client USING (clientnumber)
            LEFT JOIN petclinic.pet USING(petnumber)
            LEFT JOIN petclinic.clientphone USING (clientnumber)
            WHERE lname='" . $clientLast . "' or
                  phonenumber='" . $clientPhone . "' or
                  zipcode='" . $clientZip . "' or
                  petname='" . $petName . "' or
                  license='" . $petLicense . "' or
                  microchip='" . $petMicrochip . "' or
                  rabiestag='" . $petRabies . "' or
                  tattoonumber='" . $petTattoo . "'";
//    echo $sql . '<br>';
    
    if ( $result = $mysqli->query($sql) ) {
        if ( $result->num_rows ) {
            $separator = '</td><td>';

            while ($row = $result->fetch_row() ) {
                $search_fields = array_slice($row, 0, count($row) - 2);
                $link_ids = array_slice($row, -2);

                $data = implode($separator, $search_fields);

                $data .= $separator . '<a href="clientmaint.php?searchEditClient=' . $link_ids[0] . '">Edit client</a>';
                $data .= $separator . '<a href="petmaint.php?searchEditPet=' . $link_ids[1] . '">Edit pet</a>';

                $searchResults .= '<tr><td>' . $data . '</td></tr>';
            }

            $searchResults .= $searchResults;
        }
        else {
            $searchResults = '<tr><td colspan="8">No results found</td></tr>';
        }
    }
    else {
        echo $mysqli->error;
    }

    $mysqli->close();
}

echo '<div class="center"><h2 class="royalBlue">Search</h2></div>';
echo '<form method="post" action="search.php">';
echo '<div class="center">';
echo '<fieldset><legend class="bold">Client Info:</legend>';
echo '<div class="fieldLabel searchLabel">Last name:</div>
        <div class="searchField"><input id="clientLast" name="clientLast" type="text" size="42" maxlength="40" placeholder="Last name" value="' . $clientLast . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">Phone Number:</div>
        <div class="searchField"><input id="clientPhone" name="clientPhone" type="text" size="15" maxlength="13" placeholder="Phone#" value="' . $clientPhone . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">Zip Code:</div>
        <div class="searchField"><input id="clientZip" name="clientZip" type="text" size="12" maxlength="10" placeholder="Zip Code" value="' . $clientZip . '"></div>';
echo '</fieldset>';
echo '<fieldset><legend class="bold">Pet Info:</legend>';
echo '<div class="fieldLabel searchLabel">Name:</div>
        <div class="searchField"><input id="petName" name="petName" type="text" size="17" maxlength="15" placeholder="Name" value="' . $petName . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">License Number:</div>
        <div class="searchField"><input id="petLicense" name="petLicense" type="text" size="17" maxlength="15" placeholder="License#" value="' . $petLicense . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">Micro Chip:</div>
        <div class="searchField"><input id="petMicrochip" name="petMicrochip" type="text" size="20" maxlength="18" placeholder="Micro Chip#" value="' . $petMicrochip . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">Rabies Tag:</div>
        <div class="searchField"><input id="petRabies" name="petRabies" type="text" size="12" maxlength="10" placeholder="Rabies Tag#" value="' . $petRabies . '">
        </div><br>';
echo '<div class="fieldLabel searchLabel">Tattoo Number:</div>
        <div class="searchField"><input id="petTattoo" name="petTattoo" type="text" size="12" maxlength="10" placeholder="Tattoo#" value="' . $petTattoo . '">
        </div>';
echo '</fieldset>';
echo '<br><input type="submit" value="Process Search Request">';
echo '</div></form><br>';

if ( !empty($searchResults) ) {
    $searchHeader = '<tr><th colspan="3">Client Info:</th><th colspan="5">Pet Info:</th></tr>';
    $searchHeader .= '<tr><th>Last Name</th><th>Phone Number</th><th>Zip Code</th><th>Name</th><th>License Number</th><th>Micro Chip</th><th>Rabies Tag</th><th>Tattoo Number</th></tr>';
    echo '<div class="center"><table class="searchResults"><caption><h3>Search Results</h3></caption>' . $searchHeader . $searchResults . '</table></div><br>';
}

echo '<form method="post" action="mainmenu.php">';
echo '   <div class="center"><input type="submit" value="Return to Main menu"></div>';
echo '</form><br>';

$display = 'search: ';
require_once 'includes/footer.inc';
?>