<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Perfil;

class EditarPerfilController extends Controller
{
    public function actualizar()
    {
        $descripcion = $_REQUEST["descripcion"];
        if(strlen($descripcion)>64){
            $descripcion = substr($descripcion,0,100);
        }
        $contra = $_REQUEST["contra"];
        $red= $_REQUEST["red"];
        $sm = $_REQUEST["sm"];
        $st = $_REQUEST["st"];
        $sn = $_REQUEST["sn"];

        $fm = $_REQUEST["fm"];
        $ft = $_REQUEST["ft"];
        $fn = $_REQUEST["fn"];


        $retornar["correcto"] = false;

        $u = session("usuario");
        $usubd = Usuario::where('nick', $u->nick)->first();

        $usubd->perfil->descripcion = $descripcion;
        $usubd->perfil->red = $red;
        if($contra != ""){
            $usubd->password = $contra;
        }

        //////// semana
        if ($sm == "true" && $st == "true" && $sn == "true") {
            $usubd->perfil->horario = "todo";
        } elseif ($st == "true" && $sn == "true") {
            $usubd->perfil->horario = "tn";
        } elseif ($sm == "true" && $sn == "true") {
            $usubd->perfil->horario = "mn";
        } elseif ($sm == "true" && $st == "true") {
            $usubd->perfil->horario = "mt";
        } elseif ($sm == "true") {
            $usubd->perfil->horario = "m";
        } elseif ($st == "true") {
            $usubd->perfil->horario = "t";
        } elseif ($sn == "true") {
            $usubd->perfil->horario = "n";
        } else {
            $usubd->perfil->horario = "ninguno";
        }

        /////// fin de semana
        if ($fm == "true" && $ft == "true" && $fn == "true") $usubd->perfil->horariofin = "todo";
        elseif ($ft == "true" && $fn == "true") $usubd->perfil->horariofin = "tn";
        elseif ($fm == "true" && $fn == "true") $usubd->perfil->horariofin = "mn";
        elseif ($fm == "true" && $ft == "true") $usubd->perfil->horariofin = "mt";

        elseif ($fm == "true") $usubd->perfil->horariofin = "m";
        elseif ($ft == "true") $usubd->perfil->horariofin = "t";
        elseif ($fn == "true") $usubd->perfil->horariofin = "n";
        else $usubd->perfil->horariofin = "ninguno";

        if ($usubd->save() && $usubd->perfil->save()) {
            $retornar["correcto"] = true;
        }
        session()->put("usuario", $usubd);
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function actualizarimagen(Request $request)
    {
        $correcto = false;
        $u = session("usuario");
        $file = $request->file('img');


        $size = $file->getSize();

        if ($size > 1000000){
            return redirect("/navegacion/editarPerfil?imgsubida=invalidsize");
            die;
        }

        $nombre = explode(".", $file->getClientOriginalName());
        $extension = end($nombre);
        $extension = strtolower($extension);

        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {

            \Storage::delete('perfiles/' . $u->nick . ".jpg");
            \Storage::delete('perfiles/' . $u->nick . ".jpeg");
            \Storage::delete('perfiles/' . $u->nick . ".png");
            \Storage::delete('perfiles/' . $u->nick . ".gif");

            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") \Storage::disk('local')->put(session("usuario")->nick . "." . $extension, \File::get($file));

            if (\Storage::move(session("usuario")->nick . "." . $extension, 'perfiles/' . session("usuario")->nick . "." . $extension)) $correcto = "si";

            //REDUCCION DE TAMAÑO

            $originalImage = storage_path('app/perfiles/') . $u->nick . "." . $extension;
            if($size < 200000)
                $quality = 70;
            else if($size < 600000)
                $quality = 60;
            else{
                $quality = 50;
            }
            $outputImage = storage_path('app/perfiles/') . $u->nick . "red." . $extension;

            $exploded = explode('.', $originalImage);
            $ext = $exploded[count($exploded) - 1];

            if (preg_match('/jpg|jpeg/i', $ext))
                $imageTmp = imagecreatefromjpeg($originalImage);
            else if (preg_match('/png/i', $ext))
                $imageTmp = imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i', $ext))
                $imageTmp = imagecreatefromgif($originalImage);
            else if (preg_match('/bmp/i', $ext))
                $imageTmp = imagecreatefrombmp($originalImage);
            else
                return 0;


            imagejpeg($imageTmp, $outputImage, $quality);
            imagedestroy($imageTmp);

            // FIN REDUCCION TAMAÑO

            $usubd = Usuario::where('nick', $u->nick)->first();
            $usubd->perfil->img = $u->nick . "red." . $extension;
            $usubd->perfil->save();
            $usubd->save();
            session()->put("usuario", $usubd);
        }
        return redirect("/navegacion/editarPerfil?imgsubida=$correcto");
    }

    public function actualizarAdmin($u)
    {
        $descripcion = $_REQUEST["descripcion"];
        $red= $_REQUEST["red"];
        $sm = $_REQUEST["sm"];
        $st = $_REQUEST["st"];
        $sn = $_REQUEST["sn"];

        $fm = $_REQUEST["fm"];
        $ft = $_REQUEST["ft"];
        $fn = $_REQUEST["fn"];


        $retornar["correcto"] = false;


        $usubd = Usuario::where('nick', $u)->first();

        $usubd->perfil->descripcion = $descripcion;
        $usubd->perfil->red = $red;

        //////// semana
        if ($sm == "true" && $st == "true" && $sn == "true") {
            $usubd->perfil->horario = "todo";
        } elseif ($st == "true" && $sn == "true") {
            $usubd->perfil->horario = "tn";
        } elseif ($sm == "true" && $sn == "true") {
            $usubd->perfil->horario = "mn";
        } elseif ($sm == "true" && $st == "true") {
            $usubd->perfil->horario = "mt";
        } elseif ($sm == "true") {
            $usubd->perfil->horario = "m";
        } elseif ($st == "true") {
            $usubd->perfil->horario = "t";
        } elseif ($sn == "true") {
            $usubd->perfil->horario = "n";
        } else {
            $usubd->perfil->horario = "ninguno";
        }

        /////// fin de semana
        if ($fm == "true" && $ft == "true" && $fn == "true") $usubd->perfil->horariofin = "todo";
        elseif ($ft == "true" && $fn == "true") $usubd->perfil->horariofin = "tn";
        elseif ($fm == "true" && $fn == "true") $usubd->perfil->horariofin = "mn";
        elseif ($fm == "true" && $ft == "true") $usubd->perfil->horariofin = "mt";

        elseif ($fm == "true") $usubd->perfil->horariofin = "m";
        elseif ($ft == "true") $usubd->perfil->horariofin = "t";
        elseif ($fn == "true") $usubd->perfil->horariofin = "n";
        else $usubd->perfil->horariofin = "ninguno";

        if ($usubd->save() && $usubd->perfil->save()) {
            $retornar["correcto"] = true;
        }
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function actualizarimagenAdmin($nick,Request $request)
    {
        $correcto = false;
        $u = Usuario::where('nick', $nick)->first();
        $file = $request->file('img');

        $size = $file->getSize();

        if ($size > 1000000){
            return redirect("/navegacion/editarPerfil?imgsubida=invalidsize");
            die;
        }

        $nombre = explode(".", $file->getClientOriginalName());
        $extension = end($nombre);
        $extension = strtolower($extension);

        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {

            \Storage::delete('perfiles/' . $u->nick . ".jpg");
            \Storage::delete('perfiles/' . $u->nick . ".jpeg");
            \Storage::delete('perfiles/' . $u->nick . ".png");
            \Storage::delete('perfiles/' . $u->nick . ".gif");

            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") \Storage::disk('local')->put($nick . "." . $extension, \File::get($file));

            if (\Storage::move($nick . "." . $extension, 'perfiles/' .$nick . "." . $extension)) $correcto = "si";

            //REDUCCION DE TAMAÑO

            $originalImage = storage_path('app/perfiles/') . $u->nick . "." . $extension;
            if($size < 200000)
                $quality = 70;
            else if($size < 600000)
                $quality = 60;
            else{
                $quality = 50;
            }
            $outputImage = storage_path('app/perfiles/') . $u->nick . "red." . $extension;

            $exploded = explode('.', $originalImage);
            $ext = $exploded[count($exploded) - 1];

            if (preg_match('/jpg|jpeg/i', $ext))
                $imageTmp = imagecreatefromjpeg($originalImage);
            else if (preg_match('/png/i', $ext))
                $imageTmp = imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i', $ext))
                $imageTmp = imagecreatefromgif($originalImage);
            else if (preg_match('/bmp/i', $ext))
                $imageTmp = imagecreatefrombmp($originalImage);
            else
                return 0;


            imagejpeg($imageTmp, $outputImage, $quality);
            imagedestroy($imageTmp);

            // FIN REDUCCION TAMAÑO

            $usubd = Usuario::where('nick', $u->nick)->first();
            $usubd->perfil->img = $u->nick . "red." . $extension;
            $usubd->perfil->save();
            $usubd->save();
        }
        return redirect("/admin/navegacion/editarPerfil/$usubd->nick?imgsubida=$correcto");
    }

}

