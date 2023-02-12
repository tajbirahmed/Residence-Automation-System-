<!doctype html>
<html lang="en">
    <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
            <title>BUILDING NAME</title>
    </head>
  <body>
   

<?php
    include_once('../connect.php');
    if (isset($_GET['showHolding'])) {
        $hld = $_GET['showHolding']; 
        $sql = "select * from building where holdingNumber=$hld";
        $result = mysqli_query($con, $sql); 
       
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['buildingName']; 
            $hld = $row['holdingNumber']; 
            $img = $row['image']; 
            echo '<div class="building-info">
                        <h1 class="building-name">'.$name.'</h1>
                        <p class="holding-number">Holding Number: '.$hld.'</p>

                </div>';
             
        }
    }
        
        ?>
         <div class="container my-5">
              <table class="table">
                    <thead>
                        <tr>  
                            <th colspan="4" style="text-align:center">Apartments</th>
                        </tr>
                        <tr>
                            <th scope="col">Apartment ID</th>
                            <th scope="col">Size </th>
                            <th scope="col">Rent per Month</th>
                            <th scope="col">Availability</th>
                            <th scope="col">Rent Collection Date</th>
                            <th scope="col">Rent Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                     <tbody>
        <?php
            $sql = "select * from apartment where holdingNumber=$hld";
            $result = mysqli_query($con, $sql); 
       
            while ($row = mysqli_fetch_assoc($result)) {
                $aid = $row['ApartmentID']; 
                $rpdn = $row['rentpermonth']; 
                $size = $row['size']; 
                $avl=$row['availability'] ? "YES" : "NO";
                
                echo '  <tr>
                <td>'.$aid.'</td>
                <td>'.$size.'</td>
                <td>'.$rpdn.'</td>
                <td>'.$avl.'</td>
                </tr>';
                
                }
        ?>
                </tbody>
            </table>
        </div>


    
        </body>
</html>