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
$resetMsg = 'Are you sure you want to delete all of the databases?';
$pageMsg = 'Petclinic Database Reset';

$user = '';
$password = '';

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head><title>' . $pageMsg . '</title></head>';
echo '<body><h2>' . $pageMsg . '</h2>';

if ( !empty($_POST) ) {
   $user = trim($_POST['user']);
   $password = trim($_POST['pass']);
   resetSystem();
}

if ( file_exists('password.txt') ) {
   // The file is present, so try to use it!
   require_once 'password.txt';
   resetSystem();
}
else {
   // File NOT found, so provide a form.
   echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" onsubmit="return confirm(\'' . $resetMsg . '\');">';
   echo '<div>DB user: <input id="user" name="user" type="text"></div><br>';
   echo '<div>DB pass: <input id="pass" name="pass" type="password"></div><br>';
   echo '<div><input id="resetDB" name="resetDB" type="submit" value="Reset DB"></div>';
   echo '</form><br>';
}

echo '</body></html>';

function resetSystem() {
    global $user, $password;

    $mysqli = @new mysqli('localhost', $user, $password, '');

    if ( $mysqli->connect_errno ) {
        echo 'Connectivity trouble: ' . $mysqli->connect_error;
    }
    else {
        echo 'Resetting system...<br><br>';

        $dbList = array('petclinicsys', 'petclinicproc', 'petclinic', 'petcliniccorp',
                        'petclinicinv', 'petclinicvendor', 'petclinicapptclinic',
                        'petclinicapptboard', 'petclinicapptgroom', 'petclinicdocmgmt',
                        'petclinicinvoices', 'petcliniclang', 'venom', 'petclinicmsgs', 'petclinicreg');

        $total = count( $dbList );

        for ( $i = 0; $i < $total; $i++ ) {
            $sql = 'DROP DATABASE IF EXISTS `' . $dbList[$i] . '`;';

            print '<div>Dropping database: ' . $dbList[$i] . ' ...';

            if ( $mysqli->query( $sql ) === TRUE ) {
                print 'done.';
            }

            print '</div>';
        }

        echo '<br>Reset complete!<br><br>';
    }
}
/*
DROP DATABASE `vetcliniccorp`;
DROP DATABASE `vetclinicappt`;
DROP USER 'username'@'localhost';

CREATE DATABASE IF NOT EXISTS `petclinicsys`;
CREATE DATABASE IF NOT EXISTS `petclinicproc`;
CREATE DATABASE IF NOT EXISTS `petclinic`;
CREATE DATABASE IF NOT EXISTS `petcliniccorp`;
CREATE DATABASE IF NOT EXISTS `petcliniclang`;
CREATE DATABASE IF NOT EXISTS `petclinicinvoices`;
CREATE DATABASE IF NOT EXISTS `petclinicinv`;
CREATE DATABASE IF NOT EXISTS `petclinicdocmgmt`;
CREATE DATABASE IF NOT EXISTS `petclinicapptgroom`;
CREATE DATABASE IF NOT EXISTS `petclinicapptclinic`;
CREATE DATABASE IF NOT EXISTS `petclinicapptboard`;
CREATE DATABASE IF NOT EXISTS `petclinicvendor`;
CREATE DATABASE IF NOT EXISTS `venom`;
*/
?>