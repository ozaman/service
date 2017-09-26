<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
      Welcome to T-booking.com API
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 
    <!-- font awesome icons-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">

      ::selection 
      { 
        background-color: #E13300; 
        color: white;
      }
      ::-moz-selection 
      { 
        background-color: #E13300; 
        color: white;
      }

      body 
      {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
      }

      a 
      {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
      }

      h1 
      {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
      }

      code 
      {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
      }

      #body 
      {
        margin: 0 15px 0 15px;
      }

      p.footer 
      {
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
      }

      #container 
      {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
      }
      .style1 
      {
        color: #FF0000;
        font-weight: bold;
      }
      .style2 
      {
        color: #0000FF;
        font-weight: bold;
      }
    </style>
    <style>
      @import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
      /* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
      .board
      {
        width: 75%;
        margin: 60px auto;
        height: 500px;
        background: #fff;
        /*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
      }
      .board .nav-tabs 
      {
        position: relative;
        border-bottom: 0;
        width: 80%;
        margin: 40px auto;
        margin-bottom: 0;
        box-sizing: border-box;

      }

      .board > div.board-inner
      {
        background: #fafafa url(http://subtlepatterns.com/patterns/geometry2.png);
        background-size: 30%;
        border-bottom: 1px solid #DDD;
      }

      p.narrow
      {
        width: 60%;
        margin: 10px auto;
      }

      .liner
      {
        height: 2px;
        background: #ddd;
        position: absolute;
        width: 80%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 50%;
        z-index: 1;
      }

      .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus 
      {
        color: #555555;
        cursor: default;
        /* background-color: #ffffff; */
        border: 0;
        border-bottom-color: transparent;
      }

      span.round-tabs
      {
        width: 70px;
        height: 70px;
        line-height: 70px;
        display: inline-block;
        border-radius: 100px;
        background: white;
        z-index: 2;
        position: absolute;
        left: 0;
        text-align: center;
        font-size: 25px;
      }

      span.round-tabs.one
      {
        color: rgb(34, 194, 34);
        border: 2px solid rgb(34, 194, 34);
      }

      li.active span.round-tabs.one
      {
        background: #fff !important;
        border: 2px solid #ddd;
        color: rgb(34, 194, 34);
      }

      span.round-tabs.two
      {
        color: #febe29;
        border: 2px solid #febe29;
      }

      li.active span.round-tabs.two
      {
        background: #fff !important;
        border: 2px solid #ddd;
        color: #febe29;
      }

      span.round-tabs.three
      {
        color: #3e5e9a;
        border: 2px solid #3e5e9a;
      }

      li.active span.round-tabs.three
      {
        background: #fff !important;
        border: 2px solid #ddd;
        color: #3e5e9a;
      }

      span.round-tabs.four
      {
        color: #f1685e;
        border: 2px solid #f1685e;
      }

      li.active span.round-tabs.four
      {
        background: #fff !important;
        border: 2px solid #ddd;
        color: #f1685e;
      }

      span.round-tabs.five
      {
        color: #999;
        border: 2px solid #999;
      }

      li.active span.round-tabs.five
      {
        background: #fff !important;
        border: 2px solid #ddd;
        color: #999;
      }

      .nav-tabs > li.active > a span.round-tabs
      {
        background: #fafafa;
      }
      .nav-tabs > li 
      {
        flex: 1;
        width: 20%;
      }
      .nav-tabs 
      {
        display: flex;
      }
      /*li.active:before {
      content: " ";
      position: absolute;
      left: 45%;
      opacity:0;
      margin: 0 auto;
      bottom: -2px;
      border: 10px solid transparent;
      border-bottom-color: #fff;
      z-index: 1;
      transition:0.2s ease-in-out;
      }*/
      li:after 
      {
        content: " ";
        position: absolute;
        left: 45%;
        opacity: 0;
        margin: 0 auto;
        bottom: 0px;
        border: 5px solid transparent;
        border-bottom-color: #ddd;
        transition: 0.1s ease-in-out;
    
      }
      li.active:after 
      {
        content: " ";
        position: absolute;
        left: 45%;
        opacity: 1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-bottom-color: #ddd;
    
      }
      .nav-tabs > li a
      {
        width: 70px;
        height: 70px;
        margin: 20px auto;
        border-radius: 100%;
        padding: 0;
      }

      .nav-tabs > li a:hover
      {
        background: transparent;
      }

      .tab-content
      {
      }
      .tab-pane
      {
        position: relative;
        padding-top: 50px;
      }
      .tab-content .head
      {
        font-family: 'Roboto Condensed', sans-serif;
        font-size: 25px;
        text-transform: uppercase;
        padding-bottom: 10px;
      }
      .btn-outline-rounded
      {
        padding: 10px 40px;
        margin: 20px 0;
        border: 2px solid transparent;
        border-radius: 25px;
      }

      .btn.green
      {
        background-color: #5cb85c;
        /*border: 2px solid #5cb85c;*/
        color: #ffffff;
      }



      @media( max-width : 585px )
      {
    
        .board 
        {
          width: 90%;
          height: auto !important;
        }
        span.round-tabs 
        {
          font-size: 16px;
          width: 50px;
          height: 50px;
          line-height: 50px;
        }
        .tab-content .head
        {
          font-size: 20px;
        }
        .nav-tabs > li a 
        {
          width: 50px;
          height: 50px;
          line-height: 50px;
        }

        li.active:after 
        {
          content: " ";
          position: absolute;
          left: 35%;
        }

        .btn-outline-rounded 
        {
          padding: 12px 20px;
        }
      }

    </style>
  </head>
  <body>

    <div id="container">
      <h1>
        Welcome to API T-booking.com
      </h1>
      <div id="body">

        <div class="board-inner">
          <ul class="nav nav-tabs" id="myTab">
            <div class="liner">
            </div>
            <li  <? if($this->input->get('type') == '' || $this->input->get('type') == 'transfer') { ?> class="active" <? } ?>  >
              <a href="?type=transfer"   title="Transfer Product Function Create">
                <span class="round-tabs one">
                  <i class="fa fa-cab ">
                  </i>
                </span>
              </a>
            </li>
            <li  <? if($this->input->get('type') == 'tour') { ?> class="active" <? } ?>  >
              <a href="?type=tour"  title="Tour & Ticket & Spa    Product  Function Create ">
                <span class="round-tabs four">
                  <i class="fa fa-suitcase">
                  </i>
                </span>
              </a>
            </li>
            <li  <? if($this->input->get('type') == 'other') { ?> class="active" <? } ?>  >
              <a href="?type=other"   title="Other Method Search cancel and reject">
                <span class="round-tabs five">
                  <i class="fa fa-gears">
                  </i>
                </span>
              </a>
            </li>
                     
          </ul>
        </div>

        <?
        if($this->input->get('type') == 'other') {
          ?>
          <h3 align="center">Other Method Search cancel and reject</h3>
          <div class="board-inner">
            <ul class="nav nav-tabs" id="myTab">
              <div class="liner">
              </div>
              <li>
                <a href="#other" data-toggle="tab" class="active"  title="Other Method">
                  <span class="round-tabs five">
                    <i class="fa fa-gears">
                    </i>
                  </span>
                </a>
              </li>
                     
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="other">
              <h3 class="head text-center">
                Other Method
              </h3>
              <div class="col-lg-12">
              	  <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="72" />
                  <tr>
                    <td align="left" class="green">
                      /////////////////////////    Search
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      GET /apiv2/book/search/api00025 HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                </table>
              	<p></p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="72" />
                  <tr>
                    <td width="72" align="left" class="red">
                      ////////////////////// Cancel Booking
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      POST /apiv2/book/cancel/api00025 HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="72" />
                  <tr>
                    <td width="72" align="left" class="red"> ////////////////////// Reject Booking </td>
                  </tr>
                  <tr>
                    <td align="left"> POST /apiv2/book/cancel/api00025 HTTP/1.1 </td>
                  </tr>
                  <tr>
                    <td align="left"> Host:    t-booking.com </td>
                  </tr>
                  <tr>
                    <td align="left"> Content-Type:    application/json </td>
                  </tr>
                  <tr>
                    <td align="left"> API-KEY: YOUR_API_KEY </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
              
              </div>
            </div>
            <div class="clearfix">
            </div>
          </div>

          <?
        } 
        elseif($this->input->get('type') == 'tour') {
          ?>
          <h3 align="center"> Tour & Ticket & Spa  Product  Function Create</h3>
          <div class="board-inner">
            <ul class="nav nav-tabs" id="myTab">
              <div class="liner">
              </div>
              <li>
                <a href="#tour" data-toggle="tab" class="active" title="Tour     Product  Include  transfer">
                  <span class="round-tabs four">
                    <i class="fa fa-suitcase">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#tour_no" data-toggle="tab" title="Tour  Product  Not Include  transfer ">
                  <span class="round-tabs four">
                    <i class="fa fa-suitcase">
                    </i>
                  </span>
                </a>
              </li>                    
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tour">
              <h3 class="head text-center">
                Tour     Product  Include  transfer
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="162" />
                  <col width="87" />
                  <col width="93" />
                  <col width="513" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. S0005  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      adult
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Pax for  Adult * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      child
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Pax for  child * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      ondate
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Ondate  Date format Y-m-d ex. 2016-03-21  * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      program_start
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Pragram Start    Ex. 09:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      pickup_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Location topic for pickup place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td> pickup_place_address </td>
                    <td> string </td>
                    <td> text </td>
                    <td> Address for pickup place  </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      to_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Location topic for to place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td> to_place_address </td>
                    <td> string </td>
                    <td> text </td>
                    <td> Address for to place Address </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">
                      *** After this product update status system will sent new    status and pickup time to your system
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="162" />
                  <tr>
                    <td align="left" width="162">
                      POST /apiv2/book/create/  HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot;api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;S0005&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;adult&quot; : &quot;5&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;child&quot; : &quot;2&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;ondate&quot; :    &quot;2016-06-23&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;program_start&quot; :    &quot;21:00&quot; ,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place&quot; : &quot;Pickup    place Name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">    &quot;pickup_place_address&quot; : &quot;Pickup    place Address&quot;, </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place&quot; : &quot;To place    name&quot;  ,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">    &quot;to_place_address&quot; : &quot;To place    Address&quot;  , </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking Product include transfer&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>


              </div>
            </div>
            <div class="tab-pane fade in" id="tour_no">
              <h3 class="head text-center">
                Tour  Product  Not Include  transfer
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="146" />
                  <col width="94" />
                  <col width="88" />
                  <col width="515" />
 
                  <tr>
                    <td bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td bgcolor="#FFFF66">
                      Type
                    </td>
                    <td bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. S0020  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      adult
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Pax for  Adult * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      child
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Pax for  child * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      ondate
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Ondate  Date format Y-m-d ex. 2016-03-21  * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      program_start
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Pragram Start    Ex. 09:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">
                      *** After this product update status system will sent new    status to your system
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="146" />
                  <tr>
                    <td align="left" width="146">
                      POST /apiv2/book/create/  HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;S0020&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;adult&quot; : &quot;5&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;child&quot; : &quot;2&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;ondate&quot; :    &quot;2016-06-24&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;program_start&quot; :    &quot;21:00&quot; ,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking Product Not include transfer&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>


              </div>
            </div>
            <div class="clearfix">
            </div>
          </div>

          <?
        } 
        else {
          ?> 
          <h3 align="center">Transfer Product Function Create</h3>
          <div class="board-inner">
            <ul class="nav nav-tabs" id="myTab">
              <div class="liner">
              </div>
              <li class="active">
                <a href="#join_in" data-toggle="tab" title="Transfer Product Pickup form Airport Join Car">
                  <span class="round-tabs one">
                    <i class="fa fa-cab ">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#private_in" data-toggle="tab" title="Transfer Product  Sent To  Airport  Join Car">
                  <span class="round-tabs one">
                    <i class="fa fa-car">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#join_out" data-toggle="tab" title="Transfer Product  Sent To  Airport  Join Car">
                  <span class="round-tabs three">
                    <i class="fa fa-cab">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#private_out" data-toggle="tab" title="Transfer Product  Sent To     Airport  Private Car">
                  <span class="round-tabs three">
                    <i class="fa fa-car">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#service" data-toggle="tab" title="Transfer Product  Service Private Car">
                  <span class="round-tabs two">
                    <i class="fa fa-car">
                    </i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#point" data-toggle="tab" title="Transfer Product  Point To Point Private Car">
                  <span class="round-tabs two">
                    <i class="fa fa-car">
                    </i>
                  </span>
                </a>
              </li>
                     
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="join_in">
              <h3 class="head text-center">
                Transfer Product Pickup form Airport Join Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="213" />
                  <col width="80" />
                  <col width="89" />
                  <col width="465" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00046  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      arrival_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Arrival date  Date format Y-m-d ex. 2016-03-21  * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      arrival_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Arrival time Ex. 09:30 (this is    format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      arrival_flight
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Arrival flight number of flight * Request 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      baggage
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of Baggage
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      to_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Name for to place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      to_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Name for to place Address
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="213" />
                  <tr>
                    <td align="left" width="213">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00046&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_date&quot; :    &quot;2016-07-21&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_time&quot; :    &quot;09:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_flight&quot; :    &quot;TG201&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;baggage&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place&quot; : &quot;To place    Name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place_address&quot; : &quot;To    place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking Pickup from airport&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>
              </div>      
            </div>
            <div class="tab-pane fade in" id="private_in">
              <h3 class="head text-center">
                Transfer Product Pickup form Airport Private Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="213" />
                  <col width="80" />
                  <col width="89" />
                  <col width="465" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td bgcolor="#E8E8E8">
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00003  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      arrival_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Arrival date  Date format Y-m-d ex. 2016-03-21  * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      arrival_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Arrival time Ex. 09:30 (this is    format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      arrival_flight
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Arrival flight number of flight * Request 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      baggage
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of Baggage
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      number_car
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Total number of car for use this    type transfer only * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      to_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Name for to place (English Only) * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      to_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td bgcolor="#E8E8E8">
                      text
                    </td>
                    <td>
                      Name for to place Address
                    </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="213" />
                  <tr>
                    <td align="left" width="213">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00003&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_date&quot; :    &quot;2016-07-21&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_time&quot; :    &quot;09:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;arrival_flight&quot; :    &quot;TG201&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;baggage&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;number_car&quot; : &quot;1&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place&quot; : &quot;To place    Name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place_address&quot; : &quot;To    place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking Pickup from airport&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="join_out">
              <h3 class="head text-center">
                Transfer Product  Sent To  Airport  Join Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="187" />
                  <col width="83" />
                  <col width="86" />
                  <col width="512" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00047  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      departure_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Departure    date  Date format Y-m-d ex.    2016-07-21  *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      departure_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Departure    time Ex. 20:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      departure_flight
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Departure    flight number of flight * Request 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      baggage
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of Baggage
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      pickup_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Name of pickup place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      pickup_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Name of pickup place Address
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      service_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Service time    Ex. 17:30 (this is format time) 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">
                      *** After this product update status system will sent new    status and pickup time to your system
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="187" />
                  <tr>
                    <td align="left" width="187">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00047&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_date&quot; :    &quot;2016-07-26&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_time&quot; :    &quot;20:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_flight&quot; :    &quot;TG201&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;baggage&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place&quot;    : &quot;Pickup place name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place_address&quot;    : &quot;Pickup place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_time&quot;    : &quot;17:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking  Sent To airport&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="private_out">
              <h3 class="head text-center">
                Transfer Product  Sent To     Airport  Private Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="187" />
                  <col width="83" />
                  <col width="86" />
                  <col width="512" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00004  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      departure_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Departure    date  Date format Y-m-d ex.    2016-07-21  *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      departure_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Departure    time Ex. 20:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      departure_flight
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Departure    flight number of flight * Request 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      baggage
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of Baggage
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      number_car
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Total number of car  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      pickup_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Name of pickup place (English Only) * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      pickup_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Name of pickup place Address
                    </td>
                  </tr>
                  <tr>
                    <td>
                      service_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Service time    Ex. 17:30 (this is format time) 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left">
                      *** After this product update status system will sent new    status and pickup time to your system
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="187" />
                  <tr>
                    <td align="left" width="187">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00004&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_date&quot; :    &quot;2016-07-26&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_time&quot; :    &quot;20:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;departure_flight&quot; :    &quot;TG201&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;baggage&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;number_car&quot; : &quot;1&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place&quot;    : &quot;Pickup place name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place_address&quot;    : &quot;Pickup place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_time&quot;    : &quot;17:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking  Sent To airport&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="service">
              <h3 class="head text-center">
                Transfer Product  Service Private Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="209" />
                  <col width="97" />
                  <col width="93" />
                  <col width="489" />
                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00011  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      service_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Service    date  Date format Y-m-d ex.    2016-03-21  *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      service_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Service  time Ex. 09:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      baggage
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of Baggage
                    </td>
                  </tr>
                  <tr>
                    <td>
                      number_car
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Total number of car for use this    type transfer only * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      pickup_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Location topic for pickup place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      pickup_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Name of pickup place Address
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      to_place
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Location topic for to place (English Only) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      to_place_address
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Name for to place Address
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      car_use_plan
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text car using plan
                    </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="209" />
                  <tr>
                    <td align="left" width="209">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00011&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_date&quot; :    &quot;2016-07-26&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_time&quot; :    &quot;20:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;baggage&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;number_car&quot; : &quot;1&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place&quot; : &quot;Pickup    place name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;pickup_place_address&quot;    : &quot;Pickup place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place&quot; : &quot;To place    name&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;to_place_address&quot; : &quot;To    place Address&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;car_use_plan&quot; : &quot;Go to    central , Big C , Lotus&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking  transfer Service&quot;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>


              </div>
            </div>
            <div class="tab-pane fade in" id="point">
              <h3 class="head text-center">
                Transfer Product  Point To Point Private Car
              </h3>
              <div class="col-lg-12">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="157" />
                  <col width="97" />
                  <col width="93" />
                  <col width="489" />

                  <tr>
                    <td width="150" bgcolor="#FFFF66">
                      Parameter
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Type
                    </td>
                    <td width="100" bgcolor="#FFFF66">
                      Format
                    </td>
                    <td bgcolor="#FFFF66">
                      Description
                    </td>
                  </tr>
                  <tr>
                    <td>
                      agent_ref
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Ref no.  Ref of booking *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      product
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Code prduct ex. 00013  * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      guest_english
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name English 
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      guest_other
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      Guest name of your country    (Chinese) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      phone
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Phone number *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      email
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      varchar
                    </td>
                    <td>
                      Guest E-mail
                    </td>
                  </tr>
                  <tr>
                    <td>
                      service_date
                    </td>
                    <td>
                      date
                    </td>
                    <td>
                      Y-m-d
                    </td>
                    <td>
                      Service    date  Date format Y-m-d ex.    2016-03-21  *    Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      service_time
                    </td>
                    <td>
                      time
                    </td>
                    <td>
                      H:i 
                    </td>
                    <td>
                      Service  time Ex. 09:30 (this is format time) * Request
                    </td>
                  </tr>
                  <tr>
                    <td>
                      total_pax
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Number of pax   * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td>
                      number_car
                    </td>
                    <td>
                      integer
                    </td>
                    <td>
                      number
                    </td>
                    <td>
                      Total number of car for use this    type transfer only * Request
                    </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td> pickup_place </td>
                    <td> string </td>
                    <td> varchar </td>
                    <td> Location topic for pickup place (English Only) * Request </td>
                  </tr>
                  <tr>
                    <td> pickup_place_address </td>
                    <td> string </td>
                    <td> text </td>
                    <td> Name of pickup place Address </td>
                  </tr>
                  <tr bgcolor="#E8E8E8">
                    <td> to_place </td>
                    <td> string </td>
                    <td> varchar </td>
                    <td> Location topic for to place (English Only) * Request </td>
                  </tr>
                  <tr>
                    <td> to_place_address </td>
                    <td> string </td>
                    <td> text </td>
                    <td> Name for to place Address </td>
                  </tr>
                  <tr>
                    <td>
                      remark
                    </td>
                    <td>
                      string
                    </td>
                    <td>
                      text
                    </td>
                    <td>
                      Text Remark  If have the remark
                    </td>
                  </tr>
                </table>
                <p>&nbsp;
                  
                </p>
                <table width="100%" cellpadding="0" cellspacing="0">
                  <col width="157" />
                  <tr>
                    <td align="left" width="157">
                       POST /apiv2/book/create/     HTTP/1.1
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Host:    t-booking.com
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      Content-Type:    application/json
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      API-KEY: YOUR_API_KEY
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      {
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;agent_ref&quot; : &quot; api00100&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_english&quot; : &quot; Guest    name English&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;guest_other&quot; : &quot; Guest    name of your country &quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;phone&quot; :    &quot;0123456789&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;email&quot; : &quot;Guest E-mail&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;product&quot; : &quot;00013&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_date&quot; :    &quot;2016-07-26&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;service_time&quot; :    &quot;20:30&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;total_pax&quot; : &quot;3&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;number_car&quot; : &quot;1&quot;,
                    </td>
                  </tr>
                  <tr>
                    <td align="left">     &quot;pickup_place&quot; : &quot;Pickup    place name&quot;, </td>
                  </tr>
                  <tr>
                    <td align="left">     &quot;pickup_place_address&quot;    : &quot;Pickup place Address&quot;, </td>
                  </tr>
                  <tr>
                    <td align="left">     &quot;to_place&quot; : &quot;To place    name&quot;, </td>
                  </tr>
                  <tr>
                    <td align="left">     &quot;to_place_address&quot; : &quot;To    place Address&quot;, </td>
                  </tr>
                  <tr>
                    <td align="left">
                          &quot;remark&quot; : &quot;Remark This    Booking Point to Point 
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      }
                    </td>
                  </tr>
                </table>


              </div>
            </div>
            <div class="clearfix">
            </div>
          </div>

          <?
        } ?>


      </div>

      <p class="footer">
        Page rendered in 
        <strong>
          {elapsed_time}
        </strong>seconds. <?php echo  (ENVIRONMENT === 'development') ?  'T-booking.com Version <strong>' . CI_VERSION . '</strong>' : '' ?>
      </p>
    </div>
 

                
               
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>

    <script>
      $(function(){
          $('a[title]').tooltip();
        });

    </script>
  </body>
</html>