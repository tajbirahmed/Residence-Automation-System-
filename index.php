<?php

    include_once('connect.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>RAS</title>
    </head>
    <body>

        <div class="container my-5">
            <table class="table">
                <thead>


                </thead>
                <?php
                session_start();

                    if (isset($_SESSION['type'])) {
                        if ($_SESSION['type'] == 'admin') {
                            $type = 'admin';
                        } 
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



                    $sql = "select * from building"; 

                    $result = mysqli_query($con, $sql); 
                    $col = 1;

                    while ($row = mysqli_fetch_assoc($result)) {

                        if ($col == 1) {
                            echo '<tbody><tr>';
                        }
                        echo '<td>
                                <a href="displayApartment.php?id='.$row['holdingNumber'].'" class="text-light">
                                    <div class="card" style="width: 12rem;">
                                    <img class="card-img-top" src="images.jpg" alt="Card image cap">
                                        <div class="card-body text-dark">
                                        '.$row['holdingNumber'].' <br>
                                        '.$row['buildingName'].' <br>
                                        </div>
                                    </div>
                                </a>';
                        if (isset($type)) {
                            $hld = $row['holdingNumber']; 
                            if ($type == 'admin' || ($type == 'owner' && isset($holding[$hld]))) {
                                echo '<button class="btn btn-primary">Update</button>
                                        <button class="btn btn-danger">Delete</button>';
                            }
                        }
                        echo '</td>';

                        $col++;
                        if ($col == 5) {
                            echo '</tr></tbody>';
                            $col = 1;
                        }
                    }
                    if ($col > 1 && $col < 5) {
                        echo '</tr></tbody>';
                    }
                    
                ?>

            </table>
            </div>
    </body>
</html>
