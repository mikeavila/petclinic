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
                    coname: {
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
                    state: {
                         required: true,
                         minlength: 3
                    },
                    zipcode: {
                         required: true,
                         minlength: 5,
                         maxlength: 7
                    },
                    telephone: {
                         required: true,
                         phoneUS: true
                    },
                    fax: {
                         phoneUS: true
                    },
                    statetax: {
                         required: true
                    }
               },
			   messages: {
                    coname: {
                         required: "Enter the Company Name"
                    },
                    address1: {
                         required: "Enter the Company Address"
                    },
                    city: {
                         required: "Enter the Company City"
                    },
                    state: {
                         required: "Enter the Company State"
                    },
                    zipcode: {
                         required: "Enter the Company Zip Code"
                    },
                    telephone: {
                         required: "Enter the Company Telephone Number"
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
     var coname = $("input#coname").val();
     var address1 = $("input#address1").val();
     var address2 = $("input#address2").val();
     var city = $("input#city").val();
     var state = $("input#state").val();
     var zipcode = $("input#zipcode").val();
     var telephone = $("input#telephone").val();
     var fax = $("input#fax").val();
     var logo = $("input#logo").val();
     var license = $("input#license").val();
     var statetax = $("input#statetax").val();
     var dataString = '&prefix=' + prefix + '&fname=' + fname + '&lname=' + lname + '&suffix=' + suffix +
          '&address1=' + address1 + '&address2=' + address2 + '&city=' + city + '&state=' + state +
          '&zipcode=' + zipcode + '&htele=' + htele + '&ftele=' + ftele + '&ctele=' + ctele +
          '&email=' + email + '&status=' + status + '&billable=' + billable + '&emplnumber=' + emplnumber;
  $.ajax({
      type: "POST",
      url: "corpinfo1.php",
      data: dataString,
      cache: false,
      done: function(){}
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
$display = "Corpinfo:".$emplnumber;
require_once "password.php";
$mysqlic = new mysqli('localhost', $user, $password, '');
require_once "includes/key.inc";
require_once "includes/de.inc";
$sql = "SELECT * FROM `petcliniccorp`.`company`;";
$result = $mysqlic->query($sql);
$row_cnt = $result->num_rows;
$row = $result->fetch_row();
$coname=$row[0];
$address1 = mc_decrypt($row[1], ENCRYPTION_KEY);
if (strlen($row[2] > 0))
{
	$address2 = mc_decrypt($row[2], ENCRYPTION_KEY);
} else {
	$address2 = "";
}
$city = mc_decrypt($row[3], ENCRYPTION_KEY);
$state=$row[4];
$zipcode=$row[5];
$telephone=$row[6];
$fax=$row[7];
$logo=$row[8];
$license=$row[9];
$statetax=$row[10];
$weight=$row[11];
$temp=$row[12];
$lang=$row[13];
?>
<form id="corpinfo" name="corpinfo" action="corpinfo1.php" method="post">
<table cellpadding="5" cellspacing="5" width="95%">
<tr>
     <td class="label">
         <label for="coname">
             Company Name 
         </label>
     </td>
     <td class="field">
         <input id="coname" name="coname" type="text" size="40" maxlength="40" value="<?php echo $coname;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="address1">
             Address 
         </label>
     </td>
     <td class="field">
         <input id="address1" name="address1" type="text" size="40" maxlength="40" value="<?php echo $address1;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="address2">
             Address 2 (Optional)
         </label>
     </td>
     <td class="field">
         <input id="address2" name="address2" type="text" size="40" maxlength="40" value="<?php echo $address2;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="city">
             City
         </label>
     </td>
     <td class="field">
         <input id="city" name="city" type="text" size="25" maxlength="25" value="<?php echo $city;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="state">
             State 
         </label>
     </td>
     <td class="field">
         <input id="state" name="state" type="text" size="20" maxlength="20" value="<?php echo $state;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="zipcode">
             Zip Code
         </label>
     </td>
     <td class="field">
         <input id="zipcode" name="zipcode" type="text" size="7" maxlength="7" value="<?php echo $zipcode;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="telephone">
             Telephone
         </label>
     </td>
     <td class="field">
         <input id="telephone" name="telephone" type="text" size="12" maxlength="12" value="<?php echo $telephone;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="fax">
             FAX (Optional)
         </label>
     </td>
     <td class="field">
         <input id="fax" name="fax" type="text" size="12" maxlength="12" value="<?php echo $fax;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="logo">
             Logo File (Optional)
         </label>
     </td>
     <td class="field">
         <input id="logo" name="logo" type="text" size="25" maxlength="25" value="<?php echo $logo;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="license">
            Business License (Optional)
         </label>
     </td>
     <td class="field">
         <input id="license" name="license" type="text" size="15" maxlength="15" value="<?php echo $license;?>"> 
     </td>
     <td class="status">
     </td>
     <td class="label">
         <label for="statetax">
            State Tax (as a 2 decimal) INCLUDE THE DECIMAL POINT
         </label>
     </td>
     <td class="field">
         <input id="statetax" name="statetax" type="text" size="5" maxlength="5" value="<?php echo $statetax;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr><td colspan="6" align="center"><font size="+1">The following cannot be changed:</font></td></tr>
<tr><td align="right">Weight</td><td><input type="text" size="1" maxlength="1" READONLY value="<?php echo $weight; ?>"></td>
<td align="right">Temperature</td><td><input type="text" size="1" maxlength="1" READONLY value="<?php echo $temp; ?>"></td>
<td align="right">Language</td><td><input type="text" size="3" maxlength="3" READONLY value="<?php echo $lang; ?>"></td></tr>
<tr><td align="center" colspan="6"><input type="submit" value="Update Company Information"></td></tr>
<tr><td colspan="6"><input name="pass" type="hidden" value="2"></td></tr>
<?php
echo '<tr><td id="errormsg" name="errormsg" colspan="6">';
include "includes/display_errormsg.inc";
echo '</td></tr></table></form>';
echo '<form action="mainmenu.php" method="post">';
echo '<table border="0" width="95%"><tr><td align="center"><input type="submit" value="Return to Main Menu"></td></tr></table></form>';
require_once 'includes/footer.inc';
$mysqlic->close();
?>