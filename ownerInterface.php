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

                    while ($row = mysqli_fetch_assoc($result)) {
                        $hld = $row['holdingNumber'];
                        $holding[$hld] = 1;
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
                if (count($holding) > 1) {
                    echo '<div style="float: left">
                            <button class="btn btn-success">Previous</button>
                          </div>';
                    echo '<div style="float: right">
                            <button class="btn btn-success">Next</button>
                          </div>';
                } else {
                    echo '<div class="container my-5" style=    "display: block;
                                                                margin-left: auto;
                                                                margin-right: auto;
                                                                width: 40%;">
                          <img src="images.jpg" alt="slow connection" width="150px"><br>
                          <div class="container mx-3" "display: block;
                                margin-left: auto;
                                margin-right: auto;
                                width: 40%;"> <p style="font-size:25px; margin: auto;">'.$hld.'</p><br>
                          </div>
                          </div>'; 
                }

            ?>
            <table class="table"> 
                <thead>

                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </body>
