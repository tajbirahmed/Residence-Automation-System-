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
    require_once('../home/_nav_from_show_building_info.php');
    include_once('../connect.php');
    
    if (isset($_GET['showHolding'])) {
        $hld = $_GET['showHolding']; 
        $sql = "select * from `building` where holdingNumber=$hld";
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
                            <th colspan="7" style="text-align:center; font-size: 30px">Apartments</th>
                        </tr>
                        <tr>
                            <th scope="col" style="text-align: center">Apartment ID</th>
                            <th scope="col" style="text-align: center">Size </th>
                            <th scope="col" style="text-align: center">Rent per Month</th>
                            <th scope="col" style="text-align: center">Status</th>
                            <th scope="col" style="text-align: center">Rent Collection Date</th>
                            <th scope="col" style="text-align: center">Rent Status</th>
                            <th scope="col" style="text-align: center">Action</th>
                            
                        </tr>
                    </thead>
                     <tbody>
        <?php
            include_once('../connect.php');
            if (isset($hld)) {
                $sql = "select * from apartment where holdingNumber=$hld";
                $result = mysqli_query($con, $sql); 
        
                while ($row = mysqli_fetch_assoc($result)) {
                    $aid = $row['ApartmentID']; 
                    $rpdn = $row['rentpermonth']; 
                    $size = $row['size']; 
                    $avl=$row['availability'] ? "Empty" : "Rented";
                    if ($avl == "Empty") 
                        $col = "red"; 
                    else 
                        $col = "green";
                    
                    echo '  <tr>
                    <td style="text-align: center;font-weight: bold;">'.$aid.'</td>
                    <td style="text-align: center;">'.$size.'</td>
                    <td style="text-align: center; ">'.$rpdn.'</td>
                    <td style="text-align: center; color: '.$col.'; font-weight: bold; font-size: 19px">'.$avl.'</td>
                    <td style="text-align: center;"> </td>
                    <td style="text-align: center;"> </td>';
                    
                    echo '<td style="text-align: center;">'; 
                    if (!$row['availability'])
                        echo '<a href="../Building/tenant_info.php?aid='.$aid.'"><button class="btn btn-success">Details</button></a>';
                    echo ' ';
                    if ($row['availability'])
                        echo '<a href="../Building/Apartments/tenant_update.php?aid='.$aid.'&hld='.$hld.'"><button class="btn btn-primary">Add Tenant</button></a>';
                    echo ' ';
                        echo '<button class="btn btn-danger">Delete Apartment</button>
                    </td>
                    </tr>';
                    
                    }
                }
        ?>
                </tbody>
            </table>
            </div>
            <div class="container">
                <form method="post" action="../Building/Apartments/addapartment.php?id=<?php echo $hld ?>">
                    <h3>Add Apartment to Building</h3>
                    <button class="btn btn-success">Add Apartment</button>
                    
                </form>
            </div>
        </body>
</html>
