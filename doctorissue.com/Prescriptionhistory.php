<?php
include("session.php");
include("sidenav.php");
?>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
</style>
</head>
<body>
<div class="container">
  <h2 ><strong>Prescription History</strong> </h2>

    <div class="row">
<div class="col-75" id="result"></div>
<div class="col-75"id="show_load_data_message"></div>

</div>
</div>
</body>
</html>

<div id="dataModal" class="modal fade">

  <div  class="modal-dialog">
    <div  class="modal-content">
      <div  class="modal-header">
        <button type="button" name="button" class="close" data-dismiss="modal">X</button>
          <h4 class="modal-title">Prescription</h4>
      </div>
      <div class="modal-body" id="Prescriptions_detail">

      </div>
      <div class="modal-footer">
          <button type="button" name="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<script >
var limit = 20; //The number of records to display per request
var start = 0;
var action = 'inactive';
  $(document).ready(function(){

 fetchprescription();

  });
  function fetchprescription(){
    action = 'active';
    var userid ="";
    $.ajax({
      url: "prescriptionhistoryresult.php",
      type:"POST",
      data:{limit:limit, start:start},
      success:function(data){

        $('#result').append(data);

        if( $.trim(data).length == 0 )
        {
         $('#show_load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
         action = 'active';
        }
        else
        {
         $('#show_load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
         action = 'inactive';
        }

      }
    })

  }

  $(document).on("click",".view_data",function(){

          var prescription_id =$(this).attr("id");
          $.ajax({
            url: "view_data_result.php",
            type:"POST",
            data:{"prescription_id":prescription_id},
            success:function(data){
              $('#Prescriptions_detail').html(data);
            }
          })
  $('#dataModal').modal('show');
});


   $(window).scroll(function(){


     if($(window).scrollTop() + $(window).height() > $("#result").height() && action == 'inactive')
     {

      action = 'active';
      start =limit
      limit=limit+20;

      fetchprescription();
     }
    });


</script>
