<?php
include("db-connection.php");
//table creation and insert data into table

$ID = $PostTitle = $PostDescription;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //get data from user input
    $ID = $_POST['id'];
    $PostTitle = $_POST['name'];
    $PostDescription = $_POST['desc'];

    try {

        //create table query
        $tableSql = "CREATE TABLE IF NOT EXISTS User_Input (
            ID INT(6) PRIMARY KEY,
            PostTitle VARCHAR(30) NOT NULL,
            PostDescription VARCHAR(200) NOT NULL
        )";

        //insert post data into table
        $tableValue = "INSERT INTO User_Input (ID, PostTitle, PostDescription)
        VALUES ($ID, '$PostTitle', '$PostDescription')";

        $conn->exec($tableSql);
        if($conn->exec($tableValue) == true){
            header('Location: view.php');
        } else {
            echo "Data not insert into table!!!";
        }
        $conn->exec($tableValue);
        

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="form.css">
    <title>Post Form</title>
</head>

<body>
    <div class="form">
        <div class="title">Sigma InfoSolution LTD</div>
        <div class="subtitle">Employee Review Form</div>
        <div class="input-container ic1">
            <form action="" method="post">
                <input type="number" name="id" id="id" placeholder="Enter your employee ID" />
                <div class="cut"></div>
        </div>
        <div class="input-container ic1">
            <input type="text" name="name" id="name" placeholder="Enter your Name">
            <div class="cut"></div>
        </div>
        <div class="input-container ic2">
            <textarea name="desc" id="desc" cols="25" rows="5">Comment</textarea>
            <div class="cut cut-short"></div>
        </div>
        <button type="submit" name="submit" value="submit" class="submit">Submit</button>
        </form>
    </div>

</body>

</html>