<?php

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Http;

trait Mail
{
    public function mailPremio(){
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try{
            //Server settings
            $mail->SMTPDebug = true;
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = env('MAIL_PORT', 587);

            //Recipients
            $mail->setFrom(env('MAIL_USERNAME'), 'Coexitocontigo');
            $mail->addAddress(auth()->user()->email, auth()->user()->name);

            $mail->addAttachment("assets/mail/bienvenida.png", "Descrubre tu premio.png");

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "¡Te damos la bienvenida a la promo que premia tu fidelidad!";
            $mail->Body    = view('mails.bienvenida', ['user' => auth()->user()]);
            $mail->AltBody = "¡Bienvenido!";

            $mail->send();

        } catch (Exception $e) {
            return redirect()->back()->withErrors("Error: {$mail->ErrorInfo}")->withInput();
        }
    }
}
