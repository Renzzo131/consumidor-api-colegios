function numero_pagina(pagina) {
    document.getElementById('pagina').value = pagina;
    listar_colegios();
}
async function datos_form() {
    try {
        mostrarPopupCarga();
        // capturamos datos del formulario html
        const datos = new FormData();
        datos.append('sesion', session_session);
        datos.append('token', token_token);
        datos.append('ies', session_ies);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=datos_registro', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            listar_usuarios(json.contenido);
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        }
        //console.log(json);
    } catch (e) {
        console.log("Oops, ocurrio un error " + e);
    } finally {
        ocultarPopupCarga();
    }
}
function listar_usuarios(contenido, elemento = 'beneficiario', usuario = 0) {
    try {
        let contenido_select = '<option value="">Seleccione</option>';
        if (Array.isArray(contenido)) {
            contenido.forEach(usuario => {
                contenido_select += '<option value="' + usuario.id + '">' + usuario.nombre + '</option>';
            });
            document.getElementById(elemento).innerHTML = contenido_select;
        }

    } catch (error) {
        console.log("ocurrio un error al listar sedes " + error);
    }

}
async function listar_colegios() {
    
    try {
        mostrarPopupCarga();
        // para filtro
        let pagina = document.getElementById('pagina').value;
        let cantidad_mostrar = document.getElementById('cantidad_mostrar').value;
        let busqueda_tabla_codigo = document.getElementById('busqueda_tabla_codigo').value;
        let busqueda_tabla_nombre = document.getElementById('busqueda_tabla_nombre').value;
        let busqueda_tabla_departamento = document.getElementById('busqueda_tabla_departamento').value;
        let busqueda_tabla_provincia = document.getElementById('busqueda_tabla_provincia').value;
        let busqueda_tabla_distrito = document.getElementById('busqueda_tabla_distrito').value;
        let busqueda_tabla_nivel = document.getElementById('busqueda_tabla_nivel').value;
        let busqueda_tabla_atencion = document.getElementById('busqueda_tabla_atencion').value;
        let busqueda_tabla_gestion = document.getElementById('busqueda_tabla_gestion').value;
        // asignamos valores para guardar
        document.getElementById('filtro_codigo_modular').value = busqueda_tabla_codigo;
        document.getElementById('filtro_nombre').value = busqueda_tabla_nombre;
        document.getElementById('filtro_departamento').value = busqueda_tabla_departamento;
        document.getElementById('filtro_provincia').value = busqueda_tabla_provincia;
        document.getElementById('filtro_distrito').value = busqueda_tabla_distrito;
        document.getElementById('filtro_nivel').value = busqueda_tabla_nivel;
        document.getElementById('filtro_atencion').value = busqueda_tabla_atencion;
        document.getElementById('filtro_gestion').value = busqueda_tabla_gestion;
        // generamos el formulario
        const formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('cantidad_mostrar', cantidad_mostrar);
        formData.append('busqueda_tabla_codigo', busqueda_tabla_codigo);
        formData.append('busqueda_tabla_nombre', busqueda_tabla_nombre);
        formData.append('busqueda_tabla_departamento', busqueda_tabla_departamento);
        formData.append('busqueda_tabla_provincia', busqueda_tabla_provincia);
        formData.append('busqueda_tabla_distrito', busqueda_tabla_distrito);
        formData.append('busqueda_tabla_nivel', busqueda_tabla_nivel);
        formData.append('busqueda_tabla_atencion', busqueda_tabla_atencion);
        formData.append('busqueda_tabla_gestion', busqueda_tabla_gestion);
        formData.append('sesion', session_session);
        formData.append('token', token_token);
        //enviar datos hacia el controlador
        let respuesta = await fetch(base_url_server + 'src/control/Colegio.php?tipo=listar_colegios', {
            method: 'POST',
            body: formData
        });

        let json = await respuesta.json();
        document.getElementById('tablas').innerHTML = `<table id="" class="table dt-responsive" width="100%">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Código Modular</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Provincia</th>
                            <th>Distrito</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido_tabla">
                    </tbody>
                </table>`;
        document.querySelector('#modals_editar').innerHTML = ``;
        if (json.status) {
            let datos = json.contenido;
            datos.forEach(item => {
                generarfilastabla(item);
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            document.getElementById('tablas').innerHTML = `no se encontraron resultados`;
        }
        let paginacion = generar_paginacion(json.total, cantidad_mostrar);
        let texto_paginacion = generar_texto_paginacion(json.total, cantidad_mostrar);
        document.getElementById('texto_paginacion_tabla').innerHTML = texto_paginacion;
        document.getElementById('lista_paginacion_tabla').innerHTML = paginacion;
        //console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar colegios" + e);
    } finally {
        ocultarPopupCarga();
    }
}
function generarfilastabla(item) {
    let cont = document.querySelectorAll(".filas_tabla").length + 1;

    // Crear fila en tabla
    let nueva_fila = document.createElement("tr");
    nueva_fila.id = "fila" + item.codigo_modular;
    nueva_fila.className = "filas_tabla";
    nueva_fila.innerHTML = `
        <th>${cont}</th>
        <td>${item.codigo_modular}</td>
        <td>${item.nombre_ie}</td>
        <td>${item.departamento}</td>
        <td>${item.provincia}</td>
        <td>${item.distrito}</td>
        <td>
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target=".modal_editar${item.codigo_modular}">
                Editar
            </button>
        </td>
    `;
    document.querySelector('#contenido_tabla').appendChild(nueva_fila);

    // Crear modal de edición por cada colegio
    document.querySelector('#modals_editar').innerHTML += `
    <div class="modal fade modal_editar${item.codigo_modular}" tabindex="-1" role="dialog" aria-labelledby="modalLabel${item.codigo_modular}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title h4" id="modalLabel${item.codigo_modular}">Editar Centro Educativo</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
    <form id="frmActualizar${item.codigo_modular}">
        <div class="row">
            <div class="col-md-6">
                <label>Código Modular</label>
                <input type="text" class="form-control mb-2" name="codigo_modular" id="codigo_modular${item.codigo_modular}" value="${item.codigo_modular}" readonly>

                <label>Nombre IE</label>
                <input type="text" class="form-control mb-2" name="nombre_ie" id="nombre_ie${item.codigo_modular}" value="${item.nombre_ie}">

                <label>Nivel / Modalidad</label>
                <input type="text" class="form-control mb-2" name="nivel_modalidad" id="nivel_modalidad${item.codigo_modular}" value="${item.nivel_modalidad}">

                <label>Detalle Nivel</label>
                <input type="text" class="form-control mb-2" name="detalle_nivel" id="detalle_nivel${item.codigo_modular}" value="${item.detalle_nivel}">

                <label>Forma de Atención</label>
                <input type="text" class="form-control mb-2" name="forma_atencion" id="forma_atencion${item.codigo_modular}" value="${item.forma_atencion}">

                <label>Género de Alumnos</label>
                <input type="text" class="form-control mb-2" name="genero_alumnos" id="genero_alumnos${item.codigo_modular}" value="${item.genero_alumnos}">

                <label>Gestión</label>
                <input type="text" class="form-control mb-2" name="gestion" id="gestion${item.codigo_modular}" value="${item.gestion}">

                <label>Dependencia</label>
                <input type="text" class="form-control mb-2" name="dependencia" id="dependencia${item.codigo_modular}" value="${item.dependencia}">
            </div>

            <div class="col-md-6">
                <label>Director</label>
                <input type="text" class="form-control mb-2" name="director" id="director${item.codigo_modular}" value="${item.director}">

                <label>Teléfono</label>
                <input type="text" class="form-control mb-2" name="telefono" id="telefono${item.codigo_modular}" value="${item.telefono}">

                <label>Dirección Local</label>
                <input type="text" class="form-control mb-2" name="direccion_local" id="direccion_local${item.codigo_modular}" value="${item.direccion_local}">

                <label>Localidad</label>
                <input type="text" class="form-control mb-2" name="localidad" id="localidad${item.codigo_modular}" value="${item.localidad}">

                <label>Centro Poblado</label>
                <input type="text" class="form-control mb-2" name="centro_poblado" id="centro_poblado${item.codigo_modular}" value="${item.centro_poblado}">

                <label>Área Censo</label>
                <input type="text" class="form-control mb-2" name="area_censo" id="area_censo${item.codigo_modular}" value="${item.area_censo}">

                <label>Departamento</label>
                <input type="text" class="form-control mb-2" name="departamento" id="departamento${item.codigo_modular}" value="${item.departamento}">

                <label>Provincia</label>
                <input type="text" class="form-control mb-2" name="provincia" id="provincia${item.codigo_modular}" value="${item.provincia}">

                <label>Distrito</label>
                <input type="text" class="form-control mb-2" name="distrito" id="distrito${item.codigo_modular}" value="${item.distrito}">
            </div>

            <div class="col-md-6 mt-3">
                <label>Región</label>
                <input type="text" class="form-control mb-2" name="region" id="region${item.codigo_modular}" value="${item.region}">

                <label>UGEL</label>
                <input type="text" class="form-control mb-2" name="ugel" id="ugel${item.codigo_modular}" value="${item.ugel}">

                <label>Turno</label>
                <input type="text" class="form-control mb-2" name="turno" id="turno${item.codigo_modular}" value="${item.turno}">

                <label>RUC</label>
                <input type="text" class="form-control mb-2" name="ruc" id="ruc${item.codigo_modular}" value="${item.ruc}">

                <label>Razón Social</label>
                <input type="text" class="form-control mb-2" name="razon_social" id="razon_social${item.codigo_modular}" value="${item.razon_social}">
            </div>

            <div class="col-md-6 mt-3">
                <label>Estado</label>
                <input type="text" class="form-control mb-2" name="estado" id="estado${item.codigo_modular}" value="${item.estado}">

                <label>Total de Secciones</label>
                <input type="text" class="form-control mb-2" name="total_secciones" id="total_secciones${item.codigo_modular}" value="${item.total_secciones}">
            </div>
        </div>

        <div class="form-group mb-0 justify-content-end row text-center mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="actualizarColegio('${item.codigo_modular}')">Actualizar</button>
            </div>
        </div>
    </form>
</div>

            </div>
        </div>
    </div>`;
}

async function registrar_centro_educativo() {
    // Capturamos todos los campos del formulario (id's según el formulario que generamos)
    let codigo_modular   = document.getElementById('codigo_modular').value.trim();
    let nombre_ie        = document.getElementById('nombre_ie').value.trim();
    let nivel_modalidad  = document.getElementById('nivel_modalidad').value.trim();
    let detalle_nivel    = document.getElementById('detalle_nivel').value.trim();
    let forma_atencion   = document.getElementById('forma_atencion').value.trim();
    let genero_alumnos   = document.getElementById('genero_alumnos').value.trim();
    let gestion          = document.getElementById('gestion').value.trim();
    let dependencia      = document.getElementById('dependencia').value.trim();
    let director         = document.getElementById('director').value.trim();
    let telefono         = document.getElementById('telefono').value.trim();
    let direccion_local  = document.getElementById('direccion_local').value.trim();
    let localidad        = document.getElementById('localidad').value.trim();
    let centro_poblado   = document.getElementById('centro_poblado').value.trim();
    let area_censo       = document.getElementById('area_censo').value.trim();
    let departamento     = document.getElementById('departamento').value.trim();
    let provincia        = document.getElementById('provincia').value.trim();
    let distrito         = document.getElementById('distrito').value.trim();
    let region           = document.getElementById('region').value.trim();
    let ugel             = document.getElementById('ugel').value.trim();
    let turno            = document.getElementById('turno').value.trim();
    let ruc              = document.getElementById('ruc').value.trim();
    let razon_social     = document.getElementById('razon_social').value.trim();
    let estado           = document.getElementById('estado').value.trim();
    let total_secciones  = document.getElementById('total_secciones').value;

    // VALIDACIÓN: campos que consideramos obligatorios (ajusta según requieras)
    if (codigo_modular === "" || total_secciones === "" ||   razon_social === "" ||   ruc === "" ||   turno === "" ||   ugel === "" ||   region === "" ||   provincia === "" ||   departamento === "" ||   area_censo === "" ||   centro_poblado === "" ||   localidad === "" ||   direccion_local === "" ||  telefono === "" ||  director === "" ||  dependencia === "" ||  gestion === "" ||  genero_alumnos === "" || forma_atencion === "" || detalle_nivel === "" || nombre_ie === "" || nivel_modalidad === "" || distrito === "" || estado === "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Por favor complete los campos obligatorios: Código Modular, Nombre de la IE, Nivel/Modalidad, Distrito y Estado.',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: ''
        });
        return;
    }

    try {
        // Tomamos el form (por si hay inputs no listados) y creamos FormData
        const datos = new FormData(frmRegistrarCentroEducativo);

        // Aseguramos que todos los campos principales estén presentes en FormData
        datos.set('codigo_modular', codigo_modular);
        datos.set('nombre_ie', nombre_ie);
        datos.set('nivel_modalidad', nivel_modalidad);
        datos.set('detalle_nivel', detalle_nivel);
        datos.set('forma_atencion', forma_atencion);
        datos.set('genero_alumnos', genero_alumnos);
        datos.set('gestion', gestion);
        datos.set('dependencia', dependencia);
        datos.set('director', director);
        datos.set('telefono', telefono);
        datos.set('direccion_local', direccion_local);
        datos.set('localidad', localidad);
        datos.set('centro_poblado', centro_poblado);
        datos.set('area_censo', area_censo);
        datos.set('departamento', departamento);
        datos.set('provincia', provincia);
        datos.set('distrito', distrito);
        datos.set('region', region);
        datos.set('ugel', ugel);
        datos.set('turno', turno);
        datos.set('ruc', ruc);
        datos.set('razon_social', razon_social);
        datos.set('estado', estado);
        datos.set('total_secciones', total_secciones);

        // Añadimos sesión y token (mismo patrón que en tu función original)
        datos.append('sesion', session_session);
        datos.append('token', token_token);

        // Enviar datos hacia el controlador (ajusta la URL si tu ruta es otra)
        let respuesta = await fetch(base_url_server + 'src/control/Colegio.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
console.log("Session:", session_session, "Token:", token_token);

        if (json.status) {
            document.getElementById("frmRegistrarCentroEducativo").reset();
            Swal.fire({
                type: 'success',
                title: 'Registro Exitoso',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });
        } else if (json.msg === "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });
        }

    } catch (e) {
        console.log("Oops, ocurrió un error: " + e);
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Ocurrió un error al intentar registrar. Revisa la consola.',
            confirmButtonClass: 'btn btn-confirm mt-2'
        });
    }
}


async function actualizarInstitucion(id) {
    let beneficiario = document.getElementById('beneficiario' + id).value;
    let cod_modular = document.getElementById('cod_modular' + id).value;
    let ruc = document.querySelector('#ruc' + id).value;
    let nombre = document.querySelector('#nombre' + id).value;
    if (cod_modular == "" || ruc == "" || nombre == "" || beneficiario == "") {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...',
            confirmButtonClass: 'btn btn-confirm mt-2',
            footer: '',
            timer: 1000
        })
        return;
    }
    const formulario = document.getElementById('frmActualizar' + id);
    const datos = new FormData(formulario);
    datos.append('data', id);
    datos.append('sesion', session_session);
    datos.append('token', token_token);
    try {
        let respuesta = await fetch(base_url_server + 'src/control/Institucion.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            $('.modal_editar' + id).modal('hide');
            Swal.fire({
                type: 'success',
                title: 'Actualizar',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                footer: '',
                timer: 1000
            })
        }
        //console.log(json);
    } catch (e) {
        console.log("Error al actualizar periodo" + e);
    }

}

async function actualizarColegio(codigo_modular) {
    // Captura de valores desde el formulario
    let nombre_ie = document.getElementById('nombre_ie' + codigo_modular).value;
    let nivel_modalidad = document.getElementById('nivel_modalidad' + codigo_modular).value;
    let detalle_nivel = document.getElementById('detalle_nivel' + codigo_modular).value;
    let forma_atencion = document.getElementById('forma_atencion' + codigo_modular).value;
    let genero_alumnos = document.getElementById('genero_alumnos' + codigo_modular).value;
    let gestion = document.getElementById('gestion' + codigo_modular).value;
    let dependencia = document.getElementById('dependencia' + codigo_modular).value;
    let director = document.getElementById('director' + codigo_modular).value;
    let telefono = document.getElementById('telefono' + codigo_modular).value;
    let direccion_local = document.getElementById('direccion_local' + codigo_modular).value;
    let localidad = document.getElementById('localidad' + codigo_modular).value;
    let centro_poblado = document.getElementById('centro_poblado' + codigo_modular).value;
    let area_censo = document.getElementById('area_censo' + codigo_modular).value;
    let departamento = document.getElementById('departamento' + codigo_modular).value;
    let provincia = document.getElementById('provincia' + codigo_modular).value;
    let distrito = document.getElementById('distrito' + codigo_modular).value;
    let region = document.getElementById('region' + codigo_modular).value;
    let ugel = document.getElementById('ugel' + codigo_modular).value;
    let turno = document.getElementById('turno' + codigo_modular).value;
    let ruc = document.getElementById('ruc' + codigo_modular).value;
    let razon_social = document.getElementById('razon_social' + codigo_modular).value;
    let estado = document.getElementById('estado' + codigo_modular).value;
    let total_secciones = document.getElementById('total_secciones' + codigo_modular).value;

    // Validación básica
    if (
        nombre_ie == "" || nivel_modalidad == "" || detalle_nivel == "" || forma_atencion == "" ||
        genero_alumnos == "" || gestion == "" || dependencia == "" || director == "" ||
        telefono == "" || direccion_local == "" || localidad == "" || centro_poblado == "" ||
        area_censo == "" || departamento == "" || provincia == "" || distrito == "" ||
        region == "" || ugel == "" || turno == "" || ruc == "" || razon_social == "" ||
        estado == "" || total_secciones == ""
    ) {
        Swal.fire({
            type: 'error',
            title: 'Error',
            text: 'Campos vacíos...',
            confirmButtonClass: 'btn btn-confirm mt-2',
            timer: 1200
        });
        return;
    }

    // Obtener el formulario
    const formulario = document.getElementById('frmActualizar' + codigo_modular);
    const datos = new FormData(formulario);
    datos.append('data', codigo_modular);
    datos.append('sesion', session_session);
    datos.append('token', token_token);

    try {
        let respuesta = await fetch(base_url_server + 'src/control/Colegio.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            $('.modal_editar' + codigo_modular).modal('hide');
            Swal.fire({
                type: 'success',
                title: 'Actualizado',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1200
            });
        } else if (json.msg == "Error_Sesion") {
            alerta_sesion();
        } else {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1200
            });
        }
    } catch (e) {
        console.log("Error al actualizar colegio: " + e);
    }
}
