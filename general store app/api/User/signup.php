<?php
 
// get database connection
require_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Status: ' . 404);
    http_response_code(404);
}
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->username = isset($_POST['username']) ? (($_POST['username']!='') ? $_POST['username'] : die()): die();
$user->password = base64_encode(isset($_POST['password'])?(($_POST['password']!='')?$_POST['password'] : die()) : die());
$user->created = date('Y-m-d H:i:s');

// create the user

if($user->signup()){
    $user_arr=array(
        "Status" => 1,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "Status" => 2,
        "message" => "Username already exists!"
    );
}
http_response_code(200);
header('Status: ' . 200);

echo(json_encode($user_arr));
?>