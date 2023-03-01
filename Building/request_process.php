
<?php
    session_start();
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        if (isset($_GET['email']) && isset($_GET['holding']) && isset($_GET['status'])) {
            $email = $_GET['email']; 
            $holding = $_GET['holding']; 
            $status = $_GET['status'];
            if ($status == 1) {
                $sql = "INSERT INTO `own` (`holdingNumber`,`email`) 
                                            values('$holding', '$email')";
                mysqli_query($con, $sql); 
                
            }
            $sql = "UPDATE `ownership_request` 
                                        set status = 1 
                                        where holdingNumber = '$holding' and email = '$email'" ;
            mysqli_query($con, $sql); 
        }
    }
?>
