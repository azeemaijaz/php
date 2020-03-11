<?php
 
// get database connection
require_once '../config/database.php';
 
// instantiate vendor object
include_once '../objects/vendor.php';
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Status: ' . 404);
    http_response_code(404);
}
$database = new Database();
$db = $database->getConnection();
 
$vendor = new Vendor($db);
 
$vendor->mobile = isset($_POST['mobile']) ? (($_POST['mobile']!='') ? $_POST['mobile'] : die()): die();
$vendor->password = base64_encode(isset($_POST['password'])?(($_POST['password']!='')?$_POST['password'] : die()) : die());
$vendor->created = date('Y-m-d H:i:s');

// create the vendor

if($vendor->signup()){
    $vendor_arr=array(
        "Status" => 1,
        "message" => "Successfully Signup!",
        "id" => $vendor->id,
        "mobile" => $vendor->mobile
    );
}
else{
    $vendor_arr=array(
        "Status" => 2,
        "message" => "mobile already exists!"
    );
}
http_response_code(200);
header('Status: ' . 200);
echo(json_encode($vendor_arr));
?>