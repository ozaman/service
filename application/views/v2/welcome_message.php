<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to API T-booking.com </title>

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
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to API T-booking.com !</h1>

	<div id="body">
	  <p><strong>This is parameter for JSON</strong></p>
	  <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom"><p><strong>Name</strong></p></td>
          <td valign="bottom"><p><strong>Type</strong></p></td>
          <td valign="bottom"><p><strong>Format</strong></p></td>
          <td valign="bottom"><p><strong>Description</strong></p></td>
        </tr>
        <tr>
          <td valign="top"><p>agent_ref </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Agent REF (T-booking.com) in vbooking is  订单号 * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>guest </p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Guest name * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>adult</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Pax for  Adult * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>child</p></td>
          <td valign="top"><p>integer</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Pax for  child * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>phone</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Phone number * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>product</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Code prduct ex. 00001  * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>ondate</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Date format Y-m-d ex. 2016-03-21 ,<br>
            Can use ondate for program tour ,<br>
            If type transfer is date of     flight *    Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>program_start</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Time for program start tour , If transfer time for flight.<br>
            Ex. 09:30 (this is format time) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>flight</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>This type transfer only request number flight * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>number_car</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Total number of car for use this type transfer only * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>from_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Location topic for pickup place use all type product <br>
            ( and this product include transfer if this type not transfer    product ) * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>to_place</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Location topic for to place use type transfer only,<br>
            Location topic for back place use type not transfer only and    this product include transfer , * Request </p></td>
        </tr>
        <tr>
          <td valign="top"><p>remark</p></td>
          <td valign="top"><p>string</p></td>
          <td valign="top"></td>
          <td valign="top"><p>Text Remark  If have the    details</p></td>
        </tr>
      </table>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p><strong>///////////////////////////  Create Booking </strong></p>
	  <p><strong>Ex. Transfer product  Pickup form Airport</strong></p>
	  <p> POST /apiv2/book/create/   HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;00003&quot;,<br>
	    &quot;ondate&quot;  : &quot;2016-03-21&quot;,<br>
	    &quot;number_car&quot; : &quot;1&quot;,<br>
	    &quot;flight&quot; : &quot;TG201&quot;,<br>
	    &quot;program_start&quot; : &quot;09:00&quot;,<br>
	    &quot;to_place&quot; : &quot;test&quot;<br>
	    <br>
	    }</p>
	  <p><strong>Ex. Transfer product  Pickup form Hotel</strong></p>
	  <p> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;00004&quot;,<br>
	    &quot;ondate&quot; : &quot;2016-03-23&quot;,<br>
	    &quot;number_car&quot; : &quot;1&quot;,<br>
	    &quot;flight&quot; : &quot;TG201&quot;,<br>
	    &quot;program_start&quot; : &quot;19:00&quot;,<br>
	    &quot;from_place&quot; : &quot;test&quot;<br>
	    <br>
	    }</p>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	  <p><strong>Ex. Transfer product  Pont To Point and Servive</strong></p>
	  <p> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;00013&quot;,<br>
	    &quot;ondate&quot; : &quot;2016-03-23&quot;,<br>
	    &quot;number_car&quot; : &quot;1&quot;,<br>
	    &quot;program_start&quot; : &quot;19:00&quot;,<br>
	    &quot;from_place&quot; : &quot;test&quot;,<br>
	    &quot;to_place&quot; : &quot;test&quot;<br>
	    <br>
	    }</p>
	  <p>&nbsp;</p>
	  <p><strong>Ex. Tour  product   Include  transfer</strong></p>
	  <p> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot; api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot;  : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;S0020&quot;,<br>
	    &quot;ondate&quot; : &quot;2016-03-23&quot;,<br>
	    &quot;program_start&quot; : &quot;21:00&quot; ,<br>
	    &quot;from_place&quot; : &quot;test&quot;,<br>
	    &quot;to_place&quot; : &quot;test&quot;   <br>
	    }</p>
	  <p><strong>&nbsp;</strong></p>
	  <p><strong>&nbsp;</strong></p>
	  <p><strong>&nbsp;</strong></p>
	  <p><strong>Ex. Tour  product   No transfer</strong></p>
	  <p> POST  /apiv2/book/create/  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong><br>
	    {<br>
	    &quot;agent_ref&quot; : &quot;api00100&quot;,<br>
	    &quot;guest&quot; : &quot;test&quot;,<br>
	    &quot;adult&quot; : &quot;5&quot;,<br>
	    &quot;child&quot; : &quot;2&quot;,<br>
	    &quot;phone&quot; : &quot;0123456789&quot;,<br>
	    &quot;product&quot; : &quot;S0020&quot;,<br>
	    &quot;ondate&quot; : &quot;2016-03-23&quot;,<br>
	    &quot;program_start&quot; : &quot;21:00&quot;    <br>
	    }</p>
	  <p>&nbsp;</p>
	  <p><strong>////////////////////// Cancel Booking</strong><br>
	    POST /apiv2/book/cancel/ api00025  HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong></p>
	  <p><strong>/////////////////////////  Search</strong><br>
	    GET  /apiv2/book/search/ api00025 HTTP/1.1<br>
	    Host: t-booking.com<br>
	    Content-Type: application/json<br>
	    API-KEY: <strong><em><u>YOUR_API_KEY</u></em></strong></p>
	  <p>&nbsp;</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'API T-booking.com  Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>