

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>
</head>



<body>


<div class="container">
  <h1></h1>


    <h4>Enter Your Verification Code:</h4><br>
    <p>A code is already sent to your Phone Number /Email</p>
    <input type="text" name="verification_code" id="verification_code" required>
    <br>
    <button class=" btn btn-warning resent_button"type="button"id="resent_button" name="resent_button">Resent Code</button>
					<span class="" id="is_code_sent" style="color:red;"></span>
    <br>
    <button  class="btn btn-success Submit_button" type="button" id="Submit_button" name="Submit_button" >SUBMIT</button>
    	<span class="" id="Error_field" style="color:red;"></span>


</div>

</body>
</html>




<script >
var number_of_try=0;
  $(document).ready(function(){


    $(document).on("click",".Submit_button",function(){

            var select_btn_val =$("#verification_code").val();
            if(select_btn_val!=""){
              $.ajax({
                url: "test_verification_code.php",
                type:"POST",
                data:{select_btn_val:select_btn_val},
                success:function(result){
                  if(result==1){
                    window.location.assign("homepage.php");

                  }else {
                      alert("Wrong Verification Code.\n Try Again");
                  }

                }
              })
            }else{
              alert("Enter your Code First ,Then Submit.\n Thank You");
            }


            });

    $(document).on("click",".resent_button",function(){

            var string_ =$(this).attr("id");
            if(number_of_try<3){
              number_of_try++;
              $.ajax({
                type:"POST",
                url:"sent_verification_code.php",
                data:{"string_":string_},
                success:function (data){
                  $("#is_code_sent").text("A Code is sent to your Registered phone Number("+number_of_try+") ");
                }
              })
            }



            });



  });






</script>
