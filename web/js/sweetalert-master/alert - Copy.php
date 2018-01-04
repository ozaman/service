<!doctype html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
  <title>SweetAlert</title>

  <link rel="stylesheet" href="example/example.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

  <!-- This is what you need -->
  <script src="dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="dist/sweetalert.css">
  <!--.......................-->

</head>

<body>


<ul class="examples">



	<li class="warning confirm">
		<div class="ui">
			<p>A warning message, with a function attached to the "Confirm"-button...</p>
			<button>Try me!</button>
		</div>
 
	</li>

 

 

</ul>
<input type="tel" />






 


 


<script>



document.querySelector('ul.examples li.warning.confirm button').onclick = function(){
	swal({
		title: "Are you sure ?",
		text: "Please Enter your Password !",
		//type: "warning",
		type: 'input',
		inputType: "password",
		imageUrl: 'img/Delete_icon.png',   
		animation: false,
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: false,
		
	},
	function(inputValue){
		if (inputValue === false) return false;

		if (inputValue === "") {
			swal.showInputError("You need to enter password!");
			return false;
		}
   		if (inputValue != "test") {
			swal.showInputError("You  enter wrong password!");
			return false;
		}
   		$.ajax({
                url: "scriptDelete.php",
                type: "POST",
                data: {id: 5},
                dataType: "html",
                success: function () {
                    swal({
					title: "Deleted!",
					text: "Your imaginary Item has been  deleted! "+ inputValue +"",
					type: 'success'
					},
					function () {
					    window.location.reload();
					});  
                }	
            });
           
		

	});
	
};


</script>



</body>

</html>
