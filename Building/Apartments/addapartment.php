<?php
session_start();  
    include('../../connect.php');
    $inset_error = 0;
    if (isset($_GET['id'])) {
        $hld = $_GET['id']; 
        $sql = "SELECT buildingName from `building` where holdingNumber='$hld' limit 1";
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result);
        $bname = $row['buildingName'];
        
        if (isset($_POST['submit'])){
            if (isset($_POST['aid']) && 
                isset($_POST['rpm']) && 
                isset($_POST['size']) && 
                isset($_POST['bhk']) && 
                isset($_POST['floor'])) {
                    if (!empty($_POST['aid']) && 
                    !empty($_POST['rpm']) && 
                    !empty($_POST['size']) && 
                    !empty($_POST['bhk']) && 
                    !empty($_POST['floor'])){
                        $size = $_POST['size']; 
                        $rpm = $_POST['rpm']; 
                        $aid = $hld . '-' . $_POST['aid']; 
                        $bhk = $_POST['bhk'];
                        $floor = $_POST['floor'];

                        $sql = "SELECT * from `apartment` where ApartmentID = '$aid' limit 1";
                        $result = mysqli_query($con, $sql); 
                        if (mysqli_num_rows($result)) {
                            $inset_error = 1;
                        } else {
                            
                            
                            // Edited 
                            // not testted
                            $extensions  = array('mp4', 'mkv'); 
                            $video = $_FILES['vdo']; 
                            $filename = explode('.', $video['name']);
                            if (in_array(strtolower($filename[1]), $extensions)) {
                                
                                $upload_video = '../../video/apartments/'. $aid . '.' . $filename[1];
                                move_uploaded_file($video['tmp_name'], $upload_video);
                                
                                $upload_video = 'apartments/' . $aid . '.' . $filename[1];
                            } else $upload_video = '';

                            $sql = "INSERT INTO `apartment` (`ApartmentID`, `holdingNumber`,`rentpermonth`, `size`, `BHK`, `availability`, `video`, `floor`) 
                                    VALUES ('$aid', '$hld' ,'$rpm', '$size', '$bhk', 1, '$upload_video', '$floor')";

                            mysqli_query($con, $sql);

                            // ~~have to  work on that~~
                            // ~in payment_history table~
                            $month = date('Y-m');
                            $sql = "INSERT INTO `payment_history` (`ApartmentID`, `rent_of`) 
                                                values('$aid', '$month')";
                            mysqli_query($con, $sql);
                            
                            header('Location: ../../owner/showBuildinginfo.php?showHolding='.$hld.'&success=1');
                        }
                    }
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">    
        <title>Residence Automation System</title>
    </head>
    <body>
        <?php 
            require_once('../../home/_nav_from_aparmtent_view.php');
            if ($inset_error == 1) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Aprtment Already Exists!</strong> Retry.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        ?>
        <div class="container my-5" style ="width: 30%">
        <h3 style ="text-align: center;">Add Apartment to <?php echo $bname; ?></h3></div>    
        <div class="container my-5" style ="width: 30%">
            <form method="post" action="addapartment.php?id=<?php echo $hld; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Apartment ID</label>
                    <input type="text" required name="aid" class="form-control" autocomplete = "off" placeholder="Enter Aparment ID*">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Floor</label>
                    <input type="number" required name="floor" class="form-control" autocomplete = "off" placeholder="Enter which floor the apartment is*">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Rent Per Month</label>
                    <input type="number" required name = "rpm" class="form-control" autocomplete = "off" placeholder="Enter Rent Per Month*">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Size</label>
                    <input type="number" required name = "size" class="form-control" autocomplete = "off" placeholder="Enter Size*">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">BHK</label>
                    <input type="number" required name="bhk" class="form-control" autocomplete = "off" placeholder="BHK*">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Attach Video</label>
                    <input type="file" accept = ".mp4, .mkv"name="vdo" class="form-control" autocomplete = "off" placeholder="Please attach video.">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </body>
</html>
