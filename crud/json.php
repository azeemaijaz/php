<?php
error_reporting(0);

if (isset($_POST['submit'])) {
   $data['title']= $title = $_POST['title'];
   $data['date']=  $date = $_POST['date'];
   $data['time']=  $time =  $_POST['time'];
   $data['priority']=  $priority = $_POST['priority'];

    if (isset($_POST['notification'])) {
        $data['notification']=  $notification =  $_POST['notification'];
    } else {
        $data['notification']=  $notification =  0;
    }
    $data['category']=  $categoryid = $_POST['category'];


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
}
?>