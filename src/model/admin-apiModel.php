

    <?php
require_once "../library/conexion.php";

class ApiModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
        public function obtenerToken() {
        $sql = "SELECT token FROM tokens LIMIT 1";
        $result = $this->conexion->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            return $row['token'];
        }

        return null;
    }

}