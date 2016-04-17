<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*Petclinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
?>
<script>
	$(document).ready(function() {
		// validate signup form on keyup and submit
		var validator = $("#employeeform").validate({
			rules: {
				euserid: "required",
				password: "required",
				userid: {
					required: true,
					minlength: 2
				},
				epassword: {
					required: true,
					minlength: 5
				},
				fname: {
					required: true,
					minlength: 3
				},
                    lname: {
                         required: true,
                         minlength: 3
                    },
                    address: {
                         required: 5
                    },
                    city: {
                         required: 3
                    },
				state: {
                         required: true,
                         minlength: 4
                    },
                    zipcode: {
                         required: true,
                         minlength: 5,
                         maxlength: 10
                    },
                    tele: {
                         required: true,
                         phoneUS: true
                    }
			},
			messages: {
				euserid: {
                         required: "Please enter the a Userid for this Employee"
                    },
				epassword: {
                         required: "Please enter a Password for this Employee" 
                    },
                    fname: {
                         required: "Please enter the Employee's First Name"
                    },
                    lname: {
                         required: "Please enter the Employee's Last Name"
                    },
                    address: {
                         required: "Please enter the Employee's Address"
                    },
				city: {
					required: "Please ener the City where your Employee lives"
				},
				state: {
					required: "Please enter the State where your Employee lives"
				},
                    zipcode: {
                         required: "Please enter the Zip Code where the Employee lives"
                    },
                    tele: {
                         required: "Please enter the Employee's Telephone Number"
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
	});
function continueon() {
     var euserid = $("input#euserid").val();
     var epassword = $("input#epassword").val();
     var prefix = $("input#prefix").val();
     var fname = $("input#fname").val();
     var lname = $("input#lname").val();
     var suffix = $("input#suffix").val();
     var address = $("input#address").val();
     var address2 = $("input#address2").val();
     var city = $("input#city").val();
     var state = $("input#state").val();
     var zipcode = $("input#zipcode").val();
     var tele = $("input#tele").val();
     var dataString = '&euserid='+ euserid + '&epassword=' + epassword + '&prefix=' + prefix +
          '&fname=' + fname + '&lname=' + lname + '&suffix=' + suffix + '&address=' + address +
          '&address2=' + address2 + '&city=' + city + '&state=' + state + 
          '&zipcode=' + zipcode + '&tele=' + tele;
     $.ajax({
      type: "POST",
      url: "install2.php",
      data: dataString,
      cache: false,
      success: function() {
          $( "#tabs" ).tabs( "option", "disabled", [ 0, 1, 2, 3, 4, 5, 7, 8, 9, 10 ] );
          $("#tabs" ).tabs("enable", 6 );
          $("#tabs").tabs("option", "active", 6);
          $( "#totalprogress" ).progressbar({  value: 60 });
          setTimeout(fakeit(), 4000);
          $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 5, 6, 7, 9, 10 ] );
          $("#tabs" ).tabs("enable", 8 );
          $("#tabs").tabs("option", "active", 8 );
          $("#tab8").load("continue.php");
          }
    });
     return false;
}
function fakeit() {
     return; 
}
</script>
<div>The following information is needed in order to create the initial employee record in the database. 
This initial record is the owner of the Pet Clinic and will have authority to access all records in all databases 
and all systems.</div>
<form id="employeeform"  name="employeeform">

<table cellpadding="5" cellspacing="5" width="75%">

<tr><td class="label"><label id="euserid" for="euserid">Enter a Userid</label></td>
<td id="field"><input id="euserid" name="euserid" type="text" size="40" maxlength="10" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="epassword" for="epassword">Enter a Password</label></td>
<td id="field"><input id="epassword" name="epassword" type="text" size="40" maxlength="10" value= ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="prefix" for="prefix">Prefix (such as Dr)</label></td>
<td><input id="prefix" name="prefix" type="text" size="5" maxlength="25" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="fname" for="fname">First Name</label></td>
<td id="field"><input id="fname" name="fname" type="text" size="40" maxlength="25" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="lname" for="lname">Last Name</label></td>
<td id="field"><input id="lname" name="lname" type="text" size="40" maxlength="40" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="suffix" for="suffix">Suffix (such as Jr)</label></td>
<td id="field"><input id="suffix" name="suffix" type="text" size="5" maxlength="25" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="address" for="address">Address</label></td>
<td id="field"><input id="address" name="address" type="text" size="40" maxlength="30" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="lname" for="lname">Address 2 (Optional)</label></td>
<td id="field"><input id="address2" name="address2" type="text" size="40" maxlength="15" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="city" for="city">City</label></td>
<td id="field"><input id="city" name="city" type="text" size="40" maxlength="25" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="state" for="state">State</label></td>
<td id="field"><input id="state" name="state" type="text" size="40" maxlength="20" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="zipcode" for="zipcode">Zip Code (5 or 9 chars for US; 7 chars for Canada)</label></td>
<td id="field"><input id="zipcode" name="zipcode" type="text" size="40" maxlength="7" value = ""></td>
<td class="status"></td></tr>

<tr><td class="label"><label id="tele" for="tele">Telephone</label></td>
<td id="field"><input id="tele" name="tele" type="text" size="40" maxlength="13" value = ""></td>
<td class="status"></td></tr>

<tr><td align="center" colspan="2"><input class="submit" type="submit" value="Create Employee Record"></td></tr></table>
</table></form>
<br><br>This will be Employee # 1.
<script type="text/javascript">JQUERY4U.UTIL.setupEmployeeValidation();</script>