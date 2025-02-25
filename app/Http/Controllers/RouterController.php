<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib3\Net\SSH2;
use Illuminate\Support\Facades\Log;

class RouterController extends Controller
{
    public function index()
    {
        // Lógica para la página de inicio del controlador (si es necesario)
        return view('welcome'); // Usa la vista "welcome.blade.php"
    }

    public function showConfigForm()
    {
        dd('showConfigForm'); // Agrega esta línea para depurar
        return view('router.config');
    }

    public function updateConfig(Request $request)
    {
        $nuevoSSID = $request->input('ssid');
        $nuevaContrasena = $request->input('password');

        // Validar $nuevoSSID y $nuevaContrasena (¡IMPORTANTE!)
        $request->validate([
            'ssid' => 'required|string|max:32', // Ejemplo de validación
            'password' => 'required|string|min:8',
        ]);

        try {
            $resultado = $this->cambiarConfiguracionRouter($nuevoSSID, $nuevaContrasena);
            return redirect('/config/router')->with('message', $resultado);
        } catch (\Exception $e) {
            Log::error("Error al cambiar la configuración del router: " . $e->getMessage());
            return redirect('/config/router')->with('error', 'Ocurrió un error al cambiar la configuración.  Revisa los logs del servidor.');
        }
    }

    private static function cambiarConfiguracionRouter($nuevoSSID, $nuevaContrasena)
    {
        $ip = "192.168.10.225";
        $usuario = "root";
        $contrasena = "12345678";

        try {
            $ssh = new SSH2($ip);
            if (!$ssh->login($usuario, $contrasena)) {
                throw new \Exception("No se pudo iniciar sesión por SSH.");
            }

            // ***  CORRECCIÓN DE LA VULNERABILIDAD DE INYECCIÓN DE COMANDOS ***
            $escapedSSID = escapeshellarg($nuevoSSID);
            $escapedPassword = escapeshellarg($nuevaContrasena);

            $comandos = [
                "uci set wireless.@wifi-iface[0].ssid=$escapedSSID",
                "uci set wireless.@wifi-iface[0].key=$escapedPassword",
                "uci commit wireless",
                "wifi" // Reinicia la interfaz wifi
            ];

            foreach ($comandos as $comando) {
                $output = $ssh->exec($comando);
                Log::info("Comando: " . $comando . ", Output: " . $output);
                if (strpos($output, 'command not found') !== false) {
                   throw new \Exception("Comando no encontrado en el router: " . $comando);
                }
            }

            return "Configuración cambiada con éxito.";

        } catch (\Exception $e) {
            Log::error("Error en cambiarConfiguracionRouter: " . $e->getMessage());
            throw $e; // Re-lanza la excepción para que la capture el updateConfig
        }
    }

    public function ssh()
    {
        $ip = "192.168.10.225";
        $usuario = "root";
        $contrasena = "12345678";

        try {
            $ssh = new SSH2($ip);
            if ($ssh->login($usuario, $contrasena)) {
                $output = $ssh->exec('reboot');
                Log::info("Salida del comando reboot: " . $output); // Loggear la salida
                return "Router reiniciando.  Revisa la conexión en unos minutos."; // Mensaje al usuario
            } else {
                throw new \Exception("Falló el inicio de sesión SSH.");
            }
        } catch (\Exception $e) {
            Log::error("Error en la función ssh: " . $e->getMessage());
            return "Error: " . $e->getMessage(); // Mensaje al usuario
        }
    }
}
