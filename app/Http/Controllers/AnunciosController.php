<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Http\Requests\AnuncioRequest;
use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    public function nuevoAnuncio(AnuncioRequest $r)
    {
        $nick = session("usuario")->nick;
        $texto = $r->input("texto");
        $titulo = $r->input("titulo");
        $precio = $r->input("precio");
        if ($precio < 0) {
            $precio *= -1;
        }
        $img = $r->file("img");


        $anuncio = new Anuncio();
        $anuncio->nick = $nick;
        $anuncio->texto = $texto;
        $anuncio->titulo = $titulo;
        $anuncio->precio = $precio;

        $anuncio->save();

        if ($img != null) {
            $size = $img->getSize();

            if ($size > 1000000) {
                return redirect("/navegacion/nuevoAnuncio?error=img");
                die;
            }

            $nombre = explode(".", $img->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);

            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {

                \Storage::delete('anuncios/' . $anuncio->cod . ".jpg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".jpeg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".png");
                \Storage::delete('anuncios/' . $anuncio->cod . ".gif");

                if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") \Storage::disk('local')->put($anuncio->cod . "." . $extension, \File::get($img));

                if (\Storage::move($anuncio->cod . "." . $extension, 'anuncios/' . $anuncio->cod . "." . $extension)) $correcto = "si";

                //REDUCCION DE TAMAÑO

                $originalImage = storage_path('app/anuncios/') . $anuncio->cod . "." . $extension;
                if ($size < 200000)
                    $quality = 70;
                else if ($size < 600000)
                    $quality = 60;
                else {
                    $quality = 50;
                }
                $outputImage = storage_path('app/anuncios/') . $anuncio->cod . "red." . $extension;

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

                $anuncio->img = ($anuncio->cod . "red." . $extension);
                $anuncio->save();
            } else {
                return redirect("/navegacion/nuevoAnuncio?error=img");
                die;
            }
        }

        return redirect("/navegacion/misAnuncios");
    }

    public function filtrar($campo, $valor)
    {
        if ($campo == "titulo" || $campo == "texto") {
            return view("buscaranuncio")
                ->with("anuncios", Anuncio::where($campo, "LIKE", "%$valor%")->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }

        if ($campo == "precioi") {
            return view("buscaranuncio")
                ->with("anuncios", Anuncio::where("precio", "<", $valor)->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }

        if ($campo == "precios") {
            return view("buscaranuncio")
                ->with("anuncios", Anuncio::where("precio", ">", $valor)->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }
    }

    public function filtrarAdmin($campo, $valor)
    {
        if ($campo == "titulo" || $campo == "texto") {
            return view("admin.buscaranuncio")
                ->with("anuncios", Anuncio::where($campo, "LIKE", "%$valor%")->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }

        if ($campo == "precioi") {
            return view("buscaranuncio")
                ->with("anuncios", Anuncio::where("precio", "<", $valor)->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }

        if ($campo == "precios") {
            return view("buscaranuncio")
                ->with("anuncios", Anuncio::where("precio", ">", $valor)->orderBy("fecha", "desc")->paginate(10))
                ->with("seleccionado", "$campo")
                ->with("valor", "$valor");
        }
    }

    public function misAnuncios()
    {
        return view("misanuncios")
            ->with("anuncios", Anuncio::where("nick", session("usuario")->nick)->orderBy("fecha", "desc")->paginate(10));
    }

    public function editarAnuncio($cod,AnuncioRequest $r)
    {
        $nick = session("usuario")->nick;
        $texto = $r->input("texto");
        $titulo = $r->input("titulo");
        $precio = $r->input("precio");
        if ($precio < 0) {
            $precio *= -1;
        }
        $img = $r->file("img");


        $anuncio = Anuncio::where("cod",$cod)->where("nick",$nick)->first();
        $anuncio->nick = $nick;
        $anuncio->texto = $texto;
        $anuncio->titulo = $titulo;
        $anuncio->precio = $precio;

        $anuncio->save();

        if ($img != null) {
            $size = $img->getSize();

            if ($size > 1000000) {
                return redirect("/navegacion/nuevoAnuncio?error=img");
                die;
            }

            $nombre = explode(".", $img->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);

            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {

                \Storage::delete('anuncios/' . $anuncio->cod . ".jpg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".jpeg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".png");
                \Storage::delete('anuncios/' . $anuncio->cod . ".gif");

                if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") \Storage::disk('local')->put($anuncio->cod . "." . $extension, \File::get($img));

                if (\Storage::move($anuncio->cod . "." . $extension, 'anuncios/' . $anuncio->cod . "." . $extension)) $correcto = "si";

                //REDUCCION DE TAMAÑO

                $originalImage = storage_path('app/anuncios/') . $anuncio->cod . "." . $extension;
                if ($size < 200000)
                    $quality = 70;
                else if ($size < 600000)
                    $quality = 60;
                else {
                    $quality = 50;
                }
                $outputImage = storage_path('app/anuncios/') . $anuncio->cod . "red." . $extension;

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

                $anuncio->img = ($anuncio->cod . "red." . $extension);
                $anuncio->save();
            } else {
                return redirect("/navegacion/editaranuncio?error=img");
                die;
            }
        }

        return redirect("/navegacion/misAnuncios");
    }

    public function editarAnuncioAdmin($cod,AnuncioRequest $r)
    {
        $texto = $r->input("texto");
        $titulo = $r->input("titulo");
        $precio = $r->input("precio");
        if ($precio < 0) {
            $precio *= -1;
        }
        $img = $r->file("img");


        $anuncio = Anuncio::where("cod",$cod)->first();
        $anuncio->texto = $texto;
        $anuncio->titulo = $titulo;
        $anuncio->precio = $precio;

        $anuncio->save();

        if ($img != null) {
            $size = $img->getSize();

            if ($size > 1000000) {
                return redirect("/navegacion/nuevoAnuncio?error=img");
                die;
            }

            $nombre = explode(".", $img->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);

            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") {

                \Storage::delete('anuncios/' . $anuncio->cod . ".jpg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".jpeg");
                \Storage::delete('anuncios/' . $anuncio->cod . ".png");
                \Storage::delete('anuncios/' . $anuncio->cod . ".gif");

                if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif") \Storage::disk('local')->put($anuncio->cod . "." . $extension, \File::get($img));

                if (\Storage::move($anuncio->cod . "." . $extension, 'anuncios/' . $anuncio->cod . "." . $extension)) $correcto = "si";

                //REDUCCION DE TAMAÑO

                $originalImage = storage_path('app/anuncios/') . $anuncio->cod . "." . $extension;
                if ($size < 200000)
                    $quality = 70;
                else if ($size < 600000)
                    $quality = 60;
                else {
                    $quality = 50;
                }
                $outputImage = storage_path('app/anuncios/') . $anuncio->cod . "red." . $extension;

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

                $anuncio->img = ($anuncio->cod . "red." . $extension);
                $anuncio->save();
            } else {
                return redirect("/admin/navegacion/editaranuncio?error=img");
                die;
            }
        }

        return redirect("/admin/navegacion/buscarAnuncio");
    }

    public function eliminarAnuncio($cod){
        $anuncio = Anuncio::where("cod",$cod)->where("nick",session("usuario")->nick)->first();
        $anuncio->delete();
    }
    public function eliminarAnuncioAdmin($cod){
    $anuncio = Anuncio::where("cod",$cod)->first();
    $anuncio->delete();
}
}