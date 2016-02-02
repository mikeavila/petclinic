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
require_once "includes/common.inc");
$editpetnum = $_GET["editpetnum"];
require_once "includes/expire.inc";
setcookie("editpetnum", $editpetnum, $expire1hr);
if (!is_numeric($editpetnum)) {
		$speciescd="";
		$speciescd = $_GET["speciescd"];
		setcookie("speciescd", $speciescd, $expire1hr);
}
redirect("petmaint.php");
?>