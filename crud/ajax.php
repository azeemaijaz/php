<?php
error_reporting(0);

   $data['title']= $_POST['title'];
   $data['date']=  $_POST['date'];
   $data['time']=   $_POST['time'];
   $data['priority']=  $_POST['priority'];

    if (isset($_POST['notification'])) {
        $data['notification']=$_POST['notification'];
    } else {
        $data['notification']= 0;
    }
    $data['category']=$_POST['category'];


    $tags =  '';
    foreach ($_POST['tags'] as $value) {
        $tags .= $value . ",";
    }
    $data['tags']=  $tags = rtrim($tags, ",");

    if ($_FILES['fileToUpload']['name'] != '') {
     
        $data['post_img']=   $file_name = $_FILES['fileToUpload']['name'];

    } 
    // print_r($data);
echo json_encode($data);

?>