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
function continueon() {
     $( "#tabs" ).tabs( "option", "disabled", [ 0, 1, 2, 3, 4, 5, 6, 7, 9, 10 ] );
     $("#tabs" ).tabs("enable", 8 );
     $("#tabs").tabs("option", "active", 8);
     $( "#stepprogress" ).progressbar({ value: 0 });
     $( "#totalprogress" ).progressbar({  value: 70 });
     $("#tab8").load("install3.php");
}
</script>
<br>To continue, enter the requested information and click on the submit button below. 
<br>The remaining databases and tables will be created.
<form method='post' onSubmit="continueon(); return false">
<br><br>Enter the name or the IP Address given to the server/computer where the mySQL Server is located.
<br><input name="computer" type="text" size="25" maxlength="25">
<br><br>Enter the email address of the Vet Clinic.
<br><input name="email" type="text" size="40" maxlength="40">
<br><br>Enter the domain name of the Vet Clinic.
<br><input name="domain" type="text" size="30" maxlength="30">
<br><br><input class="submit" type="submit" value="Continue">
</form>