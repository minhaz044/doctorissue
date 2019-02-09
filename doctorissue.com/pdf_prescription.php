<?php
include("DBcon.php");
include("session.php");
include("gblfun.php");
require("fpdf/fpdf.php");
if(isset($_GET['p_id'])){
$prescription_id=mysqli_real_escape_string($con,$_GET['p_id']);

//incomplite Project
$pdf=NEW FPDF("p","mm","A4");
$pdf->Addpage();
$pdf->SetMargins(20,40, 20);







/********************SQL Query Part ********************************/
                  /*Prescription Info*/
$prescription_query="SELECT * FROM prescription WHERE prescription_id='$prescription_id' AND user_id='$login_session'";
$prescription_query_execute=mysqli_query($con,$prescription_query) or die(mysqli_error($con));
if($prescription_query_execute && mysqli_num_rows($prescription_query_execute)==1){
$prescription_query_row = mysqli_fetch_assoc($prescription_query_execute);
if($prescription_query_row['user_id']==$login_session){
//*********************user Info ****************//
$doctors_id=$prescription_query_row['doctors_id'];
  $patient_info_query="SELECT fname,lname,dob  from users where accountno='$prescription_query_row[user_id]'";
  $patient_info_query_execute=mysqli_query($con,$patient_info_query) or die(mysqli_error($con));
  $patient_info_query_row = mysqli_fetch_assoc($patient_info_query_execute);

//*********************Doctors Info*****************//
$doctor_info_query="SELECT users.accountno,users.fname,users.lname,doctors_basic_info.speciality ,doctors_basic_info.institution,doctors_basic_info.designation
from users ,doctors_basic_info where users.accountno='$doctors_id' AND users.accountno=doctors_basic_info.did";
$doctor_info_query_execute=mysqli_query($con,$doctor_info_query) or die(mysqli_error($con));
$doctor_info_query_row = mysqli_fetch_assoc($doctor_info_query_execute);
$doctor_name= $doctor_info_query_row["fname"]." ".$doctor_info_query_row["lname"];
/*************************Hospital Info***********************************/
$hospital_info_query="SELECT serialinfo.address,hospital_by_district.hospital_name from serialinfo,hospital_by_district WHERE serialinfo.sid='$prescription_query_row[serial_info_id]' AND hospital_by_district.hospital_id=serialinfo.hospital_id";
$hospital_info_query_execute=mysqli_query($con,$hospital_info_query) or die(mysqli_error($con));
$hospital_info_query_row = mysqli_fetch_assoc($hospital_info_query_execute);








/***************************Variable Decliration Scope**************************/

$hospital_name=$hospital_info_query_row['hospital_name'];
$hospital_address=$hospital_info_query_row['address'];
$doctors_info=$doctor_name."\n".$doctor_info_query_row['designation']."\n".$doctor_info_query_row['institution']."\n"."Doctors Id:   ".$doctors_id."\n"."Date:  ".$prescription_query_row['submisson_date'];
$patient_name= $patient_info_query_row["fname"]." ".$patient_info_query_row["lname"];
$patient_age=intval(date('Y', time() - strtotime($patient_info_query_row['dob']))) - 1970;
$patient_address="";
$prescription_problem_section=$prescription_query_row['problems'];
$prescription_primary_test_section=$prescription_query_row['primary_test'];
$prescription_investigation_test_section=$prescription_query_row['test'];
$prescription_rx_section=$prescription_query_row['medicine'];
$prescription_sugesition_section=$prescription_query_row['comment'];

$made_by="Developed By:Minhaz Uddin";









                      /************************************/



        $pdf->SetFont('Arial','B',14);


$initial_point_x= $pdf->GetX();
$initial_point_y= $pdf->GetY();
$pdf->SetXY($initial_point_x, $initial_point_y);


/*********************Header Of Prescription**************/
        $pdf->Cell(160 ,5,"",0,1);
        $pdf->Cell(100 ,5,"$hospital_name",0,0);
        $pdf->Cell(60 ,5,"Doctors Information",0,1);

/***********************Header End***************/

$doctors_info_section_x= $pdf->GetX();
$doctors_info_section_y= $pdf->GetY();

/**************End of taking value for seting doc ctor inmnfo sec  box******/
$hospital_address_section_title_box_weidth=70;
$hospital_address_title_box_hight=5;
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell($hospital_address_section_title_box_weidth,$hospital_address_title_box_hight, "$hospital_address", 0, 'L', FALSE);
/****************End of Hospital Address Section************/
$last_position_of_hospitial_address_y= $pdf->GetY();
        $pdf->SetXY($doctors_info_section_x+100, $doctors_info_section_y);
$doctors_info_section_weidth =70;
$doctors_info_section_hight=5;
        $pdf->MultiCell($doctors_info_section_weidth,$doctors_info_section_hight, "$doctors_info", 0, 'L', FALSE);
$last_position_of_doctors_info_y= $pdf->GetY();
/********************End of Doctors Info Section**********************/
if($last_position_of_doctors_info_y >=$last_position_of_doctors_info_y){
  $patient_name_line_up_y=$last_position_of_doctors_info_y;
}else{
  $patient_name_line_up_y=$last_position_of_hospitial_address_y;
}
$patient_name_line_up_x=17;


        $pdf->Line($patient_name_line_up_x,$patient_name_line_up_y+5, $patient_name_line_up_x+175,$patient_name_line_up_y+5);
        $pdf->Line($patient_name_line_up_x,$patient_name_line_up_y+5+5,$patient_name_line_up_x+175, $patient_name_line_up_y+5+5);
        $pdf->Line($patient_name_line_up_x,$patient_name_line_up_y+5+5+5,$patient_name_line_up_x+175, $patient_name_line_up_y+5+5+5);
        $pdf->SetXY($patient_name_line_up_x+3, $patient_name_line_up_y+5);

        $pdf->Cell( 20,5,"Name:",0,0);
        $pdf->Cell(80 ,5,"$patient_name",0,0);
        $pdf->Cell(15 ,5,"Age:",0,0);
        $pdf->Cell(45 ,5,"$patient_age",0,1);

        $pdf->Cell(20 ,5,"Address:   ",0,0);
        $pdf->Cell(160 ,5,"$patient_address",0,1);
$start_point_of_prescription_x=$pdf->GetX();
$start_point_of_prescription_y=$pdf->GetY();
        $pdf->SetXY($start_point_of_prescription_x,$start_point_of_prescription_y+10);

////***********************End of Section for patient name and address******************** /////
$middle_line_x1=$pdf->GetX()+70;
$middle_line_y1=$pdf->GetY();
$middle_line_x2=$pdf->GetX()+70;
$middle_line_y2=$pdf->GetY()+200;

        $pdf->Line($middle_line_x1,$middle_line_y1, $middle_line_x2,$middle_line_y2);
//$pdf->Line($patient_name_line_up_x,$patient_name_line_up_y+5+5,$patient_name_line_up_x+175, $patient_name_line_up_y+5+5);
//$pdf->Line($patient_name_line_up_x,$patient_name_line_up_y+5+5+5,$patient_name_line_up_x+175, $patient_name_line_up_y+5+5+5);



        $pdf->SetXY($pdf->GetX() , $pdf->GetY()+5);

/*******************heading *//////////////
/***********problem part goes here******************/


$problem_section_title_box_weidth=75;
$problem_section_title_box_hight=5;
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell($problem_section_title_box_weidth ,$problem_section_title_box_hight,'Problems:',0,0);

$rx_section_title_box_weidth=90;
$rx_section_title_box_hight=5;
        $pdf->Cell($rx_section_title_box_weidth ,$rx_section_title_box_hight,'Rx:',0,1);
        $pdf->SetFont('Arial','',12);

        $rx_section_box_position_x=$pdf->GetX()+75;
        $rx_section_box_position_y= $pdf->GetY();
        $current_x= $pdf->GetX();
        $current_y= $pdf->GetY();
        $pdf->SetXY($current_x+5 , $current_y);
$problem_section_box_weidth=65;
$problem_section_box_hight=5;
        $pdf->multiCell($problem_section_box_weidth,$problem_section_box_hight,"$prescription_problem_section",0,1);
/**********************Primary Test(O/E) Section****************************/
$Primary_test_section_title_box_weidth=$problem_section_box_weidth;
$Primary_test_section_title_box_hight=$problem_section_box_hight;
        $current_x= $pdf->GetX();
        $current_y= $pdf->GetY();
        $pdf->SetXY($current_x , $current_y+5);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell($Primary_test_section_title_box_weidth ,$Primary_test_section_title_box_hight,"Primary Test(O/E):",0,1);

        $current_x= $pdf->GetX();
        $current_y= $pdf->GetY();
        $pdf->SetXY($current_x+5 , $current_y);
$Primary_test_section_box_weidth=$problem_section_box_weidth;
$Primary_test_section_box_hight=$problem_section_box_hight;
        $pdf->SetFont('Arial','',12);
        $pdf->multiCell($Primary_test_section_box_weidth,$Primary_test_section_box_hight,"$prescription_primary_test_section",0,1);



/**************************Investigation Test:**************************/
$investigation_test_section_title_box_weidth=$Primary_test_section_title_box_weidth;
$investigation_test_section_title_box_hight=$Primary_test_section_title_box_hight;
$current_x= $pdf->GetX();
$current_y= $pdf->GetY();
        $pdf->SetXY($current_x , $current_y+5);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell($investigation_test_section_title_box_weidth ,$investigation_test_section_title_box_hight,"Investigation Test:",0,1);


$current_x= $pdf->GetX();
$current_y= $pdf->GetY();
        $pdf->SetXY($current_x+5 , $current_y);
$investigation_test_section_box_weidth=$Primary_test_section_box_weidth;
$investigation_test_section_box_hight=$Primary_test_section_box_hight;
        $pdf->SetFont('Arial','',12);
        $pdf->multiCell($investigation_test_section_box_weidth,$investigation_test_section_box_hight,"$prescription_investigation_test_section",0,1);

/******************************Rx Box Field**************************************/
$rx_section_box_weidth=80;
$rx_section_box__hight=5;
        $pdf->SetXY($rx_section_box_position_x+5,$rx_section_box_position_y);

        $pdf->MultiCell($rx_section_box_weidth,$rx_section_box__hight, "$prescription_rx_section", 0, 'L', FALSE);

/**************************End of Rx Field*********************************/
$rx_section_box_weidth=80;
$rx_section_box__hight=5;
        $pdf->SetXY($rx_section_box_position_x, $pdf->GetY()+5);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell($investigation_test_section_title_box_weidth ,$investigation_test_section_title_box_hight,"Sugesition:",0,1);
        $pdf->SetFont('Arial','',14);
        $pdf->SetXY($rx_section_box_position_x+5, $pdf->GetY());
        $pdf->MultiCell($rx_section_box_weidth,$rx_section_box__hight, "$prescription_sugesition_section", 0, 'L', FALSE);

/*****************************End Of  Sugesition part********************/


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY($middle_line_x2-25,$middle_line_y2);
        $pdf->Cell( 100,5,"$made_by",0,1);
/*****************************End of Company Sign ********************/

}
}


$pdf->output('D','Prescription.pdf');



}

?>
