<?php 
require ("logica/Persona.php");
require ("logica/Paciente.php");

$filtro = $_GET["filtro"];
$paciente = new Paciente();
$pacientes = $paciente -> buscar($filtro);
if(count($pacientes) > 0){
    echo "<table class='table table-striped table-hover mt-3'>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>";
foreach($pacientes as $pac){
    echo "<tr>";
    echo "<td>" . $pac->getId() . "</td>";

    $palabras = explode(" ", $filtro);

    $nombre = $pac->getNombre();
    $apellido = $pac->getApellido();

    foreach($palabras as $palabra){
        $palabra = trim($palabra);
        if(strlen($palabra) > 0){
            // Resaltar en nombre
            $nombre = preg_replace_callback(
                "/(" . preg_quote($palabra, "/") . ")/i",
                function ($matches) {
                    return "<strong>" . $matches[0] . "</strong>";
                },
                $nombre
            );

            // Resaltar en apellido
            $apellido = preg_replace_callback(
                "/(" . preg_quote($palabra, "/") . ")/i",
                function ($matches) {
                    return "<strong>" . $matches[0] . "</strong>";
                },
                $apellido
            );
        }
    }

    echo "<td>$nombre</td>";
    echo "<td>$apellido</td>";
    echo "<td>" . $pac->getCorreo() . "</td>";
    echo "</tr>";
}

    
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
}
?>
