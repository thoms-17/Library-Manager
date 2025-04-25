<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class EmailHelper
{
    static function sendVerificationEmail($userEmail, $userName, $token)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $envVariables = parse_ini_file(__DIR__ . '/../.env');

        $emailSender = $envVariables['EMAIL_SENDER'];
        $emailPassword = $envVariables['EMAIL_PASSWORD'];

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $emailSender; // Ton adresse Gmail
            $mail->Password = $emailPassword; // Le mot de passe app
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($emailSender, 'Library Manager');
            $mail->addAddress($userEmail, $userName);

            $mail->isHTML(true);
            $mail->Subject = 'Library Manager - Vérification de votre adresse email';
            $mail->Body = "
            <p>Bonjour $userName,</p>
            <p>Merci pour votre inscription. Cliquez sur le lien suivant pour vérifier votre adresse email :</p>
            <p><a href='http://localhost:8888/verify-email?token=$token'>Vérifier mon email</a></p>
        ";

            $mail->send();
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi du mail : " . $mail->ErrorInfo);
        }
    }
}
