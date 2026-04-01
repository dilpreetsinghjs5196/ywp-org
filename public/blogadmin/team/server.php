<?php 
include("db_config.php");


if(isset($_POST["submit_team"]))
{

$name = mysqli_real_escape_string($con, $_POST['user_name']);
$position = mysqli_real_escape_string($con, $_POST['user_position']);
$title = mysqli_real_escape_string($con, $_POST['user_title']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$image = $file_name = $_FILES['photo']['name'];
    if($image == ""){
        $sql = "INSERT INTO `teams`(`user_name`, `user_position`, `user_title`, `description`) VALUES ('$name','$position','$title','$description')";
        
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

        $sql = "INSERT INTO `teams`(`user_name`, `user_position`, `user_title`, `description`, `photo`) VALUES ('$name','$position','$title','$description', '$file_name')";
        
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
    $position = mysqli_real_escape_string($con, $_POST['user_position']);
    $title = mysqli_real_escape_string($con, $_POST['user_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $image = $file_name = $_FILES['photo']['name'];
    if($image == ""){
        $update_team = "UPDATE `teams` SET `user_name`='$name',`user_position`='$position',`user_title`='$title',`description`='$description' WHERE `id` = '$id'";
    
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
        
        $update_team = "UPDATE `teams` SET `user_name`='$name',`user_position`='$position',`user_title`='$title',`description`='$description',`photo`='$file_name' WHERE `id` = '$id'";
    
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
    $delete_sql = "DELETE FROM `teams` WHERE `id` = $id";
    $ress = mysqli_query($con, $delete_sql); 
    if($ress == 1)
    {
        echo json_encode($ress);
    }else{
        echo json_encode($ress);
    }
}


?>