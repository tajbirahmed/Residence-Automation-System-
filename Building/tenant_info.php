<?php 
include_once('../connect.php');
    if (isset($_GET['aid'])) {
        $aid = $_GET['aid']; 
      if (isset($_POST['delete'])) {

            $sql = "DELETE from `tenant` where ApartmentID='$aid'"; 
            $result = mysqli_query($con, $sql); 
            $sql = "DELETE from `user` where username=concat('$aid', '@ras.com')"; 
            $result = mysqli_query($con, $sql); 
            
            if ($result) {
                $sql = "UPDATE `apartment` 
                      set availability = 1
                      where ApartmentID='$aid'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                  $hld = explode('-', $aid); 
                   header('Location:../owner/showBuildinginfo.php?showHolding='.$hld[0].'');
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>TENEANT_INFO</title>
  </head>
  <body>
    <?php
    session_start();
    require_once('../home/_nav_from_show_building_info.php');
        include_once('../connect.php'); 
        if (isset($_GET['aid'])) {
            $aid = $_GET['aid'];
            // Detail of a specific apartement where it has a tenant

            $sql = "select * from tenant where  ApartmentID='$aid'";
            $result = mysqli_query($con, $sql); 
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $fname = $row['first_name']; 
                    $lname = $row['last_name']; 
                    $phone = $row['phone']; 
                    $email = $row['email']; 
                    $img = $row['image']; 
                    $nid = $row['nid'];
                    $nid_image = $row['nid_image'];
                } 
            }
        }
        
    ?>
    <div class="card" style="width: 18rem; ;margin: auto; width: 20%; padding: 10px;">
    <img class="card-img-top" src="../images/<?php  echo $img; ?>" style="height:300px;"alt="Slow internet">
    <img class="card-img-top" src="../images/<?php  echo $nid_image; ?>" alt="Slow internet">  
      <div class="card-body">
            <p style="font-size: 20px">Name: <?php echo $fname;  echo $lname; ?></p>
            <p style="font-size: 15px">Phone: <?php echo $phone ?></p>
            <p style="font-size: 15px">Email: <?php echo $email ?></p>
            <p style="font-size: 15px">NID: <?php echo $nid ?></p>

        </div>
    </div>
    <div class="container" style="text-align: center;">
        <form method="post">
            <button class="btn btn-danger" name="delete">Delete Tenant</button>
        </form>
    </div>
  </body>
</html>
