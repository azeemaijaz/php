<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/products.php';
header("Content-Type:application/json");
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    header('Status: ' . 404);
    http_response_code(404);
    die();
}
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare products object
$products = new Products($db);

$stmt = $products->list();
if($stmt->num_rows > 0){
    $products_arr['Status']=1;
    while($row = $stmt->fetch_assoc()){
        $products_arr["Items"][]=array("Title"=> $row['product_name'],
                                        "Description"=> 'A product from '.$row['brand_name'],
                                        "Price"=> $row['price']);
    }
  echo json_encode($products_arr);
    http_response_code(200);
    header('Status: ' . 200);

}
else{
    $products_arr=array(
        "Status" => 2,
        "message" => "No record found!",
    );
    http_response_code(204);
    echo json_encode($products_arr);

}
?>