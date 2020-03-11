<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/vendor.php';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Status: ' . 404);
    http_response_code(404);
}
header("Content-type:application/json");

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$vendor = new Vendor($db);
// set ID property of user to be edited
$vendor->mobile = isset($_POST['mobile']) ? (($_POST['mobile']!='') ? $_POST['mobile'] : die()): die();
$vendor->password = base64_encode(isset($_POST['password'])?(($_POST['password']!='')?$_POST['password'] : die()) : die());
// read the details of user to be edited

$stmt = $vendor->login();

if($stmt->num_rows > 0){
    // get retrieved row
    $row = $stmt->fetch_assoc();
    // create array
    $vendor_arr=array(
        "Status" => 1,
        "message" => "Successfully Login!",
        "id" => $row['vendor_id'],
        "mobile" => $row['mobile']
    );

}
else{
    $vendor_arr=array(
        "status" => 2,
        "message" => "Invalid Credentials",
    );

}
http_response_code(200);
header('Status: ' . 200);
// make it json format
echo(json_encode($vendor_arr));


?>