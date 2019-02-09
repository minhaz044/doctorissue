
<?php  include("sidenav.php"); ?>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

ul {
  list-style-type: none;

}
li a {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.3s;
    cursor: pointer;
  	height:15px;
  	width:150px;
  	background-color: white;
    color: black;
    border: 2px solid #4CAF50;
height:22px;
}


li a:hover {
     background-color: #4CAF50;
    color: white;
}

</style>
</head>
<body>




<div class="container-p">
  <h2>Search Patient</h2>
    <div class="row">
      <div class="col-75">
         <input type="text" name="search_id" id="search_id"  placeholder="Search With Patient ID" required></br>
      </div>
        <div class="col-25">
            <button type="button" class="button-p"name="search_btn" id="search_btn">SEARCH</button>
        </div>
      </div>
      <div class="" id="result">

      </div>
</div>

</body>
</html>





<script >


  $(document).ready(function(){

    $("#search_btn").click(function(){
         fetchpatient();
    });


  function fetchpatient(){
    var search_id =$("#search_id").val();

    $.ajax({
    	url: "view_patient_result.php",
      type:"POST",
    	data:{"search_id":search_id},
      success:function(data){
        $('#result').html(data);
      }
    })
   }
  });

</script>
