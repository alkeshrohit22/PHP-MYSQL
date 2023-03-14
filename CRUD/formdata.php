<?php
include "db-connection.php";
//table creation and insert data into table

$PrimaryFlag = true;

$IdError = $PostTittleError = $PostDescriptionError = '';

$ID = $PostTitle = $PostDescription = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get data from user input
    $ID = $_POST['id'];
    $PostTitle = $_POST['name'];
    $PostDescription = $_POST['desc'];

    try {

        //create table query
        $tableSql = "CREATE TABLE IF NOT EXISTS User_Input (
            ID INT(20) PRIMARY KEY,
            PostTitle VARCHAR(500) NOT NULL,
            PostDescription VARCHAR(10000) NOT NULL
            )";
        $conn->exec($tableSql);

        $dbid = $conn->query('SELECT ID FROM User_Input')->fetchAll(PDO::FETCH_COLUMN);
        foreach ($dbid as $v) {
            if ($v == $ID) {
                http_response_code(409); // Conflict
                echo json_encode(array("message" => "Duplicate primary key value."));
                exit;
            }
        }

        // insert post data into table
        $tableValue = "INSERT INTO User_Input (ID, PostTitle, PostDescription)
            VALUES ($ID, '$PostTitle', '$PostDescription')";

        if ($conn->exec($tableValue) == true) {
            echo json_encode(array("success"=>true,"message" => "saved sucssesfully."));
            exit;
        } else {
            echo "Data not insert into table!!!";
        }

    } catch (PDOException $e) {
        echo 'Error ' . $e->getMessage();
    }

}

?>