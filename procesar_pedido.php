<?php
$conn = new mysqli("localhost","root","","cafedonpepe");
if($conn->connect_error){ die("Conexión fallida: " . $conn->connect_error); }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("INSERT INTO pedidos (producto, precio, cantidad, nombre_cliente, direccion, telefono) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdisss", $producto, $precio, $cantidad, $nombre_cliente, $direccion, $telefono);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: pedido_confirmacion.php?producto=".urlencode($producto));
exit();
?>
