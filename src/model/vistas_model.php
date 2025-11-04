<?php
class vistaModelo
{
    protected static function obtener_vista($vista)
    {

        $palabras_permitidas_n1 = ['inicio', 'api-client', 'nuevo-colegio', 'colegios', 'api-request', 'api-token', 'new-api-client', 'new-api-token', 'usuarios', 'nuevo-usuario'];

        if (in_array($vista, $palabras_permitidas_n1)) {

            if (is_file("./src/view/" . $vista . ".php")) {
                $contenido = "./src/view/" . $vista . ".php";
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "inicio" || $vista == "index" ) {
            $contenido = "inicio.php";
        } elseif ($vista == "login") {
            $contenido = "login";
        } elseif ($vista == "reset-password" ) {
            $contenido = "reset-password";
        } else {
            $contenido = "404";
        }

        return $contenido;
    }
}
