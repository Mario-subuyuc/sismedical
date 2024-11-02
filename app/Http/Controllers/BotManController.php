<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public function handle(Request $request)
    {
        $botman = app('botman');
        $responseMessage = '';

        // Captura explícita del mensaje desde el request
        $incomingMessage = $request->input('message', '');

        // Verifica si el mensaje está vacío y responde en consecuencia
        if (empty($incomingMessage)) {
            return response()->json(['message' => 'No se recibió ningún mensaje.']);
        }

        // Comparación directa del mensaje usando patrones
        if (preg_match('/.*horarios.*/i', $incomingMessage)) {
            $responseMessage = 'Nuestros horarios de atención son de 8:00 a.m. a 8:00 p.m.';
        }elseif (preg_match('/.*quien|eres|funcion|función.*/i', $incomingMessage)) {
            $responseMessage = 'soy un chat online que responde a preguntas frecuentes, para brindarte un excelente servicio';
        }elseif (preg_match('/.*hola|saludos|buenas.*/i', $incomingMessage)) {
            $responseMessage = 'En que puedo ayudarte hoy, estamos para servirte';
        } elseif (preg_match('/.*especialidades|especialidad.*/i', $incomingMessage)) {
            $responseMessage = 'Ofrecemos las siguientes especialidades: Cardiología, Pediatría, y Neurología.';
        } elseif (preg_match('/.*doctores.*/i', $incomingMessage)) {
            $responseMessage = 'Actualmente tenemos a los siguientes doctores disponibles: Doctor1 Swift,<br> Doctor2 Barrientos,<br> y Doctor3 Valedez.';
        } elseif (preg_match('/.*consultorios|ubicacion|ubicaciones.*/i', $incomingMessage)) {
            $responseMessage = 'Contamos con consultorios en: Guatemala Z10, Chimaltenango, y Xela.';
        } elseif (preg_match('/.*gracias|adios.*/i', $incomingMessage)) {
            $responseMessage = 'De nada, estamos para servirte';
        } elseif (preg_match('/.*emergencia|peligro.*/i', $incomingMessage)) {
            $responseMessage = 'si te encuntas en una situacion bulnerable puedes llamar al 911';
        } elseif (preg_match('/.*reserva|cita|disponibilidad.*/i', $incomingMessage)) {
            $responseMessage = 'debes crear un usuario en nuestro sistema<br>, puedes hacerlo desde el boton superior derecho llamdo ingresar';
        }elseif (preg_match('/.*sismedical.*/i', $incomingMessage)) {
            $responseMessage = 'sistema de reserva de citas medical en linea';
        } 
        elseif (preg_match('/.*informacion|información|telefono|comunicacion|contacto|precios|cuotas.*/i', $incomingMessage)) {
            $responseMessage = 'Para más información, puedes comunicate a este <a href="https://wa.me/50245967221" target="_blank">WhatsApp</a>';
        } else {
            $responseMessage = "Lo siento, no entiendo el mensaje: podria preguntar sobre \"$incomingMessage\" <a href=\"https://wa.me/50245967221\" target=\"_blank\"> en este WhatsApp</a>";
        }

        // Retornar la respuesta generada como JSON
        return response()->json(['message' => $responseMessage]);
    }
}
