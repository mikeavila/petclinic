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
     //validate signup form on keyup and submit
     var validator = $('#petform').validate({
          rules: {
               petname: {
                    required: true,
                    minlength: 4
               },
               petdob: {
                    required: true,
                    minlength: 10
               },
               petbreed: {
                   required: true,
                   minlength: 1
               },
               petgender: {
                    required: true
               },
               petfixed: {
                    required: true
               },
               petdesc: {
                    required: true
               },
               petcolor: {
                    required: true,
                    minlength: 3
               },
               petpicture: {
                    required: true,
                    pattern: /^(Y|N)$/
               },
               petstatus: {
                    required: true,
                    pattern: /^(A|I|D)$/
               }
          },
          messages: {
               petname: {
                    required: 'Enter the Pet Name'
               },
               petdob: {
                    required: 'The pet DOB should have the format YYYY/MM/DD'
               },
               petbreed: {
                    required:'Select the correct Pet Breed'
               },
               petgender: {
                    required:'Select the Pet Gender'
               },
               petfixed: {
                    required:'Select whether (or not) the Pet has been Fixed'
               },
               petdesc: {
                    required:'Enter a Pet Description'
               },
               petcolor: {
                    required:'Enter the Pet Color(s)'
               },
               petpicture: {
                    required:'Enter Y or N if there is a Pet picture'
               },
               petstatus: {
                    required:'Enter the Pet Status'
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
        //  specifying a submitHandler prevents the default submit, good for the demo
          submitHandler: function() {
               continueon();
          },
       //   set this class to error-labels to indicate valid fields
          success: function(label) {
       //        set &nbsp; as text for IE
               label.html('&nbsp;').addClass('checked');
          },
          highlight: function(element, errorClass) {
               $(element).parent().next().find('.' + errorClass).removeClass('checked');
          }
     });
     return false;
});
function continueon() {
     var editpetnum = $('input#editpetnum').val();
     var emplnumber = $('input#emplnumber').val();
     var petname = $('input#petname').val();
     var petdob = $('input#petdob').val();
     var petbreed = $('select#petbreed').val();
     var petgender = $('select#petgender').val();
     var petfixed = $('select#petfixed').val();
     var petdesc = $('input#petdesc').val();
     var petcolor = $('input#petcolor').val();
     var license = $('input#license').val();
     var microchip = $('input#microchip').val();
     var rabiestag = $('input#rabiestag').val();
     var tattoonumber = $('input#tattoonumber').val();
     var picture = $('input#picture').val();
     var status = $('input#status').val();
     var client1 = $('input#client1').val();
     var client2 = $('input#client2').val();
     var petpic = $('select#petpic').val();
     var dataString = '&editpetnum=' + editpetnum + '&petname=' + petname + '&petdob=' + petdob + '&petbreed=' + petbreed + '&petgender=' + petgender +
          '&petfixed='+ petfixed + '&petdesc=' + petdesc + '&petcolor=' + petcolor + '&license=' + license + '&microchip=' + microchip + '&rabiestag=' + rabiestag +
          '&tattoonumber=' + tattoonumber + '&picture=' + picture + '&client1=' + client1 + '&client2=' + client2 + '&status=' + status + '&petpic=' + petpic + '&emplnumber=' + emplnumber;

  $.ajax({
      type: 'POST',
      url: 'petmaint1.php',
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
$mysqli = new mysqli('localhost', $_SESSION["user"], mc_decrypt($_SESSION["up"], ps_key), '');
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$emplnumber = $_SESSION['employeenumber'];
$log->logThis($logdatetimeecc."petmaint.php");

$editpetnum = "";

if(isset($_POST["editpetnum"])) {
     $editpetnum = $_POST["editpetnum"];
     unset($_POST["editpetnum"]);
}
else if(isset($_GET["editpetnum"])) {
     $editpetnum = $_GET["editpetnum"];
     unset($_GET["editpetnum"]);
}

$log->logThis($logdatetimeecc."editpetnum is ".$editpetnum);
$display = 'Petmaint:' . $emplnumber;

if ( !empty($_SESSION['pet_data']) ) {
    echo '<div class="success">Successfully added/updated pet: ' . $_SESSION['pet_data']['petname'] . ', pet#(' . $_SESSION['pet_data']['pid'] . ')</div>';
    unset ($_SESSION['pet_data']); // don't retain this data.
}

if ($editpetnum == "")
{
     $log->logThis($logdatetimeecc."editpetnum is null (or empty string?)");
     echo '<center><form action="petmaint.php" method="post">';
     echo '<table width="25%">';
     echo '<tr><td>Enter the Pet Number to be edited.</td></tr>';
     echo '<tr><td><input type="text" name="editpetnum" size="5" maxlength="5" value=""></td></tr>';
     echo '<tr><td><input type="submit" value="Edit Requested Pet"></td></tr></table>';
     echo '</form><form action="petmaint.php" method="post">';
     echo '<input type="hidden" name="editpetnum" value="new">';
     echo '<table width="25%"><tr><td><input type="submit" value="Create New Pet"></td></tr>';
     echo '</table></form></center>';
    include 'includes/returnmaintmenu.inc';
     require_once 'includes/footer.inc';
     exit();
}
else if ($editpetnum == "new") {
     $log->logThis($logdatetimeecc."editpetnum is new");

     $petname="";
     $petdob="";
     $petbreed="";
     $petgender="";
     $petfixed="";
     $petcolor="";
     $petdesc="";
     $license="";
     $microchip="";
     $rabiestag="";
     $tattoonumber="";
     $picture="N";
     $status="A";
     $changeid=$emplnumber;
     $client1 = "";
     $client2 = "";
}
else {
     $sql = "SELECT * FROM `petclinic`.`pet` WHERE `petnumber` = ".$editpetnum;
     $result = $mysqli->query($sql);
     if ($result == FALSE)
     {
          put_errormsg("Pet SELECT failed; ".$mysqli->error);
          redirect("mainmenu.php");
          exit();
     }
     $row_cnt = $result->num_rows;
     if ($row_cnt == 0) {
          put_errormsg("Invalid Pet Number");
          redirect("maintmenu.php");
          exit();
     }

     $row = $result->fetch_row();
     $petname = $row[1];
     $petdob = $row[2];
     $petbreed = $row[3];
     $petgender = $row[4];
     $petfixed = $row[5];
     $petcolor = $row[6];
     $petdesc = $row[7];
     $license = $row[8];
     $microchip = $row[9];
     $rabiestag = $row[10];
     $tattoonumber = $row[11];
     $picture = $row[12];
     $status = $row[13];
     $changeid = $emplnumber;
}
?>
<form id="petform" name="petform">
<table cellpadding="5" cellspacing="5" width="90%">
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">Pet Number</td>
     <td class="field">
         <input type="text" id="editpetnum" name="editpetnum" size="4" maxlength="4" READONLY value="<?php echo $editpetnum; ?>">
     </td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petname">Pet Name</label>
     </td>
     <td class="field">
         <input id="petname" name="petname" type="text" size="15" maxlength="15" value="<?php echo $petname;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petdob">Date of Birth (as YYYY/MM/DD)</label>
     </td>
     <td class="field">
         <input id="petdob" name="petdob" type="text" size="10" maxlength="10" value="<?php echo $petdob;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="center">Species</td>
     <td class="center">
         <select id="breedFilter" size="3" onchange="applyBreedFilter(this);">
             <option value="all" selected>All Species</option>
              <?php
               $sql = "SELECT * FROM `petclinic`.`code_species` ORDER BY `speciesdesc`;";
               $result = $mysqli->query($sql);
               $speciesCodes = array();

               while ( $row = $result->fetch_row() ) {
                   echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                   $speciesCodes[$row[0]] = $row[1];
               }
             ?>
         </select>
     </td>
     <td class="label">Breed</td>
     <td class="field">
         <select id="petbreed" name="petbreed" size="5">
             <option value=""></option>
          <?php
               $breeds = array();

               foreach ( $speciesCodes as $key => $value ) {
                   // create an array for each code so we can 'group' the breeds by species.
                   $breeds[$key] = array();
               }

               $sql = "SELECT * FROM `petclinic`.`code_breed` ORDER BY `breeddesc`;";
               $result = $mysqli->query($sql);

               if ($result == FALSE)
               {
                    put_errormsg("Internal error for code_breed (1)");
                    redirect("mainmenu.php");
               }
               $row_cnt = $result->num_rows;
               if ($row_cnt == 0) {
                    put_errormsg("Internal error for code_breed (2)");
                    redirect("mainmenu.php");
                    exit();
               }

               while ($row = $result->fetch_row()) {
                    $option = '';

                    if( $petbreed == $row[1] ) {
                        $option = '<option value="' . $row[1] . '" selected>' . $row[2] . '</option>';
                    }
                    else {
                        $option = '<option value="' . $row[1] . '">' . $row[2] . '</option>';
                    }

                    $breeds[$row[0]][] = $option;
               }

               foreach ( $breeds as $key => $value ) {
                   $speciesDesc = $speciesCodes[$key];
                   echo '<optgroup id="' . $key . '" label="----- ' . $speciesDesc . ' -----">';

                   if ( !empty($value) ) {
                       echo implode( $value );
                   }
                   else {
                       // Cover the situation where there may not yet be any
                       // breeds listed for the species.
                       echo '<option value="">No ' . $speciesDesc . ' entries found</option>';
                   }

                   echo '</optgroup>';
               }

               unset($speciesCodes, $breeds); // release the arrays used at this area.
          ?>
         </select>
     </td>
     <td class="status"></td>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petgender">Gender</label>
     </td>
     <td class="field">
          <select id="petgender" name="petgender" size="2">
<?php
          echo '<option value="M"' . ($petgender == "M" ? ' selected' : '') . '>Male</option>';
          echo '<option value="F"' . ($petgender == "F" ? ' selected' : '') . '>Female</option>';
?>
          </select>
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petfixed">Fixed</label>
     </td>
     <td class="field">
          <select id="petfixed" name="petfixed" size="2">
<?php
          echo '<option value="Y"' . ($petfixed == "Y" ? ' selected' : '') . '>Yes</option>';
          echo '<option value="N"' . ($petfixed == "N" ? ' selected' : '') . '>No</option>';
?>
          </select>
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petdesc">Description</label>
     </td>
     <td class="field">
         <input id="petdesc" name="petdesc" type="text" size="50" maxlength="50" value="<?php echo $petdesc;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="petcolor">Color</label>
     </td>
     <td class="field">
         <input id="petcolor" name="petcolor" type="text" size="50" maxlength="20" value="<?php echo $petcolor;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="license">License</label>
     </td>
     <td class="field">
         <input id="license" name="license" type="text" size="15" maxlength="15" value="<?php echo $license;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="microchip">Microchip</label>
     </td>
     <td class="field">
         <input id="microchip" name="microchip" type="text" size="18" maxlength="18" value="<?php echo $microchip;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="rabiestag">Rabies Tag</label>
     </td>
     <td class="field">
         <input id="rabiestag" name="rabiestag" type="text" size="10" maxlength="10" value="<?php echo $rabiestag;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="tattoonumber">Tatto Number</label>
     </td>
     <td class="field">
         <input id="tattoonumber" name="tattoonumber" type="text" size="10" maxlength="10" value="<?php echo $tattoonumber;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="picture">Picture (Y/N)</label>
     </td>
     <td class="field">
         <input id="picture" name="picture" type="text" size="1" maxlength="1" value="<?php echo $picture;?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">
         <label for="status">Status (A/I/D)</label>
     </td>
     <td class="field">
         <input id="status" name="status" type="text" size="1" maxlength="1" value="<?php echo $status;?>">
     </td>
     <td class="status"></td>
</tr>
<?php
$clientpc = array_fill(0, 2, "");

if ( 'new' != $editpetnum ) {
     $sqlclient="SELECT clientnumber FROM `petclinic`.`clientpet` WHERE `petnumber` = " . $editpetnum ;
     $resultpc = $mysqli->query($sqlclient);

     if ($resultpc <> FALSE) {
          if ( $resultpc->num_rows != 0 ) {
               $i = 0;
               while ( ($rowpc = $resultpc->fetch_row()) && $i < 2) {
                    $clientpc[$i] = $rowpc[0];
                    ++$i;
               }
          }
     }
}
?>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="center"><a href="petmaintc.php" target="_blank"> Click Here </a> to get a list of Clients</td>
     <td colspan="2">&nbsp;</td>
</tr>
<tr>
     <td rowspan="2" class="center" colspan="2">This pet belongs<br>to client(s):</td>
     <td class="label">
         <label for="client1">Client number</label>
     </td>
     <td class="field">
         <input id="client1" name="client1" type="text" size="5" maxlength="5" value="<?php echo $clientpc[0];?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td class="label">
         <label for="client2">Additional Client</label>
     </td>
     <td class="field">
         <input type="text" id="client2" name="client2" size="5" maxlength="5" value="<?php echo $clientpc[1]; ?>">
     </td>
     <td class="status"></td>
</tr>
<tr>
     <td colspan="2">&nbsp;</td>
     <td class="label">Do you want to upload a pet picture?</td>
     <td class="field">
         <select id="petpic" name="petpic" size="2">
             <option value="N" selected>No</option>
             <option value="Y">Yes</option>
         </select>
     </td>
</tr>
</table>
<input type="hidden" id="emplnumber" name="emplnumber" value="<?php echo $emplnumber; ?>">
<div class="center"><input type="submit" value="Create/Update Pet"></div>
</form>
<?php
include "includes/returnmaintmenu.inc";
include "includes/display_errormsg.inc";
require_once "includes/footer.inc";
$mysqli->close();
?>