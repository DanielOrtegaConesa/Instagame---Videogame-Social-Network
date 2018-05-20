<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class nuevoJuegoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * CREATE TABLE juegos(
    cod INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    year INT(4),
    img VARCHAR(40),
    descripcion TEXT,
    PRIMARY KEY (cod)
    );

     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:50',
            'descripcion' => 'required',
            'year' => "required|max:4|min:4"
        ];
    }
}
