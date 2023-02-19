<?php
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
                        echo '<h1> Your Enlisted Buildings are</h1>';
                    } else {
                        echo '<h1> Your Enlisted Building is </h1>';
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hld = $row['holdingNumber'];
                        $holding[$hld] = 1; 
                        echo '<a href="owner/showBuildinginfo.php?showHolding='.$hld.'"><button class="btn btn-primary">'.showBuildingName($con, $hld).'</button>';
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
            <a href="Building/addbuilding.php?id=<?php echo $email; ?>"><button>Add New Building</button>
        </div>
    </body>
