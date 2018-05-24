<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Usuario;
use App\Perfil;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    public function mostrar()
    {
        return view('registro');
    }

    public function registrar(UsuarioRequest $request)
    {
        $nick = $request->input("nick");
        $nick = strtoupper($nick);
        $pass = $request->input("password");
        $email = $request->input("email");

        $correcto = false;

        $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $_REQUEST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));
        if ($captcha->success) {

            $existe = DB::table('usuarios')->where('nick', $nick)->exists();
            if (!$existe) {
                //insercion en bd
                $usuario = new Usuario();
                $usuario->nick = $nick;
                $usuario->password = $pass;
                $usuario->email = $email;
                $usuario->validado = 0;
                $usuario->clave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                if ($usuario->save()) {
                    $correcto = true;
                }

                //envio de mail
                $asunto = "Validacion en INSTAGAME";
                $cuerpo = ' 
            <html> 
            <head> 
                <title>Validacion del perfil</title> 
            </head> 
            <body> 
            <h1>Hola ' . $nick . ', para finalizar tu registro haz click en el siguiente enlace</h1> 
            <p> 
                <a href="http://danielortegaconesa.com/registro/validar?clave=' . $usuario->clave . '&nick=' . $usuario->nick . '">Click Aqui</a>
            </p> 
            </body> 
            </html> 
            ';

                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: INSTAGAME  <admin@danielortegaconesa.com>\r\n";
                mail($email, $asunto, $cuerpo, $headers);

            } else {
                $retornar["mensaje"] = "El nick no esta disponible";
            }
        } else {
            $retornar["mensaje"] = "Te hemos detectado como un robot";
        }
        $retornar["correcto"] = $correcto;

        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function validar()
    {
        $nick = $_REQUEST["nick"];
        $clave = $_REQUEST["clave"];

        $existe = DB::table('perfiles')->where('nick', $nick)->exists();
        if (!$existe) {
            $usuario = Usuario::where('nick', '=', $nick)->first();
            if ($usuario->clave == $clave) {
                $usuario->validado = 1;
                $usuario->clave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $usuario->save();

                $perfil = new Perfil();
                $perfil->nick = $nick;
                $perfil->descripcion = "Hola! Estoy usando INSTAGAME";
                $perfil->save();
                session()->put("usuario", $usuario);
                return redirect("/");
            } else {
                echo "Clave incorrecta";
            }
        } else {
            echo "Validacion realizada anteriormente";
        }
    }
}
