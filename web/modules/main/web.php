<script>
$( document ).ready(function() {
	
    loadCurrentReport();
});
	
</script>
<input type="hidden" id="count_click" value="0" />

<div class="container" >
	<div class="row">
        <div class="col-sm-12">
            <legend>Name:</legend>
        </div>
        <!-- panel preview -->
        <div class="col-sm-6">
            
            <div class="panel panel-default">
           
                <div class="panel-body form-horizontal payment-form">
                    <div class="form-group">
                        <label for="concept" class="col-sm-3 control-label">รายการ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="program" name="program">
                        </div>
                    </div>
                   
                     <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">รุ่นรถ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="car_model" name="car_model">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">ป้ายทะเบียน</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="license_plate" name="license_plate">
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">ราคาขาย</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price_unit" name="price_unit" onkeyup="cal_price();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">จำนวน</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="num_product" name="num_product" onkeyup="cal_price();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">ส่วนลด</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="discount" name="discount" onkeyup="cal_price();">
                                <option value="0">---</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                            </select>
                        </div>
                    </div> 
                   <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">ราคาสุทธิ</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="total" name="total" disabled="disabled">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">เลขที่</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="number" name="number">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">ผู้รับของ</label>
                        <div class="col-sm-9">
                           <!--<input type="text" class="form-control" id="prison" name="prison">-->
                           <select class="form-control" id="prison" name="prison">
                                <option value="1">A</option>
                                <option value="2">B</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">วันที่</label>
                        <div class="col-sm-9">
                            <!--<input type="date" class="form-control" id="date" name="date">-->
                            <input type="text" id="datetimepicker4" name="date" value="<? echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-default preview-add-button">
                                <span class="glyphicon glyphicon-plus"></span> Add
                            </button>
                        </div>
                    </div>
                </div>
	
            </div>            
        </div> <!-- / panel preview -->
       
        <div class="col-sm-6">
          <div class="panel panel-default">
          		<table><tr><td><input type="text" id="date_find_report" name="date" value="<? //echo date('Y-m-d'); ?>2017-04-16" class="form-control"></td>
          		<td><button class="btn" id="find_current_rp" onclick="loadCurrentReport()">OK</button></td>
          		</tr></table>
          		
          		<div align="center">
          		<div id="load_current_report"></div>
          			<div id="load_paging"></div>
          			<div id="next_page">

          		</div>
				</div>
           </div>
        </div>

        <div class="col-sm-12">
            <h4>Preview:</h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table preview-table">
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>รุ่นรถ</th>
                                    <th>ป้ายทะเบียน</th>
                                    <th>เลขที่</th>
                                    <th>ผู้รับของ</th>
                                    <th>วันที่</th>
                                    <th>ราคาขาย</th>
                                    <th>จำนวน</th>
                                    <th>ส่วนลด</th>
                                    <th>ราคาสุทธิ</th> 
                                    <th>ลบ</th>        
                                </tr>
                            </thead>
                            <tbody></tbody> <!-- preview content goes here-->
                        </table>
                    </div>                            
                </div>
            </div>
            <div class="row text-right">
                <div class="col-xs-12" >
                    <h4>Total: <strong><span class="preview-total"></span></strong></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr style="border:1px dashed #dddddd;">
                    <button type="button" class="btn btn-primary btn-block" id="save_data">Save Data</button>
                </div>                
            </div>
        </div>
	</div>
</div>
<br/>
<br/>
<div id="json" style="display: none;">0</div>

<script>
//function test(){
	$('.pagination a').click(function(){
	$(this).siblings('a').removeClass('active');
    $(this).addClass('active');
	var n = $(this).text();
	var num = $(this).attr('id');
	alert(num);
	loadCurrentReport(num);
	
	});
//}
	
	
</script>  

<script>
	function loadCurrentReport(num){
		$("#load_current_report").html('<br><img src="css/hourglass.gif"  align="center" /> ');
		
		var date = $('#date_find_report').val();
		var url = "popup.php?name=main&file=current_report&date="+date+"&num="+num;
		$("#load_paging").load(url+" #next_page");
		alert(num);
	$("#load_current_report").load(url+" #mini_report");
	
	}
</script>

<script>
    $('#datetimepicker4').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

     $('#date_find_report').datetimepicker({
     	
        timepicker: false,
        format: 'Y-m-d'
        
    });
    
/**
* $('#date_find_report')
    .datetimepicker()
    .on('changeDate', function(ev){
        if (ev.date.valueOf() < date-start-display.valueOf()){
            ....
        }
    });
*/
    
</script>

<script>
	
	$('#save_data').click(function(){
		
swal({
  title: "Are you sure?",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  closeOnConfirm: true
},
function(){
  //
  var count = $('#count_click').val();
  var url = 'modules/main/save_data.php';
  var arr =  [];
  
  for(var a=1;a<=count;a++){
  	var arr2 = [];

 	$('table #tr_'+a+' td').each(function(){
 		
 		var txt = $(this).text();
 		expr = "%";
 		var find = txt.includes(expr);
 		if(find==true){
			txt = txt.substring(0,txt.indexOf("%"));
		}
    	arr2.push(txt);                                                
    });
    arr.push(arr2);
  }

  $.post( url,{ 'arr[]': arr , count : count}, function( data ) {
//alert(data);		
 		 if(data==1){
		 	swal("Deleted!", "Your imaginary file has been deleted.", "success");
		 	$('.trHover').remove();
			$('#count_click').val(0);
		    $(".preview-total").text(0); 
		 }else{
		 	swal("Deleted!", "Your imaginary file has been deleted.", "warning");
		 }
 		
	});	
});
  
  		
});
	
</script>

<script>
	
$("#num_product").bind('keyup mouseup', function () {
  cal_price();          
});

$("#discount").bind('keyup mouseup', function () {
  cal_price();          
});
	
$("#price_unit").bind('keyup mouseup', function () {
  cal_price();          
});
	
	function cal_price(){
		
		var price = $('#price_unit').val();
		var num = $('#num_product').val();
        var discount = $('#discount').val();
        if(num>0){
			price = price*num;
		}
      
		var discounts = (price*discount)/100;
        var sum_row = price - discounts;
        
        $('#total').val(sum_row.toFixed(2));
		
	}
	
</script>

<script>

	function calc_total(){
    var sum = 0;
    $('.input-total').each(function(){
        sum += parseFloat($(this).text());
       
    });
    
    $(".preview-total").text(sum);    
}
$(document).on('click', '.input-remove-row', function(){ 
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
    	tr.remove();
    	var click_remove = $('#count_click').val();
    	$('#count_click').val(click_remove-=1);
	   	calc_total();
	});
});


$(function(){
	
    $('.preview-add-button').click(function(){
        var form_data = {};
        var count =  parseFloat($('#count_click').val());
        $('#count_click').val(count+=1);
        
        var row = $('<tr class="trHover" id="tr_'+count+'" ></tr>');  
       
        
        form_data["program"] = $('.payment-form input[name="program"]').val();
        form_data["car_model"] = $('.payment-form input[name="car_model"]').val();
        form_data["license_plate"] = $('.payment-form input[name="license_plate"]').val();
        form_data["number"] = $('.payment-form input[name="number"]').val();
        form_data["prison"] = $('.payment-form #prison option:selected').val();
        form_data["date"] = $('.payment-form input[name="date"]').val();
        form_data["price_unit"] = parseFloat($('.payment-form input[name="price_unit"]').val()).toFixed(2);
        form_data["num_product"] = parseFloat($('.payment-form input[name="num_product"]').val()).toFixed(2);
        form_data["discount"] = $('.payment-form #discount option:selected').val()+"%";
        form_data["total"] = parseFloat($('.payment-form input[name="total"]').val()).toFixed(2);
        form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
        
         $.each(form_data, function( type, value ) {
         	alert(value);
            $('<td class="input-'+type+'" id="'+type+"_"+count+'"></td>').html(value).appendTo(row);
            
        });
        // $('<td class="input-" id=""></td>').html(sum_row).appendTo(row);
        $('.preview-table > tbody:last').append(row); 
	    calc_total();
        
    });  
});
</script>


