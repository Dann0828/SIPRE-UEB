<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Persona;

class MailController extends Controller
{
    public function sendEmail($id){

        $persona = Persona::find($id);
        $nombre = $persona->nombre;
        $correo = $persona->correo;
        $img_path = public_path('vendor/adminlte/dist/img/logo_ubosque.jpg');


        $message = "Hola $nombre, te agradecemos por tomar nuestro servicio de préstamos. Queremos que evalúes nuestro servicio en el siguiente enlace:";
        $link = "https://docs.google.com/forms/d/e/1FAIpQLSdt2dc3ZxVvwPBDEHfVfG4mPbveWf_zWitCTJBDfRXxvs8Cjg/viewform?usp=sf_link";

        $details = [
            'title' => 'Encuesta de satisfacción sobre el préstamo realizado.',
            'body' => "$message $link",
            'img_path' => $img_path,
        ];

        Mail::to($correo)->send(new TestMail($details));
        return "Correo Electrónico Enviado";
    }

}
