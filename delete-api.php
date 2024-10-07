<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

$student_id = $data['sid'];

if (!isset($data['sid'])) {
    echo json_encode(array('message' => 'Student ID not provided'));
    exit();
}

include('config.php');

// Use double quotes to embed the variable correctly
$sql = "DELETE FROM student WHERE id = $student_id";

if (mysqli_query($connection, $sql)) {
    echo json_encode(array('message' => 'Student deleted successfully'));
} else {
    echo json_encode(array('message' => 'No student found'));
}

mysqli_close($connection);

?>
