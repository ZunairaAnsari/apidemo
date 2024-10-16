<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['sid'])) {
    echo json_encode(array('message' => 'Student ID not provided'));
    exit();
}

$student_id = $data['sid'];

include('config.php');

$sql = "SELECT * FROM student WHERE id = $student_id";
$result = mysqli_query($connection, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);
    } else {
        echo json_encode(array('message' => 'No student found'));
    }
} else {
    echo json_encode(array('message' => 'Query error: ' . mysqli_error($connection)));
}

mysqli_close($connection);

?>
