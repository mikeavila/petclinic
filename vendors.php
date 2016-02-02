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
?>
<script>
	$(document).ready(function() {
		// validate signup form on keyup and submit
		var validator = $("#clientform").validate({
			rules: {
				vendorname: {
					required: true,
					minlength: 3
				},
                    vendorshortname: {
                         required: true,
                         minlength: 3
                    },
                    vendoraddress1: {
                         required: true,
                         minlenghth: 4
                    },
                    vendorcity: {
                         required: true,
                         minlength: 4
                    },
                    vendorzipcode: {
                         required: true,
                         minlength: 5,
                         maxlength: 10
                    },
                    vendortele: {
                         required: true,
                         phoneUS: true
                    }
               },
			messages: {
                    vendorname: {
                         required: "Enter the Vendor Company Name"
                    },
                    vendorshortname: {
                         required: "Enter the Vendor Company Short Name"
                    },
                    vendoraddress1: {
                         required: "Enter the Vendor Address"
                    },
				vendorcity: {
					required: "Enter the City of the Vendor"
				},
                    vendorzipcode: {
                         required: "Enter the Zip Code of the Vendor"
                    },
                    vendortele: {
                         required: "Enter the Vendor Telephone Number"
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
                    continueon();
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
     var editvendornum = $("input#editvendornum").val();
     var vendorname = $("input#vendorname").val();
     var vendorshortname = $("input#vendorshortname").val();
     var vendorcontact = $("input#vendorcontact").val();
     var vendoraddress1 = $("input#vendoraddress1").val();
     var vendoraddress2 = $("input#vendoraddress2").val();
     var vendorcity = $("input#vendorcity").val();
     var vendorstate = $("input#vendorstate").val();
     var vendorzipcode = $("input#vendorzipcode").val();
     var vendortele = $("input#vendortele").val();
     var vendorfax = $("input#vendorfax").val();
     var vendoremail = $("input#vendoremail").val();
     var emplnumber = $("input#emplnumber").val();
     var dataString = '&editvendornum=' + editvendornum + '&vendorname=' + vendorname + '&vendorshortname=' + vendorshortname + '&vendorcontact=' + vendorcontact +
          '&vendoraddress1=' + vendoraddress1 + '&vendoraddress2=' + vendoraddress2 + '&vendorcity=' + vendorcity + '&vendorstate=' + vendorstate +
          '&zipcode=' + zipcode + '&htele=' + htele + '&ftele=' + ftele + '&ctele=' + ctele +
          '&vendoremail=' + vendoremail + '&vendorfax=' + vendorfax + '&emplnumber=' + emplnumber;
  $.ajax({
      type: "POST",
      url: "vendors1.php",
      data: dataString,
      cache: false,
      done: fakeit(){}
  });
  return false;
}
function fakeit() {
     return;
}
</script>
<?php
require_once "includes/header2.inc";
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_COOKIE['employeenumber'];
$display = "Vendors:".$emplnumber;
require_once "includes/expire.inc";
$editvendornum = $_COOKIE["editvendornum"];
$errormsg=$_COOKIE["errormessage"];
if ($editvendornum == " ")
{
	echo "<center><form action=\"setupvmaint.php\" method=\"get\">";
	echo "<table width = \"25%\" border = \"0\">";
	echo "<tr><td>Enter the Vendor Number to be edited.</td></tr>";
	echo "<tr><td><input type=\"text\" name=\"editvendornum\" size=\"5\" maxlength=\"5\"></td></tr>";
	echo "<tr><td><input type=\"submit\" value=\"Edit Requested Vendor\"></td></tr></table>";
	echo "</form><form action=\"setupvmaint.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"editvendornum\" value=\"new\">";
	echo "<table width=\"25%\"><tr><td><input type=\"submit\" value=\"Create New Client\"></td></tr>";
	echo "</table></form></center>";
	require_once "includes/footer.inc";
	exit();
}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
if ($editvendornum <> "new")
{
	require_once "includes/key.inc";
	require_once "includes/de.inc";
     /****************  incorrect table and columns ***************/
	$sql = "SELECT vendorid, vendorname, vendorshortname, vendorcontact, vendoraddress1, vendoraddress2, vendorcity, vendorstate, vendorzipcode, vendortele, vendorfax, vendoremail";
	$sql = $sql." FROM `petclinicinv`.`vendor` WHERE vendorid = ".$editvendornum;
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
		setcookie("errormessage", "Invalid Vendor Number", $expire1hr);
          redirect("vendors.php");          
		exit();
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		setcookie("errormessage", "Invalid Vendor Number", $expire1hr);
          redirect("vendors.php");           
		exit();
	}
	setcookie("errormessage", " ", $expire10hr); 
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$editvendornum=$row[0];
		$vendorname=$row[1];
		$vendorshortname=$row[2];
		$vendorcontact=$row[3];
		$vendoraddress1=$row[4];
		$vendoraddress2=$row[5];
		$vendorcity=$row[6];
		$vendorstate=$row[7];
		$vendorzipcode=$row[8];
          $vendortele=$row[9];
          $vendorfax=$row[10];
		$vendoremail=$row[11];
		$address1 = mc_decrypt($address1, ENCRYPTION_KEY);
		if ($address2 <> "")
			$address2 = mc_decrypt($address2, ENCRYPTION_KEY);
		$city = mc_decrypt($city, ENCRYPTION_KEY);
	}
}
if ($editvendornum == "new")
{
	if (strlen($errormsg) < 2)
	{
		$editvendornum="";
		$vendorname="";
		$vendorshortname="";
		$vendorcontact="";
		$vendoraddress1="";
		$vendoraddress2="";
		$vendorcity="";
		$vendorstate="";
		$vendorzipcode="";
          $vendortele="";
          $vendorfax="";
		$vendoremail="";
	}
}
?>
<form id="clientform" name="clientform">
<table cellpadding="5" cellspacing="5" width="95%">
<tr><td align="right">Vendor Number</td><td><input type="text" name="editvendornum" size="4" maxlength="4" READONLY value="<?php echo $editvendornum;?>"></td></tr>
<tr>
     <td class="label">
         <label for="vendorname">
             Vendor Company Name 
         </label>
     </td>
     <td class="field">
         <input id="vendorname" name="vendorname" type="text" size="50" maxlength="50" value="<?php echo $vendorname;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="vendorshortname">
             Vendor Short Name
         </label>
     </td>
     <td class="field">
         <input id="vendorshortname" name="vendorshortname" type="text" size="25" maxlength="25" value="<?php echo $vendorshortname;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="vendorcontact">
             Vendor Contact Name
         </label>
     </td>
     <td class="field">
         <input id="vendorcontact" name="vendorcontact" type="text" size="25" maxlength="25" value="<?php echo $vendorcontact;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="vendoraddress1">
             Vendor Address 
         </label>
     </td>
     <td class="field">
         <input id="vendoraddress1" name="vendoraddress1" type="text" size="50" maxlength="50" value="<?php echo $vendoraddress1;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="vendoraddress2">
             Vendor Address 2 (Optional) 
         </label>
     </td>
     <td class="field">
         <input id="vendoraddress2" name="vendoraddress2" type="text" size="50" maxlength="50" value="<?php echo $vendoraddress2;?>"> 
     </td>
     <td class="status">
     </td>   
</tr>
<tr>     
    <td class="label">
         <label for="vendorcity">
             City 
         </label>
     </td>
     <td class="field">
         <input id="vendorcity" name="vendorcity" type="text" size="40" maxlength="40" value="<?php echo $vendorcity;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
    <td class="label">
         <label for="vendorstate">
             State 
         </label>
     </td>
     <td class="field"><SELECT name="vendorstate">
<?php
$sqlstate = "SELECT * FROM `petclinic`.`code_state`";
$resultstate = $mysqli->query($sqlstate);
if ($resultstate == FALSE)
{
	setcookie("errormessage", "Acquiring States Error", $expire1hr);
     redirect("vendors.php");      
	exit();
}
$row_cnt_state = $resultstate->num_rows;
if ($row_cnt_state == 0) {
	setcookie("errormessage", "Acquiring States Error", $expire1hr); 
     redirect("vendors.php"); 
	exit();
}
for ($i = 0; $i < $row_cnt_state; $i++) {
	$rowstate = $resultstate->fetch_row();
	echo "<option value=\"$rowstate[0]\"";
	if (strlen($state) > 0) {
		if ($rowstate[0] == $state)
			echo " SELECTED ";
	}
	echo " >".$rowstate[1]."</option>";
}
?>
     </select>
     <td class="status">
     </td>
     <td class="label">
         <label for="vendorzipcode">
             Zip Code (5 chars US; 7 chars Canada) 
         </label>
     </td>
     <td class="field">
         <input id="vendorzipcode" name="vendorzipcode" type="text" size="10" maxlength="10" value="<?php echo $vendorzipcode ?>">
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="vendortele">
             Vendor Telephone 
         </label>
     </td>
     <td class="field">
         <input id="vendortele" name="vendortele" type="text" size="12" maxlength="13" value="<?php echo $vendortele;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="vendorfax">
             FAX Telephone
         </label>
     </td>
     <td class="field">
         <input id="vendorfax" name="vendorfax" type="text" size="13" maxlength="13" value="<?php echo $vendorfax;?>"> 
     </td>
     <td class="status">
     </td>
</tr>  
<tr>
     <td class="label">
         <label for="vendoremail">
             Vendor EMail 
         </label>
     </td>
     <td class="field">
         <input id="vendoremail" name="vendoremail" type="text" size="50" maxlength="50" value="<?php echo $vendoremail;?>"> 
     </td>
     <td class="status">
     </td>
</tr>     
<tr><td><input type="hidden" name="emplnumber" value="<?php echo $emplnumber; ?>"></td></tr>
<tr><td colspan="6" align="center"><input type="submit" value="Create/Update Vendor"></td></tr></table></form>
<form action="maintmenu.php" method="post"><table width="75%"><tr><td align="center"><input type="submit" value="Return to Maintenance Menu"></td></tr></table></form>
<?php
$errormsg = $_COOKIE['errormessage'];
if ($errormsg <> " ")
{
	echo "<div id='errormsg'> $errormsg </div>";
}
$mysqli->close();
//include "helpline.php";
//help("clientmaint.php");
require_once "includes/footer.inc";
?>