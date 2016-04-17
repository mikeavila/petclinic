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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/header1.inc";
?>
<script type="text/javascript">
	$(document).ready(function() {
		// validate signup form on keyup and submit
		var validator = $("#docform").validate({
			rules: {
				doctorinfo: {
					required: true,
					minlength: 10
				},
                docstatelic: {
                    required: true,
                    minlength: 5
                },
                doctorstatus: {
                    required: true,
                    pattern: /^(A|I|D)$/
                }
            },
			messages: {
                doctorinfo: {
                    required: "Enter the Doctor&#39;s Information"
                },
                docstatelic: {
                    required: "Enter the Doctor&#39;s State License"
                },
                status: {
                    required: "Enter the Doctor&#39;s Status (A or I or D)"
                }
			},
			// the errorPlacement has to take the table layout into account
			errorPlacement: function(error, element) {
				if (element.is(":radio"))
					error.appendTo(element.parent().next().next());
				else if (element.is(":checkbox"))
					error.appendTo(element.next());
				else
					error.appendTo(element.parent().next());
			},
			// specifying a submitHandler prevents the default submit, good for the demo
			submitHandler: function() {
				//alert("submitted!");
                    //continueon();
			},
			// set this class to error-labels to indicate valid fields
			success: function(label) {
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			},
			highlight: function(element, errorClass) {
				$(element).parent().next().find("." + errorClass).removeClass("checked");
			}
		});
          return false;
	});
function continueon() {
     var docnumber = $("input#docnumber").val();
     var doctorinfo = $("input#doctorinfo").val();
     var docstatelic = $("input#docstatelic").val();
     var docdea = $("input#docdea").val();
     var doctorstatus = $("input#doctorstatus").val();
     var emplnumber = $("input#emplnumber").val();
     var dataString = "&docnumber=" + docnumber + "&doctorinfo=" + doctorinfo + "&docstatelic=" + docstatelic + "&docdea=" + docdea +
          "&doctorstatus=" + doctorstatus + "&emplnumber=" + emplnumber;
  $.ajax({
      type: "POST",
      url: "doctors2.php",
      data: dataString,
      cache: false,
      done: fakeit()
  });

  return false;
}
function fakeit() {
     window.location.href="doctors2.php?done=1";
     return;
}
</script><?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
?>
<br><br><center><b>Medicine Inventory Create Base Record</b></center>
<br><br>
The Base Record will have all Medicine Inventory transactions update its values. You can create the base record with Medicine
Inventory already in stock or use a Medicine Inventory transaction to update the base record.
<br><br>
<?php
$u="";
if(isset($_GET["u"])) {
	$u = $_GET["u"];
}
if($u=="u") {
	echo "<center><form method='get' action='invmedbase.php?u=y'>";
	$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
	$sql = "SELECT `medid`,`meddesc` FROM `petclinicinv`.`invmedicine` WHERE `status` = 'A';";
	$result = $mysqli->query($sql);
	if ($result == FALSE) {
		put_errormsg("There are no Medicines in the Medicine Inventory");
		redirect("invmedmenu.php");
		exit();
	}
	$row_cnt = $result->num_rows;
	if($row_cnt==0) {
		put_errormsg("There are no Medicines in the Medicine Inventory");
		redirect("invmedmenu.php");
		exit();
	}
	echo "Select the Base Record that you want to Modify";
	echo "<SELECT id='baserec' name='baserec' size='5'>";
	$row = $result->fetch_row();
	for ($i = 0; $i < $row_cnt; $i++) {
    	$row = $result->fetch_row();
        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
	$mysqli->close();
	echo "<input type='submit' value='Process Request'>";
	echo "</SELECT>";
	echo "</form></center>";
	exit();
}
if($u = "y") {
	$baserec = $_GET["baserec"];
	$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
	$sql = "SELECT * FROM `petclinicinv`.`invmedicine` WHERE `medid` = ".$baserec.";";
	$result = $mysqli->query($sql);
	if ($result == FALSE) {
		put_errormsg("Invalid medid");
		redirect("invmedmenu.php");
		exit();
	}
	$row_cnt = $result->num_rows;
	if($row_cnt==0) {
		put_errormsg("Invalid medid");
		redirect("invmedmenu.php");
		exit();
	}
	$row = $result->fetch_row();
/*
 	`medid` integer (5) NOT NULL AUTO_INCREMENT,
	`meddesc` varchar(32) NOT NULL,
    `vendorid` integer(11),
	`wherebought` varchar(50),
	`purdate` integer(8),
	`cartoncost` decimal(5,2),
	`cartonspurch` integer(3),
	`containercarton` integer(3) NOT NULL,
	`itemscontainer` integer(4) NOT NULL,
	`itemcost` decimal(5,2),
	`containercost` decimal(6,2),
	`itemreorderlevel` integer(3) NOT NULL,
	`itemmarkup` decimal(3,2) NOT NULL,
	`containermarkup` decimal(3,2) NOT NULL,
	`itemsalesprice` decimal(6,2) NOT NULL,
	`containersalesprice` decimal(6,2) NOT NULL,
	`taxable` char(1) NOT NULL DEFAULT \"Y\",
	`status` char(1) NOT NULL DEFAULT \"A\",
 */
	$desc = $row[1];
	$purchdate = $row[4];
	$cartoncost = $row[5];
	$contcost = $row[10];
	$cartonspurch = $row[6];
	$contcarton = $row[7];
	$itemcont = $row[8];
	$itemcost = $row[9];
	$itemreorder = $row[11];
	$itemmarkup = $row[12];
	$contmarkup = $row[13];
	$itemsales = $row[14];
	$contsales = $row[15];
	$status = $row[17];
	$mysqli->close();
	echo "<form method='post' action='invmedbase2.php'><table width='80%'>";
} else {
	$desc = "";
	$purchdate = "";
	$cartoncost = "0.00";
	$contcost = "0.00";
	$cartonspurch = "0";
	$contcarton = "0";
	$itemcont = "0";
	$itemcost = "0.00";
	$itemreorder = "0";
	$itemmarkup = "0.00";
	$contmarkup = "0.00";
	$itemsales = "0.00";
	$contsales = "0.00";
	$status = "A";
	echo "<form method='post' action='invmedbase1.php'><table width='80%'>";
}
?>
<tr><td>Enter the Description <input type="text" name="desc" size="40" maxlength="40" value="<?php echo $desc;?>"></td>
<td>Enter where the Medicine is usually purchased <SELECT name="wherebought" size="3">
<?php
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT `vendorid`,`vendorshortname` FROM `petclinicinv`.`vendor` WHERE `vendorstatus` = 'A';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
echo '<option value="0">Unknown</option>';
} else {
	echo '<option value="0">Unknown</option>';
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
     echo '<option value="0">Unknown</option>';
     } else {
          for ($i = 0; $i < $row_cnt; $i++) {
               $row = $result->fetch_row();
               echo '<option value="'.$row[0].'?'.$row[1].'">'.$row[1].'</option>';
          }
     }
}
$mysqli->close();
?>
</select></td>
<tr>
     <td class="label">
         <label for="purchdate">
             Enter the last purchase date (YYYYMMDD)
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
<tr>
     <td class="label">
         <label for="cartoncost">
             Carton Cost (2 decimal)
         </label>
     </td>
     <td class="field">
         <input id="cartoncost" name="cartoncost" type="text" size="6" maxlength="6" value="<?php echo $cartoncost;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="contcost">
             Container Cost (2 decimal)
         </label>
     </td>
     <td class="field">
         <input id="contcost" name="contcost" type="text" size="6" maxlength="6" value="<?php echo $contcost;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="cartonspurch">
             Cartons Purchased
         </label>
     </td>
     <td class="field">
         <input id="cartonspurch" name="cartonspurch" type="text" size="3" maxlength="3" value="<?php echo $cartonspurch;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="contcarton">
             How many containers are in a carton
         </label>
     </td>
     <td class="field">
         <input id="contcarton" name="contcarton" type="text" size="3" maxlength="3" value="<?php echo $contcarton;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemcont">
             How many items are in a container
         </label>
     </td>
     <td class="field">
         <input id="itemcont" name="itemcont" type="text" size="4" maxlength="4" value="<?php echo $itemcont;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemcost">
             What is the cost per item (2 decimal)
         </label>
     </td>
     <td class="field">
         <input id="itemcost" name="itemcost" type="text" size="6" maxlength="6" value="<?php echo $itemcost;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemreorder">
             What is the Item Reorder Level
         </label>
     </td>
     <td class="field">
         <input id="itemreorder" name="itemreorder" type="text" size="3" maxlength="3" value="<?php echo $itemreorder;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemmarkup">
             What is the Item Markup from cost as a percent
         </label>
     </td>
     <td class="field">
         <input id="itemmarkup" name="itemmarkup" type="text" size="4" maxlength="4" value="<?php echo $itemmarkup;?>">%
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemmarkup">
             What is the Item Markup from cost as a percent
         </label>
     </td>
     <td class="field">
         <input id="itemmarkup" name="itemmarkup" type="text" size="4" maxlength="4" value="<?php echo $itemmarkup;?>">%
     </td>
     <td class="status">
     </td>
</tr><tr>
     <td class="label">
         <label for="contmarkup">
            What is the Container Markup from cost as a percent
         </label>
     </td>
     <td class="field">
         <input id="contmarkup" name="contmarkup" type="text" size="4" maxlength="4" value="<?php echo $contmarkup;?>">%
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="itemsales">
             What is the Item Sales Price (2 decimal)
         </label>
     </td>
     <td class="field">
         <input id="itemsales" name="itemsales" type="text" size="6" maxlength="6" value="<?php echo $itemsales;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="contsales">
             What is the Container Sales Price (2 decimal)
         </label>
     </td>
     <td class="field">
         <input id="contsales" name="contsales" type="text" size="6" maxlength="6" value="<?php echo $contsales;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="status">
             Status (A or D)
         </label>
     </td>
     <td class="field">
         <input id="status" name="status" type="text" size="1" maxlength="1" value="<?php echo $status;?>">
     </td>
     <td class="status">
     </td>
</tr>
<tr><td>Is the Item Taxable <SELECT name="taxable" size="2"><option value="Y">Yes</option><option value="N">No</option></select></td></tr></table>
<br><br>
<?php include "includes/display_errormsg.inc"; ?>
<br><br>
<input type="submit" value="Create/Update Medicine Base Record"></form>

<form method="post" action="mainmenu.php"><input type="submit" value="Return to the Main Menu"></form>
<?php
require_once "includes/display_errormsg.inc";
require_once "includes/helpline.inc";
help("invmedbase.php");
$emplnumber = $_SESSION["employeenumber"];
$display ="invmedbase:".$emplnumber;
require_once "includes/footer.inc";
?>