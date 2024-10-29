<?php

//ESMOND AGHARO 07035967785. 
//Not too strong in Laravel, thanks.

$host = 'localhost';
$dbname = 'interview';
$username = 'root'; 
$password = '';   

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}





?>