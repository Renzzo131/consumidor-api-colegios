async function mostrar_token() {
    try {
        const response = await fetch(base_url_server + 'src/control/Token.php?tipo=mostrar_token');
        const data = await response.json();

        if (data.status) {
            document.getElementById('token_usuario').value = data.token || '---';
        } else {
            document.getElementById('token_usuario').value = 'No disponible';
        }
    } catch (error) {
        console.error("Error al obtener el token:", error);
        document.getElementById('token_usuario').value = 'Error al cargar token';
    }
}

async function actualizar_token() {
    try {
        const response = await fetch(base_url_server + 'src/control/Token.php?tipo=actualizar_token');
        const data = await response.json();

        if (data.status) {
            document.getElementById('token_usuario').value = data.token;
            alert("Token actualizado correctamente");
        } else {
            alert("No se pudo actualizar el token");
        }
    } catch (error) {
        console.error("Error al actualizar el token:", error);
    }
}
