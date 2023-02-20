<?php
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    session_start();
    include_once('connect.php');
    include_once('functions.php');
?>

<!doctype html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Residence Automation System</title>
    </head>
    <body>
        <?php 
            require 'home/_nav.php';
        ?>
        <div class="container my-5">
            <table class="table">
                <thead>


                </thead>
                <tbody>
                    <?php
                    
                        // A redundant section 
                        // Basically used for showing UPDATE and DELETE 
                        // button in index page
                        // !!?? 
                        if (isset($_SESSION['type'])) {
                            if ($_SESSION['type'] == 'admin') {
                                $type = 'admin';
                            } 
                            if ($_SESSION['type'] == 'owner') {
                                $type = 'owner'; 
                                if (isset($_SESSION['email'])){
                                    $email = $_SESSION['email']; 
                                    
                                    // For showing button to specific user in home page
                                    // For updation and deletion of a specific building!?
                                    $sql = "select * from own where email='$email'"; 
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

                        
                        
                        // showing building in index page
                        // to specific user
                        $sql = "select * from building"; 
                        $result = mysqli_query($con, $sql); 
                        $col = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img = $row['image'];
                            if ($col == 1) {
                                echo '<tr>';
                            }
                            echo '<td>
                                    <a href="displayApartment.php?id='.$row['holdingNumber'].'" class="text-light">
                                        <div class="card" style="width: 12rem;">
                                        <img class="card-img-top" src="images/'.$img.'" alt="Card image cap" style="width: 190px; height: 150px;">
                                            <div class="card-body text-dark">
                                            '.$row['holdingNumber'].' <br>
                                            '.$row['buildingName'].' <br>
                                            </div>
                                        </div>
                                    </a>';
                            
                            echo '</td>';
                            $col++;
                            if ($col == 5) {
                                echo '</tr>';
                                $col = 1;
                            }
                        }
                        if ($col > 1 && $col < 5) {
                            echo '</tr>';
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </body>
</html>
