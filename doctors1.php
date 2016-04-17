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
</script>
<?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
$emplnumber = $_SESSION['employeenumber'];

if(isset($_POST["editdocnum"])) {
     $docnumber=$_POST["editdocnum"];
} else {
     $docnumber = "new";
}
if(isset($_POST["doctorinfo"])) {
     $doctorinfo=$_POST["doctorinfo"];
} else {
     $doctorinfo = "";
}
if(isset($_POST["docstatelic"])) {
     $docstatelic=$_POST["docstatelic"];
} else {
     $docstatelic = "";
}
if(isset($_POST["docdea"])) {
     $docdea=$_POST["docdea"];
} else {
     $docdea="";
}
if(isset($_POST["doctorstatus"])) {
     $doctorstatus=$_POST["doctorstatus"];
} else {
     $doctorstatus = "A";
}
if ($docnumber <> "new") {
     $mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
     $sql = "SELECT * FROM `petcliniccorp`.`doctors` WHERE `doctorid` = $docnumber;";
     $result = $mysqli->query($sql);
     if ($result == FALSE)
     {
          put_errormsg("Cannot access doctors table");
     } else {
          $row_cnt = $result->num_rows;
          if ($row_cnt == 0) {
               put_errormsg("There are no Doctors in the database");
          } else {
               while ( $row = $result->fetch_row() ) {
                    $docnumber = $row[0];
                    $doctorinfo = $row[1];
                    $docstatelic = $row[2];
                    $docdea = $row[3];
                    $doctorstatus = $row[4];
               }
          }
}
$mysqli->close();
}
?>
<div class="center"><h2>Doctor Entry</h2></div>
<div id="formContainer">
<div id="formLeftSide">&nbsp;</div>
<div id="formRightSide">
<form class="center" id="docform" name="docform" method="post">
<?php
    if ( 'new' == $docnumber ) {
    	$buttonText = 'Add Doctor';
		echo 'Enter the Doctor Name as it would appear on an Invoice. (Example: Dr John Doe DVM)';
    }
    else {
    	$buttonText = 'Modify Doctor';
    	echo 'Modify the doctor information as necessary.';
    }
?>
<br>
<br>
<table width="98%">
<tr>
	<td class="fieldLabel">Doctor ID:</td>
	<td class="field">
		<input id="docnumber" name="docnumber" type="text" size="3" maxlength="3" value="<?php echo $docnumber; ?>" READONLY>
	</td>
</tr>
<tr>
     <td class="fieldLabel">
         <label for="doctorinfo">Name:</label>
     </td>
     <td class="field">
         <input id="doctorinfo" name="doctorinfo" type="text" size="50" maxlength="50" value="<?php echo $doctorinfo; ?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="fieldLabel">
         <label for="docstatelic">State License:</label>
     </td>
     <td class="field">
         <input id="docstatelic" name="docstatelic" type="text" size="50" maxlength="25" value="<?php echo $docstatelic; ?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="fieldLabel">
         <label for="docdea">DEA License:</label>
     </td>
     <td class="field">
         <input id="docdea" name="docdea" type="text" size="50" maxlength="25" value="<?php echo $docdea; ?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="fieldLabel">
         <label for="doctorstatus">Status (A, I, or D):</label>
     </td>
     <td class="field">
         <input id="doctorstatus" name="doctorstatus" type="text" size="50" maxlength="1" value="<?php echo $doctorstatus; ?>">
     </td>
     <td class="status"></td>
</tr>
</table>
	<div class="center"><input id="docsubmit" name="docsubmit" type="submit" value="<?php echo $buttonText; ?>">
		<br><input id="emplnumber" name="emplnumber" type="hidden" value="<?php echo $emplnumber; ?>">
	</div>
</form>
<br>
<?php include "includes/returnmaintmenu.inc"; ?>
<br>
</div>
</div>
<br>
<?php
require_once "includes/display_errormsg.inc";
require_once "includes/phonemsgs.inc";
$display = "doctors1:";
require_once 'includes/footer.inc';
?>