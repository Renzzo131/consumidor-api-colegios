<?php
require_once(__DIR__ . '/../model/admin-tokenModel.php');
require_once(__DIR__ . '/../library/conexion.php');

class Token {
    private $modelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->modelo = new AdminTokenModel($conexion->connect());
    }

    // 🔹 Mostrar token guardado en la BD local
    public function mostrar_token() {
        $token = $this->modelo->obtenerToken();
        if ($token) {
            echo json_encode(['status' => true, 'token' => $token]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'No hay token guardado']);
        }
    }

    // 🔹 Llamar a la API para obtener el token del cliente con ID específico
    public function actualizar_token() {
        // Cambia este valor según el cliente que quieres consultar
        $id_cliente = 1; // ← aquí defines el cliente (puede venir por $_GET o $_POST)

        // URL real de tu API
        $url = "https://apicolegios.serviciosvirtuales.com.pe/src/control/ApiRequest.php?tipo=obtener_token&id=" . $id_cliente;

        // Llamada con cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Validar si la API devolvió correctamente el token
        if ($data && isset($data['token'])) {
            $token = $data['token'];

            // Guardar token en BD local
            $ok = $this->modelo->actualizarToken($token);

            if ($ok) {
                echo json_encode(['status' => true, 'token' => $token]);
            } else {
                echo json_encode(['status' => false, 'msg' => 'Error al guardar token']);
            }
        } else {
            echo json_encode(['status' => false, 'msg' => 'No se recibió token desde la API']);
        }
    }
}

// --- Enrutador ---
if (isset($_GET['tipo'])) {
    $obj = new Token();

    switch ($_GET['tipo']) {
        case 'mostrar_token':
            $obj->mostrar_token();
            break;

        case 'actualizar_token':
            $obj->actualizar_token();
            break;

        default:
            echo json_encode(['status' => false, 'msg' => 'Tipo no válido']);
    }
}
