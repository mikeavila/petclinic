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

$clientLast   = '';
$clientPhone  = '';
$clientZip    = '';
$petName      = '';
$petLicense   = '';
$petMicrochip = '';
$petRabies    = '';
$petTattoo    = '';

$searchResults = '';

if ( !empty($_POST) ) {
$clientLast   = trim($_POST['clientLast']);
$clientPhone  = trim($_POST['clientPhone']);
$clientZip    = trim($_POST['clientZip']);
$petName      = trim($_POST['petName']);
$petLicense   = trim($_POST['petLicense']);
$petMicrochip = trim($_POST['petMicrochip']);
$petRabies    = trim($_POST['petRabies']);
$petTattoo    = trim($_POST['petTattoo']);

$useClientInfo = ( !empty($clientLast) || !empty($clientPhone) || !empty($clientZip) );
$usePetInfo = ( !empty($petName) || !empty($petLicense) || !empty($petMicrochip) || !empty($petRabies) || !empty($petTattoo) );

    $mysqli = new mysqli('localhost', $user, $password, '');
    $db_rows = 0;
    $sql = '';

    if ( ($useClientInfo && $usePetInfo) || $usePetInfo ) {
    // We have data in both areas, or at least petInfo. We should not have any pet data without a client!!
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
    }
    else if ( $useClientInfo && !$usePetInfo ) { // We only have client data (might not yet have any pet entries)
        $sql = "SELECT lname, phonenumber, zipcode, petname, license, microchip, rabiestag, tattoonumber,
                       petclinic.clientpet.clientnumber, petclinic.clientpet.petnumber
                FROM petclinic.client JOIN petclinic.clientphone USING (clientnumber)
                LEFT JOIN petclinic.clientpet USING (clientnumber)
                LEFT JOIN petclinic.pet USING(petnumber)
                WHERE lname='" . $clientLast . "' or
                      phonenumber='" . $clientPhone . "' or
                      zipcode='" . $clientZip . "'";
    }
//    echo $sql . '<br>';

    if ( !empty($sql) ) {
        if ( $result = $mysqli->query($sql) ) {
            $db_rows = $result->num_rows;
            if ( $db_rows ) {
                $i = 0;
                $separator = '</td><td>';

                while ($row = $result->fetch_array() ) {
                    $data  = $row['lname'];
                    $data .= $separator . $row['phonenumber'];
                    $data .= $separator . $row['zipcode'];
                    $data .= $separator . $row['petname'];
                    $data .= $separator. $row['license'];
                    $data .= $separator . $row['microchip'];
                    $data .= $separator. $row['rabiestag'];
                    $data .= $separator. $row['tattoonumber'];

                    $data .= $separator . '<a href="clientmaint.php?editclientnum=' . $row['clientnumber'] . '">Edit client</a>';

                    if ( !empty($row['petnumber']) ) {
                        $data .= $separator . '<a href="petmaint.php?editpetnum=' . $row['petnumber'] . '">Edit pet</a>';
                    }
                    else {
                        $data .= $separator . '&nbsp;';
                    }

                    $searchResults .= '<tr><td>' . ++$i . '.</td><td>' . $data . '</td></tr>';
                }
            }
            else {
                $searchResults = '<tr><td colspan="9">No results found</td></tr>';
            }
        }
        else {
            echo $mysqli->error;
        }

        $mysqli->close();
    }
    else {
        $searchResults = '<tr><td colspan="9">No criteria specified.</td></tr>';
    }
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
    $matches = '';

    if ( !empty($db_rows) ) {
        $matches = ': ( Found ' . $db_rows . ( $db_rows == 1 ? ' entry': ' entries' ) . ' )';
    }

    $searchHeader = '<tr><th colspan="4">Client Info:</th><th colspan="5">Pet Info:</th></tr>';
    $searchHeader .= '<tr><th>&nbsp;</th><th>Last Name</th><th>Phone Number</th><th>Zip Code</th><th>Name</th><th>License Number</th><th>Micro Chip</th><th>Rabies Tag</th><th>Tattoo Number</th></tr>';
    echo '<div class="center"><table class="searchResults"><caption><h3>Search Results' . $matches . '</h3></caption>' . $searchHeader . $searchResults . '</table></div><br>';
}

echo '<form method="post" action="mainmenu.php">';
echo '   <div class="center"><input type="submit" value="Return to Main menu"></div>';
echo '</form><br>';

$display = 'search: ';
require_once 'includes/footer.inc';
?>