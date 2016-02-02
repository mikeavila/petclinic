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
<center><font size="+2"><b><u>Logon Help</u></b></font></center>
<br>
The Logon web page is the "entrance" to the Vet Clinic Software application. This web page is used to provide security to the various application features. 
It ensures you are the person authorized to access the application and its features. 
<BR>
To login, you need three (3) pieces of information. You would obtain these items from the person that created your employee record. You need your 
Employee Number, your User ID, and your Password. Enter these items where indicated on the Login web page.
<br>
If this is your first time logging in to VetClinic, you will be asked to create a new password. This is to ensure that you and only you know the password 
to enter the site using your identification. Guard these three (3) items carefully. They represent you.
<br>
If you forget your password, you can try to reset the password yourself. You must have entered a Reset Hint Question and Answer in your employee record.
If you have not done this the System Administrator must reset your password.
<br><br><center><b><u>Messages</u></b></center>
<br><br>
<b><u>You must enter more information</u></b> You will receive a more specific message when you do not enter you employee number,
user id, or password.
<br>
<br>
<b><u>Sometimes no message</u></b> When incorrect information is entered no messge is shown for security reasons. If someone is 
trying to logon with your information, telling them which information is wrong helps them concentrate on that specific information.
To make it harder the specific incorrect information is not identified.
<br><br>
<b><u>Logons have been disabled</u></b> When the System Administrator needs to perform updates or other system tasks, he/she stops
logons to prevent errors for the user and for the tasks being performed.
<br><br>
<b><u>Your Userid is Inactive or Deleted</u></b> Your userid has become inactive or hs been deleted. Contact the System Administrator 
to find out why.
<br><br>
<center><a href="javascript:window.opener='x';window.close();">Close Window</a></center>