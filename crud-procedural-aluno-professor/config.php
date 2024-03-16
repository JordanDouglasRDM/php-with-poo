<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'php_2bim';
session_start();
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;", $username, $password);
} catch (\PDOException $e) {
    echo "
        <alert class='alert alert-warning d-block'>
            {$e->getMessage()}
        </alert>
    ";
}