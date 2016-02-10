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
$background = "3";
require_once "includes/header1.inc";
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
?>
<br><br><center><b><u>Medicine Inventory Create Base Record</u></b></center>
<br><br>
The Base Record will have all Medicine Inventory transactions update its values. You can create the base record with Medicine 
Inventory already in stock or use a Medicine Inventory transaction to update the base record.
<br><br>
<form method="post" action="invmedbase1.php"><table width=80%>
<tr><td>Enter the Description <input type="text" name="desc" size="40" maxlength="40"></td>
<td>Enter where the Medicine is usually purchased <SELECT name="wherebought" size="3">
<?php
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT `vendorid`,`short_name` FROM `petclinicinv.contacts` WHERE `vendorstatus` = 'A';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
echo '<option value="0">Unknown</option>';
} else {
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
     echo '<option value="0">Unknown</option>';
     } else {
          for ($i = 0; $i < $row_cnt; $i++) {
               $row = $result->fetch_row();
               echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
          }
     }
}
$mysqli->close();
?>
</select></td>
<tr>
     <td class="label">
         <label for="purchdate">
             Enter the last purchase date (YYYMMDD) 
         </label>
     </td>
     <td class="field">
         <input id="purchdate" name="purchdate" type="text" size="8" maxlength="8" value="<?php echo $purchdate;?>"> 
     </td>
     <td class="status">
     </td>
</tr></table>
<br><br>
<center><b>Be sure to read and understand the concept of Carton<>Container<>Item on the help page.</b>
<br>The Carton Cost, the Cartons Purchased, the Cost per Item, and Container Cost are optional but the remaining fields must be entered. 
They control inventory reordering and sales price. However, if you want an Inventory Record created for the Accounting Module,
you must enter ALL of the information.</center>
<br><br>
<table width=70%>
<!---------------------------------------

<tr>
     <td class="label">
         <label for="prefix">
             Prefix (such as Dr) 
         </label>
     </td>
     <td class="field">
         <input id="prefix" name="prefix" type="text" size="4" maxlength="4" value="<?php echo $prefix;?>"> 
     </td>
     <td class="status">
     </td>
</tr>

--------------------------------------------->
<tr><td>Carton Cost <input type="text" name="cartoncost1" size="3" maxlength="3">.
<input type="text" name="cartoncost2" size="2" maxlength="2"></td>

<td>Container Cost <input type="text" name="contcost1" size="4" maxlength="4">.
<input type="text" name="contcost2" size="2" maxlength="2"></td></tr>

<tr><td>Cartons Purchased <input type="text" name="cartonspurch" size="3" maxlength="3"></td>

<td>How many containers are in a carton <input type="text" name="contcarton" size="3" maxlength="3"></td></tr>

<tr><td>How many items are in a container <input type="text" name="itemcont" size="4" maxlength="4"></td>

<td>What is the cost per item <input type="text" name="itemcost1" size="3" maxlength="3">.
<input type="text" name="itemcost2" size="2" maxlength="2"></td></tr>

<tr><td>What is the Item Reorder Level <input type="text" name="itemreorder" size="3" maxlength="3"></td>

<td>What is the Item Markup from cost as a percent <input type="text" name="itemmarkup1" size="1" maxlength="1">
.<input type="text" name="itemmarkup2" size="2" maxlength="2"></td></tr>

<tr><td>What is the Container Markup from cost as a percent <input type="text" name="contmarkup1" size="1" maxlength="1">
.<input type="text" name="contmarkup2" size="2" maxlength="2"></td></tr>

<tr><td>What is the Item Sales Price <input type="text" name="itemsales1" size="4" maxlength="4">.
<input type="text" name="itemsales2" size="2" maxlength="2"></td>

<td>What is the Container Sales Price <input type="text" name="contsales1" size="4" maxlength="4">.
<input type="text" name="contsales2" size="2" maxlength="2"></td></tr>

<tr><td>Is the Item Taxable <SELECT name="taxable" size="2"><option value="Y">Yes</option><option value="N">No</option></select></td></tr>

<tr><td>Do you want an Inventory Record created for the Accounting Module 
<SELECT name="acctg"><option value="Y" SELECTED>Yes</option><option value="N" >No</option></select></td></tr>

</table><br><br><br><br><font size="+2" color="red">
<?php include "includes/display_errormsg.inc"; ?>
</font><br><br>
<input type="submit" value="Create Medicine Base Record"></form>

<form method="post" action="mainmenu.php"><input type="submit" value="Return to the Main Menu"></form>
<?php
require_once "includes/helpline.inc";
help("invmedbase.php");
$emplnumber = $_COOKIE["employeenumber"];
$display ="invmedbase:".$emplnumber;
require_once "includes/footer.inc";
?>