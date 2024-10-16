<?php

try {
    $db_name = "mysql:host=localhost;dbname=exporting-data-excel";
    $db_user = "zunaira";
    $db_pass = "zunaira";

    $con = new PDO($db_name, $db_user, $db_pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $con->prepare('SELECT * FROM customers');
    $sql->execute();

    $error = $sql->errorInfo();

    if ($error[0] !== '00000') {
        header('Content-Type: application/json');
        echo json_encode(['error' => $error[2]], JSON_PRETTY_PRINT);
        exit();
    }

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'No records found.'], JSON_PRETTY_PRINT);
        exit();
    }
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()], JSON_PRETTY_PRINT);
    exit();
}
