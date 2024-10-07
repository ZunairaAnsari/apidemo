<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET');

include('config.php');

$sql = 'SELECT * FROM student';

$result = mysqli_query($connection, $sql);
 
if(mysqli_num_rows($result) > 0){
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
}
else{
    echo json_encode(array('message' => 'No student found'));
}
?>