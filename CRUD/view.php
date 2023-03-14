<?php
include 'db-connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body style="background-image: linear-gradient(45deg,#328f8a,#08ac4b);">
    <div class="container">
        <h1 style="color:black; font-size:100px;">Main View Page</h1>
        <h2>User Input<a class="btn btn-success" style="margin-left:735px" href="form.html">ADD Value</a></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
            <?php
$stmt = $conn->query("SELECT * FROM User_Input");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><a class="btn btn-info" id="update" onclick="moveToUpdate(<?php echo $row[0] ?>)">Edit</a>&nbsp;<a
                            class="btn btn-danger" id="delete" onclick="moveToDelete(<?php echo $row[0] ?>)" >Delete</a></td>

                </tr>
            <?php
}
?>
            </tbody>

        </table>

    </div>

    <script>

        function moveToDelete(id){
            if(confirm("Sure You Want to delete?")){
                console.log(id);
                window.location.href = "delete.php?id="+id;
            }
        }

        function moveToUpdate(value){
            if(confirm("Sure You Want to Update?")){
                console.log(value);
                window.location.href = "update.php?id="+value;
            }
        }

    </script>
</body>

</html>