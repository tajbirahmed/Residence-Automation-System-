<?php
    session_start(); 
    include_once('../connect.php');
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];   
        if (isset($_GET['hld'])) {
            
            
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

    <title>View Expanse</title>
    </head>
    <body>
    <?php 
        require_once('../home/_nav_from_show_building_info.php'); 
        if (isset($_GET['id']) && $_GET['id'] == 1) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Expense Added Successful</strong>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }    
    ?>    
    <div class="container my-4" style="text-align:center; width: 20%;">
            <form method="post" action="expense_statement.php">
            
            <div class="form-group">
                <label for="exampleInputEmail1">Select Month</label>
                <input type="month" required name="date" value="<?php echo date('Y-m'); ?>" class="form-control">
            </div>
            
            <div class="form-group">
                <select class="form-control" name="holding">
                    <option value="none" selected disabled hidden>Select Building</option> 
                    <?php 
                        $sql = "SELECT * from building NATURAL JOIN own where email='$email'"; 
                        $result = mysqli_query($con, $sql);
                        if ($result){
                            while ($row = mysqli_fetch_assoc($result)) {
                                $bname = $row['buildingName']; 
                                $holding = $row['holdingNumber'];
                                echo '<option value="'.$holding.'">'.$bname.'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
                             
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </body>
</html>