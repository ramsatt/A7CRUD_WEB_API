<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
if($_POST){

// include database connection
include 'config/database.php';

try{

// insert query
$query = "INSERT INTO products SET p_name=:name, p_description=:description, p_price=:price";
// prepare query for execution
$stmt = $con->prepare($query);
// posted values
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
// bind the parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':price', $price);
// Execute the query
if($stmt->execute()){
    echo json_encode(array('result'=>'success'));
}else{
    echo json_encode(array('result'=>'fail'));
}
}
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}
}
?>
