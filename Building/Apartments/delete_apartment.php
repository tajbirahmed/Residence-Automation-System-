<?php
include_once('../../connect.php');
session_start(); 
    if (isset($_GET['hld']) && isset($_GET['aid'])) {
        $hld = $_GET['hld']; $aid = $_GET['aid']; 
        if (!empty($aid) && !empty($hld)) {
            // $alert = false; 
            $sql = "SELECT buildingName from `building` where holdingNumber=$hld limit 1";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $bname = $row['buildingName']; 
            
            if (isset($_POST['delete'])) {
                $alert = false;
                if (isset($_POST['password'])) {
                    $password = $_POST['password']; 
                    if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        $sql = "SELECT password from `user` where username='$email' limit 1";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($result); 
                        if ($password == $row['password']) {
                            

                            $sql = "DELETE `apartment` where ApartmentID='$aid'"; 
                            $result = mysqli_query($con, $sql);

                            if ($result) {
                                header('Location:../../owner/showBuildinginfo.php?showHolding='.$hld.'');
                            } else {
                                // deletion unsuccessful
                            }
                        } else {

                            header('Location: delete_apartment.php?hld='.$hld.'&aid='.$aid.'');
                        }
                    }
                    
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Delete Building</title>
    </head>
    <body>
        <?php 
            require_once('../../home/_nav_from_aparmtent_view.php');
        ?>
        <div class="container my-5">
        <form method="post">
        <div class="form-group">
            <label>Building Name</label>
            <input type="text" value="<?php echo $bname; ?>" readonly name="bname" class="form-control">
        </div>

        <div class="form-group">
            <label>Holding Number</label>
            <input type="text" value="<?php echo $hld; ?>" readonly name="bname" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Apartment ID</label>
            <input type="text" name="aid" value="<?php echo $aid; ?>" readonly class="form-control">
        </div>
        
        <div class="form-group">
            <label>Enter Your Password to Confirm Delete</label>
             <input type="password" name = "password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" name="delete" class="btn btn-danger">Confirm Delete</button>
    </form>
        </div>
    </body>
</html>
