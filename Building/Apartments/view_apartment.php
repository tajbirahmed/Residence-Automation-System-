<?php
    session_start(); 
    include_once('../../connect.php');
    if (isset($_GET['aid'])) {
        $aid = $_GET['aid']; 
        $temp_hld = explode('-',$_GET['aid']);
        $hld = $temp_hld[0]; 
        
        $sql = "SELECT buildingName from `building` where holdingNumber = '$hld' limit 1"; 
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        $bname = $row['buildingName'];

        $sql = "SELECT * from `apartment` where ApartmentID = '$aid' limit 1"; 
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        $size = $row['size']; 
        $avl = $row['availability']; 
        $bhk = $row['BHK'];
        $floor = $row['floor'];
        $rpm = $row['rentpermonth'];
        $video = $row['video'];
    }
    if (isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 'owner' && isset($_POST['submit'])) {
        $video = $_FILES['vdo'];
        if (!empty($video)) {
            $extensions  = array('mp4', 'mkv'); 
            $video = $_FILES['vdo']; 
            $filename = explode('.', $video['name']);
            if (in_array(strtolower($filename[1]), $extensions)) {
                
                $upload_video = '../../video/apartments/'. $aid . '.' . $filename[1];
                move_uploaded_file($video['tmp_name'], $upload_video);
                
                $upload_video = 'apartments/' . $aid . '.' . $filename[1];
                
                $sql = "UPDATE `apartment` 
                        set video = '$upload_video'
                        where ApartmentID = '$aid'";
                mysqli_query($con, $sql);
                header('Location: view_apartment.php?aid='.$aid.'');
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

    <title>Apartment <?php echo $aid; ?> of <?php echo $bname; ?></title>
    </head>
    <body>
        <?php 
            require_once('../../home/_nav_from_aparmtent_view.php');
            if (isset($_GET['id']) && $_GET['id'] == 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Owners notified successfully.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        ?>
        <div class="container my-5" style = "text-align: center;">
            <h3 style="text-align: center;"> You are view Apartment <?php  echo $aid;?> of <?php echo $bname; ?></h3>
            <div class="container my-2" style="width:40%;">

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col"  style="text-align: center;">Size</th>
                        <th scope="col" style="text-align: center;">Floor</th>
                        <th scope="col" style="text-align: center;">BHK</th>
                        <th scope="col" style="text-align: center;">Rent Per Month(Tk)</th>
                        <th scope="col" style="text-align: center;">Availabity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><?php echo $size; ?></td>
                            <td style="text-align: center;"><?php echo $floor; ?></td>
                            <td style="text-align: center;"><?php echo $bhk; ?></td>
                            <td style="text-align: center;"><?php echo $rpm; ?></td>
                            <td style="text-align: center;"><?php if ($avl) echo "YES"; else echo "NO";?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container my-5" style="text-align: center;"> 
                <h3>Video of Apartment</h3>
            <video src="../../video/<?php echo $video;?>" width="320" height="240" controls></video>
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 'owner'){
                        echo '<div class="container my-2" style="width: 30%;">
                            <form method="post" enctype="multipart/form-data">
                                <input type="file" name="vdo" class="form-control"accept=".mp4, .mkv" required placeholder="upload updated video">
                                <button type="submit" name="submit" class="btn btn-success">Upload Video</button>
                            </form>
                        </div>';
                    }
                ?>
            </div>
            <?php 
                if (!isset($_SESSION['email'])){
                    echo '<a href="apply_request.php?aid='.$aid.'"><button class="btn btn-success">Apply</button></a>
                    ';
                }
                ?>
            </div>

    </body>
</html>
