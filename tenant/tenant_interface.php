<?php
    include_once('../connect.php'); 
    if (isset($_GET['id'])) {
        $userid = $_GET['id']; 
        // Checking if Apartment exists in 
        $sql = "SELECT * from apartment where concat(ApartmentID, '@ras.com')='$userid' limit 1";
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        $sql1 = "SELECT * from tenant where concat(ApartmentID, '@ras.com')='$userid' limit 1";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($result1); 
    }
    // MORE 
?>

<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>TENANT VIEW</title>
    </head>
    <body>
        <?php session_start(); require_once('../home/_nav_from_show_building_info.php');?>
        <div class="container">
            <table class="table">
                <h1> Info about your apartment.</h1>
                <thead>
                    <tr>
                    <th scope="col">Holding Number of Building</th>
                    <th scope="col">Apartment ID</th>
                    <th scope="col">Date You Arrived.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td><?php $temp = $row['holdingNumber']; echo $temp; ?></td>
                        
                        <td><?php $temp = $row['ApartmentID']; echo $temp; ?></td>
                        
                        <td><?php $temp = $row1['registerddate']; echo $temp; ?></td>
                    </tr>
                </tbody>
            </table>
        </div><div class="container my-5">
        
        </div>
    </body>
</html>
