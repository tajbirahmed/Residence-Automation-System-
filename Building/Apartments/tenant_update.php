<?php 
    include_once('../../connect.php'); 
    if (isset($_GET['aid']) && isset($_GET['hld'])) {
        $aid = $_GET['aid']; 
        $hld = $_GET['hld'];
        // echo 'Success';
        if (isset($_POST['fname']) && 
            isset($_POST['lname']) && 
            isset($_POST['phone']) && 
            isset($_POST['email']) && 
            isset($_POST['NID'])) { 

            $fname = $_POST['fname']; 
            $lname = $_POST['lname']; 
            $phone = $_POST['phone']; 
            $email = $_POST['email']; 
            $nid = $_POST['NID']; 
            $fdesc = $_POST['fdesc']; 
             
            if (!empty($fname) && !empty($lname) && !empty($phone) && !empty($email) && !empty($nid) && !empty($fdesc)) {
                $sql = "INSERT INTO `tenant` 
                    (`holdingNumber`, `apartmentid`, `first_name`, `last_name`, `phone`, `email`, `image`, `nid`, `fdesc`) 
                    VALUES ('$hld', '$aid', '$fname', '$lname', '$phone', '$email', '', '$nid', '$fdesc')";
                mysqli_query($con, $sql); 
                $username = $hld.$aid.'@ras.com';
                $sql = "insert into `user` (`username`, `password`, `type`) 
                                     values('$username', '$nid', 'tenant')"; 
                mysqli_query($con, $sql);
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> 
            <title>TENANT</title>
        </head>
        <body>
            <div class="container my-5">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <input name = "fname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first name">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input name = "lname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter last name">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input name = "phone" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input name = "email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NID</label>
                        <input name = "NID" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter NID">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Family Description</label>
                        <input name = "fdesc" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter small description of family">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input name = "" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image">
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </body>
</html>