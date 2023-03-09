<?php 
include "db-connection.php";

if (isset($_GET['id'])) {

    //getting data from id
    $ID = $_GET['id'];
    $ID = (int)$ID;

    
    //delete query
    $sql = "DELETE FROM User_Input WHERE ID=$ID";

    if($conn->exec($sql) == true){
        header('Location: view.php');
    } else {
        echo "Record not successfully deleted!!!";
    }
} 

?>

