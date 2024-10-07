<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['sid'], $data['sname'], $data['sage'], $data['scity'])) {
    echo json_encode(array('message' => 'All fields are required', 'status' => false));
    exit();
}

$id = $data['sid'];
$name = $data['sname']; 
$age = $data['sage'];
$city = $data['scity'];

include('config.php');


$name = mysqli_real_escape_string($connection, $name);
$city = mysqli_real_escape_string($connection, $city);


$sql = "UPDATE student SET name = '$name', age = $age, city = '$city' WHERE id = $id";

if(mysqli_query($connection, $sql)){
    echo json_encode(array('message' => 'Student updated successfully', 'status' => true));
} else {
    echo json_encode(array('message' => 'Error: '. mysqli_error($connection), 'status' => false));
}

mysqli_close($connection);

?>
