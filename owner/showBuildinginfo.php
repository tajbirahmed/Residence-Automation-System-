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
        session_start();
        require_once('../home/_nav_from_show_building_info.php');
        include_once('../connect.php');
        if (isset($_GET['success']) && $_GET['success'] = 1) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully Added.</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        
        if (isset($_GET['showHolding'])) {
            $hld = $_GET['showHolding']; 
            $sql = "select * from `building` where holdingNumber=$hld";
            $result = mysqli_query($con, $sql); 
        
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['buildingName']; 
                $hld = $row['holdingNumber']; 
                $img = $row['image']; 
                echo '<div class="building-info" style="text-align: center;">
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
            include_once('../functions.php');
            if (isset($hld)) {
                $sql = "select * from apartment where holdingNumber=$hld";
                $result = mysqli_query($con, $sql); 
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $aid = $row['ApartmentID']; 
                    $rpdn = $row['rentpermonth']; 
                    $size = $row['size']; 
                    
                    
                    $sql1 = "SELECT registerddate from tenant where ApartmentID='$aid' limit 1";
                    $result1 = mysqli_query($con, $sql1); 
                    if (mysqli_num_rows($result1)){
                        $row1 = mysqli_fetch_assoc($result1);
                        $rcd = date_create($row1['registerddate']);
                        date_add($rcd, date_interval_create_from_date_string("7 days"));
                    } else {
                        $rcd='empty';
                    }
                    $avl=$row['availability'] ? "Empty" : "Rented";
                    if ($avl == "Empty") 
                        $col = "red"; 
                    else 
                        $col = "green";
                    $rcd = show_date($rcd);
                    echo '  <tr>
                    <td style="text-align: center;font-weight: bold;">'.$aid.'</td>
                    <td style="text-align: center;">'.$size.'</td>
                    <td style="text-align: center; ">'.$rpdn.'</td>
                    <td style="text-align: center; color: '.$col.'; font-weight: bold; font-size: 19px">'.$avl.'</td>
                    <td style="text-align: center;"> '.$rcd.' </td>
                    <td style="text-align: center;"> </td>';
                    
                    echo '<td style="text-align: center;">';
                    echo '<a href="../Building/Apartments/view_apartment.php?aid='.$aid.'"><button class="btn btn-primary">View</button></a>  '; 
                    if (!$row['availability']){
                        echo '<a href="../Building/tenant_info.php?aid='.$aid.'"><button class="btn btn-success">Details</button></a>';
                    echo ' ';
                    echo '<a href="../payment/tenant_rent_history.php?aid='.$aid.'"><button class="btn btn-success">Rent History</button></a>';
                        
                    }
                    if ($row['availability'])
                        echo '<a href="../Building/Apartments/tenant_update.php?aid='.$aid.'&hld='.$hld.'"><button class="btn btn-primary">Add Tenant</button></a>';
                    echo ' ';
                        echo '<a href="../Building/Apartments/delete_apartment.php?hld='.$hld.'&aid='.$aid.'"><button class="btn btn-danger">Delete Apartment</button></a>
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
                <h3>Add Worker to Building</h3>
                    <a href="add_staff.php?hld=<?php echo $hld; ?>"><button class="btn btn-success">Add Worker</button></a>
                    <h3>Add Building expenditure</h3>
                    <a href="add_expanse.php?hld=<?php echo $hld; ?>"><button class="btn btn-primary">Add Expanse</button></a>

            </div>
        </body>
</html>
