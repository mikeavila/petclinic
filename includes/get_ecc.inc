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
if (isset($_SESSION["ecc"])) {
     $ecc = $_SESSION["ecc"];
} else {
     $tempecc = date('zHis');
     $ecc = $tempecc;
     $_SESSION["ecc"] = $ecc; }
?>