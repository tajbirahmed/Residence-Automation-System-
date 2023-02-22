<?php 
    session_start(); 
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        if (!empty($email)) {
            $temp_aid = explode('@', $email); 
            $aid = $temp_aid[0];
        }
    }
    if (isset($_POST['submit'])) {
        if (isset($_POST['rent_month']) && isset($_POST['p_date']) && isset($_POST['medium']) && isset($_POST['tid'])) {
            
            $month = $_POST['rent_month'];  
            $p_date = $_POST['p_date']; 
            $medium = $_POST['medium']; 
            $tid = $_POST['tid'];

            $sql = "select first_name, last_name from tenant where ApartmentID='$aid' limit 1";
            $result = mysqli_query($con, $sql); 
            
            $row = mysqli_fetch_assoc($result);
            $name = $row['first_name'] . ' ' . $row['last_name'];
            
            if (!empty($month) && !empty($p_date) && !empty($medium) && !empty($tid)) {
                if ($medium != 'none') {
                    $sql = "UPDATE payment_history 
                            set name = '$name', paid_date = '$p_date', type = '$medium', tnx_id = '$tid', verify = 'payment-not-checked', verified_by='not verified'
                            where ApartmentID = '$aid' and rent_of = '$month'";

                    $result = mysqli_query($con, $sql); 
                    if ($result) {
                        // 
                        $email = $_SESSION['email']; 
                        header('Location: ../tenant/tenant_interface.php?id='.$email.'');
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

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Payment</title>
    </head>
    <body>
        <?php 
            require_once('../home/_nav_from_show_building_info.php');
        ?> 
        <div class="container my-4" style="width:30%;">
            <form method="post" action="tenant_payment.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rent Month</label>
                    <input type="month" name="rent_month" class="form-control" value = "<?php if (isset($month)) echo $month; else echo date('Y-m'); ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Paid Date</label>
                    <input type="date" name="p_date" class="form-control" value = "<?php if (isset($p_date)) echo $p_date; else echo date('Y-m-d');?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Medium</label>
                    <select name="medium" class="form-control">
                        <option value="value = "<?php if (isset($medium)) echo $medium; else echo 'none'; ?>" selected disabled hidden>Select an Option</option>
                        <option value="bkash">Bkash</option>
                        <option value="nagad">Nagad</option>
                        <option value="rocket">Rocket</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Transaction ID</label>
                    <input type="text" name="tid" value = "<?php if (isset($tid)) echo $tid; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter tnxid">
                </div>
        
                <button type="submit" name="submit" class="btn btn-success">Confirm</button>
            </form>
        </div>

    </body>
</html>