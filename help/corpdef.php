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
<center><font size="+2"><b><u>Company Default Settings Help</u></b></font></center>
<br>
The application defaults provide a way to save data entry keying, manual adjustments, and other ways to speed up the application.
<br><br>
<b><u>Preload Defaults:</u></b> This setting will preload defaults every time a user logs in to the application. This will slightly increase 
logon time and slightly decrease the loading of the web pages every time. By preloading the defaults at log on, the application does not 
have to access the database for the defaults every time a new web page is displayed. However, if defaults are changed when a user is online, 
the defaults will <b>NOT</b> change for that person until they log on the next time. <b>Critical defaults</b> will never be preloaded.
Example: Background colors will be preloaded. Automatic Sales Price will never be preloaded.
<br><br>
<b><u>Default State:</u></b> The default state is used when creating new clients. Instead of having to go through a list of states,
the default state is shown. You still have the option of changing the state but the majority of times the state where you are located will
be the state where your customers are located. This setting can be preloaded.
<br><br>
<b><u>Automatic Sales Price:</u></b> When a new purchase transaction is created and the purchase cost is higher that the previous cost,
the application, using the markup percent you indicated in the base record for that inventory item, the sales price can be automatically
adjusted. If you do not set this setting to "Y" you will have to manually adjust the sales price. This setting will not be preloaded.
<br><br>Time Zone</u></b> Select the city closest to you but in the same time zone as your clinic. You may not get the correct time
set in the application if you have an incorrect time zone.
<br><br>
<center><a href="javascript:window.opener='x';window.close();">Close Window</a></center>