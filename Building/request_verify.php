
<?php
    session_start(); 
    include_once('../connect.php'); 
    if (isset($_SESSION['email']) && isset($_GET['holding'])) {
        $email = $_SESSION['email']; 
        $hld = $_GET['holding'];
        $sql = "INSERT INTO `ownership_request` (`holdingNumber`, `email`, `status`) 
                                                values('$hld', '$email', 0)"; 

        $result = mysqli_query($con, $sql);
        if ($result) {
            // success
            header('Location: request_authority.php');
        } else {
            // fail
        }
    }
?>
