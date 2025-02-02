<?php

namespace App\Http\Controllers;

use App\Models\fcmToken;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FcmTokenController extends Controller
{
    public function registerToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'user_id' => 'nullable|integer',
        ]);

        // Guardar el token en la base de datos
        fcmToken::updateOrCreate(
            ['token' => $request->token],
            ['user_id' => $request->user_id]
        );

        return response()->json(['message' => 'Token registrado correctamente.']);
    }
    public function updateToken(Request $request)
    {
        $expiredToken = $request->input('expired_token');
        $refreshedToken = $request->input('refreshed_token');

        // Buscar el token expirado en la base de datos
        $fcmToken = FcmToken::where('token', $expiredToken)->first();

        if ($fcmToken) {
            $fcmToken->token = $refreshedToken;
            $fcmToken->save();
            return response()->json(['message' => 'Token actualizado exitosamente'], 200);
        }

        return response()->json(['error' => 'Token no encontrado'], 404);
    }

    public function sendNotification($token, $title, $body)
    {

        $file = new Filesystem();
        $archivoPath = storage_path('app/botzero-test-firebase-adminsdk-l750d-5108c493e1.json');
        

        if ($file->exists($archivoPath)) {
            $archivo = $file->get($archivoPath);
            $config = json_decode($archivo, true);

            if ($config !== null) {
                // Inicializa el cliente de Google usando la cuenta de servicio
                $googleClient = new GoogleClient();
                $googleClient->setAuthConfig($config);
                $googleClient->addScope('https://www.googleapis.com/auth/firebase.messaging');
            } else {
                // Manejo de error si el JSON es inválido
                throw new \Exception("El archivo JSON es inválido o está corrupto.");
            }
        } else {
            throw new \Exception("El archivo de configuración no existe en la ruta especificada: $archivoPath");
        }

        // Obtiene el token de acceso
        $accessToken = $googleClient->fetchAccessTokenWithAssertion()['access_token'];

        // Configura el cliente HTTP con Guzzle y el token de acceso en los headers
        $client = new Client();

        // Realiza la solicitud de envío de notificación
        $response = $client->post('https://fcm.googleapis.com/v1/projects/botzero-test/messages:send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "message" => [
                    "token" => $token,
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                    ]
                ]
            ]
        ]);

        return $response->getBody();
    }



    public function notifyUsers()
    {
        $tokens = FcmToken::all();

        foreach ($tokens as $token) {
            $this->sendNotification($token->token, 'Título', 'Cuerpo de la notificación', 'android');
        }

        return response()->json(['message' => 'Notificaciones enviadas.']);
    }
    public function getUsersWithTokens(){

        // Suponiendo que tienes una relación entre User y FcmToken
        $users = DB::table('users')
        ->join('fcm_tokens','fcm_tokens.user_id','=','users.id')
        ->select('users.id','users.username','fcm_tokens.token')
        ->get(); // Trae solo id y nombre del usuario
        // Formato de respuesta JSON
        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->username,
                'token' => $user->token
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    

        
    }
}
