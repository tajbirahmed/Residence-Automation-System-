<?php 
    session_start();
    include_once('../connect.php'); 
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email']; 
        if (isset($_GET['id']) && isset($_GET['aid']) && isset($_GET['rent_of'])) {
            $aid = $_GET['aid']; 
            $rent_of = $_GET['rent_of'];
            if ($_GET['id'] == 'accept') {
                $sql = "UPDATE `payment_history` 
                        set verified_by = '$email', verify = 'verified' 
                        where ApartmentID='$aid' and rent_of='$rent_of'"; 
                $result = mysqli_query($con, $sql);
                if ($result) {
                    // 
                }
            } 
            else if ($_GET['id'] == 'reject') {
                $sql = "UPDATE `payment_history` 
                        set verify = 'rejected' 
                        where ApartmentID='$aid' and rent_of='$rent_of'"; 
                $result = mysqli_query($con, $sql);
                if ($result) {
                    // 
                }
            }
            header('Location: payment_statement.php');
        }
    }
?>