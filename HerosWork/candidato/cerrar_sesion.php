<!-- Modifica la ruta en la solicitud AJAX -->
<script>
    function cerrarSesion() {
        // Realiza una solicitud al servidor para cerrar la sesión
        var xhr = new XMLHttpRequest();
        // Ajusta la ruta según la ubicación de cerrar_sesion.php
        xhr.open("GET", "cerrar_sesion.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Redirige al index después de cerrar la sesión
                window.location.href = '../index.php';
            }
        };
        xhr.send();
    }
</script>
