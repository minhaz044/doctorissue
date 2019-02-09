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


    <div class="row">
<div class="col-75" id="result"></div>
<div class="col-75"id="show_load_data_message"></div>

</div>
</div>
</body>
</html>






<script >
var limit = 30; //The number of records to display per request
var start = 0;
var action = 'inactive';
  $(document).ready(function(){

 fetchprescription();

  });
  function fetchprescription(){
    action = 'active';
    var userid ="";
    $.ajax({
      url: "allnotificationresult.php",
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
         $('#show_load_data_message').html("<button type='button' class='btn '>.......</button>");
         action = 'inactive';
        }

      }
    })

  }




   $(window).scroll(function(){


     if($(window).scrollTop() + $(window).height() > $("#result").height() && action == 'inactive')
     {

      action = 'active';
      start =limit
      limit=limit+30;

      fetchprescription();
     }
    });


</script>
