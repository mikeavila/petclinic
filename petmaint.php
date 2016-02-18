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
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
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
          alert(msg);
          window.location.href=msg;
      }
    });
     return false;
}
</script>
<?php
require_once "includes/header2.inc";
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
if(isset($_COOKIE["editpetnum"])) {
     $editpetnum = $_COOKIE["editpetnum"];
} else {
     $editpetnum = "";
}
if ($editpetnum == "")
{
	echo "<center><form action=\"setuppmaint.php\" method=\"get\">";
	echo "<table width = \"25%\" border = \"0\">";
	echo "<tr><td>Enter the Pet Number to be edited.</td></tr>";
	echo "<tr><td><input type=\"text\" name=\"editpetnum\" size=\"5\" maxlength=\"5\"></td></tr>";
	echo "<tr><td><input type=\"submit\" value=\"Edit Requested Pet\"></td></tr></table>";
	echo "</form><form action=\"setuppmaint.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"editpetnum\" value=\"new\">";
	echo "<table width=\"25%\"><tr><td><input type=\"submit\" value=\"Create New Pet\"></td></tr>";
	echo "</table></form></center>";
	$display = "Petmaint:".$emplnumber;
	require_once "includes/footer.inc";
	exit();
}
if ($editpetnum == "new") {
     redirect("petmaint1new.php");
	exit();
}
if ($editpetnum == "new1") {
     redirect("petmaint1new1.php");
	exit();
}
if ($editpetnum == "new2") {
     redirect("petmaint1new1.php");
	exit();
}
$errormessage = get_errormsg();
delete_errormsg();
if (empty($errormessage)) {
	include "password.php";
	$mysqli = new mysqli('localhost', $user, $password, '');
	$sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = $editpetnum;";
	$result = $mysqli->query($sql);
	if ($mysqli->query($sql) === FALSE) {
          put_errormsg("Error selecting Pet Information".$mysqli->error);
          redirect("criticalerror.php?m=petmaint.php&ec=0");
		exit(1);
	}
	$row = $result->fetch_row();
	if ($row == 0) {
          put_errormsg("Invalid Pet Number".$mysqli->error);
          redirect("criticalerror.php?m=petmaint.php&ec=0");
		exit(1);
	}
	$petnumber = $row[0];
	$petname = $row[1];
	$dob = $row[2];
	$doby = substr($dob, 0, 4);
	$dobm = substr($dob, 4, 2);
	$dobd = substr($dob, 6, 2);
	$petspecies = $row[3];
	$petbreed = $row[4];
	$petgender = $row[5];
	$petfixed = $row[6];
	$petcolor = $row[7];
	$petdesc = $row[8];
	$license = $row[9];
	$microchip = $row[10];
	$rabiestag = $row[11];
	$tattoonumber = $row[12];
	$picture = $row[13];
	$status = $row[14];
	$changeid = $row[15];
}
echo "<form method=\"post\" action=\"petmaintupd.php\">";
require_once "petmaintform.php";
$mysqli->close();
?>