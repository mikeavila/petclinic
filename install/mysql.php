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
?>
<script type="text/javascript">
     $( "stepprogress" ).progressbar( "value", 0 );
     $( "totalprogress" ).progressbar( "value", 20 );
     jQuery.validator.setDefaults({
          debug: true,
          success: "valid"
     });
     var validator = $("#up").validate({
			rules: {
				userid: "required",
				password: "required",
				userid: {
					required: true,
					minlength: 3,
                         message: "The Userid is required"
				},
				password: {
					required: true,
					minlength:3,
                          message: "The Password is required"
				},
			},
			messages: {
				userid: {
					required: "Enter MySQL Userid",
					minlength: jQuery.validator.format("Enter at least {0} characters")
				},
				password: {
					required: "Enter MySQL password",
					minlength: jQuery.validator.format("Enter at least {0} characters")
				},
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
			// set this class to error-labels to indicate valid fields
			success: function(label) {
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			},
			highlight: function(element, errorClass) {
				$(element).parent().next().find("." + errorClass).removeClass("checked");
			}
          });
function newwindow() {
     var d = new Date();
     var curr_hour = d.getHours();
     var curr_min = d.getMinutes();
     var timeexpires = ((curr_hour * 60) + (curr_min + 60));
     $.cookie('u', document.getElementById('userid').value, {expires: timeexpires});
     $.cookie('p', document.getElementById('password').value, {expires: timeexpires});
     $("#tabs").tabs("option", "disabled", [0, 1, 3, 4, 5, 6, 7, 8, 9, 10]);
     $("#tabs").tabs( "enable", 2 );
     $("#tabs").tabs("option", "active", 2);
     $("#tab2").load("install.php");
}
</script>
<?php
require_once '../includes/version.inc';
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("mysql.php Tab2 Active");
?>
<form id='up' action="#tab2" method='post' onsubmit='newwindow();return false'>
<div>Select Language to use <select name="language"><option>US English</option></select>
<br><br>Most installations do not require a change to the MySQL Userid and Password.
<br>If you are using someone's sever they may not give you root access.
<br>In that case, enter the Userid and Password assigned to you.
<br><br><b>PLEASE NOTE:</b> Your Userid must be able to:
</div>
<br>
<div class="softwareList">
<ol class="dbPermissions">
<li>Create databases</li>
<li>Create tables</li>
<li>Create users</li>
<li>Insert</li>
<li>Select</li>
<li>Grant</li>
</ol>
</div>
<br>
<div>
<div><label for="userid">Enter your MySQL Userid ID: <input id="userid" name="userid" type="text" placeholder="MySQL user" size="20" maxlength="20" REQUIRED value=""></label></div>
<div><label for="password">Enter your MySQL Password: <input id="password" name="password" type="text" placeholder="MySQL password" size="20" maxlength="20" REQUIRED value=""></label></div>
</div>
<br><br>
<input class="submit" type="submit" value="Create">
</form>