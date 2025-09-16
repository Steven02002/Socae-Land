<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {

        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $usuario = new Usuario($_POST);

            $alerts = $usuario->validarLogin();
            
            if(empty($alerts)) {
                // Verificar quel el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmed ) {
                    Usuario::setAlert('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['first_name'] = $usuario->first_name;
                        $_SESSION['last_name'] = $usuario->last_name;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        
                        // Redireccion
                        if($usuario->admin) {
                          header('Location: /admin/speakers');
                        }

                    } else {
                        Usuario::setAlert('error', 'Contraseña incorrecta');
                    }
                }
            }
        }

        $alerts = Usuario::getAlerts();
        
        // Render a la vista 
        $router->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'alerts' => $alerts
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /login');
        }
    }

    public static function register(Router $router) {
        $alerts = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->synchronize($_POST);
            
            $alerts = $usuario->validar_cuenta();

            if(empty($alerts)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlert('error', 'El Usuario ya esta registrado');
                    $alerts = Usuario::getAlerts();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $result =  $usuario->save();
                    // debuguear($usuario);

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->first_name, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($result) {
                        header('Location: /message');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('auth/register', [
            'title' => 'Crea tu cuenta',
            'usuario' => $usuario, 
            'alerts' => $alerts
        ]);

    }

    public static function forget(Router $router) {
        $alerts = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alerts = $usuario->validarEmail();

            if(empty($alerts)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmed) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->save();
                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->first_name, $usuario->token );
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alerts['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alerts['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/forget', [
            'title' => 'Olvide mi contraña',
            'alerts' => $alerts
        ]);
    }

    public static function restore(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlert('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $usuario->synchronize($_POST);

            // Validar el password
            $alerts = $usuario->validarPassword();

            if(empty($alerts)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // Guardar el usuario en la BD
                $result = $usuario->save();

                // Redireccionar
                if($result) {
                    header('Location: /login');
                }
            }
        }

        $alerts = Usuario::getAlerts();
        
        // Muestra la vista
        $router->render('auth/restore', [
            'title' => 'Reestablecer contraseña',
            'alerts' => $alerts,
            'token_valido' => $token_valido
        ]);
    }

    public static function message(Router $router) {

        $router->render('auth/message', [
            'title' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlert('error', 'Token No Válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmed = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->save();

            Usuario::setAlert('exito', 'Cuenta Comprobada éxitosamente');
        }

        $router->render('auth/confirmed', [
            'title' => 'Confirma tu cuenta',
            'alerts' => Usuario::getAlerts()
        ]);
    }
}