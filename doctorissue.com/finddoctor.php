
<?php
include("session.php");
include("DBcon.php");
include("sidenav.php");


?>

<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>
* {
    box-sizing: border-box;
}
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}
input[type=date] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}
input[type=time] {
    width: 47%;
    padding: 12px;
    border: 1p solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}
label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}
input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}
input[type=submit]:hover {
    background-color: #45a049;
}
.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
.linkab {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 5px;
    width: 75%;
    align:center;
}
.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}
.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
    input[type=time] {
        width: 43%;

    }
    .linkab {
        border-radius: 5px;
        padding: 5px;
        width: 100%;
        align:center;
    }
}
</style>
</head>
<body>
<div class="container Responsive">

    <div class="row">
      <div class="col-75">
        <select name="district_code" id="district_code" class="form-control Responsive dts" required>
            <option value="">Select District</option>
            <?php echo fetch_district(); ?>
           </select>
           <br />
           <select name="wtnd" id="wtnd" class="form-control action" required>
            <option value="">Select Option</option>
            <option value="0">specialist</option>
            <option value="1">Name Of Hospital</option>
           </select>
           <br />
           <select name="hospital_specialist" id="hospital_specialist" class="form-control">
            <option value="">Select Option</option>
           </select>
         </br><input type="text" class="form-control" placeholder="Name OR ID of Doctor(Optional)" id="dname"name="dname">
         <div class="col-25">
         </br><input type="button" class="btn btn-success search_button"value="Search" name="search_button">
         </div>
      </div>

      </div>
<div id="show_loaded_search_result"class=""></div>
   <div id="show_load_data_message"></div>




</div>
</body>
</html>
























<script>
var is_btn_pressed=0;
var rand=Math.floor((Math.random() * 100) + 1);
$(document).ready(function(){
  $('.dts').change(function(){
    is_btn_pressed=0;
         $('#wtnd').html('<option value="">Select Option</option><option value="0">specialist</option><option value="1">Name Of Hospital</option>');
         $('#hospital_specialist').html('');
    });
 $('.action').change(function(){
   is_btn_pressed=0;
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var choice = $(this).val();
   var district_code = $('#district_code').val();
   var result = '';
   $.ajax({
    url:"fetch_option.php",
    method:"POST",
    data:{action:action, choice:choice, district_code:district_code},
    success:function(data){
     $('#hospital_specialist').html(data);

    }
   })
  }
 });
});



var limit = 10; //The number of records to display per request
var start = 0; //The starting pointer of the data
var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active


function load_search_result_data()
{
//alert("Start:"+start +"Limit:"+ limit);
  var district_code=$('#district_code').val();
  var hospital_specialist=$('#hospital_specialist').val();
  var dname=$('#dname').val();
  var wtnd=$('#wtnd').val();
$.ajax({
 url:"find_doctor_result.php",
 method:"POST",
 data:{district_code:district_code,hospital_specialist:hospital_specialist,dname:dname,wtnd:wtnd,rand:rand,limit:limit, start:start},
 cache:false,
 success:function(data)
 {


  $('#show_loaded_search_result').append(data);
  if( $.trim(data).length == 0 || $(window).height() > $("#show_loaded_search_result").height())
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
});
}




$(document).on("click",".search_button",function(){
      limit = 10; //The number of records to display per request
      start = 0;

     rand=Math.floor((Math.random() * 100) + 1);
     is_btn_pressed=1;
     action = 'active';
     $('#show_loaded_search_result').html("");
     load_search_result_data();

});

if(action == 'inactive' && is_btn_pressed)
 {
  action = 'active';
  load_search_result_data(limit, start);
 }
 $(window).scroll(function(){
   if($(window).scrollTop() + $(window).height() > $("#show_loaded_search_result").height() && action == 'inactive' && is_btn_pressed)
   {
    action = 'active';
    start =limit;
    limit=limit+10;

    setTimeout(function(){
     load_search_result_data();
    }, 1000);
   }
  });


</script>
