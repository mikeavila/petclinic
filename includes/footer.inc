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
if ( empty($display) ) {
	$display = '';
}
?>
<div id="footer" class="center">
	<div id="petclinicVersion" class="left">
	PetClinic Management Software Version 
	<?php
		include "version.inc";
		echo $version;
	?>
	</div>
	<div id="copyright">&copy;Copyright 2015-2016 Michael Avila and Paul Thursby </div>
	<div id="displayInfo"><?php echo $display; ?></div>
</div>
</body>
</html>