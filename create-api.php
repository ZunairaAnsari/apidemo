<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);


if (!isset($data['sname'], $data['sage'], $data['scity'])) {
    echo json_encode(array('message' => 'All fields are required', 'status' => false));
    exit();
}

$name = $data['sname'];
$age = $data['sage'];
$city = $data['scity'];

include('config.php');

$sql = "INSERT INTO student (name, age, city) VALUES ('$name', '$age', '$city')";

if(mysqli_query($connection, $sql)){
    echo json_encode(array('message' => 'New student added successfully', 'status' => true));
} else {
    echo json_encode(array('message' => 'Error: '. mysqli_error($connection), 'status' => false));
}

mysqli_close($connection);

?>
