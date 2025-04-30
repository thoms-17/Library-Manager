<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class EmailHelper
{
    private static function sendEmail($toEmail, $toName, $subject, $bodyHtml)
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
            $mail->Username = $emailSender;
            $mail->Password = $emailPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($emailSender, 'Library Manager');
            $mail->addAddress($toEmail, $toName);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $bodyHtml;

            $mail->send();
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi du mail : " . $mail->ErrorInfo);
        }
    }

    public static function sendVerificationEmail($userEmail, $userName, $token)
    {
        $subject = 'Library Manager - Vérification de votre adresse email';
        $body = "
        <p>Bonjour $userName,</p>
        <p>Merci pour votre inscription. Cliquez sur le lien suivant pour vérifier votre adresse email :</p>
        <p><a href='http://localhost:8888/verify-email?token=$token'>Vérifier mon email</a></p>
    ";
        self::sendEmail($userEmail, $userName, $subject, $body);
    }

    public static function sendPasswordResetEmail($userEmail, $resetToken)
    {
        $subject = 'Réinitialisation de votre mot de passe';
        $body = "
        <p>Bonjour,</p>
        <p>Vous avez demandé à réinitialiser votre mot de passe. Cliquez sur le lien ci-dessous :</p>
        <p><a href='http://localhost:8888/reset-password?token={$resetToken}'>Réinitialiser mon mot de passe</a></p>
        <p>Si vous n'avez pas fait cette demande, ignorez ce message.</p>
    ";
        self::sendEmail($userEmail, "", $subject, $body);
    }
}
