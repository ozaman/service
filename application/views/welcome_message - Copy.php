<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to T-booking.com API</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	.style1 {
	color: #FF0000;
	font-weight: bold;
}
    .style2 {
	color: #0000FF;
	font-weight: bold;
}
    </style>
</head>
<body>

<div id="container">
	<h1>Welcome to API T-booking.com </h1>

	<div id="body">
	  <p><strong>This is parameter for connect API </strong></p>
	  <p><strong>Ex. Transfer Product   Pickup form Airport  Parameter </strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><br>
              <strong>Name</strong> </td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Agent REF (T-booking.com) in your system * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>arrival_date</p></td>
          <td valign="top"><p>date</p></td>
          <td valign="top"><p>Y-m-d</p></td>
          <td valign="top"><p>Arrival date  Date    format Y-m-d ex. 2016-03-21  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>arrival_time</p></td>
          <td valign="top"><p>time</p></td>
          <td valign="top"><p>H:i </p></td>
          <td valign="top"><p>Arrival time Ex. 09:30 (this is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>arrival_flight</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Arrival flight number of flight * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>number_car</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Total number of car for use this type transfer only * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>to_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for to place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>text</p></td>
          <td valign="top"><p>Text Remark  If have the    remark </p></td>
        </tr>
      </table>
	  <p><strong>&nbsp;</strong> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <em><u>YOUR_API_KEY</u></em><br>
	    {<br>
&quot;agent_ref&quot; : &quot; api00100&quot;,<br>
&quot;guest&quot; : &quot; guest name&quot;,<br>
&quot;adult&quot; : &quot;5&quot;,<br>
&quot;child&quot; : &quot;2&quot;,<br>
&quot;phone&quot; : &quot;0123456789&quot;,<br>
&quot;product&quot; : &quot;00003&quot;,<br>
&quot;arrival_date&quot;  : &quot;2016-07-21&quot;,<br>
&quot;arrival_time&quot;  : &quot;09:30&quot;,<br>
&quot;arrival_flight&quot;  : &quot;TG201&quot;,<br>
&quot;number_car&quot; : &quot;1&quot;,<br>
&quot;to_place&quot;  : &quot;To place test&quot;,<br>
&quot;remark&quot;  : &quot;Remark This Booking Pickup from airport&quot;<br>
      }</p>
	  <p><strong>Ex. Transfer Product  Sent To  Airport   Parameter </strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><br>
              <strong>Name</strong> </td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Agent REF (T-booking.com) in vbooking is  订单号 * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>departure_date</p></td>
          <td valign="top"><p>date</p></td>
          <td valign="top"><p>Y-m-d</p></td>
          <td valign="top"><p>Departure date  Date format Y-m-d    ex. 2016-03-21  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>departure_time</p></td>
          <td valign="top"><p>time</p></td>
          <td valign="top"><p>H:i </p></td>
          <td valign="top"><p>Departure time Ex. 09:30 (this is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>departure_flight</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Departure flight number of flight * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>number_car</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Total number of car for use this type transfer only * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>pickup_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for pickup place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>text</p></td>
          <td valign="top"><p>Text Remark  If have the    remark </p></td>
        </tr>
      </table>
	  <p class="style1">*** After this product update  status system will sent new status and pickup time to your system</p>
	  <p> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <em><u>YOUR_API_KEY</u></em><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot; guest name&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;00004&quot;,<br>
	    &quot;departure  _date&quot; : &quot;2016-07-26&quot;,<br>
	    &quot;departure  _time&quot; : &quot;20:30&quot;,<br>
	    &quot;departure  _flight&quot; : &quot;TG201&quot;,<br>
	    &quot;number_car&quot; : &quot;1&quot;,<br>
	    &quot;pickup _place&quot;  : &quot;Pickup place test&quot;,<br>
	    &quot;remark&quot;  : &quot;Remark This Booking  Sent To  airport&quot;<br>
	    }</p>
	  <p><strong>Ex. Transfer Product   Point To Point / Servive  Parameter </strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><br>
              <strong>Name</strong> </td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Agent REF (T-booking.com) in vbooking is  订单号 * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>service_date</p></td>
          <td valign="top"><p>date</p></td>
          <td valign="top"><p>Y-m-d</p></td>
          <td valign="top"><p>Service date  Date format Y-m-d    ex. 2016-03-21  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>service_time</p></td>
          <td valign="top"><p>time</p></td>
          <td valign="top"><p>H:i </p></td>
          <td valign="top"><p>Service  time Ex. 09:30 (this    is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>number_car</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Total number of car for use this type transfer only * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>pickup_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for pickup place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>to_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for to place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>text</p></td>
          <td valign="top"><p>Text Remark  If have the    remark </p></td>
        </tr>
      </table>
	  <p><strong>&nbsp;</strong> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <em><u>YOUR_API_KEY</u></em><br>
	    {<br>
&quot;agent_ref&quot; : &quot; api00100&quot;,<br>
&quot;guest&quot; : &quot; guest name&quot;,<br>
&quot;adult&quot; : &quot;5&quot;,<br>
&quot;child&quot; : &quot;2&quot;,<br>
&quot;phone&quot; : &quot;0123456789&quot;,<br>
&quot;product&quot; : &quot;00013&quot;,<br>
&quot;service _date&quot;  : &quot;2016-07-26&quot;,<br>
&quot;service _time&quot;  : &quot;20:30&quot;,<br>
&quot;number_car&quot; : &quot;1&quot;,<br>
&quot;pickup  _place&quot; : &quot;Pickup place test&quot;,<br>
&quot;to  _place&quot; : &quot;To place test&quot;,<br>
&quot;remark&quot;  : &quot;Remark This Booking Point to Point / Service&quot;<br>
      }</p>
	  <p>===========================================================<br>
      <strong>Ex.  Tour  Product  Include   transfer Parameter </strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><br>
              <strong>Name</strong> </td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Agent REF (T-booking.com) in vbooking is  订单号 * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>ondate</p></td>
          <td valign="top"><p>date</p></td>
          <td valign="top"><p>Y-m-d</p></td>
          <td valign="top"><p>Ondate  Date format    Y-m-d ex. 2016-03-21  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>program_start</p></td>
          <td valign="top"><p>time</p></td>
          <td valign="top"><p>H:i </p></td>
          <td valign="top"><p>Pragram Start Ex. 09:30 (this is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>pickup_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for pickup place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>to_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Location topic for to place (English Only) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>text</p></td>
          <td valign="top"><p>Text Remark  If have the    remark </p></td>
        </tr>
      </table>
	  <p class="style1">*** After this product update  status system will sent new status and pickup time to your system</p>
	  <p>POST /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <em><u>YOUR_API_KEY</u></em><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot;  : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;S0005&quot;,<br>
	    &quot;ondate&quot; : &quot;2016-06-23&quot;,<br>
	    &quot;program_start&quot; : &quot;21:00&quot; ,<br>
	    &quot;pickup_place&quot;  : &quot;test&quot;,<br>
	    &quot;to_place&quot; : &quot;test&quot;   ,<br>
	    &quot;remark&quot;  : &quot;Remark This Booking Product include transfer&quot;<br>
	    } </p>
	  <p>=====================================================================</p>
	  <p><strong>Ex. Tour  Product   Not Include  transfer Parameter </strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><br>
              <strong>Name</strong> </td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Agent REF (T-booking.com) in vbooking is  订单号 * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"><p>number</p></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>varchar</p></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>ondate</p></td>
          <td valign="top"><p>date</p></td>
          <td valign="top"><p>Y-m-d</p></td>
          <td valign="top"><p>Ondate  Date format    Y-m-d ex. 2016-03-21  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>program_start</p></td>
          <td valign="top"><p>time</p></td>
          <td valign="top"><p>H:i </p></td>
          <td valign="top"><p>Pragram Start Ex. 09:30 (this is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"><p>text</p></td>
          <td valign="top"><p>Text Remark  If have the    remark </p></td>
        </tr>
      </table>
	  <p class="style1">*** After this product update  status system will sent new status to your system</p>
	  <p>POST /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <em><u>YOUR_API_KEY</u></em><br>
	    {<br>
&quot;agent_ref&quot; : &quot; api00100&quot;,<br>
&quot;guest&quot; : &quot;test&quot;,<br>
&quot;adult&quot; : &quot;5&quot;,<br>
&quot;child&quot;  : &quot;2&quot;,<br>
&quot;phone&quot; : &quot;0123456789&quot;,<br>
&quot;product&quot; : &quot;S0005&quot;,<br>
&quot;ondate&quot; : &quot;2016-06-24&quot;,<br>
&quot;program_start&quot; : &quot;21:00&quot; ,<br>
&quot;remark&quot;  : &quot;Remark This Booking Product include transfer&quot;<br>
      } </p>
	  <p>=====================================================================</p>
	  <p><span class="style1">////////////////////// Cancel Booking</span><br>
	    POST /apiv2/book/cancel/ api00025  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
      API-KEY: <em><u>YOUR_API_KEY</u></em></p>
	  <p><span class="style2">/////////////////////////  Search</span><br>
	    GET  /apiv2/book/search/ api00025 HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
      API-KEY: <em><u>YOUR_API_KEY</u></em></p>
	  <p>&nbsp;</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'T-booking.com Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>