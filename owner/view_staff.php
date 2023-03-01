<?php
    include_once('../connect.php'); 
    if (isset($_GET['id'])) {
        $hld = $_GET['id']; 
        $sql = "SELECT * from staff where holdingNumber='$hld'";
        $result = mysqli_query($con, $sql); 
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

    <title>Staffs</title>
    </head>
    <body>
        <?php 
            require_once('../home/_nav_from_show_building_info.php');
            if (isset($_GET['staff_add']) && $_GET['staff_add'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Stuff is Successfully Added.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            if (isset($_GET['stuff_up']) && $_GET['stuff_up'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Stuff is Successfully Updated.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            if (isset($_GET['stuff_del']) && $_GET['stuff_del'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Stuff is Successfully Deleted.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        ?>
        <div class="container my-5" style="width: 50%;">
            <h3 style="text-align: center;">Information About Staffs</h3>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Joining Date</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $up = 'update'; 
                    $del = 'delete';
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        $name = $row['name']; 
                        $phone = $row['phone']; 
                        $image = $row['image']; 
                        $date = $row['joining_date']; 
                        $id = $row['staffid'];
                        echo '
                            <tr>
                                <td>'.$name.'</td>
                                <td>'.$phone.'</td>
                                <td>'.$date.'</td>
                                <td><img  src = "../images/'.$image.'" style="width: 100px;"></td>
                                <td> <a href="modify_staff.php?id='.$id.'&verdict='.$up.'"><button class = "btn btn-primary">Update</button></a> 
                                   <a href="modify_staff.php?id='.$id.'&verdict='.$del.'"><button class = "btn btn-danger">Delete</button></a></td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
            </table>
            <h3>Add Worker to Building</h3>
                    <a href="add_staff.php?hld=<?php echo $hld; ?>"><button class="btn btn-success">Add Worker</button></a>
        </div>
    </body>
</html>