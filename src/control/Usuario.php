<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');

$tipo = $_GET['tipo'];

$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();
$objAdmin = new AdminModel();

$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

if ($tipo == "validar_datos_reset_password") {
  $id_email = $_POST['id'];
  $token_email = $_POST['token'];

  $arr_Respuesta = array('status' => false, 'mensaje' => 'Link caducado');
  $datos_usuario = $objUsuario->buscarUsuarioById($id_email);
  if ($datos_usuario->reset_password == 1 && password_verify($datos_usuario->token_password, $token_email)) {
    $arr_Respuesta = array('status' => true, 'mensaje' => 'Ok');
  }
  echo json_encode($arr_Respuesta);
}

if ($tipo == "listar_usuarios_ordenados_tabla") {
  $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
  if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    $pagina = $_POST['pagina'];
    $cantidad_mostrar = $_POST['cantidad_mostrar'];
    $busqueda_tabla_dni = $_POST['busqueda_tabla_dni'];
    $busqueda_tabla_nomap = $_POST['busqueda_tabla_nomap'];
    $busqueda_tabla_estado = $_POST['busqueda_tabla_estado'];

    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $busqueda_filtro = $objUsuario->buscarUsuariosOrderByApellidosNombres_tabla_filtro($busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado);
    $arr_Usuario = $objUsuario->buscarUsuariosOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado);

    $arr_contenido = [];
    if (!empty($arr_Usuario)) {
      for ($i = 0; $i < count($arr_Usuario); $i++) {
        $arr_contenido[$i] = (object)[
          'id' => $arr_Usuario[$i]->id,
          'dni' => $arr_Usuario[$i]->dni,
          'nombres_apellidos' => $arr_Usuario[$i]->nombres_apellidos,
          'correo' => $arr_Usuario[$i]->correo,
          'telefono' => $arr_Usuario[$i]->telefono,
          'estado' => $arr_Usuario[$i]->estado,
          'options' => '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Usuario[$i]->id . '"><i class="fa fa-edit"></i></button>
                                  <button class="btn btn-info" title="Resetear Contraseña" onclick="reset_password(' . $arr_Usuario[$i]->id . ')"><i class="fa fa-key"></i></button>'
        ];
      }
      $arr_Respuesta['total'] = count($busqueda_filtro);
      $arr_Respuesta['status'] = true;
      $arr_Respuesta['contenido'] = $arr_contenido;
    }
  }
  echo json_encode($arr_Respuesta);
}

if ($tipo == "registrar") {
  $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
  if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    if ($_POST) {
      $dni = $_POST['dni'];
      $apellidos_nombres = $_POST['apellidos_nombres'];
      $correo = $_POST['correo'];
      $telefono = $_POST['telefono'];

      if ($dni == "" || $apellidos_nombres == "" || $correo == "" || $telefono == "") {
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
      } else {
        $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
        if ($arr_Usuario) {
          $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Usuario ya se encuentra registrado');
        } else {

          $password = $_POST['password'];

          $pass_secure = password_hash($password, PASSWORD_DEFAULT);


          //  REGISTRAR USUARIO
          $id_usuario = $objUsuario->registrarUsuario($dni, $apellidos_nombres, $correo, $telefono, $pass_secure);

          if ($id_usuario > 0) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso.');
          } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar usuario');
          }
        }
      }
    }
  }
  echo json_encode($arr_Respuesta);
}

if ($tipo == "actualizar") {
  $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
  if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    if ($_POST) {
      $id = $_POST['data'];
      $dni = $_POST['dni'];
      $nombres_apellidos = $_POST['nombres_apellidos'];
      $correo = $_POST['correo'];
      $telefono = $_POST['telefono'];
      $estado = $_POST['estado'];

      if ($id == "" || $dni == "" || $nombres_apellidos == "" || $correo == "" || $telefono == "" || $estado == "") {
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
      } else {
        $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
        if ($arr_Usuario && $arr_Usuario->id != $id) {
          $arr_Respuesta = array('status' => false, 'mensaje' => 'DNI ya está registrado');
        } else {
          $consulta = $objUsuario->actualizarUsuario($id, $dni, $nombres_apellidos, $correo, $telefono, $estado);
          if ($consulta) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
          } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
          }
        }
      }
    }
  }
  echo json_encode($arr_Respuesta);
}

if ($tipo == "reiniciar_password") {
  $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
  if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    $id_usuario = $_POST['id'];
    $password = $objAdmin->generar_llave(10);
    $pass_secure = password_hash($password, PASSWORD_DEFAULT);
    $actualizar = $objUsuario->actualizarPassword($id_usuario, $pass_secure);
    if ($actualizar) {
      $arr_Respuesta = array('status' => true, 'mensaje' => 'Contraseña actualizada correctamente a: ' . $password);
    } else {
      $arr_Respuesta = array('status' => false, 'mensaje' => 'Hubo un problema al actualizar la contraseña, intente nuevamente');
    }
  }
  echo json_encode($arr_Respuesta);
}

if ($tipo == "buscar_usuarios") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_sesion');

    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {

        $usuarios = $objUsuario->obtenerTodosLosUsuarios();

        $arr_Respuesta['status'] = true;
        $arr_Respuesta['msg'] = 'correcto';
        $arr_Respuesta['usuarios'] = $usuarios;
    }

    echo json_encode($arr_Respuesta);
}
