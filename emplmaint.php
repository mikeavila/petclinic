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
<script>
$(document).ready(function() {
     // validate signup form on keyup and submit
     var validator = $('#empform').validate({
          rules: {
               uuserid: {
                    required: true,
                    minlength: 4
               },
               password: {
                    required: true,
                    minlength: 8
               },
               changepwd: {
                    required: true,
                    pattern: /^(Y|N)$/
               },
               fname: {
                    required: true,
                    minlength: 3
               },
               lname: {
                    required: true,
                    minlength: 3
               },
               address1: {
                    required: true
               },
               city: {
                    required: true,
                    minlength: 3
               },
               state: {
                    required: true,
                    minlength: 3,
                    maxlength: 40
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
               status: {
                    required: true,
                    pattern: /^(A|I|D)$/
               }
          },
          messages: {
               uuserid: {
                    required: 'Enter a User ID'
               },
               password: {
                    required: 'Enter a Password'
               },
               changepwd: {
                    required: 'Enter if Password needs changing 1st logon'
               },
               fname: {
                    required:'Enter the First Name of the Employee'
               },
               lname: {
                    required:'Enter the Last Name of the Employee'
               },
               address1: {
                    required:'Enter the Employee Address'
               },
               city: {
                    required:'Enter the City where your Employee lives'
               },
               state: {
                    required:'Enter the State where your Employee lives'
               },
               zipcode: {
                    required:'Enter the Zip Code where the Employee lives'
               },
               telephone: {
                    required:'Enter the Employee Telephone Number'
               },
               status: {
                    required:'Enter the Employee Status'
               }
          },
          // the errorPlacement has to take the table layout into account
          errorPlacement: function(error, element) {
               if (element.is(':radio'))
                    error.appendTo(element.parent().next().next());
               else if (element.is(':checkbox'))
                    error.appendTo(element.next());
               else
                    error.appendTo(element.parent().next());
          },
          // specifying a submitHandler prevents the default submit, good for the demo
          submitHandler: function() {
               //alert('submitted!');
               continueon();
          },
          // set this class to error-labels to indicate valid fields
          success: function(label) {
               // set &nbsp; as text for IE
               label.html('&nbsp;').addClass('checked');
          },
          highlight: function(element, errorClass) {
               $(element).parent().next().find('.' + errorClass).removeClass('checked');
          }
     });
     return false;
});
function continueon() {
     var editempnum = $('input#editempnum').val();
     var uuserid = $('input#uuserid').val();
     var epassword = $('input#password').val();
     var changepwd = $('input#changepwd').val();
     var passwordhint = $('input#passwordhint').val();
     var hintanswer = $('input#hintanswer').val();
     var prefix = $('input#prefix').val();
     var fname = $('input#fname').val();
     var lname = $('input#lname').val();
     var suffix = $('input#suffix').val();
     var address1 = $('input#address1').val();
     var address2 = $('input#address2').val();
     var city = $('input#city').val();
     var state = $('input#state').val();
     var zipcode = $('input#zipcode').val();
     var telephone = $('input#telephone').val();
     var email = $('input#email').val();
     var status = $('input#status').val();
     var emplnumber = $('input#emplnumber').val();
     var changeid = $('input#changeid').val();
     var dataString = '&editempnum=' + editempnum + '&uuserid=' + uuserid + '&changepwd=' + changepwd + '&passwordhint=' + passwordhint + '&hintanswer=' + hintanswer +
          '&prefix='+ prefix + '&fname=' + fname + '&lname=' + lname + '&suffix=' + suffix + '&address1=' + address1 + '&address2=' + address2 +
          '&city=' + city + '&state=' + state + '&zipcode=' + zipcode + '&telephone=' + telephone + '&email=' + email + '&status=' + status + '&emplnumber=' + emplnumber +
          '&changeid=' + changeid + '&epassword=' + epassword;
  $.ajax({
      type: 'POST',
      url: 'empmaint1.php',
      data: dataString,
      cache: false,
      success: function(msg) {
          window.location.href=msg;
      }
    });
     return false;
}
</script>
<?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
$emplnumber = $_SESSION['employeenumber'];
$display = "Emplmaint:".$emplnumber;

if(isset($_GET["e"])) {
     $errorcode = $_GET["e"];
} else {
     $errorcode = "n";
}
$editempnum = '';
if ( !empty($_GET['editempnum']) ) {
	$editempnum = $_GET['editempnum'];
	unset($_GET['editempnum']);
}
if ( !empty($_SESSION['employee_data']) ) {
	echo '<div class="success">Successfully added/updated user: ' . $_SESSION['employee_data']['user'] . ', employee#(' . $_SESSION['employee_data']['uid'] . ')</div>';
	unset ($_SESSION['employee_data']); // don't retain this data.
}
if (($editempnum == "") OR ($errorcode == "y"))
{
	echo '<center><form action="emplmaint.php" method="get">';
	echo '<table width="25%">';
	echo '<tr><td>Enter the Employee Number to be edited.</td></tr>';
	echo '<tr><td><input type="text" name="editempnum" size="5" maxlength="5"></td></tr>';
	echo '<tr><td><input type="submit" value="Edit Requested Employee"></td></tr></table>';
	echo '</form><form action="emplmaint.php" method="get">';
	echo '<input type="hidden" name="editempnum" value="new">';
	echo '<table width="25%"><tr><td><input type="submit" value="Create New Employee"></td></tr>';
	echo '</table></form></center>';
     include "includes/returnmaintmenu.inc";
     include "includes/display_errormsg.inc";
	require_once "includes/footer.inc";
	exit();
}
else if ($editempnum <> "new")
{
	$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
	$sql = "SELECT emplnumber, uuserid, upassword, changepwd, pwdhint, hintans, lname, fname, prefix, suffix, address, address2, city, state, zipcode, telephone, ";
	$sql = $sql."email, status, changeid  FROM petcliniccorp.employee WHERE emplnumber = ".$editempnum;
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
          put_errormsg("Invalid Employee number");
          redirect("emplmaint.php?e=y");
		exit();
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
          put_errormsg("Invalid Employee number");
          redirect("emplmaint.php?e=y");
		exit();
	}
     delete_errormsg();
	while ( $row = $result->fetch_row() ) {
		$editempnum=$row[0];
		$uuserid=$row[1];
		$epassword=$row[2];
		$changepwd=$row[3];
		$passwordhint=$row[4];
		$hintanswer=$row[5];
		$lname=$row[6];
		$fname=$row[7];
		$prefix=$row[8];
		$suffix=$row[9];
		$address1=$row[10];
		$address2=$row[11];
		$city=$row[12];
		$state=$row[13];
		$zipcode=$row[14];
		$telephone=$row[15];
		$email=$row[16];
		$status=$row[17];
		$epassword = mc_decrypt($epassword, ENCRYPTION_KEY);
		$passwordhint = mc_decrypt($passwordhint, ENCRYPTION_KEY);
		$hintanswer= mc_decrypt($hintanswer, ENCRYPTION_KEY);
		$address1 = mc_decrypt($address1, ENCRYPTION_KEY);
		if ($address2 <> "")
			$address2 = mc_decrypt($address2, ENCRYPTION_KEY);
		$city = mc_decrypt($city, ENCRYPTION_KEY);
	}
	$mysqli->close();
}
else if ($editempnum == "new")
{
     $uuserid="";
     $epassword="";
     $changepwd="Y";
     $passwordhint="";
     $hintanswer="";;
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
}
?>
<form id="empform" name="empform">
<table cellpadding="5" cellspacing="5" width="75%">
<tr><td>Employee Number</td><td><input type="text" id="editempnum" name="editempnum" size="4" maxlength="4" READONLY value="<?php echo $editempnum; ?>">
<tr>
     <td class="label">
         <label for="uuserid">
             UserID
         </label>
     </td>
     <td class="field">
         <input id="uuserid" name="uuserid" type="text" size="40" maxlength="10" value="<?php echo $uuserid;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="password">
             Password
         </label>
     </td>
     <td class="field">
         <input id="password" name="password" type="text" size="40" maxlength="10" value="<?php echo $epassword;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="changepwd">
             Change Password
         </label>
     </td>
     <td class="field">
         <input id="changepwd" name="changepwd" type="text" size="1" maxlength="1" value="<?php echo $changepwd;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="passwordhint">
             Password Hint
         </label>
     </td>
     <td class="field">
         <input id="passwordhint" name="passwordhint" type="password" size="20" maxlength="20" value="<?php echo $passwordhint;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="hintanswer">
             Hint Answer
         </label>
     </td>
     <td class="field">
         <input id="hintanswer" name="hintanswer" type="password" size="15" maxlength="15" value="<?php echo $hintanswer;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="prefix">
             Prefix (such as Dr)
         </label>
     </td>
     <td class="field">
         <input id="prefix" name="prefix" type="text" size="5" maxlength="25" value="<?php echo $prefix;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="fname">
             First Name
         </label>
     </td>
     <td class="field">
         <input id="fname" name="fname" type="text" size="40" maxlength="25" value="<?php echo $fname;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="lname">
             Last Name
         </label>
     </td>
     <td class="field">
         <input id="lname" name="lname" type="text" size="40" maxlength="40" value="<?php echo $lname;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="suffix">
             Suffix (such as Jr)
         </label>
     </td>
     <td class="field">
         <input id="suffix" name="suffix" type="text" size="5" maxlength="5" value="<?php echo $suffix;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="address1">
             Address
         </label>
     </td>
     <td class="field">
         <input id="address1" name="address1" type="text" size="30" maxlength="30" value="<?php echo $address1;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="address2">
             Address 2 (Optional)
         </label>
     </td>
     <td class="field">
         <input id="address2" name="address2" type="text" size="40" maxlength="40" value="<?php echo $address2;?>">
     </td>
     <td class="status"></td>
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
     <td class="status"></td>
     <td class="label">
         <label for="state">
             State
         </label>
     </td>
     <td class="field">
         <input id="state" name="state" type="text" size="40" maxlength="20" value="<?php echo $state;?>">
     </td>
     <td class="status"></td>
     <td class="label" rowspan="2">
         <label for="zipcode">
             Zip Code
         </label>
     </td>
     <td class="field">
         <input id="zipcode" name="zipcode" type="text" size="40" maxlength="7" value="<?php echo $zipcode;?>" placeholder="5 chars for US; 7 chars for Canada">
     </td>
     <td class="status"></td>
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
     <td class="status"></td>
     <td class="label">
         <label for="email">
             Email
         </label>
     </td>
     <td class="field">
         <input id="email" name="email" type="text" size="25" maxlength="25" value="<?php echo $email;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="status">
             Status
         </label>
     </td>
     <td class="field">
         <input id="status" name="status" type="text" size="1" maxlength="1" value="<?php echo $status;?>">
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="changeid">
             Change ID
         </label>
     </td>
     <td class="field">
         <input id="changeid" name="changeid" type="text" size="4" maxlength="4" value="<?php echo $emplnumber;?>"  READONLY>
     </td>
     <td class="status"></td>
</tr>
</table>
<input type="hidden" id="emplnumber" name="emplnumber" value="<?php echo $emplnumber; ?>">
<div class="center"><input type="submit" value="Create/Update Employee"></div></form>
<?php
include "includes/returnmaintmenu.inc";
require_once 'includes/display_errormsg.inc';
require_once 'includes/footer.inc';
?>