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
function put_errormsg($message) {
     include "password.php";
     include "get_ecc.inc";
     $mysqliem = new mysqli('localhost', $user, $password, '');
     $sql = "INSERT INTO `petclinicmsgs`.`errormsgs` (`ecc`, `errormessage`) VALUES ('$ecc', '$message');";
     if ($mysqliem->query($sql) == TRUE) {
     
     } else {
          echo "Error inserting into petclinicsys" . $mysqliem->error;
          exit(1);
     }
     $mysqliem->close();
}
function get_errormsg() {
     include "password.php";
     include "get_ecc.inc";
     $message = "";
     $mysqliem = new mysqli('localhost', $user, $password, '');
     $sql="SELECT errormessage FROM `petclinicmsgs`.`errormsgs` WHERE ecc = '$ecc';";
     $result = $mysqliem->query($sql);
     if ($result == true) {
          $row = $result->fetch_row();
          if($row[0] === NULL) {
               $message = "";
          } else {
               $message = $row[0];
          }
      }
     $mysqliem->close();
     return $message;
}
function delete_errormsg() {
     include "password.php";
     include "get_ecc.inc";
     $mysqliem = new mysqli('localhost', $user, $password, '');
     $sql = "DELETE FROM `petclinicmsgs`.`errormsgs` WHERE WHERE ecc = ".$ecc.";";
     $result = $mysqliem->query($sql);
     $mysqliem->close();
}
