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

<h2>User Update Form</h2>
<form action="" method="post">
    <label for="id">ID</label>
    <input type="number" name="id" id="id" placeholder="Enter your employee ID" value="<?php echo $fetch_id; ?>"><br>

    <label for="name">Name</label>
    <input type="text" name="name" id="name" placeholder="Enter your Name" value="<?php echo $fetch_tit; ?>"><br>

    <label for="desc">Comment</label>
    <textarea name="desc" id="desc" cols="30" rows="10"><?php echo $fetch_desc; ?></textarea><br><br>

    <input type="submit" value="Update" name="Update">
</form>

</body>

</html>
