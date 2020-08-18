<?php

// destruimos la session
session_destroy();


// redirigimos a la pagina de loguin
echo '<script>

	window.location = "ingreso";

</script>';
// header("Location:http://localhost/fabio_gonzalez/fg/ingreso");

