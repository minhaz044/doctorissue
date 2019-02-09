<?php

include("../DBcon.php");
include("../session.php");
include("../gblfun.php");

if($login_role=="adminsx" || $login_role=="admin"){

if ($_POST['time_from']!="" && $_POST['time_to']!="" && $_POST['req_type']!="" && $_POST['order']!="" ) {

$date=date_create($_POST['time_from']);
$time_from=date_format($date,"Y-m-d H:i:s");
$date=date_create($_POST['time_to']);
$time_to=date_format($date,"Y-m-d H:i:s");
$type=$_POST['req_type'];
$order=$_POST['order'];
$output="";

if($type==1){

  $query="SELECT * FROM temp_doctors_basic_info,users WHERE  users.accountno=temp_doctors_basic_info.user_id
  AND  temp_doctors_basic_info.accepted=0
  AND  temp_doctors_basic_info.rejected=0
  AND temp_doctors_basic_info.date_time BETWEEN '$time_from' AND '$time_to' ";
}
elseif ($type==2) {
  $query="SELECT * FROM temp_doctors_basic_info,users WHERE  users.accountno=temp_doctors_basic_info.user_id
  AND  temp_doctors_basic_info.accepted=1
  AND  temp_doctors_basic_info.rejected=0
  AND temp_doctors_basic_info.date_time BETWEEN '$time_from' AND '$time_to' ";
}
elseif ($type==3) {
  $query="SELECT * FROM temp_doctors_basic_info,users WHERE  users.accountno=temp_doctors_basic_info.user_id
  AND  temp_doctors_basic_info.accepted=0
  AND  temp_doctors_basic_info.rejected=1
  AND temp_doctors_basic_info.date_time BETWEEN '$time_from' AND '$time_to' ";
}
else{
$query="SELECT * FROM temp_doctors_basic_info,users WHERE  users.accountno=temp_doctors_basic_info.user_id
AND  temp_doctors_basic_info.accepted=0
AND  temp_doctors_basic_info.rejected=0
AND temp_doctors_basic_info.date_time BETWEEN '$time_from' AND '$time_to' ";
}
$result=mysqli_query($con,$query) or die(mysqli_error($con));


if(mysqli_num_rows($result)>0){
    while($result_row = mysqli_fetch_assoc($result)) {


                       $output.='<div class="row">
                          <!-----pic Section -------->
                          <div class="col-lg-2 col-sm-2 ">
                              <img class="  pull-right" src="../'.$result_row['picture'].'" alt="'.$result_row['fname'].$result_row['lname'].'" style="   border-radius: 50%;"  width="120" height="120">
                          </div>
                          <!----- Personal Info Section-------->
                          <div class="col-lg-4 col-sm-4 ">
                            <p class=" " style="font-size: 22px;">'.$result_row['fname'].$result_row['lname'].'</p>
                            <p class="  "><strong>#ID Number :</strong>'.$result_row['user_id'].'</br> </p>
                            <p class="  "><strong>BM&DC        Registation Number :</strong>'.$result_row['govt_doc_id'].'</br> </p>
                             <p class="  ">';
                             if($result_row['gender']==1){
                                  $output.='<strong>Gender:</strong>Male</br> </p>';
                             }
                             else{
                                 $output.='<strong>Gender:</strong>Female</br> </p>';
                             }
                             $output.='
                          </div>
                          <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                          <div class="row ">
                            <div class="col-lg-9 col-sm-9">
                            </div>
                            <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                            <button type="button" id='.$result_row['sid'].' class=" requesthandaler btn btn-success btn-sm hidden-xs" style="margin-top:30px;"name="accept">Accept</button>
                            <button type="button" id='.$result_row['sid'].' class=" requesthandaler btn btn-success btn-sm hidden-xs" style="margin-top:30px;"name="reject">Reject</button>
                              </div>
                          </div>
                        </div>
                        </div>
                        </br>
                        <div id="d2"></div></br>';

    }




}
echo $output;


}
}
 ?>
