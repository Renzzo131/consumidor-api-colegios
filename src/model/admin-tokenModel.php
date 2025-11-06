<?php
class AdminTokenModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerToken() {
        $sql = $this->conexion->query("SELECT token FROM tokens LIMIT 1");
        $data = $sql->fetch_assoc();
        return $data ? $data['token'] : null;
    }

    public function actualizarToken($token) {
        // Si solo hay una fila, basta con actualizar toda la tabla
        $stmt = $this->conexion->prepare("UPDATE tokens SET token = ?");
        $stmt->bind_param("s", $token);
        return $stmt->execute();
    }
}
