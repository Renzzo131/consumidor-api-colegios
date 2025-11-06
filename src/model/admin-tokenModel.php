<?php
require_once "../library/conexion.php";

class TokenModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function verificar_sesion_si_activa($id_sesion, $token)
    {
        $hora_actuals = date("Y-m-d H:i:s");
        $hora_actual = strtotime('-1 minute', strtotime($hora_actuals));
        $hora_actual = date("Y-m-d H:i:s", $hora_actual);

        $b_sesion = $this->conexion->query("SELECT * FROM sesiones WHERE id='$id_sesion'");
        $datos_sesion = $b_sesion->fetch_object();

        $fecha_hora_fin_sesion = $datos_sesion->fecha_hora_fin;

        $fecha_hora_fin = strtotime('+8 hour', strtotime($fecha_hora_fin_sesion));
        $fecha_hora_fin = date("Y-m-d H:i:s", $fecha_hora_fin);

        if ((password_verify($datos_sesion->token, $token)) && ($hora_actual <= $fecha_hora_fin)) {
            // actualizar fecha de sesion
            $hora_actual = date("Y-m-d H:i:s");
            $nueva_fecha_hora_fin = strtotime('+1 minute', strtotime($hora_actual));
            $nueva_fecha_hora_fin = date("Y-m-d H:i:s", $nueva_fecha_hora_fin);

            $this->conexion->query("UPDATE sesiones SET fecha_hora_fin='$nueva_fecha_hora_fin' WHERE id=$id_sesion");
            return 1;
        } else {
            return 0;
        }
    }

    public function buscarToken()
    {
        $sql = $this->conexion->query("SELECT * FROM tokens");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function actualizarToken($token)
    {
        $stmt = $this->conexion->prepare("UPDATE tokens SET token = ?");
        $stmt->bind_param("s", $token);
        return $stmt->execute();
    }
}
