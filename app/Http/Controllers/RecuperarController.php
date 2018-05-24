<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class RecuperarController extends Controller
{
    public function mostrar()
    {
        return view("recuperar");
    }

    public function enviarMail(Request $r)
    {
        $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $r->input('response') . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if ($captcha->success) {
            $email = $r->input("email");
            $u = Usuario::where("email", "=", $email)->get();
            if (count($u) == 0) {
                echo "mal";
            } else {
                echo "bien";
            }
            foreach ($u as $usu) {
                $usu->clave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $usu->save();
                $asunto = "Contraseña olvidada en INSTAGAME";
                $cuerpo = ' 
            <html> 
            <head> 
                <title>Contraseña olvidada en INSTAGAME</title> 
            </head> 
            <body> 
            <h1>Hola ' . $usu->nick . ', mediante el siguiente enlace accederas a tu perfil y podras cambiar la contraseña</h1> 
            <p> 
                <a href="http://danielortegaconesa.com/recuperar/validar?clave=' . $usu->clave . '&nick=' . $usu->nick . '">Click Aqui</a>
            </p> 
            </body> 
            </html> 
            ';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: INSTAGAME  <admin@danielortegaconesa.com>\r\n";
                mail($email, $asunto, $cuerpo, $headers);
            }
        } else {
            echo "robot";
        }
    }

    public function validar(Request $r)
    {
        $nick = $r->input("nick");
        $clave = $r->input("clave");

        $u = Usuario::where("nick", $nick)->first();
        if ($u != NULL) {
            if ($u->clave == $clave) {
                session()->put("usuario", $u);
                $u->clave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $u->save();
                return redirect("/");
            }
            echo "La clave no coincide, vuelve a solicitar";
        }else{
            echo "No ecntramos tu usuario, vuevle a solicitar";
        }



    }
}
