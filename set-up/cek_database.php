<?php

$host = $_POST['host'];
$database = $_POST['nama'];
$user = $_POST['user'];
$password = $_POST['password'];

try {
    $create = new PDO("mysql:host=$host", $user, $password);
    $create->exec("CREATE DATABASE `$database`;"
                    . "CREATE USER '$user'@'localhost' IDENTIFIED BY '$password';"
                    . "GRANT ALL ON `$database`.* TO '$user'@'localhost';"
                    . "FLUSH PRIVILEGES;") or die(print_r($create->errorInfo(), true));

    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    echo json_encode(array("status" => "success"));
} catch (PDOException $e) {
    echo json_encode(array('status' => 'error', 'pesan' => $e->getMessage()));
}
