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
******************************************************************
* Obtained from stackoverflow.com                                *
*                                                                *
* Just add this after jQuery loads and before your code          *
*****************************************************************/
?>
<script type="text/javascript">
$(window).ajaxComplete(function () {console.log('Ajax Complete'); });
$(window).ajaxError(function (data, textStatus, jqXHR) {console.log('Ajax Error');
    console.log('data: ' + data);
    console.log('textStatus: ' + textStatus);
        console.log('jqXHR: ' + jqXHR); });
$(window).ajaxSend(function () {console.log('Ajax Send'); });
$(window).ajaxStart(function () {console.log('Ajax Start'); });
$(window).ajaxStop(function () {console.log('Ajax Stop'); });
$(window).ajaxSuccess(function () {console.log('Ajax Success'); });
</script>