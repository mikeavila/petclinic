<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =========                                               *
*petclinic Management Software                                   *
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
// $(document).ready(function() {
        // var validator = $("#phonemsg").validate({
            // rules: {
                    // fromname: {
                         // required: true
                    // },
                    // tele: {
                         // required: true,
                         // phoneUS: true
                    // },
                    // message: {
                         // required: true,
                         // minlength: 5
                    // }
            // },
            // messages: {
                    // fromname: {
                         // required: 'Enter who the Message is From'
                    // },
                    // tele: {
                         // required: 'Enter the Phone Number of the person sending a Message'
                    // },
                    // message: {
                         // required: 'Enter the Message'
                    // }
            // },
           // the errorPlacement has to take the table layout into account
            // errorPlacement: function(error, element) {
                // if (element.is(":radio"))
                    // error.appendTo(element.parent().next().next());
                // else if (element.is(":checkbox"))
                    // error.appendTo(element.next());
                // else
                    // error.appendTo(element.parent().next());
            // },
     //       specifying a submitHandler prevents the default submit, good for the demo
            // submitHandler: function() {
                    continueon();
            // },
       //     set this class to error-labels to indicate valid fields
            // success: function(label) {
         //       set &nbsp; as text for IE
                // label.html("&nbsp;").addClass("checked");
            // },
            // highlight: function(element, errorClass) {
                // $(element).parent().next().find("." + errorClass).removeClass("checked");
            // }
        // });
          // return false;
    // });
// function continueon() {
     // var data = [];  // to be populated with the checked entries.
     // var msgfor = $('select#msgfor').val();
     // var fromname = $('input#fromname').val();
     // var tele = $('input#tele').val();
     // var message = $('textarea#message').val();
     // $("input[name='chkbxs[]']:checked").each(function(i) { // process the checkboxes
         // data.push($(this).val());
     // });
     // var dataString = '&msgfor=' + msgfor + '&fromname=' + fromname + '&tele=' + tele + '&message=' + message + '&chkbxs=' + data;
      // console.debug(dataString);
      // $.ajax({
        // type: 'POST',
        // url: 'phonemsgs2.php',
        // data: dataString,
        // success: function(msg) {
             // console.debug(msg);
            // window.location.href=msg;
        // }
     // });

//     return false;
     // return true;
// }
</script>
<?php
require_once "includes/header2.inc";
require_once "includes/common.inc";
if ( array_key_exists('employeenumber', $_SESSION)) {
    $emplnumber = $_SESSION['employeenumber'];
}
$display = "Phonemsgs: " . $emplnumber;
?>
<div id="phonemsgdiv" name="phonemsgdiv"><h1 id="phonemsgtitle" name="phonemsgtitle">Phone Message</h1><br>
<form id="phonemsg" name="phonemsg" method="post" action="phonemsgs2.php">
<table id="phonemsgtable" name="phonemsgtable" cellpadding="2" cellspacing="2">
<tr><td valign="top">Message For: <select id="msgfor" name="msgfor" size="3">
<?php
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$sql = "SELECT `emplnumber`, `lname`, `fname` FROM `petcliniccorp`.`employee` WHERE `status` = 'A';";
$result = $mysqli->query($sql);
if ($result == FALSE)
{
     put_errormsg("Invalid Employee number");
     redirect("phonemsg.php");
     exit();
}
$row_cnt = $result->num_rows;
if ($row_cnt == 0) {
     put_errormsg("Invalid Employee number");
     redirect("phonemsg.php");
     exit();
}
while ( $row = $result->fetch_row() ) {
     echo '<option value='.$row[0].'>'.$row[1].', '.$row[2]."</option>";
}
$mysqli->close();
?>
</select></td></tr>
<tr><td><br>From: <input id="fromname" name="fromname" type="text" size="40" maxlength="40"></td></tr>
<tr><td><br>Telephone Number: <input id="tele" name="tele" type="text" size="28" maxlength="13"></td></tr>
<tr><td><br>
<input name="chkbxs[]" type="checkbox" value="emergency"> Emergency &nbsp; &nbsp; &nbsp; <input name="chkbxs[]" type="checkbox" value="cametosee"> Came to see you
<br><input name="chkbxs[]" type="checkbox" value="call"> Call &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input name="chkbxs[]" type="checkbox" value="callagain"> Will call again<br>
<input name="chkbxs[]" type="checkbox" value="retyourcall"> Returned your call
</td></tr>
<tr><td><br>Message: Limited to 100 chars</td></tr>
<tr><td>
     <textarea id="message" name="message" rows="6" cols="46" maxlength="100" onkeyup="phoneMsgCount();"></textarea>
</td></tr>
</table>
<div id="result"></div>
<div class="center"><input id="pmsubmit" name="pmsubmit" type="submit" value="Save Phone Message"></div>
</form>
</div>
<br>
<br>
<?php
include "includes/returnmaintmenu.inc";
require_once 'includes/footer.inc';
?>