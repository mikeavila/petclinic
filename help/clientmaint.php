<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*VetClinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$background = "2";
require_once "../includes/header1.inc";
require_once "../includes/header2.inc";
?>
<br><br>
<center><font size="+2"><b><u>Client Help</u></b></font></center>
<br>
Most of the input is self explanatory except for two: Status and Billable.
<br><br>
<b><u>Status:</u></b> The Status input can be one of three values. A(ctive), I(nactive), or
D(elete). Normally it will be A(ctive).
<br><br>
<b><u>Billable:</u></b> Just about anyone can be a client. Let us usde the example of a family consiting
of a  father, mother, and a son. Any one of them could be a client because any one of them could bring in
their pet. Perhaps only the father wants to be billed for the visit. Or perhaps only the father and mother. 
The client who can be billed for the visit is a Billable Client. For tht prson you would select Yes so they 
can be billed. When you select Yes for a Billable Client, their name is added to the invoice subsystem.
<br><br>
<center><a href="javascript:window.opener='x';window.close();">Close Window</a></center>