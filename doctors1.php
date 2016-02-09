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
$emplnumber = $_COOKIE['employeenumber'];
require_once "includes/expire.inc";
if(isset($_POST["docnumber"])) {
     $docnumber=$_POST["docnumber"];
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
     require_once "password.php";
     $mysqli = new mysqli('localhost', $user, $password, '');
     $sql = "SELECT * FROM `petcliniccorp`.`doctors` WHERE `docid` = $docnumber;";
     $result = $mysqli->query($sql);
     if ($result == FALSE)
     {
          put_errormsg("Cannot access doctors table");
     } else {
          $row_cnt = $result->num_rows;
          if ($row_cnt == 0) {
               put_errormsg("There are no Doctors in the database");
          } else {
               for ($i = 0; $i < $row_cnt; $i++) {
                    $row = $result->fetch_row();
                    echo '<option value="'.$row[0].'">'.sprintf("%3s",$row[0])." ".$row[1].'</option>';
               } 
          }
}
$mysqli->close();
}
?>
<form class="center" id="docform" name="docform" method="post" >
<div id="formContainer">
<div><h2>Doctor Entry</h2></div>
Enter a Doctor's Name as you want it to appear in an Invoice
<br>Example: Dr John Doe DVM
<br><div class="fieldLabel">Doctor ID:</div><input id="docnumber" name="docnumber" type="text" size="3" maxlength="3" value="<?php echo $docnumber; ?>" READONLY>
<table width="90%">
<tr>
     <td class="label">
         <label for="doctorinfo">
             Name
         </label>
     </td>
     <td class="field">
         <input id="doctorinfo" name="doctorinfo" type="text" size="50" maxlength="50" value="<?php echo $doctorinfo;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="docstatelic">
             State License 
         </label>
     </td>
     <td class="field">
         <input id="docstatelic" name="docstatelic" type="text" size="50" maxlength="25" value="<?php echo $docstatelic;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="docdea">
             DEA License 
         </label>
     </td>
     <td class="field">
         <input id="docdea" name="docdea" type="text" size="50" maxlength="25" value="<?php echo $docdea;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
<tr>
     <td class="label">
         <label for="doctorstatus">
             Status (A, I, or D) 
         </label>
     </td>
     <td class="field">
         <input id="doctorstatus" name="doctorstatus" type="text" size="50" maxlength="1" value="<?php echo $doctorstatus;?>"> 
     </td>
     <td class="status">
     </td>
</tr>
</table>
<br><br>
<div class="fieldLabel">&nbsp;</div><input id="docsubmit" name="docsubmit" type="submit" value="Add/Modify Doctor">
<br><input id="emplnumber" name="emplnumber" type="hidden" value="<?php echo $emplnumber; ?>">
</div>
</div>
</form>
<br>
<div class="center"><font size="+2" color="red">
<?php include "includes/display_errormsg.inc"; ?>
</font>
</div>
<br>
<form class="center" action="maintmenu.php"><input type="submit" value="Return to Maint Menu"></form>
</body></html>