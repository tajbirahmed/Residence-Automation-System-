<?php 
    function showBuildingName($con, $hld) { 
        $sql = "select buildingName from building where holdingNumber=$hld"; 
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        return $row['buildingName'];

    }
    function get_apartment_id($email) {
        
    }
?>
