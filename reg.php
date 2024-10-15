<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <?php
    require('dbConnection.php');
    if (isset($_POST["addUser"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $user_phone = $_POST["user_phone"];
        $user_address = $_POST["user_address"];
        $password = $_POST["password"];
        $query = "INSERT INTO `user`( `user_name`, `user_mobile`, `user_email`, `user_address`, `user_password`) 
        VALUES ('$username','$user_phone','$email','$user_address','$password')";
        $result = $conn->query($query);
        if ($result) {
            echo '<div class="alert alert-success" role="alert">
            User added successfully
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            User not added
          </div>';
        }
    }

    ?>

    <div class="container">
    <h1>Register</h1>
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input type="text" class="form-control" id="username" placeholder="Enter Name" name="username">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">User Mobile</label>
                <input type="number" class="form-control" id="userMobile" placeholder="Enter phone number" name="user_phone">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">User Address</label>
                <input type="text" class="form-control" id="userAddress" placeholder="Enter your address" name="user_address">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
          <a href="./login.php">Already have an account?</a>
            <button type="submit" class="btn btn-primary" name="addUser">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>