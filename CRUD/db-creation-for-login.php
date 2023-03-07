<?php
session_start();

$servername = "localhost";
$username = "admin";
$password = "admin";

$server_username = '';
$server_password = '';

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //creating database query
    $DBsql = 'CREATE DATABASE IF NOT EXISTS MyDatabase';
    $conn->exec($DBsql);

    $conn->query('use MyDatabase');

    //creating table query
    $Tabsql = "CREATE TABLE IF NOT EXISTS userlogin (
        username VARCHAR(25) PRIMARY KEY,
        userPassword VARCHAR(25)
        )";
    $conn->exec($Tabsql);

    $valsql = "INSERT IGNORE INTO userlogin (username, userPassword)
    VALUES ('admin', 'admin')";
    $conn->exec($valsql);

    $stmt = $conn->query("SELECT username, userPassword FROM userlogin");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $server_username = $row[0];
        $server_password = $row[1];
    }

    $_SESSION['db_username'] = $server_username;
    $_SESSION['db_password'] = $server_password;
    $conn = null;

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

?>