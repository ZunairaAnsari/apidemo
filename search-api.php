<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include('config.php');

// Get the input data
$data = json_decode(file_get_contents("php://input"), true);

// Check if search term is provided
if (!isset($data['search']) || empty(trim($data['search']))) {
    echo json_encode(array('message' => 'Missing search term'));
    exit();
}

$search = $data['search'];

// Correct SQL query to match any part of the name
$sql = "SELECT * FROM student WHERE name LIKE '%$search%'";

$result = mysqli_query($connection, $sql) or die("Couldn't connect to database");

// Check if there are results
if(mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'No search results found'));
}

mysqli_close($connection);

?>
