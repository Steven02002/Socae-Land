<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $first_name;
    public $token;
    
    public function __construct($email, $first_name, $token)
    {
        $this->email = $email;
        $this->first_name = $first_name;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@socae.com');
        $mail->addAddress($this->email, $this->first_name);
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->first_name .  "</strong> Has Registrado Correctamente tu cuenta; pero es necesario confirmarla</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirm-account?token=" . $this->token . "'>Confirmar Cuenta</a>";       
        $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@socae.com');
        $mail->addAddress($this->email, $this->first_name);
        $mail->Subject = 'Reestablece tu contraseña';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->first_name .  "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/restore?token=" . $this->token . "'>Reestablecer contraseña</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}