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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
function pwdreq($pwd)
{
	$msg = "";
    if (strlen($pwd) < 8)
{
	$msg = "The Password must be at least 8 characters";
	return $msg;
}
$test = strpbrk ($pwd." " , "1234567890");
if ($test == true) {
	$testans = 1;
} else {
	$testans = 0;
}
$test = strpbrk ($pwd." " , "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
if ($test == true) {
	$testans = $testans + 1;
} else {
	$testans = $testans + 0;
}
$test = strpbrk ($pwd." " , "abcdefghijklmnopqrstuvwxyz");
if ($test == true) {
	$testans = $testans + 1;
} else {
	$testans = $testans + 0;
}
$test = strpbrk ($pwd." " , "()$*@!#^");
if ($test == true) {
	$testans = $testans + 1;
} else {
	$testans = $testans + 0;
}
if ($testans < 4) {
	$msg = "Refer to User manual for Password restrictions";
}
	return $msg;
}
?>