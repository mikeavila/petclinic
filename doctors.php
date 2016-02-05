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
				doctorinfo: {
					required: true,
					minlength: 10
				},
                    docstatelic: {
                         required: true,
                         minlength: 5
                    },
                    docdea: {
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
                    docdea: {
                         required: "Enter the Doctor&#39;s DEA License"
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
     var docnumber = $("input#prefix").val();
     var doctorinfo = $("input#fname").val();
     var docstatelic = $("input#lname").val();
     var docdea = $("input#suffix").val();
     var doctorstatus = $("input#address1").val();
     var emplnumber = $("input#emplnumber").val();
     var step = $("input#step").val();
     var dataString = "&docnumber=" + docnumber + "&doctorinfo=" + doctorinfo + "&docstatelic=" + docstatelic + "&docdea=" + docdea +
          "&doctorstatus=" + doctorstatus + "&emplnumber=" + emplnumber + "&step=" + step;
  $.ajax({
      type: "POST",
      url: "doctors1.php",
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
$step= "0";
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
$_POST["step"] = "0";
$docnumber = "0";
$doctordesc = "";
$docstatelic = "";
$doctordea = "";
?>
<form class="center" id="docform" name="docform" method="post" action="doctors.php">
<div id="formContainer">
<div>Doctor Entry</div>
<div id="formLeftSide">
<br>
<div>Current list of Doctors</div>
<br>
<select name="doclist" size="5">
<?php
require_once "password.php";
$mysqli = new mysqli('localhost', $user, $password, '');
$sql = "SELECT * FROM `petcliniccorp`.`doctors`;";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
	$errormsg = "Cannot access doctors table";
} else {
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
          $errormsg = "There are no Doctors in the database";
     } else {
          for ($i = 0; $i < $row_cnt; $i++) {
               $row = $result->fetch_row();
               echo '<option value="'.$row[0].'">'.sprintf("%3s",$row[0])." ".$row[1].'</option>';
          } 
     }
}
$mysqli->close();
echo "</select></div>";
echo '<div id="formRightSide"><br>';
if ($step <> 2)
{
	echo "<center><form action=\"doctors1.php\" method=\"get\">";
	echo "<table width = \"40%\" border = \"0\">";
	echo "<tr><td>Enter the Doctor Number to be edited.</td></tr>";
	echo "<tr><td><input type=\"text\" name=\"editdocnum\" size=\"5\" maxlength=\"5\"></td></tr>";
	echo "<tr><td><input type=\"submit\" value=\"Edit Requested Doctor\"></td></tr></table>";
	echo "</form><form action=\"doctors1.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"editdocnum\" value=\"new\">";
	echo "<table width=\"25%\"><tr><td><input type=\"submit\" value=\"Create New Doctor\"></td></tr>";
	echo "</table></form></center>";
     echo '<form action="maintmenu.php" method="post"><center><table width="75%"><tr><td align="center"><input type="submit" value="Return to Maintenance Menu"></td></tr></table></center></form>';
     $display = "doctor:";
	require_once "includes/footer.inc";
	exit();
}
?>
Enter a Doctor's Name as you want it to appear in an Invoice
<br>Example: Dr John Doe DVM
<br><div class="fieldLabel">Doctor ID:</div><input id="docnumber" name="docnumber" type="text" size="3" maxlength="3" value="<?php echo $docnumber; ?>" READONLY>
<br><br><div class="fieldLabel">Name:</div><input id="doctorinfo" name="doctorinfo" type="text" size="50" maxlength="50" value="<?php echo $doctordesc ?>">
<br><br><div class="fieldLabel">State License:</div><input id="docstatelic" name="docstatelic" type="text" size="25" maxlength="25" value="<?php echo $docstatelic ?>">
<br><br><div class="fieldLabel">DEA License:</div><input id="docdea" name="doctordea" type="text" size="25" maxlength="25" value="<?php echo $doctordea ?>">
<br><br><div class="fieldLabel">Status:</div><input id="docstatus" name="doctorstatus" type="text" size="25" maxlength="1" value="<?php echo $doctorstatus ?>">
<br><br>
<div class="fieldLabel">&nbsp;</div><input id="docsubmit" name="docsubmit" type="submit" value="Add/Modify Doctor">
<br><input id="emplnumber" name="emplnumber" type="hidden" value="<?php echo $emplnumber; ?>"><input id="step" name="step" type="hidden" value="2">
</div>
</div>
</form>
<br>
<div class="center"><font size="+2" color="red">
<?php
if (!empty($errormsg)) {
     echo $errormsg;
}
?>
</font>
</div>
<br>
<form class="center" action="maintmenu.php"><input type="submit" value="Return to Maint Menu"></form>
</body></html>