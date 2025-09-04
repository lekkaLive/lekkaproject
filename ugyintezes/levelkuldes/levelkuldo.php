<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

function kuldes($cimzett, $cimzett_neve, $targy, $leveltorzs, $egyszerutorzs){
    $mail = new PHPMailer(true);

    try {
        // Szerver beállítások
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lekkasanyi@gmail.com';             // saját Gmail
        $mail->Password   = 'mpptwzwedfadcaik';                 // alkalmazásjelszó
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // vagy ENCRYPTION_SMTPS
        $mail->Port       = 587;                                // 465, ha SMTPS-t használsz
    
        $mail->CharSet = 'UTF-8';
        
        // Címzett(ek)
        $mail->setFrom('lekkasanyi@gmail.com', 'SMTP Teszt Feladó');
        $mail->addAddress($cimzett, $cimzett_neve);
    
        // Tartalom
        $mail->isHTML(true);
        $mail->Subject = $targy;
        $mail->Body    = $leveltorzs;
        $mail->AltBody = $egyszerutorzs;
    
        $mail->send();
        return 'Ok';
    } 
    catch (Exception $e) {
        return "{$mail->ErrorInfo}";
    }
}

