<?php
error_reporting(0);
require_once("classes/Crud.php");
$crud = new Crud();
$type = $crud->escape_string(sanitize_input($_POST['type']));
$id = $crud->escape_string(sanitize_input($_POST['id']));
if ($type == 'student') {
    $query = "select * from student WHERE sid = {$id}";
    $data = $crud->getData($query);
}
if ($type == 'book') {
    $query = "select * from book WHERE bid = {$id}";
    $data = $crud->getData($query);
}
if ($type == 'rent') {
    $query = "select * from rent WHERE rid = {$id}";
    // $query = "SELECT rent.rid,rent.startdate,rent.enddate,student.sname,book.bname FROM rent
    // LEFT JOIN student ON student.sid = rent.sid
    // LEFT JOIN book ON book.bid = rent.bid WHERE rid = {$id}";
    $data = $crud->getData($query);
}
// $data['bid'] = $_POST['id'];

// print_r($data);
echo json_encode($data[0]);
