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
<script type="text/javascript">
	$(document).ready(function() {
		// validate signup form on keyup and submit
		var validator = $("#clientform").validate({
			rules: {
				fname: {
					required: true,
					minlength: 3
				},
                    lname: {
                         required: true,
                         minlength: 3
                    },
                    address1: {
                         required: true,
                         minlength: 4
                    },
                    city: {
                         required: true,
                         minlength: 4
                    },
                    zipcode: {
                         required: true,
                         minlength: 5,
                         maxlength: 7
                    },
                    htele: {
                         required: true,
                         phoneUS: true
                    },
                    status: {
                         required: true,
                         pattern: /^(A|I|D)$/
                    }
               },
			messages: {
                    fname: {
                         required: "Enter the Client&#39;s First Name"
                    },
                    lname: {
                         required: "Enter the Client&#39;s Last Name"
                    },
                    address1: {
                         required: "Enter the Client&#39;s Address"
                    },
				city: {
					required: "Enter the City where your Client lives"
				},
                    zipcode: {
                         required: "Enter the Zip Code where the Client lives"
                    },
                    htele: {
                         required: "Enter the Client&#39;s Telephone Number"
                    },
                    status: {
                         required: "Enter the Client Status"
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
     var prefix = $("input#prefix").val();
     var fname = $("input#fname").val();
     var lname = $("input#lname").val();
     var suffix = $("input#suffix").val();
     var address1 = $("input#address1").val();
     var address2 = $("input#address2").val();
     var city = $("input#city").val();
     var state = $("select#state").val();
     var zipcode = $("input#zipcode").val();
     var htele = $("input#htele").val();
     var ftele = $("input#ftele").val();
     var ctele = $("input#ctele").val();
     var email = $("input#email").val();
     var status = $("input#status").val();
     var billable = $("select#billable").val();
     var emplnumber = $("input#emplnumber").val();
     var dataString = "&prefix=" + prefix + "&fname=" + fname + "&lname=" + lname + "&suffix=" + suffix +
          "&address1=" + address1 + "&address2=" + address2 + "&city=" + city + "&state=" + state +
          "&zipcode=" + zipcode + "&htele=" + htele + "&ftele=" + ftele + "&ctele=" + ctele +
          "&email=" + email + "&status=" + status + "&billable=" + billable + "&emplnumber=" + emplnumber;
  $.ajax({
      type: "POST",
      url: "clientmaint1.php",
      data: dataString,
      cache: false,
      done: fakeit
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
$emplnumber = '';
$editclientnum = 'new';
$errormsg = get_errormsg();
delete_errormsg();
if ( array_key_exists('employeenumber', $_COOKIE)) {
    $emplnumber = $_COOKIE['employeenumber'];
}
if ( array_key_exists('editclientnum', $_COOKIE)) {
    $editclientnum = $_COOKIE['editclientnum'];
}
$display = "Clientmaint:".$emplnumber;
require_once "includes/expire.inc";
if(isset($_GET["e"])) {
     $errorcode = $_GET["e"];
} else {
     $errorcode = "n";
}
if (($editclientnum == 'new') OR $errorcode == "y")
{
	echo '<form action="setupcmaint.php" method="get">' .
	     '<table width="25%">' .
	     '<tr><td>Enter the Customer Number to be edited.</td></tr>' .
	     '<tr><td><input type="text" name="editclientnum" size="5" maxlength="5"></td></tr>' .
	     '<tr><td><input type="submit" value="Edit Requested Client"></td></tr></table>' .
	     '</form><form action="setupcmaint.php" method="get">' .
	     '<input type="hidden" name="editclientnum" value="new">' .
	     '<table width="25%"><tr><td><input type="submit" value="Create New Client"></td></tr>' .
	     '</table></form>'.
          '<div id="errormsg">' . $errormsg . '</div>';
     delete_errormsg();
	require_once 'includes/footer.inc';
	exit();
}
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
if ($editclientnum <> "new")
{
	require_once "includes/key.inc";
	require_once "includes/de.inc";
	$sql = "SELECT clientnumber, lname, fname, prefix, suffix, address, address2, city, state, zipcode, email, status, changeid";
	$sql = $sql." FROM `petclinic`.`client` WHERE clientnumber = ".$editclientnum;
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Invalid Client Number");
          redirect("clientmaint.php?e=y");
		exit();
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Invalid Client Number");
          redirect("clientmaint.php?e=y");
		exit();
	}
	delete_errormsg(); 
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$editclientnum=$row[0];
		$lname=$row[1];
		$fname=$row[2];
		$prefix=$row[3];
		$suffix=$row[4];
		$address1=$row[5];
		$address2=$row[6];
		$city=$row[7];
		$state=$row[8];
		$zipcode=$row[9];
		$email=$row[10];
		$status=$row[11];
		$changeid=$row[12];
		$address1 = mc_decrypt($address1, ENCRYPTION_KEY);
		if ($address2 <> "")
			$address2 = mc_decrypt($address2, ENCRYPTION_KEY);
		$city = mc_decrypt($city, ENCRYPTION_KEY);
		$sqlphone="SELECT * FROM `petclinic`.`phone` WHERE `clientnumber` = \"".$editclientnum."\";";
		$result = $mysqli->query($sqlphone);
		if ($result == FALSE)
		{
			$hetel="";
			$ftele="";
			$ctele="";
		} else {
			$htelephone = "";
			$ftelephone = "";
			$ctelephone = "";
			$htele = "";
			$ftele = "";
			$ctele = "";
			$row_cnt = $result->num_rows;
			for ($j = 0; $j < $row_cnt; $j++) {
				$row = $result->fetch_row();
				$phonecode = $row[1];
				$telephone = $row[2];
				switch ($phonecode) {
					case "H":
						$htelephone = $telephone;
						break;
					case "C":
						$ctelephone = $telephone;
						break;
					case "F":
						$ftelephone = $telephone;
						break;
					default:
						break;
				}
			}
		}
	}
}

if ($editclientnum == "new")
{
	if (strlen($errormsg) < 2)
	{
		$clientnumber=" ";
		$lname="";
		$fname="";
		$prefix="";
		$suffix="";
		$address1="";
		$address2="";
		$city="";
		$state="";
		$zipcode="";
		$telephone="";
		$email="";
		$status="";
		$htele = "";
		$ftele = "";
		$ctele = "";
	}
}
?>
<form class="center" id="clientform" name="clientform">
<table cellpadding="5" cellspacing="5" width="100%">
<tr>
     <td align="right">Client Number</td>
     <td><input type="text" id="editclientnum" name="editclientnum" size="4" maxlength="4" READONLY value="<?php echo $editclientnum;?>"></td>
</tr>
<tr>
     <td class="label">
         <label for="prefix">Prefix (such as Dr)</label>
     </td>
     <td class="field">
         <input id="prefix" name="prefix" type="text" size="4" maxlength="4" value="<?php echo $prefix;?>"> 
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="fname">First Name</label>
     </td>
     <td class="field">
         <input id="fname" name="fname" type="text" size="20" maxlength="40" value="<?php echo $fname;?>"> 
     </td>
     <td class="status"></td>

     <td class="label">
         <label for="lname">Last Name</label>
     </td>
     <td class="field">
         <input id="lname" name="lname" type="text" size="20" maxlength="40" value="<?php echo $lname;?>"> 
     </td>
     <td class="status"></td>

    <td class="label">
         <label for="suffix">Suffix (such as Jr)</label>
     </td>
     <td class="field">
         <input id="suffix" name="suffix" type="text" size="5" maxlength="5" value="<?php echo $suffix;?>"> 
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="address1">Address</label>
     </td>
     <td class="field">
         <input id="address1" name="address1" type="text" size="20" maxlength="40" value="<?php echo $address1;?>"> 
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="address2">Address 2 (Optional)</label>
     </td>
     <td class="field">
         <input id="address2" name="address2" type="text" size="20" maxlength="40" value="<?php echo $address2;?>"> 
     </td>
     <td class="status"></td>     
    <td class="label">
         <label for="city">City</label>
     </td>
     <td class="field">
         <input id="city" name="city" type="text" size="25" maxlength="25" value="<?php echo $city;?>"> 
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="state">State</label>
     </td>
     <td class="field"><select id="state" name="state">
<?php
$sqlstate = "SELECT * FROM `petclinic`.`code_state`";
$resultstate = $mysqli->query($sqlstate);
if ($resultstate == FALSE)
{
     put_errormsg("Acquiring States Error");
     redirect("clientmaint.php");
	exit();
}
$row_cnt_state = $resultstate->num_rows;
if ($row_cnt_state == 0) {
     put_errormsg("Acquiring States Error");     
     redirect("clientmaint.php");
	exit();
}
while ( $rowstate = $resultstate->fetch_row() ) {
	if ( !empty($state) && $state == $rowstate[1] ) {
		echo '<option value="' . $rowstate[0] . '" selected>' . $rowstate[1] . '</option>';
	}
	else {
		echo '<option value="' . $rowstate[0] . '">' . $rowstate[1] . '</option>';
	}
}
?>
     </select></td>
     <td class="status"></td>
     <td class="label">
         <label for="zipcode">Zip Code (5 chars US; 7 chars Canada)</label>
     </td>
     <td class="field">
         <input id="zipcode" name="zipcode" type="text" size="7" maxlength="7" value="<?php echo $zipcode;?>"> 
     </td>
     <td class="status"></td>
     <td colspan="3">&nbsp;</td>
</tr>
<tr>
     <td class="label">
         <label for="htele">Home Telephone</label>
     </td>
     <td class="field">
         <input id="htele" name="htele" type="text" size="12" maxlength="12" value="<?php echo $htele;?>"> 
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="ctele">Cell Telephone</label>
     </td>
     <td class="field">
         <input id="ctele" name="ctele" type="text" size="12" maxlength="12" value="<?php echo $ctele;?>"> 
     </td>
     <td class="status"></td>     
     <td class="label">
         <label for="ftele">FAX Telephone</label>
     </td>
     <td class="field">
         <input id="ftele" name="ftele" type="text" size="12" maxlength="12" value="<?php echo $ftele;?>"> 
     </td>
     <td class="status"></td>
</tr>  
<tr>
     <td class="label">
         <label for="email">E-Mail</label>
     </td>
     <td class="field">
         <input id="email" name="email" type="text" size="25" maxlength="25" value="<?php echo $email;?>"> 
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="status">Status (A, I, or D)</label>
     </td>
     <td class="field">
         <input id="status" name="status" type="text" size="1" maxlength="1" value="<?php echo $status;?>"> 
     </td>
     <td class="status"></td> 
     <td class="label">
         <label for="billable">Is this Client Billable?</label>
     </td>
     <td class="field">
         <select id="billable" name="billable"><option value="N">No</option> <option value="Y" selected>Yes</option></select>
     </td>
     <td class="status"></td> 
</tr>     
<tr>
     <td>
     	 <input type="hidden" id="emplnumber" name="emplnumber" value="<?php echo $emplnumber; ?>">
     </td>
</tr>
<tr>
	<td colspan="9" align="center">
	     <input type="submit" value="Create/Update Client">
	</td>
</tr>
</table>
</form>
<form action="maintmenu.php" method="post">
   <div class="center">
	    <input type="submit" value="Return to Maintenance Menu">
   </div>
</form>
<?php
include "includes/display_errormsg.inc";
$mysqli->close();
require_once 'includes/helpline.inc';
help('clientmaint.php');
require_once 'includes/footer.inc';
?>