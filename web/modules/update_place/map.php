<!DOCTYPE html>
<? set_time_limit(500000000000); ?>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Reverse Geocoding by Place ID</title>
 
  </head>
  <body>
      <div id="tst">
 
    </div>
   <?php
$db->connectdb('admin_tbkmanagement',DB_USERNAME,DB_PASSWORD);
mysql_query("SET NAMES UFT8"); 
mysql_query("SET character_set_results=utf-8"); 
$res[project] = $db->select_query("SELECT id,topic,update_map,place_id,latitude,longitude,province FROM web_transferplace_new where update_map = '1' and province = 'Phuket'  ");
$num = 1;
 while($arr[project] = $db->fetch($res[project])) {
	 	$address = $arr[project][topic];
	 	$prepAddr = str_replace(' ','+',$address);
//        echo $address;
//		$url = "http://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false";
		$url = "https://maps.google.com/maps/api/geocode/json?latlng=".$arr[project][latitude].",".$arr[project][longitude]."&sensor=false";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		
			
		echo $arr[project][id]." ."." = ";
		$len = sizeof($response_a);
		echo $response_a->results[4]->address_components[0]->long_name;
//		echo " : ";
//		echo $long = $response_a->results[0]->geometry->location->lng;
 		echo "<br/>";
 		$place_id = $response_a->results[0]->place_id;
    ?>
    <!--	<textarea id="json_<?=$num;?>"><?=$response?></textarea><br>-->

	<!--<script>
    
		$( document ).ready(function() {
			var json = $('#json').val();
//			console.log(<?=$response;?>);			
//		    geocodePlaceId('<? echo $place_id ?>','<? echo $arr[project][id]; ?>');
		    
		});
    </script>-->

    <? $num+=1; } ?>
    <script>
	$( document ).ready(function() {
		var json = $('textarea#json_1').val();
		console.log(json);	
//		    geocodePlaceId('<? echo $place_id ?>','<? echo $arr[project][id]; ?>');
		    
		});
	
      // This function is called when the user clicks the UI button requesting
      // a reverse geocode.
      function geocodePlaceId(placeId,id) {
      	var geocoder = new google.maps.Geocoder;
      
       
        geocoder.geocode({'placeId': placeId}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
            	
            	
			  var lo = results[0].geometry.location.toJSON();
			  var lat = lo.lat;
			  var lng = lo.lng;
			  var place_id = placeId;
			  console.log(results);
//			  $('#tst').html(lo.toJSON());
             $.post( "modules/update_place/save_map.php?pass=1",{lat:lat,lng:lng,place_id:place_id,id:id},function( data ) {
			   
			   console.log(data);
//			   window.location.reload();
			});
			
            } else {
             
              console.log('No results found');
              var no_found = "No results found";
	               $.post( "modules/update_place/save_map.php?pass=0",{status:no_found,id:id},function( data ) {
				   console.log(data);
				   window.location.reload();
				});
            }
          } else {
            console.log('Geocoder failed due to: ' + status);
           /*  $.post( "modules/update_place/save_map.php?pass=0",{status:status,id:id},function( data ) {
			   console.log(data);
//			   window.location.reload();
			});*/
          }
        });
      }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJa08ZMaSnJP5A6EsL9wxqdDderh7zU90">
    </script>

    
  </body>
</html>