  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
article img{margin:0 1.5em 1.5em 0;box-shadow:0 0 8px 4px black;border:.5em groove #fff;}
body{ margin:3% auto; background:#f8f8f8; text-shadow:0 .8px #111;}
article {border:.5em outset #aac !important; border-radius:1em !important; box-shadow:0 0 23px #000 !important;}
header span.glyphicon{color:#DDD; text-shadow:2px 2px #111 !important;filter:blur(2px);-webkit-filter: blur(2px);
-moz-filter: blur(1px);
-o-filter: blur(1px);
-ms-filter: blur(1px);} /*Note that the blur() Effect is not supported as css3 in FFGecko and IEX*/

</style>

<div class="container-fluid">
    <div class="row">
		<div class="col-md-4" >
			
<div class="list-group">
    <a href="#seite1" data-toggle="tab" aria-controls="seite1" role="tab" class="list-group-item active" >
					Introduction
					</a>
    <a href="#seite2" data-toggle="tab" aria-controls="seite2" role="tab" class="list-group-item" >
					Handbook 
					</a>
  </div>
		</div>
		<div class="col-md-8 tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="seite1">
				<article class="panel panel-default">
					<header class="panel-heading">
						<h1 class="text-muted text-center">Intro T-Booking Service</h1></h1>
					</header>
						<div class="panel-body">
						
						   <figure class="pull-left "><img class="img-responsive img-rounded" alt="image" src="application/img/it-service.jpg" height="70px;"/>
							   <figcaption class="text-center"><strong>One fine caption</strong></figcaption>
							</figure> 
								<p>What is booking service ?</p>
<p>- It is the service of information about t-booking can be used quickly and easily.</p>
<p>- You can provide information that the user needs.</p>
<p>- No direct database connection required.</p>
								<hr/>
								<p>How to use booking service ?</p>
<p>- To connect to a web service must be enabled via <a target="_blank" href="http://services.t-booking.com/service">http://services.t-booking.com/service</a> And send the data set in the json format.</p>
						</div>
        <footer class="panel-footer clearfix "><address class="pull-right">Written by me at <time>10:00 am</time></address></footer>
    </div>
	<div role="tabpanel" class="tab-pane fade" id="seite2">
				<article class="panel panel-default">
					<header class="panel-heading">
						<h1 class="text-muted text-center">Manual User</h1>
					</header>
						<div class="panel-body">
<table align="center">
<tr>
						<td  align="center">

						   <figure class="pull-left "><img class="img-responsive img-rounded" alt="image" src="application/img/json_query.jpg"/>
							   <figcaption class="text-center"><strong>Json Form Query</strong></figcaption>
							</figure> 
							
						</td></tr>
<tr>						
<td>
							<h4>Query data</h4>
								<p>- Define the key must have :</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;request: define the condition of the select (array)</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;field: Name the field you want to use (array)</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;from: Set the desired table name in the database</p>
	
	<p>As example of a sought query product tour</p>
	<p>stay : province at start</p>
	<p>stay_to : province at end</p>
	</td>
	</tr>
</table>
								<hr/>	
								
						</div>
						<div class="panel-body" style=" display: nones;">
						   <figure class="pull-left "><img class="img-responsive img-rounded" alt="image" src="http://www.placehold.it/200.png/ddd"/>
							   <figcaption class="text-center"><strong>One fine caption</strong></figcaption>
							</figure> 
							<h4>Insert and Update data</h4>
								<p>Coming Soon</p>
								<hr/>
						</div>
        <footer class="panel-footer clearfix "><address class="pull-right">Written by me at <time>10:00 am</time></address></footer>
    </div>
			</article>
		</div>
	</div>
</div>

<script>
	$(".list-group-item").click(function(){
		//$(this).addClass("active");
		
	$('.list-group-item').removeClass('active').addClass('inactive');
    $(this).removeClass('inactive').addClass('active');
    
			//$('.list-group-item').removeClass('active')	;
			//$(this).addClass('active');
	});

	
</script>