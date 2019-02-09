<?php
include("session.php");
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
<style>
</style>
</head>
<body>
<div class="container">
  <h2 ><strong>My prescription</strong> </h2>

    <div class="row">
      <div class="col-75" id="result">





      </div>
</div>
</div>
</body>
</html>

<div id="dataModal" class="modal fade">

  <div  class="modal-dialog">
    <div  class="modal-content">
      <div  class="modal-header">
        <button type="button" name="button" class="close" data-dismiss="modal">X</button>
          <h4 class="modal-title">Report</h4>
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

  $(document).ready(function(){
 fetchreport();
  function fetchreport(){
    var userid ="<?php echo $_GET['id']; ?>";
    $.ajax({
    	url: "reportlist_result.php",
      type:"POST",
    	data:{"id":userid},
      success:function(data){
        $('#result').html(data);

      }
    })

  }

    $(document).on("click",".visibility_btn",function(){

            var select_btn_val =$(this).attr("id");
            $.ajax({
              url: "report_visiblity_result.php",
              type:"POST",
              data:{"select_btn_val":select_btn_val},
              success:function(data){
              }
            })
            fetchreport();
            });


  });



</script>
