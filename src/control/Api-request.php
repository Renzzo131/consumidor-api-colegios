<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/../model/admin-apiModel.php');



// Instancia del modelo
$objToken = new ApiModel();
$token = $objToken->obtenerToken();

if (!$token) {
    echo json_encode(['status' => false, 'msg' => 'No se encontró token activo en la base de datos']);
    exit;
}

$distrito = $_POST['data'] ?? '';

if (empty($distrito)) {
    echo json_encode(['status' => false, 'msg' => 'Debe ingresar un distrito']);
    exit;
}

// URL de la API real
$url_api = "https://apicolegios.serviciosvirtuales.com.pe/src/control/Api-request.php?tipo=verColegioApiByDistrito";

// Datos para enviar
$postData = [
    'token' => $token,
    'data' => $distrito
];

// Inicializa cURL
$ch = curl_init($url_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Ejecuta la solicitud
$respuesta = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(['status' => false, 'msg' => 'Error en cURL: ' . $err]);
} else {
    echo $respuesta;
}
