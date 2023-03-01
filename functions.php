<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use Dompdf\Dompdf;

    //Load Composer's autoloader
    require 'email_sender/vendor/autoload.php';
    require_once 'pdf_creator/vendor/autoload.php';
    function showBuildingName($con, $hld) { 
        $sql = "select buildingName from building where holdingNumber=$hld"; 
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        return $row['buildingName'];

    }
    function show_date($rcd) {
        if ($rcd != 'empty') {
            return date_format($rcd, "d-m-Y"); 
        }
        return '';
    }
    function send_mail($sender_name, $sender, $recipients, $subject, $body) {
        $mail = new PHPMailer(true);

        try {

        //Server settings
        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = "smtp.gmail.com";                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = "shible0805@gmail.com";                     
        $mail->Password   = "jkvgisyruslwbydd";                               
        $mail->SMTPSecure = "tls";            
        $mail->Port       = 587;                     

        //Recipients
        $mail->setFrom($sender, $sender_name);

        foreach($recipients as $recipient){
            $mail->addAddress($recipient);
        }
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    function month_to_month_name($month) {
        $month_name =  date("F", strtotime($month));
        $year = explode('-', $month);
        return $month_name . ' ' . $year[0];
    }
    function create_pdf($html) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
?>
