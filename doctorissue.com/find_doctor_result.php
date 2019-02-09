
<?php
if(isset($_POST["limit"], $_POST["start"]))
{
  include("DBcon.php");
  include("gblfun.php");
  $start=mysqli_real_escape_string($con,$_POST["start"]);
  $limit=mysqli_real_escape_string($con,$_POST["limit"]);
  $wtnd=mysqli_real_escape_string($con,$_POST['wtnd']);
  $district_code=mysqli_real_escape_string($con,$_POST['district_code']);
  $hospital_specialist=mysqli_real_escape_string($con,$_POST['hospital_specialist']);
  $dname=mysqli_real_escape_string($con,$_POST['dname']);
  $rand_index=mysqli_real_escape_string($con,$_POST['rand']);
  $output="";
  if(is_numeric($dname) && $dname!="" ){



       $search_query="SELECT users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
       FROM users, doctors_basic_info,serialinfo
       WHERE users.role='doctor'
       AND (accountno=$dname OR id=$dname)
       AND serialinfo.did=accountno
       AND accountno=doctors_basic_info.did
       AND serialinfo.status=1 GROUP BY(serialinfo.did) LIMIT $start,$limit";






      $search_result=mysqli_query($con,$search_query) or die(mysqli_error($con));

          if(mysqli_num_rows($search_result)>0){
            $optin_row = mysqli_fetch_assoc($search_result);





                 $output='<div class="row">
                    <!-----pic Section -------->
                    <div class="col-lg-2 col-sm-2 ">
                        <img class="  pull-right" src="'.$optin_row['profile_picture'].'" alt="'.$optin_row['name'].'" style="   border-radius: 50%;"  width="120" height="120">
                    </div>
                    <!----- Personal Info Section-------->
                    <div class="col-lg-4 col-sm-4 ">
                      <p class=" " style="font-size: 22px;">'.$optin_row['name'].'</p>
                      <p class=" ">'.speciality_hospital($optin_row['speciality'],0).'</p>
                       <p class="  ">'.$optin_row['designation'].'</br> '.$optin_row['institution'].'</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                    <div class="row ">
                      <div class="col-lg-9 col-sm-9">
                        <p class=" "><i class="fa fa-map-marker" aria-hidden="true"></i><b> Chamber</br>'.speciality_hospital($optin_row['hospital_id'],1).'</br>'.nl2br($optin_row['address']).'</p>
                        <p class=" "><i class="fa fa-money" aria-hidden="true"></i><b>Fees:'.$optin_row['fees_old'].' </b>  </br> New appointment: '.$optin_row['fees'].'</p>
                      </div>
                      <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                        <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-sm hidden-xs" style="margin-top:30px;"> View Profile</a>
                        <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-xs visible-xs" style="margin-top:10px;"> View Profile</a>
                      </div>
                    </div>
                  </div>
                  </div>
                  </br>  <div id="d2"></div></br>';








      }





  }
else if($wtnd ==0 && $district_code!="" && $hospital_specialist!="" ){//*******************************search for doctor******************************
     if($dname!=""){//all doctor with spacific specialist and dname
        $search_query="SELECT users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
        FROM users, doctors_basic_info,serialinfo
        WHERE users.role='doctor'
		    AND serialinfo.district_id=$district_code
        AND doctors_basic_info.speciality=$hospital_specialist
        AND serialinfo.did=accountno
        AND accountno=doctors_basic_info.did
        AND serialinfo.status=1
        AND CONCAT(fname,' ',lname) LIKE '%$dname%' GROUP BY(serialinfo.did) LIMIT $start,$limit";
     }
     else {//all doctors in this district with spacific specialist
       $search_query="SELECT  users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality,CONCAT(fname,' ',lname) AS name
       FROM users, doctors_basic_info,serialinfo
       WHERE users.role='doctor'
	      AND serialinfo.district_id=$district_code
       AND doctors_basic_info.speciality=$hospital_specialist
       AND serialinfo.did=accountno
        AND serialinfo.status=1
       AND accountno=doctors_basic_info.did GROUP BY(serialinfo.did) LIMIT $start,$limit" ;
     }






       $search_result=mysqli_query($con,$search_query) or die(mysqli_error($con));

           if(mysqli_num_rows($search_result)>0){
             while($optin_row = mysqli_fetch_assoc($search_result)) {

/*

               $doctors_info_basic="SELECT  * FROM	doctors_educational_qualification WHERE did=$optin_row['serialinfo.did']  AND status=1 ";
              $doctors_info_basic_result=mysqli_query($con,$doctors_info_basic) or die(mysqli_error($con));
              $degree="";
              if(mysqli_num_rows($doctors_info_basic_result)>0){

                while($doctors_info_basic_result_optin_row = mysqli_fetch_assoc($doctors_info_basic_result)) {
              $degree.=$doctors_info_basic_result_optin_row['']
                }
              }


              */




                  $output='<div class="row">
                     <!-----pic Section -------->
                     <div class="col-lg-2 col-sm-2 ">
                         <img class="  pull-right" src="'.$optin_row['profile_picture'].'" alt="profile pic" style="   border-radius: 50%;"  width="120" height="120">
                     </div>
                     <!----- Personal Info Section-------->
                     <div class="col-lg-4 col-sm-4 ">
                       <p class=" " style="font-size: 22px;">'.$optin_row['name'].'</p>
                       <p class=" ">'.speciality_hospital($optin_row['speciality'],0).'</p>
                        <p class="  ">'.$optin_row['designation'].'</br> '.$optin_row['institution'].'</p>
                     </div>
                     <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                     <div class="row ">
                       <div class="col-lg-9 col-sm-9">
                         <p class=" "><i class="fa fa-map-marker" aria-hidden="true"></i><b> Chamber</br>'.speciality_hospital($optin_row['hospital_id'],1).'</br>'.nl2br($optin_row['address']).'</p>
                         <p class=" "><i class="fa fa-money" aria-hidden="true"></i><b>Fees:'.$optin_row['fees_old'].' </b>  </br> New appointment: '.$optin_row['fees'].'</p>
                       </div>
                       <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                         <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-sm hidden-xs" style="margin-top:30px;"> View Profile</a>
                         <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-xs visible-xs" style="margin-top:10px;"> View Profile</a>
                       </div>
                     </div>
                   </div>
                   </div>
                   </br>  <div id="d2"></div></br>';







                   	}
       }

}
elseif($wtnd ==1 && $district_code!="" && $hospital_specialist!=""){//********************************search for hospital**********************************






  if($dname!=""){//all doctor with spacific Hospital With name  dname
     $search_query="SELECT  users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
     FROM users, doctors_basic_info,serialinfo
     WHERE users.role='doctor'
     AND serialinfo.district_id=$district_code
     AND serialinfo.hospital_id=$hospital_specialist
     AND serialinfo.did=accountno
     AND accountno=doctors_basic_info.did
     AND serialinfo.status=1
     AND CONCAT(fname,' ',lname) LIKE '%$dname%'  GROUP BY(serialinfo.did) LIMIT $start,$limit";
  }
  else {
    $search_query="SELECT DISTINCT users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
    FROM users, doctors_basic_info,serialinfo
    WHERE users.role='doctor'
    AND serialinfo.district_id=$district_code
    AND serialinfo.hospital_id=$hospital_specialist
    AND serialinfo.did=accountno
    AND accountno=doctors_basic_info.did
    AND serialinfo.status=1 GROUP BY(serialinfo.did) LIMIT $start,$limit";
  }





    $search_result=mysqli_query($con,$search_query) or die(mysqli_error($con));

        if(mysqli_num_rows($search_result)>0){
          while($optin_row = mysqli_fetch_assoc($search_result)) {

               $output='<div class="row">
                  <!-----pic Section -------->
                  <div class="col-lg-2 col-sm-2 ">
                      <img class="  pull-right" src="'.$optin_row['profile_picture'].'" alt="profile pic" style="   border-radius: 50%;"  width="120" height="120">
                  </div>
                  <!----- Personal Info Section-------->
                  <div class="col-lg-4 col-sm-4 ">
                    <p class=" " style="font-size: 22px;">'.$optin_row['name'].'</p>
                    <p class=" ">'.speciality_hospital($optin_row['speciality'],0).'</p>
                     <p class="  ">'.$optin_row['designation'].'</br> '.$optin_row['institution'].'</p>
                  </div>
                  <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                  <div class="row ">
                    <div class="col-lg-9 col-sm-9">
                      <p class=" "><i class="fa fa-map-marker" aria-hidden="true"></i><b> Chamber</br>'.speciality_hospital($optin_row['hospital_id'],1).'</br>'.nl2br($optin_row['address']).'</p>
                      <p class=" "><i class="fa fa-money" aria-hidden="true"></i><b>Fees:'.$optin_row['fees_old'].' </b>  </br> New appointment: '.$optin_row['fees'].'</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                      <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-sm hidden-xs" style="margin-top:30px;"> View Profile</a>
                      <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-xs visible-xs" style="margin-top:10px;"> View Profile</a>
                    </div>
                  </div>
                </div>
                </div>
                </br>  <div id="d2"></div></br>';







                 }
    }










  }
else if($district_code!="" && $dname!=""){







       $search_query="SELECT  users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
       FROM users, doctors_basic_info,serialinfo
       WHERE users.role='doctor'
       AND serialinfo.district_id=$district_code
       AND serialinfo.did=accountno
       AND accountno=doctors_basic_info.did
       AND serialinfo.status=1
       AND CONCAT(fname,' ',lname) LIKE '%$dname%' GROUP BY(serialinfo.did) LIMIT $start,$limit";







      $search_result=mysqli_query($con,$search_query) or die(mysqli_error($con));

          if(mysqli_num_rows($search_result)>0){
            while($optin_row = mysqli_fetch_assoc($search_result)) {

                 $output='<div class="row">
                    <!-----pic Section -------->
                    <div class="col-lg-2 col-sm-2 ">
                        <img class="  pull-right" src="'.$optin_row['profile_picture'].'" alt="profile pic" style="   border-radius: 50%;"  width="120" height="120">
                    </div>
                    <!----- Personal Info Section-------->
                    <div class="col-lg-4 col-sm-4 ">
                      <p class=" " style="font-size: 22px;">'.$optin_row['name'].'</p>
                      <p class=" ">'.speciality_hospital($optin_row['speciality'],0).'</p>
                       <p class="  ">'.$optin_row['designation'].'</br> '.$optin_row['institution'].'</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                    <div class="row ">
                      <div class="col-lg-9 col-sm-9">doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'
                        <p class=" "><i class="fa fa-map-marker" aria-hidden="true"></i><b> Chamber</br>'.speciality_hospital($optin_row['hospital_id'],1).'</br>'.nl2br($optin_row['address']).'</p>
                        <p class=" "><i class="fa fa-money" aria-hidden="true"></i><b>Fees:'.$optin_row['fees_old'].' </b>  </br> New appointment: '.$optin_row['fees'].'</p>
                      </div>
                      <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                        <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-sm hidden-xs" style="margin-top:30px;"> View Profile</a>
                        <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-xs visible-xs" style="margin-top:10px;"> View Profile</a>
                      </div>
                    </div>
                  </div>
                  </div>
                  </br>  <div id="d2"></div></br>';

                   }
      }




}

elseif($district_code!="") {





         $search_query="SELECT  users.profile_picture,serialinfo.did,serialinfo.fees,serialinfo.fees_old,serialinfo.address,serialinfo.hospital_id,doctors_basic_info.designation,doctors_basic_info.institution,doctors_basic_info.speciality, CONCAT(fname,' ',lname) AS name
         FROM users, doctors_basic_info,serialinfo
         WHERE users.role='doctor'
         AND serialinfo.district_id=$district_code
         AND serialinfo.did=accountno
         AND accountno=doctors_basic_info.did
         AND serialinfo.status=1
         GROUP BY(serialinfo.did)
         ORDER BY RAND($rand_index)
         LIMIT $start,$limit";







        $search_result=mysqli_query($con,$search_query) or die(mysqli_error($con));

            if(mysqli_num_rows($search_result)>0){
              while($optin_row = mysqli_fetch_assoc($search_result)) {

                   $output='<div class="row">
                      <!-----pic Section -------->
                      <div class="col-lg-2 col-sm-2 ">
                          <img class="  pull-right" src="'.$optin_row['profile_picture'].'" alt="profile pic" style="   border-radius: 50%;"  width="120" height="120">
                      </div>
                      <!----- Personal Info Section-------->
                      <div class="col-lg-4 col-sm-4 ">
                        <p class=" " style="font-size: 22px;">'.$optin_row['name'].'</p>
                        <p class=" ">'.speciality_hospital($optin_row['speciality'],0).'</p>
                         <p class="  ">'.$optin_row['designation'].'</br> '.$optin_row['institution'].'</p>
                      </div>
                      <div class="col-lg-6 col-sm-6 "><!-----doc right block-------->
                      <div class="row ">
                        <div class="col-lg-9 col-sm-9">
                          <p class=" "><i class="fa fa-map-marker" aria-hidden="true"></i><b> Chamber</br>'.speciality_hospital($optin_row['hospital_id'],1).'</br>'.nl2br($optin_row['address']).'</p>
                          <p class=" "><i class="fa fa-money" aria-hidden="true"></i><b>Fees:'.$optin_row['fees_old'].' </b>  </br> New appointment: '.$optin_row['fees'].'</p>
                        </div>
                        <div class="col-lg-3 col-sm-3 "><!----------view profile btn------->
                          <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-sm hidden-xs" style="margin-top:30px;"> View Profile</a>
                          <a target="_blank" href="doctorsprofile.php?d_id='.$optin_row['did'].'&id='.$login_session.'" class="btn btn-success btn-xs visible-xs" style="margin-top:10px;"> View Profile</a>
                        </div>
                      </div>
                    </div>
                    </div>
                    </br>  <div id="d2"></div></br>';

                     }
        }





}
else{












}
echo $output;
}



 ?>
