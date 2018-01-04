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
      <table >

         <tbody id="tblUsers">
            <tr class="examples odd" id="UserId_1" role="row">
               <td class="sorting_1">1</td>
               <td>admin</td>
               <td>Mohammad</td>
               <td>Farzin</td>
               <td class="warning"><input type="button" value="Delete" class="sweet-5" id="btn_Delete1"></td>
            </tr>
            <tr class="examples even" id="UserId_5" role="row">
               <td class="sorting_1">2</td>
               <td>11</td>
               <td>11</td>
               <td>11</td>
               <td class="warning"><input type="button" value="Delete" class="sweet-5" id="btn_Delete5"></td>
            </tr>
            <tr class="examples odd" id="UserId_6" role="row">
               <td class="sorting_1">3</td>
               <td>11</td>
               <td>11</td>
               <td>11</td>
               <td class="warning"><input type="button" value="Delete" class="sweet-5" id="btn_Delete6"></td>
            </tr>
         </tbody>
      </table>
      <script>
         $(document).ready(function () {
         $('body').on('click','td.warning input',function () { 
                         swal({
                             title: "Are you sure?",
                             text: "You will not be able to recover this imaginary file!",
                             type: "warning",
                             showCancelButton: true,
                             confirmButtonClass: 'btn-danger',
                             confirmButtonText: 'Yes, delete it!',
                             cancelButtonText: "No, cancel plx!",
                             closeOnConfirm: false,
                             closeOnCancel: false
                         },
                         function (isConfirm) {
                             if (isConfirm) {
                                 swal("Deleted!", "Your imaginary file has been deleted!", "success");
                             } else {
                                 swal("Cancelled", "Your imaginary file is safe :)", "error");
                             }
                         });
                     });
         
         });
         
         
      </script>
   </body>
</html>