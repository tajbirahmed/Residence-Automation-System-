<?php
session_start(); 
    include_once('connect.php'); 
    if (isset($_SESSION['type'])) {
         
        if ($_SESSION['type'] == 'owner') {
            
            $type = 'owner'; 
            
            if (isset($_SESSION['email'])){

                $email = $_SESSION['email']; 
                $sql = "select * from owner where email='$email'"; 

                $result = mysqli_query($con, $sql);

                if ($result) {
                     
                    if (mysqli_num_rows($result) > 1)  {
                        echo '<h1> Your Enlisted Buildings are</h1>';
                    } else {
                        echo '<h1> Your Enlisted Building is </h1>';
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hld = $row['holdingNumber'];
                        $holding[$hld] = 1; 
                        echo '<a href="owner/showBuildinginfo.php?showHolding='.$hld.'"><button class="btn btn-primary">'.$hld.'</button>';
                        echo '    ';
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Building</title>
    </head>
    <body>
        <div class="container my-5">
            <?php 
                 
            ?>
        </div>
    </body>
