<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Status: ' . 404);
    http_response_code(404);
}
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->username = isset($_POST['username']) ? (($_POST['username']!='') ? $_POST['username'] : die()): die();
$user->password = base64_encode(isset($_POST['password'])?(($_POST['password']!='')?$_POST['password'] : die()) : die());
// read the details of user to be edited

$stmt = $user->login();

if($stmt->num_rows > 0){
    // get retrieved row
    $row = $stmt->fetch_assoc();
    // create array
    $user_arr=array(
        "Status" => 1,
        "message" => "Successfully Login!",
        "id" => $row['cid'],
        "username" => $row['username']
    );

}
else{
    $user_arr=array(
        "Status" => 2,
        "message" => "Invalid Credentials",
    );

}
http_response_code(200);
header('Status: ' . 200);

// make it json format
echo(json_encode($user_arr));

?>