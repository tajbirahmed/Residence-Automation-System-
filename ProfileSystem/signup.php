<?php
    include_once('../connect.php'); 
    require_once('../home/nav_from_signup.php');
    if (isset($_POST['signup'])) {
        if (isset($_POST['fname']) && isset($_POST['lname'] ) && 
        isset($_POST['phnno']) && isset($_POST['email']) && 
        isset($_POST['password']) && isset($_POST['cpassword'])) {
            if (!empty($_POST['fname']) && !empty($_POST['lname'] ) && 
            !empty($_POST['phnno']) && !empty($_POST['email']) && 
            !empty($_POST['password']) && !empty($_POST['cpassword'])){
                if ($_POST['password'] === $_POST['cpassword']) {
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname']; 
                    $email = $_POST['email']; 
                    $phn = $_POST['phnno']; 
                    $password = $_POST['password'];
                    
                    $sql = "INSERT INTO `owner` (`first_name`, `last_name`, `phone`, `email`) VALUES ('$fname', '$lname', '$phn', '$email')";
                    mysqli_query($con, $sql);

                    $sql = "INSERT INTO `user` (`username`, `password`, `type`) VALUES ('$email', '$password', 'owner')";
                    mysqli_query($con, $sql);

                    header('Location:login.php'); 
                } else {
                    // pass not same;
                }
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Sign In</title>
    </head>
    <body>
        <div class="container my-5" style = "width: 600px">
        <p style="font-size: 25px; text-align: center;">Sign Up as an owner</p> 
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text"  name = "fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text"  name = "lname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text"  name = "phnno" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Enter Phone No.">
            </div>
        
            <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" name ="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Image</label> <br>
                <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" id="fileToUpload">
            </div>
            
            <button type="submit" class="btn btn-primary" name="signup">Sign Up</button> 
        </form>
        </div>
    </body>
</html>