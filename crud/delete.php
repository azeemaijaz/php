<?php
require_once("classes/Crud.php");

$crud = new Crud();
$pid = $crud->escape_string($_GET['pid']);

$query = "select post_img from post where post_id = $pid";
$result = $crud->getData($query);
foreach ($result as $key => $row) {
    $post_img = $row['post_img'];
}
//deleting the file from directory
if (file_exists("upload/" . $post_img)) {
    unlink("upload/" . $post_img);
}
//deleting the row from table
$result = $crud->delete($pid, 'post');


if ($result) {
    header("Location:index.php");
}
