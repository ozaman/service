<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>API Document Booking Transfer</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link id="theme-style" rel="stylesheet" href="handbook/assets/material-dashboard.css?v=<?=time();?>">
    <!-- Global CSS -->
    <link rel="stylesheet" href="handbook/assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="handbook/assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="handbook/assets/plugins/elegant_font/css/style.css">
    
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="handbook/assets/css/styles.css">
    
 	 <link rel="stylesheet" href="handbook/assets/plugins/prism/prism.css">


    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 

<body class="landing-page">   
<style>
.modal-header .close {
    margin-top: -35px !important;
}
</style>   
    <!--FACEBOOK LIKE BUTTON JAVASCRIPT SDK-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <div class="page-wrapper">
        
        <!-- ******Header****** -->
        <header class="header text-center">
            <div class="container">
                <div class="branding">
                    <h1 class="logo">
                        <span aria-hidden="true" class="icon_documents_alt icon"></span>
                        <span class="text-highlight">AIP</span><span class="text-bold">Docs</span>
                    </h1>
                </div><!--//branding-->
                <div class="tagline">
                    <p>Documentation API Service T-Booking System </p>
                    <p>for <i class="fa fa-heart"></i> developers</p>
                </div><!--//tagline-->
                <div class="social-container" style="display: none;">
                    <div class="twitter-tweet">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-text="PrettyDocs - A FREE #Bootstrap theme for project documentations #Responsive" data-via="3rdwave_themes">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </div><!--//tweet-->
                    <div class="fb-like" data-href="http://themes.3rdwavemedia.com" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>            
                 </div><!--//social-container-->
            </div><!--//container-->
        </header><!--//header-->
        
        <section class="cards-section text-center">
            <div class="container" style="margin-top: -30px;">
                <h2 class="title">Web Service Data</h2>
                <div class="intro">
                    <!--<p>Welcome to Booking Docs. This landing page is an example of how you can use a card view to present segments of your documentation. You can customise the icon fonts based on your needs.</p>-->
                    <div class="cta-container">
                        <a class="btn btn-primary btn-cta" href="http://services.t-booking.com/json_from_service_book.xlsx" target="_blank"><i class="fa fa-cloud-download"></i> Download Excel File</a>
                    </div><!--//cta-container-->
                </div><!--//intro-->
                <div id="cards-wrapper" class="cards-wrapper row" style="margin-top: -15px;">
                    <div class="item item-green col-md-4 col-sm-6 col-xs-6">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <i class="icon fa fa-cab"></i>
                            </div><!--//icon-holder-->
                            <h3 class="title">Transfer</h3>
                            <p class="intro">Get Data Product Transfer</p>
                            <a class="link" href="" data-toggle="modal" data-target="#modal_1"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item item-pink item-2 col-md-4 col-sm-6 col-xs-6">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <!--<span aria-hidden="true" class="icon icon_puzzle_alt"></span>-->
                                <span aria-hidden="true" class="icon fa fa-cab"></span>
                            </div><!--//icon-holder-->
                            <h3 class="title">Car Service</h3>
                            <p class="intro">Get Data Product Service Car.</p>
                            <a class="link" href="" data-toggle="modal" data-target="#modal_2"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item item-blue col-md-4 col-sm-6 col-xs-6">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <!--<span aria-hidden="true" class="icon icon_datareport_alt"></span>-->
                                <span aria-hidden="true" class="icon fa fa-clock-o"></span>
                            </div><!--//icon-holder-->
                            <h3 class="title">Transfer Realtime</h3>
                            <p class="intro">Get Data Product Transfer in real time.</p>
                            <a class="link" href="" data-toggle="modal" data-target="#modal_3"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
                    <div class="item item-purple col-md-4 col-sm-6 col-xs-6">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <span aria-hidden="true" class="icon icon_lifesaver"></span>
                            </div><!--//icon-holder-->
                            <h3 class="title">Tour</h3>
                            <p class="intro">Get Data Product tour</p>
                            <a class="link" href="" data-toggle="modal" data-target="#modal_4"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
               
                    <div class="item item-orange col-md-4 col-sm-6 col-xs-6">
                        <div class="item-inner">
                            <div class="icon-holder">
                                <span aria-hidden="true" class="icon icon_gift"></span>
                            </div><!--//icon-holder-->
                            <h3 class="title">Service Query</h3>
                            <p class="intro">Retrieval in the database.</p>
                            <a class="link" href="" data-toggle="modal" data-target="#modal_5"><span></span></a>
                        </div><!--//item-inner-->
                    </div><!--//item-->
                </div><!--//cards-->
                
            </div><!--//container-->
        </section><!--//cards-section-->
    </div><!--//page-wrapper-->
    
    <footer class="footer text-center">
        <div class="container">
            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
       
        <!--<small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com/" target="_blank">Xiaoying Riley</a> for developers</small>-->
        <small class="copyright">Development and Design <i class="fa fa-heart"></i> by Csd Media Team. <a href="http://www.t-booking.com/login.php" target="_blank">T-Booking.com</a></small>
        </div><!--//container-->
    </footer><!--//footer-->
    
     
    <!-- Main Javascript -->          
    <script type="text/javascript" src="handbook/assets/plugins/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="handbook/assets/plugins/bootstrap/js/bootstrap.min.js"></script>                                                                     
    <script type="text/javascript" src="handbook/assets/plugins/jquery-match-height/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="handbook/assets/js/main.js"></script>
 
<div class="modal fade" id="modal_1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Transfer</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        	<div class="content" style="    margin-top: -20px;">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Transfer 
                                    </h4>
                                </div>
                                 <div class="card-content" style="text-align: left;">  
                                 	Get data product transfer.
									Use parameter place id in database T-Booking, from (pickup place) and to (destination place) for filter data
                                 </div>
                                <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Product/product_fix" target="_blank">http://services.t-booking.com/Product/product_fix</a>   HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                                </div>
                                
                                <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"from"</span><span class="token punctuation">:</span><span class="token atrule">"407"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* from (your from place id) */</span> 
	<span class="token selector">"to"</span><span class="token punctuation">:</span><span class="token atrule">"193"</span><span class="token comment" spellcheck="true">/* to (your to place id) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>
                                
                                <div class="card-content" style="text-align: left;">       
                                      		You can check place id 
                                      		<a href="http://services.t-booking.com/place.php" target="_blank">http://services.t-booking.com/place.php</a>
                                </div>
                              
                            </div>
                       
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal_2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Car Service</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        	<div class="content" style="    margin-top: -20px;">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Service rent hour
                                    </h4>
                                </div>
                                 <div class="card-content" style="text-align: left;">  
                                 	Get data product service rent hour. 
                                 	Use parameter place id in database T-Booking from (pickup place) and to (destination place) for filter data
                                 </div>
                                <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Product/product_service" target="_blank">http://services.t-booking.com/Product/product_service</a> &nbsp; HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                                </div>
                                
                                <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"from"</span><span class="token punctuation">:</span><span class="token atrule">"407"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* from (your from place id) */</span> 
	<span class="token selector">"to"</span><span class="token punctuation">:</span><span class="token atrule">"193"</span><span class="token comment" spellcheck="true">/* to (your to place id) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>
                                
                                <div class="card-content" style="text-align: left;">       
                                      		You can check place id 
                                      		<a href="http://services.t-booking.com/place.php" target="_blank">http://services.t-booking.com/place.php</a>
                                </div>
                                
                            </div>
                       
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal_3">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Transfer Realtime</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        	<div class="content" style="    margin-top: -20px;">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detail
                                    </h4>
                                </div>
                                 <div class="card-content" style="text-align: left;">  
                                 	Change your latitude and longitude to Place ID in database.
                                 	For search product transfer or car service.
                                 </div>
                                <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Product_realtime/index" target="_blank">http://services.t-booking.com/Product_realtime/index</a>   HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                                </div>
                                
                                <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"lat_f"</span><span class="token punctuation">:</span><span class="token atrule">"7.886645743483469"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* latitude from place */</span> 
	<span class="token selector">"lng_f"</span><span class="token punctuation">:</span><span class="token atrule">"98.42643588781357"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* longitude from place */</span> 
	<span class="token selector">"lat_t"</span><span class="token punctuation">:</span><span class="token atrule">"7.891970015092479"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* latitude to place */</span> 
	<span class="token selector">"lat_f"</span><span class="token punctuation">:</span><span class="token atrule">"98.36815685033798"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* longitude to place */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>
                                
                                 <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>Response</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"from"</span><span class="token punctuation">:</span><span class="token atrule">"407"</span><span class="token punctuation">,</span><span class="token comment" spellcheck="true">/* from (your from place id) */</span> 
	<span class="token selector">"to"</span><span class="token punctuation">:</span><span class="token atrule">"193"</span><span class="token comment" spellcheck="true">/* to (your to place id) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    <span>Get this place id to search product in Transfer API</span>
                                    </div> 
                                </div>
                                
                               
                                
                            </div>
                       
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal_4">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tour</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        	<div class="content" style="    margin-top: -20px;">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Get Product Tour filter type
                                    </h4>
                                </div>
                                <div class="card-content" style="text-align: left;">  
                                 	Get all product tour filter by type 
									(if you don't send parameter type will get all product tour )
                                 </div>
                                <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Tour/index" target="_blank">http://services.t-booking.com/Tour/index</a>   HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                                </div>                     
                                <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"type"</span><span class="token punctuation">:</span><span class="token atrule">"Day Tour"</span><span class="token comment" spellcheck="true">/*  - type (type tour) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>             
                                <div class="card-content" align="left">   
                                 	<div style="    padding: 25px; border: 1px solid #ddd; box-shadow: 1px 1px 5px #999;background-color: #999999;color: #fff;">
                                	type of product tour. use this type to parameter<br/>
									 - Day Tour<br/>
									 - Boat<br/>
									 - Diving<br/>
									 - Food<br/>
									 - Golf<br/>
									 - Guide<br/>
									 - Package<br/>
									 - Plane<br/>
									 - Show<br/>
									 - Spa<br/>
									 - Wedding
									 </div>
                                </div>
							
                            </div>
                       
        	</div>
        	
        	<div class="content" style="    margin-top: -20px;">
                            <div class="card">
                            <div class="card-header">
                                    <h4 class="card-title">Get Detail Product Tour
                                    </h4>
                                </div>
                            
                            <div class="card-content" style="text-align: left;">  
                                 	Get data detail filter by your id. you can get data id use by service tour api.
                            </div>
                            <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Tour/get_detail" target="_blank">http://services.t-booking.com/Tour/get_detail</a>   HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                            </div>
                             <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"id"</span><span class="token punctuation">:</span><span class="token atrule">"1"</span><span class="token comment" spellcheck="true">/*  id (id of data row in database) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>      
                  </div>          
            </div>

			<div class="content" style="    margin-top: -20px;">
                            <div class="card">
                            <div class="card-header">
                                    <h4 class="card-title">Get Product Tour Each ID
                                    </h4>
                                </div>
                            
                            <div class="card-content" style="text-align: left;">  
                                 	Get data product tour filter by your id. you can get data id use by service tour api.
                            </div>
                            <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Tour/get_each" target="_blank">http://services.t-booking.com/Tour/get_each</a>   HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                            </div>
                             <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"id"</span><span class="token punctuation">:</span><span class="token atrule">"1"</span><span class="token comment" spellcheck="true">/*  id (id of data row in database) */</span> 
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>      
                  </div>          
            </div>
			
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    
<div class="modal fade" id="modal_5">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tour</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        	<div class="content" style="    margin-top: -20px;">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Query Data
                                    </h4>
                                </div>
                                <div class="card-content" style="text-align: left;">  
                                 	Dynamic web service. You can call schedule data, this has 3 paraneter as <br/>
                                 	- request (set conditional get data ) <br/>
                                 	- from (set table name) (array) <br/>
                                 	- field (set column name) (array) 
                                 </div>
                                 <div class="card-content" style="text-align: left;">       
                                      		POST <br/>
                                            <a href="http://services.t-booking.com/Service/index" target="_blank">http://services.t-booking.com/Service/index</a> HTTP/1.1 <br/>
						        			Host: services.t-booking.com <br/>
						        			Content-Type: application/json <br/>
                            	</div>
                                   <div class="card-content">   
                                	<div style="padding-left: 10px;padding-right: 10px;">   
                                      <div class="code-block" style="margin-top: 0px;margin-bottom :0px;">
                                        <h6>JSON Example</h6>
                                        <pre class=" language-css"><code class=" language-css"><span class="token punctuation">{</span>
	<span class="token selector">"request"</span><span class="token punctuation">:</span><span class="token atrule"> { "id" : "1" }</span><span class="token punctuation">,</span>
	<span class="token selector">"from"</span><span class="token punctuation">:</span><span class="token atrule"> "web_order"</span><span class="token punctuation">,</span>
	<span class="token selector">"field"</span><span class="token punctuation">:</span><span class="token atrule"> { "0":"id", "1":"invoice" }</span>
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                    </div> 
                                </div>      	
                            </div>
                       
        	</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    
</body>
</html> 

