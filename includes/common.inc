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
require_once "password.inc";
require_once "key.inc";
require_once "de.inc";
require_once "en.inc";
if(!isset($_SESSION["user"])) {
	$_SESSION["user"] = $user;
}
if(!isset($_SESSION["up"])) {
	$_SESSION["up"] = mc_encrypt(mc_decrypt($password, p_key), ps_key);
}
require_once "errormsg_functions.inc";
require_once "redirect_function.inc";
// includes WITH FUNCTIONS go ABOVE this line
// includes WITHOUT FUNCTIONS go BELOW this line
require_once "get_ecc.inc";
require_once "logfileinit.inc";
require_once "userlog.inc";
require_once "version.inc";
?>