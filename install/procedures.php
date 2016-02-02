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
function installprocs (procname, yn) {
     switch (procname) {
          case 's':
               document.getElementById('snomed').style.visibility = 'hidden';
               if (yn == 'y') {
                    window.open ("snomedvts.php","_blank");
               }
               document.getElementById('venom1').style.visibility = 'visible';
               break;
          case '1':
               document.getElementById('venom1').style.visibility = 'hidden';
               if (yn == 'y') {
                    window.open ("venom1.php","_blank");
                    document.getElementById('venom2').style.visibility = 'visible';
               } else {
                    document.getElementById('continuediv').style.visibility = 'visible';
               }
               break;
          case '2':
               document.getElementById('venom2').style.visibility = 'hidden';
               window.open ("venom2.php","_blank");
               document.getElementById('venom3').style.visibility = 'visible';
               break;
          case '3':
               document.getElementById('venom3').style.visibility = 'hidden';
               window.open ("venom3.php","_blank");
               document.getElementById('continuediv').style.visibility = 'visible';
               break;
          default:
               break;
     }
     return false;
}
function continueon () {
     $("#tabs").tabs("option", "disabled", [ 0, 1, 2, 4, 5, 6, 7, 8, 9, 10 ] );
     $("#tabs").tabs("enable", 3 );
     $("#tabs").tabs("option", "active", 3 );
     $("#tab3").load("company.php");
}
</script>
Select what procedures you want to install. A database and table to put your own
procedures in will automatically be created. You also have the option of two
industry standard procedures lists: SNOMED-VTS (Veterinary Extension to SNOMED CT 
by the Virginia Maryland Regional College of Veterinary Medicine) and 
VeNom (by the Royal Veterinary College). These two procedures sets contain procedure 
codes for animals. 
<br>
RECOMMENDED: VeNom is recommended because of its extensive set of procedures, diagnosis 
codes, species, and breeds. Because of the amount and complexity of the data, it is 
installed in 3 steps.
<br><br>
<div id="snomed" style="visibility: visible">
Do you want to install the SNOMED-VTS procedures? 
<br><form>
<input class="submit" type="submit" value="Yes" onclick="return installprocs('s', 'y');">
<input class="submitNo" type="submit" value="No" onclick="return installprocs('s', 'n');">
</form>
</div>
<br>
<div id="venom1" style="visibility: hidden">
Do you want to install the VeNom procedures? (Step 1 of 3)
<br><form>
<input class="submit" type="submit" value="Yes" onclick="return installprocs('1', 'y');">
<input class="submitNo" type="submit" value="No" onclick="return installprocs('1', 'n');">
</form><br>
</div>
<br>
<div id="venom2" style="visibility: hidden">
Now click to install Step 2 of 3
<br><form>
<input class="submit" type="submit" value="Yes" onclick="return installprocs('2', 'y');">
</form><br>
</div>
<br>
<div id="venom3" style="visibility: hidden">
Now click to install Step 3 of 3
<br><form>
<input class="submit" type="submit" value="Yes" onclick="return installprocs('3', 'y');">
</form><br>
</div>
<br>
<div id="continuediv" style="visibility: hidden">
<br>
<input class="submit" type="submit" value="Continue" onclick="continueon();">
<br>
</div>