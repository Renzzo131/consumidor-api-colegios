async function llamar_api() {
    const formulario = document.getElementById('frmApi');
    const datos = new FormData(formulario);
    let ruta_api = document.getElementById('ruta_api').value;
    try {
        let respuesta = await fetch(ruta_api+'/src/control/Api-request.php?tipo=verColegioApiByDistrito', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        let contenidosss = '';
        let cont=0;
        json.contenido.forEach(Element => {
            cont++;
            contenidosss+="<tr>";
            contenidosss+="<td>"+cont+"</td>";
            contenidosss+="<td>"+Element.codigo_modular+"</td>";
            contenidosss+="<td>"+Element.nombre_ie+"</td>";
            contenidosss+="<td>"+Element.departamento+"</td>";
            contenidosss+="<td>"+Element.provincia+"</td>";
            contenidosss+="<td>"+Element.distrito+"</td>";
            contenidosss+="</tr>";
        });
        document.getElementById('contenido').innerHTML = contenidosss;
    } catch (error) {
        console.log('Error:', error);
    }
}