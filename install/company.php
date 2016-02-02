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
$logFileName = "install";
$headerTitle="INSTALL LOG";
require_once '../includes/logfileinit.inc';
$log->logThis("company.php Tab3 running");
?>
<script type="text/javascript">
	$(document).ready(function() {
		// validate signup form on keyup and submit
		var validator = $("#companyform").validate({
			rules: {
				coname: "required",
				addr: "required",
				coname: {
					required: true,
					minlength: 2
				},
				addr: {
					required: true,
					minlength: 5
				},
                    city: {
					required: true,
					minlength: 5
				},
				state: {
                         required: true,
                         minlength: 4
                    },
                    zip: {
                         required: true,
                         minlength: 5,
                         maxlength: 10
                    },
                    htele: {
                         required: true
                    },
                    tax: {
                         required: true,
                         number: true
                    },
                    weight: {
                         required: true,
                         pattern: "^(K|P)$"
                    },
                    temp: {
                         required: true,
                         pattern: "^(F|C)$"
                    }
			},
			messages: {
				coname: {
                         required: "Please enter the Name of your Company"
                    },
				addr: {
                         required: "Please enter the address of your Company" 
                    },
				city: {
					required: "Please enter the City where your Company is located"
				},
				state: {
					required: "Please enter the State where your Company is located"
				},
                    zip: {
                         required: "Please enter the Zip Code where your Company is located"
                    },
                    htele: {
                         required: "Please enter the Company Telephone Number"
                    },
                    tax: {
                         required: "Please enter your state tax rate as 00.00"
                    },
                    weight: {
                         required: "Please enter P for Pounds or K for Killograms"
                    },
                    temp: {
                         required: "Please enter F for Fahrenheit or C for Celsius"
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
			//	alert("submitted!");
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
     var coname = $("input#coname").val();
     var addr = $("input#addr").val();
     var addr2 = $("input#addr2").val();
     var city = $("input#city").val();
     var state = $("input#state").val();
     var zip = $("input#zip").val();
     var htele = $("input#htele").val();
     var ftele = $("input#ftele").val();
     var logo = $("input#logo").val();
     var lic = $("input#lic").val();
     var tax = $("input#tax").val();
     var weight = $("input#weight").val();
     var temp = $("input#temp").val();
     var dataString = '&coname='+ coname + '&addr=' + addr + '&addr2=' + addr2 +
          '&city=' + city + '&state=' + state + '&zip=' + zip + '&htele=' + htele + '&ftele=' + ftele +
          '&logo=' + logo + '&lic=' + lic + '&tax=' + tax + '&weight=' + weight + '&temp=' + temp;
  $.ajax({
      type: "POST",
      url: "install1.php",
      data: dataString,
      cache: false,
      success: function() {
          $( "#tabs" ).tabs( "option", "disabled", [ 0, 1, 2, 3, 5, 6, 7, 8, 9, 10 ] );
          $( "#totalprogress" ).progressbar({ value: 40 });
          $("tabs").tabs("enable", 4);
          $("#tabs").tabs("option", "active", 4);
          setTimeout(fakeit(), 4000);
          $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 ] );
          $("#tabs" ).tabs("enable",5 );
          $("#tabs").tabs("option", "active", 5 );
          $("#tab5").load("employee.php");
      }
    });
     return false;
}
function fakeit() {
     return; }
</script>
</head><body>
         The following information is needed in order to create the Company Record in the database. 
        <br>
        <br>
        <form id='companyform' name ='companyform' method='post'>
            <table cellpadding='5' cellspacing='5' width='75%'>
                <tr>
                    <td class='label'>
                        <label for='coname'>
                            Enter Name of Company 
                        </label>
                    </td>
                    <td class="field">
                        <input id="coname" name='coname' type="text" size="40" maxlength="40" value=""> 
                    </td>
                    <td class="status">
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='addr'>
                            Enter Address of Company 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='addr' name='addr' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='addr2'>
                            Enter Optional Address 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='addr2' name='addr2' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='city'>
                            Enter City 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='city' name='city' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='addr'>
                            Enter State 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='state' name='state' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='zip'>
                            Enter Zip Code (5 or 9 chars for US; 7 chars for Canada) 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='zip' name='zip' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='htele'>
                            Enter Company telephone Number as 111-222-3333 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='htele' name='htele' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='ftele'>
                            Enter optional FAX telephone number as 111-222-3333 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='ftele' name='ftele' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='logo'>
                            Enter Optional Logo filename 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='logo' name='logo' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='lic'>
                            Business License Number (Optional) 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='lic' name='lic' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='tax'>
                            Enter State Tax Percent as 00.00 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='tax' name='tax' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='weight'>
                            Weight: Enter P for pounds or K for kilograms 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='weight' name='weight' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td class='label'>
                        <label for='temp'>
                            Temperature: Enter F for Fahrenheit or C for Celsius 
                        </label>
                    </td>
                    <td class='field'>
                        <input id='temp' name='temp' type='text' size='40' maxlength='40' value=''> 
                    </td>
                    <td class='status'>
                    </td>
                </tr>
                <tr>
                    <td align='center' colspan='3'>
                        <font color='#F62817'>
                            NOTICE: Once you select a weight or temperature type they cannot be changed! 
                        </font>
                    </td>
                </tr>
                <tr>
                    <td align='center' colspan='3'>
                        <input class="submit" type="submit" value="Create Company Record"> 
                    </td>
                </tr>
            </table>
        </form>
        <center><div id="errormessage"></div></center>