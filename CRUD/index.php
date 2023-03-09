<?php 
include_once 'db-creation-for-login.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Login Form</title>
</head>

<body>
    <?php
$nameErr = $passErr = '';
$client_name = $client_password = '';
$flag1 = false;
$flag2 = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //username validation
    if (empty($_POST["name"])) {
        $nameErr = "username is required";
    }  else {
        $client_name = test_input($_POST["name"]);

        //check client username from database
        if($client_name == $_SESSION['db_username']){
            $flag1 = true;
        } else{
            $nameErr = "Wrong username!!!";
        }

    }

    //password validation
    if(empty($_POST["password"])){
        $passErr = "password is required";
    } else {
        $client_password = test_input($_POST["password"]);

        //check client password from database
        if($client_password == $_SESSION['db_password']){
            $flag2 = true;
        } else {
            $passErr = "Wrong password!!!";
        }
    }

    if($flag1 == true && $flag2 == true){
        echo "called ";
        header('Location: form.php');
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="login-header">
                    <h3>LOGIN</h3>
                    <p>Please enter your credentials to login.</p>
                </div>
            </div>
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <span class="error">* <?php echo $nameErr; ?></span>
                <input type="text" id="username" name="name" value="" placeholder="admin">

                <span class="error">* <?php echo $passErr; ?></span>
                <input type="password" id="password" name="password" value="" placeholder="admin">

                <button type="submit" value="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
