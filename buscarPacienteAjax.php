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
        echo "<td>" . $pac -> getId() . "</td>";
        echo "<td>" . str_ireplace($filtro, "<strong>" . substr($pac -> getNombre(), stripos($pac -> getNombre(), $filtro), strlen($filtro)) . "</strong>", $pac -> getNombre()) . "</td>";
        echo "<td>" . str_ireplace($filtro, "<strong>" . substr($pac -> getApellido(), stripos($pac -> getApellido(), $filtro), strlen($filtro)) . "</strong>", $pac -> getApellido()) . "</td>";
        echo "<td>" . $pac -> getCorreo() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
}
?>
