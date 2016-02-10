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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$mysqli = new mysqli('localhost', $user, $password, '');
?>
<form id="petform" name="petform">
<table cellpadding="5" cellspacing="5" width="90%">
<tr><td align="right">Pet Number</td><td><input type="text" name="editpetnum" size="4" maxlength="4" READONLY value="<?php echo $editpetnum; ?>"></td>
     <td class="label">
         <label for="petname">
             Pet Name 
         </label>
     </td>
     <td class="field">
         <input id="petname" name="petname" type="text" size="15" maxlength="15" value="<?php echo $petname;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="dobm">
             Date of Birth Month
         </label>
     </td>
     <td class="field">
         <input id="dobm" name="dobm" type="text" size="2" maxlength="2" value="<?php echo $dobm;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="dobd">
             Date of Birth Day
         </label>
     </td>
     <td class="field">
         <input id="dobd" name="dobd" type="text" size="2" maxlength="2" value="<?php echo $dobd;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="dobm">
             Date of Birth Year
         </label>
     </td>
     <td class="field">
         <input id="doby" name="doby" type="text" size="2" maxlength="2" value="<?php echo $doby;?>"> 
     </td>
     <td class="status">
     </td>
<?php
if (!is_numeric($editpetnum)) {
	$speciescd = $_COOKIE["speciescd"];
	$speciesname = substr($speciescd, 1);
	$speciescode = substr($speciescd, 0, 1);
} else {
	$sql = "SELECT * FROM `petclinic`.`code_species` WHERE `speciescode` = \"".$petspecies."\";";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Internal error for code_species");
          redirect("mainmenu.php");           
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Internal error for code_species");
          redirect("mainmenu.php");           
		exit();
	}
	$speciesname = "";
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		if ($petspecies == $row[0]) {
			$speciesname = $row[1];
			$speciescode = $petspecies;
			break;
		}
	}
}
?>
<td align="right">Species</td><td><input type="text" name="petspecies" size="20" maxlength="20" READONLY value="<?php echo $speciesname;?>">
<input type="hidden" name="petspecies" value="<?php echo $speciescode;?>"></td><td align="right"> Breed 
<SELECT name="petbreed" size="3">
<?php
$sql = "SELECT * FROM `petclinic`.`code_breed` WHERE `breedcode` LIKE \"".$speciescode."%\" ORDER BY `breeddesc`;";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Internal error for code_breed");
          redirect("mainmenu.php");           
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Internal error for code_breed");
          redirect("mainmenu.php");           
		exit();
	}
	$petbreed1 = $petbreed;
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$petbreed = substr($row[0], 1, 2);
		echo "<option value=\"".$petbreed."\"";
		if ($petbreed1 <> "") {
			if ($petbreed == $petbreed1) {
				echo " SELECTED ";
			}
		}
		echo ">".$row[1]."</option>";
	}
?>
</select></td><td> Gender <select name="petgender" size="2">
<?php
	echo '<option value="M"' . ($petgender == "M" ? ' selected' : '') . '>Male</option>';
	echo '<option value="F"' . ($petgender == "F" ? ' selected' : '') . '>Female</option>';
     echo '</select></td>';
     echo '<td align="right"> Fixed <select name="petfixed" size="2">';
     echo '<option value="Y"' . ($petfixed == "Y" ? ' selected' : '') . '>Yes</option>';
     echo '<option value="N"' . ($petfixed == "N" ? ' selected' : '') . '>No</option>';
?>
</select></td></tr>
<tr><td align="right"> Description <input name="petdesc" type="text" size="50" maxlength="50" value= "<?php echo $petdesc; ?>">
</td><td align="right"> Color </td><td><input name="petcolor" type="text" size="20" maxlength="20" value= "<?php echo $petcolor;?>"></td></tr>
<tr><td align="right">License <input name="license" type="text" size="15" maxlength="15" value= "<?php echo $license; ?>">
<td align="right"> Microchip <input name="microchip" type="text" size="18" maxlength="18" value= "<?php echo $microchip; ?>">
</td><td> RabiesTag <input name="rabiestag" type="text" size="10" maxlength="10" value= "<?php echo $rabiestag; ?>">
</td><td> Tattoo Number <input name="tattoonumber" type="text" size="10" maxlength="10" value= "<?php echo $tattoonumber; ?>">
<td><td> Picture <input name="picture" type="text" size="1" maxlength="1" value= "<?php echo $picture; ?>">
</td><td> Status <input type="text" name="status" size="1" maxlength="1" value="<?php echo $status; ?>"></td></tr>
<?php
$sqlclient="SELECT * FROM `clientpet` WHERE `petnumber` = \"".$editpetnum."\";";
$resultpc = $mysqli->query($sqlclient);
$clientpc = array_fill(0, 10, "");
if ($resultpc <> FALSE)
	{
	$row_cntpc = $resultpc->num_rows;
	if ($row_cntpc == 0) {
		$clientpc[$i] = "";
	} else {
		for ($i = 0; $i < $row_cntpc; $i++) {
			$rowpc = $resultpc->fetch_row();
			$clientpc[$i] = $rowpc[$i];
		}	
	}				
} else {
	$clientpc[0] = "";
}
?>		
<tr><td><center><a href="petmaintc.php" target="_blank"> Click Here </a> to get a list of Clients</td></tr>
<tr><td>This pet belongs to the this/these client/clients; enter the client number(s) <input type="text" name="client1" size="5" maxlength="5" value="<?php echo $clientpc[0]; ?>">
 <input type="text" name="client2" size="5" maxlength="5" value="<?php echo $clientpc[1]; ?>"></td></tr>
<?php
if (is_numeric($editpetnum)) {
	echo "<tr><td>Do you want to upload a picture of the pet? <SELECT name=\"petpic\" size=\"2\">";
     echo "<option value=\"N\" SELECTED>No</option><option value=\"Y\">Yes</option></select></td></tr>";
     echo "<input type=\"hidden\" name=\"petid\" value=\"".$editpetnum."\">";
}
echo "</table>";
echo "<center><input type=\"submit\" value=\"Create/Update Pet\"></form>";
echo "<center><form action=\"maintmenu.php\"><input type=\"submit\" value=\"Return to Maint Menu\"></form><center>";
include "includes/display_errormsg.inc";
$mysqli->close();
?>