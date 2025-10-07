<?php
$host = 'localhost';    // nama host MySQL
$dbname = 'todo_app';   // nama database
$user = 'root';         // user MySQL kamu
$pass = '';             // password MySQL kamu

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
