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
In order to complete the entries for some of the inventory, it is important to understand how the application manages inventory. 
The application uses a concept of 
<br><br>
<center><b>Item <-> Container <->Carton </b></center>
<br><br>
An item by default is defined as the smallest unit dispensed or sold. A container contains multiple items or units. 
A carton contains one or more containers.
<br><br>
Let's use as an example a pill that is dispensed to a client. The individual pill is the item. 
The pill comes from a container which contains many of the pills. In some cases, you might sell a few pills or you might even 
sell the entire container of pills. Regardless, pills are sold by quantity, not by the container. 
If a container has 60 pills in it and you wish to sell an entire container, the quantity is 60, not 1. 
When you purchase the pill containers, you may receive multiple containers within a carton. If the pills are ONLY sold by the container, 
then the item quantity is zero and the container quantity is 1. The number of bottles purchased is what the carton contains.
<br><br>
<center><a href="javascript:window.opener='x';window.close();">Close Window</a></center>
