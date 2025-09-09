<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $mensaje = $conn->real_escape_string($_POST['mensaje']);

    $sql = "INSERT INTO comentarios (nombre, correo, mensaje) VALUES ('$nombre','$correo','$mensaje')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php#comentarios");
        exit();
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
$conn->close();
?>
