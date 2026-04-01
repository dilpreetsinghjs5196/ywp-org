<?php 
include("../team/db_config.php");


if(isset($_POST["submit_prof"]))
{

$name = mysqli_real_escape_string($con, $_POST['user_name']);
// $gender = mysqli_real_escape_string($con, $_POST['gender']);
// $position = mysqli_real_escape_string($con, $_POST['position']);
$qualification = mysqli_real_escape_string($con, $_POST['qualification']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$image = $file_name = $_FILES['photo']['name'];
    if($image == ""){
        $sql = "INSERT INTO `on_board_professionals`(`user_name`, `qualification`,`description`) VALUES ('$name', '$qualification','$description')";
        
        if ($con->query($sql) === TRUE) {
          echo header("location:index.php");
        }else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
    }else{
        $errors= array();
        $file_name = $_FILES['photo']['name'];
        $file_size =$_FILES['photo']['size'];
        $file_tmp =$_FILES['photo']['tmp_name'];
        $file_type=$_FILES['photo']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
      
        $extensions= array("jpeg","jpg","png");
      
        if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
      
        if($file_size > 209715200){
         $errors[]='File size must be excately 2 MB';
        }
      
        if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
        //  echo "Success",$file_name;
        }else{
         print_r($errors);
        }  

        $sql = "INSERT INTO `on_board_professionals`(`user_name`,`qualification`, `description`, `photo`) VALUES ('$name', '$qualification', '$description', '$file_name')";
        
        if ($con->query($sql) === TRUE) {
        //   echo "New record created successfully";
          echo header("location:index.php");
        }else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

//edit team
if(isset($_POST["submit_edit"]))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['user_name']);
    // $gender = mysqli_real_escape_string($con, $_POST['gender']);
    // $position = mysqli_real_escape_string($con, $_POST['position']);
    $qualification = mysqli_real_escape_string($con, $_POST['qualification']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $image = $file_name = $_FILES['photo']['name'];
    if($image == ""){
        $update_team = "UPDATE `on_board_professionals` SET `user_name`='$name',  `qualification`='$qualification', `description`='$description' WHERE `id` = '$id'";
    
        if ($con->query($update_team) === TRUE) {
        //   echo "New record created successfully";
          echo header("location:index.php");
        }else {
          echo "Error: " . $update_team . "<br>" . $con->error;
        }
    }else{
        $errors= array();
        $file_name = $_FILES['photo']['name'];
        $file_size =$_FILES['photo']['size'];
        $file_tmp =$_FILES['photo']['tmp_name'];
        $file_type=$_FILES['photo']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
          
        $extensions= array("jpeg","jpg","png");
          
        if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
          
        if($file_size > 209715200){
         $errors[]='File size must be excately 2 MB';
        }
          
        if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
        //  echo "Success",$file_name;
        }else{
         print_r($errors);
        }  
        
        $update_team = "UPDATE `on_board_professionals` SET `user_name`='$name', `qualification`='$qualification', `description`='$description', `photo`='$image' WHERE `id` = '$id'";
    
        if ($con->query($update_team) === TRUE) {
        //   echo "New record created successfully";
          echo header("location:index.php");
        }else {
          echo "Error: " . $update_team . "<br>" . $con->error;
        }
    }
}

if(isset($_GET['id'])){
    $id  =   $_GET['id'];
    $delete_sql = "DELETE FROM `on_board_professionals` WHERE `id` = $id";
    $ress = mysqli_query($con, $delete_sql); 
    if($ress == 1)
    {
        echo json_encode($ress);
    }else{
        echo json_encode($ress);
    }
}


?>