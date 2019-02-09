<?php
include("DBcon.php");
$output="";
if(1)
{
  $query="SELECT *  FROM user  Order by id DESC ";
  $execute=mysqli_query($con,$query) or die(mysqli_error($con));
  $output .=mysqli_real_escape_string($con,$_POST['action']).'<table>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>';
              if( mysqli_num_rows($execute) > 0){
                while($row = mysqli_fetch_assoc($execute)) {
                   $output.='
                   <tr>
                     <td>'.$row["f_name"].'</td>
                     <td>'.$row["l_name"].'</td>
                     <td><button type="button" name="update" id="'.$row["id"].'">Update</button></td>
                     <td><button type="button" name="delete" id="'.$row["id"].'">delete</button></td>
                   </tr>';
                }
            }
  $output.='</table>';

}
else {
  $output .='<table>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>';
}
  echo $output;
?>
