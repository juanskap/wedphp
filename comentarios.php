<?php
$conn = new mysqli("localhost","root","","cafedonpepe");
if($conn->connect_error){ die("Conexión fallida: " . $conn->connect_error); }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];

    $stmt = $conn->prepare("INSERT INTO comentarios (nombre, email, comentario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $comentario);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: index.php#comentarios");
exit();
?>

