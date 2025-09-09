<?php
$producto = isset($_GET['producto']) ? $_GET['producto'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido Confirmado</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5 text-center">
    <h2>¡Tu pedido ha sido realizado!</h2>
    <p>Gracias por ordenar: <strong><?php echo htmlspecialchars($producto); ?></strong></p>
    <a href="index.php" class="btn btn-success mt-3">Volver al Inicio</a>
</div>
</body>
</html>
