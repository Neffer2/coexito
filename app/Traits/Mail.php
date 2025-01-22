<?php

namespace App\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Http;

trait Mail
{
    public function welcome(){
        $this->sendMail([
            'subject' => "¡Te damos la bienvenida a la promo que premia tu fidelidad!",
            'mail' => 'mails.bienvenida',
            'altBody' => "¡Bienvenido!"
        ]);
    }

    public function premio($premio_id){
        $mail = "";
        if ($premio_id == 101){
            $mail = 'bono-20';
        }elseif($premio_id == 102){
            $mail = 'bono-30';
        }elseif($premio_id == 103){
            $mail = 'bono-50';
        }elseif($premio_id == 103){
            $mail = 'bono-100';
        }

        $this->sendMail([
            'subject' => "¡Te damos la bienvenida a la promo que premia tu fidelidad!",
            'mail' => 'mails.bienvenida',
            'altBody' => "¡Bienvenido!"
        ]);
    }

    public function sigueIntentando(){
        $this->sendMail([
            'subject' => "¡No te rindas!",
            'mail' => 'mails.sigue-intentado',
            'altBody' => "¡No te rindas!"
        ]);
    }

    public function sendMail($data = null){
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

            // $mail->addAttachment("assets/mail/bienvenida.png", "Descrubre tu premio.png");

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject =  $data['subject'];
            $mail->Body    = view($data['mail'], ['user' => auth()->user()]);
            $mail->AltBody = $data['altBody'];
            $mail->send();

        } catch (Exception $e) {
            return redirect()->back()->withErrors("Error: {$mail->ErrorInfo}")->withInput();
        }
    }
}
