<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-colegioModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();

//variables de sesion
$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

if ($tipo == "listar_colegios") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_codigo = $_POST['busqueda_tabla_codigo'];
        $busqueda_tabla_nombre = $_POST['busqueda_tabla_nombre'];
        $busqueda_tabla_departamento = $_POST['busqueda_tabla_departamento'];
        $busqueda_tabla_provincia = $_POST['busqueda_tabla_provincia'];
        $busqueda_tabla_distrito = $_POST['busqueda_tabla_distrito'];
        $busqueda_tabla_nivel = $_POST['busqueda_tabla_nivel'];
        $busqueda_tabla_atencion = $_POST['busqueda_tabla_atencion'];
        $busqueda_tabla_gestion = $_POST['busqueda_tabla_gestion'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objColegio->buscarColegios_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_nombre, $busqueda_tabla_departamento, $busqueda_tabla_provincia, $busqueda_tabla_distrito, $busqueda_tabla_nivel, $busqueda_tabla_atencion, $busqueda_tabla_gestion);
        $total_filtro = $objColegio->contarColegios_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_nombre, $busqueda_tabla_departamento, $busqueda_tabla_provincia, $busqueda_tabla_distrito, $busqueda_tabla_nivel, $busqueda_tabla_atencion, $busqueda_tabla_gestion);
        $arr_Colegio = $objColegio->buscarColegios_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo,  $busqueda_tabla_nombre, $busqueda_tabla_departamento, $busqueda_tabla_provincia, $busqueda_tabla_distrito, $busqueda_tabla_nivel, $busqueda_tabla_atencion, $busqueda_tabla_gestion);

        $arr_contenido = [];
        if (!empty($arr_Colegio)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Colegio); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vistaz
                $arr_contenido[$i]->codigo_modular   = $arr_Colegio[$i]->codigo_modular;
                $arr_contenido[$i]->nombre_ie        = $arr_Colegio[$i]->nombre_ie;
                $arr_contenido[$i]->nivel_modalidad  = $arr_Colegio[$i]->nivel_modalidad;
                $arr_contenido[$i]->detalle_nivel    = $arr_Colegio[$i]->detalle_nivel;
                $arr_contenido[$i]->forma_atencion   = $arr_Colegio[$i]->forma_atencion;
                $arr_contenido[$i]->genero_alumnos   = $arr_Colegio[$i]->genero_alumnos;
                $arr_contenido[$i]->gestion          = $arr_Colegio[$i]->gestion;
                $arr_contenido[$i]->dependencia      = $arr_Colegio[$i]->dependencia;
                $arr_contenido[$i]->director         = $arr_Colegio[$i]->director;
                $arr_contenido[$i]->telefono         = $arr_Colegio[$i]->telefono;
                $arr_contenido[$i]->direccion_local  = $arr_Colegio[$i]->direccion_local;
                $arr_contenido[$i]->localidad        = $arr_Colegio[$i]->localidad;
                $arr_contenido[$i]->centro_poblado   = $arr_Colegio[$i]->centro_poblado;
                $arr_contenido[$i]->area_censo       = $arr_Colegio[$i]->area_censo;
                $arr_contenido[$i]->departamento     = $arr_Colegio[$i]->departamento;
                $arr_contenido[$i]->provincia        = $arr_Colegio[$i]->provincia;
                $arr_contenido[$i]->distrito         = $arr_Colegio[$i]->distrito;
                $arr_contenido[$i]->region           = $arr_Colegio[$i]->region;
                $arr_contenido[$i]->ugel             = $arr_Colegio[$i]->ugel;
                $arr_contenido[$i]->turno            = $arr_Colegio[$i]->turno;
                $arr_contenido[$i]->ruc              = $arr_Colegio[$i]->ruc;
                $arr_contenido[$i]->razon_social     = $arr_Colegio[$i]->razon_social;
                $arr_contenido[$i]->estado           = $arr_Colegio[$i]->estado;
                $arr_contenido[$i]->total_secciones  = $arr_Colegio[$i]->total_secciones;

                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Colegio[$i]->codigo_modular . '"><i class="fa fa-edit"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = $total_filtro;
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}