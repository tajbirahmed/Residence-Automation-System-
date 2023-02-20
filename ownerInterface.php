<?php
    // It is the page where an owner redirected to 
    // after successfully logged in 
    // and here is a list of that owner owned 
    // buildings along with a important button Add building
    // with which an owner can add any number of buildings he want.
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    session_start(); 
    include_once('connect.php'); 
    include_once('functions.php'); 
    require_once('home/_nav_from_ownerinterface.php');
    if (isset($_SESSION['type'])) {
         
        if ($_SESSION['type'] == 'owner') {
            $type = 'owner'; 
            
            if (isset($_SESSION['email'])){
                
                $email = $_SESSION['email']; 
                $sql = "select * from own where email='$email' and holdingNumber<>0"; 

                $result = mysqli_query($con, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                     
                    if (mysqli_num_rows($result) > 1)  {
                        echo '<h1 style="text-align: center;"> Your Enlisted Buildings are</h1>';
                    } else {
                        echo '<h1 style="text-align: center;"> Your Enlisted Building is </h1>';
                    }

                    echo '<div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Building Name</th>
                                    <th scope="col">Holding Number</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        $hld = $row['holdingNumber'];
                        $sql1 = "SELECT * from building where holdingNumber=$hld limit 1"; 
                        $result1 = mysqli_query($con, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $image = $row1['image']; 
                        $update='update';
                        $delete='delete';
                        echo '<tr>
                                <td>'.$row1['buildingName'].'</td>
                                <td>'.$hld.'</td>
                                <td><img src="images/'.$image.'" style="width: 150px;"></td>
                                <td>
                                    <a href="owner/showbuildinginfo.php?showHolding='.$hld.'"><button class="btn btn-primary">View</button></a>
                                    <a href="Building/modify_building.php?id='.$hld.'&action='.$update.'"><button class="btn btn-success">Update</button></a>
                                    <a href="Building/modify_building.php?id='.$hld.'&action='.$delete.'"><button class="btn btn-danger">Delete</button></a>
                                </td>
                                ';
                    }            



                    echo '</tbody>
                        </table></div>';    

                    

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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Building</title>
    </head>
    <body>
        <div class="container my-5">
            <a href="Building/addbuilding.php?id=<?php echo $email; ?>"><button>Add New Building</button>
        </div>
    </body>
