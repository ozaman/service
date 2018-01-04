<input type="text" id="count_click" value="0" />
<button id="click">add</button>

<script>
		var count = 0;
	$('#click').click(function(){
		
		
		$('#count_click').val(count+=1);
	});
	
</script>