async function llamar_api() {
  const formulario = document.getElementById('frmApi');
  const datos = new FormData(formulario);

  try {
    // Llamada a tu controlador local (no a la API remota)
    let respuesta = await fetch('src/control/Api-request.php', {
      method: 'POST',
      body: datos
    });

    let json = await respuesta.json();

    if (!json.status) {
      console.error("Error desde el servidor:", json.msg);
      alert("⚠️ " + json.msg);
      return;
    }

    let contenido = '';
    let cont = 0;

    json.contenido.forEach(element => {
      cont++;
      contenido += `
        <tr>
          <td>${cont}</td>
          <td>${element.codigo_modular}</td>
          <td>${element.nombre_ie}</td>
          <td>${element.departamento}</td>
          <td>${element.provincia}</td>
          <td>${element.distrito}</td>
        </tr>
      `;
    });

    document.getElementById('contenido').innerHTML = contenido;

  } catch (error) {
    console.log('Error:', error);
    alert('Error al conectar con el servidor local.');
  }
}
