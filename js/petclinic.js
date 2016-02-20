//var JQUERY4U = {};
//
//(function($,W,D)
//{
//    JQUERY4U.UTIL =
//    {
//        setupClientValidation: function()
//        {
//            $("#clientform").validate({
//                rules: {
//                    fname: {
//                        required: true,
//                        minlength: 3
//                    },
//                    lname: {
//                         required: true,
//                         minlength: 3
//                    },
//                    address1: {
//                         required: true,
//                         minlength: 4
//                    },
//                    city: {
//                         required: true,
//                         minlength: 4
//                    },
//                    zipcode: {
//                         required: true,
//                         minlength: 5,
//                         maxlength: 7
//                    },
//                    htele: {
//                         required: true,
//                         phoneUS: true
//                    },
//                    status: {
//                         required: true,
//                         pattern: /^(A|I|D)$/
//                    }
//                },
//                messages: {
//                    fname: {
//                         required: "Enter the Client&#39;s First Name"
//                    },
//                    lname: {
//                         required: "Enter the Client&#39;s Last Name"
//                    },
//                    address1: {
//                         required: "Enter the Client&#39;s Address"
//                    },
//                    city: {
//                        required: "Enter the City where your Client lives"
//                    },
//                    zipcode: {
//                         required: "Enter the Zip Code where the Client lives"
//                    },
//                    htele: {
//                         required: "Enter the Client&#39;s Telephone Number"
//                    },
//                    status: {
//                         required: "Enter the Client Status"
//                    }
//                },
//                // the errorPlacement has to take the table layout into account
//                errorPlacement: function(error, element) {
//                    if (element.is(":radio"))
//                        error.appendTo(element.parent().next().next());
//                    else if (element.is(":checkbox"))
//                        error.appendTo(element.next());
//                    else
//                        error.appendTo(element.parent().next());
//                },
//                // specifying a submitHandler prevents the default submit, good for the demo
//                submitHandler: function() {
//                    //alert("submitted!");
//                    submitClientData();
//                },
//                // set this class to error-labels to indicate valid fields
//                success: function(label) {
//                    // set &nbsp; as text for IE
//                    label.html("&nbsp;").addClass("checked");
//                },
//                
//                highlight: function(element, errorClass) {
//                    $(element).parent().next().find("." + errorClass).removeClass("checked");
//                }
//            });
//        },
//        setupCompanyValidation: function() {
//            $("#companyform").validate({
//                rules: {
//                    coname: "required",
//                    addr: "required",
//                    coname: {
//                        required: true,
//                        minlength: 2
//                    },
//                    addr: {
//                        required: true,
//                        minlength: 5
//                    },
//                    city: {
//                        required: true,
//                        minlength: 5
//                    },
//                    state: {
//                        required: true,
//                        minlength: 4
//                    },
//                    zip: {
//                        required: true,
//                        minlength: 5,
//                        maxlength: 10
//                    },
//                    htele: {
//                        required: true
//                    },
//                    tax: {
//                        required: true,
//                        number: true
//                    },
//                    weight: {
//                        required: true,
//                        pattern: "^(K|P)$"
//                    },
//                    temp: {
//                        required: true,
//                        pattern: "^(F|C)$"
//                    }
//                },
//                messages: {
//                    coname: {
//                        required: "Please enter the Name of your Company"
//                    },
//                    addr: {
//                        required: "Please enter the address of your Company" 
//                    },
//                    city: {
//                        required: "Please enter the City where your Company is located"
//                    },
//                    state: {
//                        required: "Please enter the State where your Company is located"
//                    },
//                    zip: {
//                        required: "Please enter the Zip Code where your Company is located"
//                    },
//                    htele: {
//                        required: "Please enter the Company Telephone Number"
//                    },
//                    tax: {
//                        required: "Please enter your state tax rate as 00.00"
//                    },
//                    weight: {
//                        required: "Please enter P for Pounds or K for Killograms"
//                    },
//                    temp: {
//                        required: "Please enter F for Fahrenheit or C for Celsius"
//                    }
//                },
//                // the errorPlacement has to take the table layout into account
//                errorPlacement: function(error, element) {
//                    if (element.is(":radio"))
//                        error.appendTo(element.parent().next().next());
//                    else if (element.is(":checkbox"))
//                        error.appendTo(element.next());
//                    else
//                        error.appendTo(element.parent().next());
//                },
//                // specifying a submitHandler prevents the default submit, good for the demo
//                submitHandler: function() {
//                    //    alert("submitted!");
//                    submitCompanyData();
//                },
//                // set this class to error-labels to indicate valid fields
//                success: function(label) {
//                    // set &nbsp; as text for IE
//                    label.html("&nbsp;").addClass("checked");
//                },
//                highlight: function(element, errorClass) {
//                    $(element).parent().next().find("." + errorClass).removeClass("checked");
//                }
//            });
//        },
//        setupEmployeeValidation: function() {
//            $("#employeeform").validate({
//                rules: {
//                    euserid: "required",
//                    epassword: "required",
//                    euserid: {
//                        required: true,
//                        minlength: 2
//                    },
//                    epassword: {
//                        required: true,
//                        minlength: 5
//                    },
//                    fname: {
//                        required: true,
//                        minlength: 3
//                    },
//                    lname: {
//                        required: true,
//                        minlength: 3
//                    },
//                    address: {
//                        required: 5
//                    },
//                    city: {
//                        required: 3
//                    },
//                    state: {
//                        required: true,
//                        minlength: 4
//                    },
//                    zipcode: {
//                        required: true,
//                        minlength: 5,
//                        maxlength: 10
//                    },
//                    tele: {
//                        required: true,
//                        phoneUS: true
//                    }
//                },
//                messages: {
//                    euserid: {
//                        required: "Please enter the a Userid for this Employee"
//                    },
//                    epassword: {
//                        required: "Please enter a Password for this Employee" 
//                    },
//                    fname: {
//                        required: "Please enter the Employee's First Name"
//                    },
//                    lname: {
//                        required: "Please enter the Employee's Last Name"
//                    },
//                    address: {
//                        required: "Please enter the Employee's Address"
//                    },
//                    city: {
//                        required: "Please ener the City where your Employee lives"
//                    },
//                    state: {
//                        required: "Please enter the State where your Employee lives"
//                    },
//                    zipcode: {
//                        required: "Please enter the Zip Code where the Employee lives"
//                    },
//                    tele: {
//                        required: "Please enter the Employee's Telephone Number"
//                    }
//                },
//                // the errorPlacement has to take the table layout into account
//                errorPlacement: function(error, element) {
//                    if (element.is(":radio"))
//                        error.appendTo(element.parent().next().next());
//                    else if (element.is(":checkbox"))
//                        error.appendTo(element.next());
//                    else
//                        error.appendTo(element.parent().next());
//                },
//                // specifying a submitHandler prevents the default submit, good for the demo
//                submitHandler: function() {
//                    //alert("submitted!");
//                    submitEmployeeData();
//                },
//                // set this class to error-labels to indicate valid fields
//                success: function(label) {
//                    // set &nbsp; as text for IE
//                    label.html("&nbsp;").addClass("checked");
//                },
//                highlight: function(element, errorClass) {
//                    $(element).parent().next().find("." + errorClass).removeClass("checked");
//                }
//            });
//        }
//    }
//
//    //when the dom has loaded setup form validation rules
//    $(D).ready(function($) {
//        JQUERY4U.UTIL.setupClientValidation();
//        JQUERY4U.UTIL.setupCompanyValidation();
//        JQUERY4U.UTIL.setupEmployeeValidation();
//    });
//
//})(jQuery, window, document);

function sendmmnav(element) {
   var code = element.getAttribute('data-menu');

   if ( code != '0' ) {
      window.location="http://localhost/petclinic/mmnav.php?menu="+code;
      return;
   }
}

//function submitClientData() {
//    var clientnum = $("input#editclientnum").val();
//    var prefix = $("input#prefix").val();
//    var fname = $("input#fname").val();
//    var lname = $("input#lname").val();
//    var suffix = $("input#suffix").val();
//    var address1 = $("input#address1").val();
//    var address2 = $("input#address2").val();
//    var city = $("input#city").val();
//    var state = $("select#state").val();
//    var zipcode = $("input#zipcode").val();
//    var htele = $("input#htele").val();
//    var ftele = $("input#ftele").val();
//    var ctele = $("input#ctele").val();
//    var email = $("input#email").val();
//    var status = $("input#status").val();
//    var billable = $("select#billable").val();
//    var emplnumber = $("input#emplnumber").val();
//    var dataString = "&prefix=" + prefix + "&fname=" + fname + "&lname=" + lname +
//                     "&suffix=" + suffix + "&address1=" + address1 + "&address2=" + address2 +
//                     "&city=" + city + "&state=" + state + "&zipcode=" + zipcode +
//                     "&htele=" + htele + "&ftele=" + ftele + "&ctele=" + ctele +
//                     "&email=" + email + "&status=" + status + "&billable=" + billable +
//                     "&emplnumber=" + emplnumber + "&editclientnum=" + clientnum;
//    $.ajax({
//        type: "POST",
//        url: "clientmaint1.php",
//        data: dataString,
//        cache: false,
//        done: fakeit
//    });
//
//    return false;
//}
//
//function submitCompanyData() {
//    var coname = $("input#coname").val();
//    var addr = $("input#addr").val();
//    var addr2 = $("input#addr2").val();
//    var city = $("input#city").val();
//    var state = $("input#state").val();
//    var zip = $("input#zip").val();
//    var htele = $("input#htele").val();
//    var ftele = $("input#ftele").val();
//    var logo = $("input#logo").val();
//    var lic = $("input#lic").val();
//    var tax = $("input#tax").val();
//    var weight = $("input#weight").val();
//    var temp = $("input#temp").val();
//    var dataString = '&coname='+ coname + '&addr=' + addr + '&addr2=' + addr2 +
//                        '&city=' + city + '&state=' + state + '&zip=' + zip +
//                        '&htele=' + htele + '&ftele=' + ftele + '&logo=' + logo +
//                        '&lic=' + lic + '&tax=' + tax + '&weight=' + weight +
//                        '&temp=' + temp;
//    $.ajax({
//        type: "POST",
//        url: "install1.php",
//        data: dataString,
//        cache: false,
//        success: function() {
//            $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 5, 6, 7, 8, 9, 10 ] );
//            $("#totalprogress").progressbar({ value: 40 });
//            $("tabs").tabs("enable", 4);
//            $("#tabs").tabs("option", "active", 4);
//            setTimeout(fakeit, 4000);
//            $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 ] );
//            $("#tabs").tabs("enable",5 );
//            $("#tabs").tabs("option", "active", 5 );
//            $("#tab5").load("employee.php");
//           }
//    });
//  
//    return false;
//}
//
//function submitEmployeeData() {
//    var userid = $("input#euserid").val();
//    var epassword = $("input#epassword").val();
//    var prefix = $("input#prefix").val();
//    var fname = $("input#fname").val();
//    var lname = $("input#lname").val();
//    var suffix = $("input#suffix").val();
//    var address = $("input#address").val();
//    var address2 = $("input#address2").val();
//    var city = $("input#city").val();
//    var state = $("input#state").val();
//    var zipcode = $("input#zipcode").val();
//    var tele = $("input#tele").val();
//    var dataString = '&userid='+ userid + '&epassword=' + epassword + '&prefix=' + prefix +
//                      '&fname=' + fname + '&lname=' + lname + '&suffix=' + suffix +
//                      '&address=' + address + '&address2=' + address2 + '&city=' + city +
//                      '&state=' + state + '&zipcode=' + zipcode + '&tele=' + tele;
//    $.ajax({
//        type: "POST",
//        url: "install2.php",
//        data: dataString,
//        cache: false,
//        success: function() {
//            $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 5, 7, 8, 9, 10 ] );
//            $("#tabs").tabs("enable", 6 );
//            $("#tabs").tabs("option", "active", 6);
//            $( "#totalprogress").progressbar({  value: 60 });
//            setTimeout(fakeit, 4000);
//            $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 3, 4, 5, 6, 7, 9, 10 ] );
//            $("#tabs").tabs("enable", 8 );
//            $("#tabs").tabs("option", "active", 8 );
//            $("#tab8").load("continue.php");
//        }
//    });
//   
//    return false;
//}

function fakeit() {
    return;
}