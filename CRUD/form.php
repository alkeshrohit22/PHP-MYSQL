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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Post Form</title>
</head>

<body>
    <div class="form">
        <div class="title">Sigma InfoSolution LTD</div>
        <div class="subtitle">Employee Review Form</div>
        <div class="input-container ic1">
            <form action="" method="post" id="frm">
                <input type="number" name="id" id="id" placeholder="Enter your employee ID" required />
                <div class="cut"></div>
        </div>
        <div class="input-container ic1">
            <input type="text" name="name" id="name" placeholder="Enter your Name" required>
            <div class="cut"></div>
        </div>
        <div class="input-container ic2">
            <textarea name="desc" id="desc" cols="25" rows="5" placeholder="comment" required></textarea>
            <div class="cut cut-short"></div>
        </div>
        <button type="submit" name="submit" value="submit" class="submit">Submit</button>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $("#frm").on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "form.php",
                type: "POST",
                data: {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    desc: $('#desc').val()
                },
                dataType: 'json',
                success: function(response) {
                    // Handle successful submission
                    if(response.success == true){
                        window.location.href = "view.php";
                    }
                    alert(response.message);
                },
                statusCode: {
                    409: function(response) {
                        // Handle primary key violation
                        alert(response.responseJSON.message);
                    }
                }
            });
        });
    });
    </script>
</body>

</html>
