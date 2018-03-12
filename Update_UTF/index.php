
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="apple-touch-icon" sizes="76x76" href="files/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="files/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Lab Report</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="http://www.creative-tim.com/product/material-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
    <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://www.creative-tim.com/product/material-dashboard-pro" />
    <meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg" />
    <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Bootstrap core CSS     -->
    <link href="js/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="files/css-/material-dashboard.css?v=<?=time();?>" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="files/css-/demo.css?v=<?=time();?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css?v=<?=time();?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
<?php
$_SESSION['admin_user'] = 'admin_admin';
$part_img_load_big='<img src="files/img/loading/loading-large.gif"/>' ; 
//error_reporting(0);
require_once("mainfile.php");
$PHP_SELF = "index.php";
GETMODULE($_GET['name'],$_GET['file']);
?>

<style>
.td_padding{
	padding: 7px 8px !important ;
}
.input_search{
	width: 100%;
    padding: 5px;
    border: 1px solid #ddd;
    margin-bottom : 10px;
    box-shadow: 1px 1px 2px #ddd;
}
.list-driver{
padding: 5px 15px;
width: 100%;
background-color: #fff;
}
.select-driver{
  background-color: #00bcd4;
  color: #fff;
}
</style>

</head>
<script src="js/cookie.js?v=<?=time();?>"></script>
<body onload="checkCookie();">
    <div class="wrapper">
        <?php include('element/menu_bar.php'); ?>
        <div class="main-panel">
             <?php include('element/tab_bar.php'); ?>
            <div class="content" style="margin-top:45px;">
                <div class="container-fluid">
                	<div class="row">
                    <?php include ("".$MODPATHFILE."");?>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</body>


<!--   Core JS Files   -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js?v=<?=time();?>"></script>
<script src="js/action/main-script.js?v=<?=time();?>" type="text/javascript"></script>
<script src="js/jquery/jquery-ui.min.js?v=<?=time();?>" type="text/javascript"></script>
<script src="js/bootstrap.min.js?v=<?=time();?>" type="text/javascript"></script>
<script src="js/material.min.js?v=<?=time();?>" type="text/javascript"></script>
<script src="js/jquery/perfect-scrollbar.jquery.min.js?v=<?=time();?>" type="text/javascript"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js?v=<?=time();?>"></script>
<!-- Library for adding dinamically elements -->
<!--<script src="../../assets/js/arrive.min.js" type="text/javascript"></script>-->
<!-- Forms Validations Plugin -->
<script src="js/jquery.validate.min.js?v=<?=time();?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="js/moment.min.js?v=<?=time();?>"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="js/chartist.min.js?v=<?=time();?>"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="files/js-/jquery.bootstrap-wizard.js?v=<?=time();?>"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="files/js-/bootstrap-notify.js?v=<?=time();?>"></script>
<!--   Sharrre Library    -->
<script src="files/js-/jquery.sharrre.js?v=<?=time();?>"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="files/js-/bootstrap-datetimepicker.js?v=<?=time();?>"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="files/js-/jquery-jvectormap.js?v=<?=time();?>"></script>
<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="files/js-/nouislider.min.js?v=<?=time();?>"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1_8C5Xz9RpEeJSaJ3E_DeBv8i7j_p6Aw"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="files/js-/jquery.select-bootstrap.js?v=<?=time();?>"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="files/js-/jquery.datatables.js?v=<?=time();?>"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="files/js-/sweetalert2.js?v=<?=time();?>"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="files/js-/jasny-bootstrap.min.js?v=<?=time();?>"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="files/js-/fullcalendar.min.js?v=<?=time();?>"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="files/js-/jquery.tagsinput.js?v=<?=time();?>"></script>
<!-- Material Dashboard javascript methods -->
<script src="js/material-dashboard.js?v=<?=time();?>"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="files/js-/demo.js?v=<?=time();?>"></script>

</html>

<!--- Pickerdate -->
<link rel="stylesheet" type="text/css" href="js/pickerdate/classic.css?v=<?=time();?>" /> 
<link rel="stylesheet" type="text/css" href="js/pickerdate/classic.date.css?v=<?=time();?>" /> 
<script src="js/pickerdate/picker.js?v=<?=time();?>" type="text/javascript"></script>
<script src="js/pickerdate/picker.date.js?v=<?=time();?>" type="text/javascript"></script>

<div id="modal_1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title-1">เลือกค้นหา</h4>
      </div>
      <div class="modal-body" id="body_modal_1">
       		<?php include('modules/model/seacrh_box.php'); ?>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div class="fixed-plugin" style="width: auto;">
        <div class="dropdown show-dropdown open">
            <a href="#" data-toggle="modal" data-target="#modal_1" aria-expanded="true"  id="search_button">
              <!--  <i class="fa fa-cog fa-2x"> </i>-->
                <i class="fa fa-search fa-2x" style="    color: #FFFFFF;  padding: 10px;    border-radius: 0 0 6px 6px;    width: auto;"> </i>
            </a>
           
        </div>
    </div>
    
<div id="modal_2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title-2"></h4>
      </div>
      <div class="modal-body" id="body_modal_2">
       		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" id="place_now" value=""/>
<input type="hidden" id="lat" value=""/>
<input type="hidden" id="lng" value=""/>
<script>
geolocatCallFrist();
function geolocatCallFrist(){
	
		
		    if (navigator.geolocation) {
			        navigator.geolocation.getCurrentPosition(showPosition);
			       
			    } else { 
			       	console.log('??????????');
			    }
		
}	   
	     
function showPosition(position) {
	
	// https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyCx4SLk_yKsh0FUjd6BgmEo-9B0m6z_xxM
	
	 var url = 'https://maps.google.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=false&language=th&key=AIzaSyCx4SLk_yKsh0FUjd6BgmEo-9B0m6z_xxM';
//	 var url = 'https://maps.google.com/maps/api/geocode/json?latlng=9.13824,99.32175&sensor=false';
    
    $('#lat').val(position.coords.latitude);
    $('#lng').val(position.coords.longitude);
    console.log(position.coords.latitude+" : "+position.coords.longitude);
    $.post( url, function( data ) {
 
		
		if(data.status=="OVER_QUERY_LIMIT"){
			console.log('OVER_QUERY_LIMIT');
 
			 
		}else{
			
			var place = data.results[0].address_components[0].long_name;
			console.log(place);
			$('#place_now').val(place);
			$('#lat').val(position.coords.latitude);
			$('#lng').val(position.coords.longitude);
		}
		
	});
} 

</script>

<style>
.date-today{
  position:  fixed;
    z-index:  999999;
    bottom: 0px;
    right: 0px;
    border: 1px solid #ddd;
    padding: 3px;
    box-shadow: 1px 2px 5px #ddd;
   
    background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
}
#grad1 {
    height: 250px;
    width: 100%;
    background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
    color: white;
    opacity: 0.95;
}

 .company_select{
 height: 35px;
 padding: 5px;
 border-radius: 25px;
 width:100%;
 }
 .end-page {
    position: fixed; 
    left: auto;
    right: 0;
    top: 260px;
    opacity: .9;
    z-index: 3;
    padding: 1rem;
    overflow-y: auto;
    cursor: default;
}
.top-page {
    position: fixed; 
    left: auto;
    right: 0;
    top: 160px;
    opacity: .9;
    z-index: 3;
    padding: 1rem;
    overflow-y: auto;
    cursor: default;
}
.box-img-his{
		width: 100px;box-shadow: 1px 1px 10px #999;border: 1px solid #ddd;padding:5px;margin-top:10px;margin-bottom: 10px;
	}
.mobile-box{
		border: 1px solid #ddd;
		margin-bottom :15px;
		padding: 10px;
		box-shadow: 2px 2px 5px #ddd;
    background-color: #fff;
	}
.number-box-mobile{
	  width: 45px;
    background-color: #f38888;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 60px;
    color: #ffff;
    font-size: 20px;
    position : absolute;
    left : 10px;
    margin-top: -9px;
	}
</style>

<div class="date-today" id="date_today">
<strong><?=date('Y-m-d');?></strong>  
</div>

<div style="display:none;">
  <button class="top-page btn" onclick="scrollWin('top');" style="cursor: pointer;"><i class="material-icons">arrow_drop_up</i></button>
	<button class="end-page btn" onclick="scrollWin('end');"  style="cursor: pointer;"><i class="material-icons">arrow_drop_down</i></button>
</div>