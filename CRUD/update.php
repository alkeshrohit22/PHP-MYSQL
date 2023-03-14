<?php
include "db-connection.php";

if (isset($_POST['Update'])) {

    $upd_id = $_POST['id'];
    $id = (int)$upd_id;
    var_dump($upd_id);

    $upd_title = $_POST['name'];
    $upd_desc = $_POST['desc'];

    $sql = "UPDATE User_Input SET PostTitle = '$upd_title', PostDescription = '$upd_desc', ID = $id WHERE ID = $id";
    
    //prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    if($stmt->execute() == true){
        header('Location: view.php');
    } else {
        echo $stmt->rowCount() . " records UPDATED successfully";
    }
}

if (isset($_GET['id'])) {

    $ID = $_GET['id'];

    $stmt = $conn->query("SELECT * FROM User_Input WHERE ID=$ID");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $fetch_id = $row[0];
        $fetch_tit = $row[1];
        $fetch_desc = $row[2];
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
            <form action="update.php" method="post">
                <input type="number" name="id" id="id" value="<?php echo $fetch_id; ?>" placeholder="Enter your employee ID" />
                <div class="cut"></div>
        </div>
        <div class="input-container ic1">
            <input type="text" name="name" id="name" value="<?php echo $fetch_tit; ?>" placeholder="Enter your Name">
            <div class="cut"></div>
        </div>
        <div class="input-container ic2">
            <textarea name="desc" id="desc" cols="25" rows="5"><?php echo $fetch_desc; ?></textarea>
            <div class="cut cut-short"></div>
        </div>
        <button type="submit" name="Update" value="Update" class="submit">Submit</button>
        </form>
    </div>

</body>

</html>
