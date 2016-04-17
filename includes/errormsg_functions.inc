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
     $mysqliem = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
     $sql = "INSERT INTO `petclinicmsgs`.`errormsgs` (`ecc`, `errormessage`) VALUES ('".$_SESSION["ecc"]."', '$message');";
     if ($mysqliem->query($sql) == TRUE) {

     } else {
          echo "Error inserting into petclinicsys" . $mysqliem->error;
          exit(1);
     }
     $mysqliem->close();
}
function get_errormsg() {
     $message = "";
     include "includes/get_ecc.inc";
     $mysqliem = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
     $sql="SELECT errormessage FROM `petclinicmsgs`.`errormsgs` WHERE ecc = '".$_SESSION["ecc"]."';";
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
     include "includes/get_ecc.inc";
     $mysqliem = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
     $sql = "DELETE FROM `petclinicmsgs`.`errormsgs` WHERE `ecc` = '".$_SESSION["ecc"]."';";
     $result = $mysqliem->query($sql);
     $mysqliem->close();
}
?>