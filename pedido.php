<?php
$producto = isset($_GET['producto']) ? $_GET['producto'] : '';
$precio = 0;

// Definir precios de los productos
$precios = [
    "Café" => 1.00,
    "Café Americano" => 2.00,
    "Capuchino" => 2.00,
    "Chocolate" => 2.00,
    "Flan" => 2.50,
    "Donas" => 3.00,
    "Torta Tres Leches" => 3.00,
    "Frapecafe" => 3.00,
    "Pan de Yema" => 3.00,
    "Pastel de Chocolate" => 1.50
];

if(array_key_exists($producto, $precios)){
    $precio = $precios[$producto];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido - <?php echo htmlspecialchars($producto); ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5 " style="max-width: 400px;">
    <h2 class="mb-4">Formulario de Pedido</h2>
    <form action="procesar_pedido.php" method="POST">
        <input type="hidden" name="producto" value="<?php echo htmlspecialchars($producto); ?>">
        <input type="hidden" name="precio" value="<?php echo $precio; ?>">

        <div class="mb-2">
            <label class="form-label">Producto</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($producto); ?>" disabled>
        </div>

        <div class="mb-2">
            <label class="form-label">Precio ($)</label>
            <input type="text" class="form-control" value="<?php echo $precio; ?>" disabled>
        </div>

        <div class="mb-2">
            <label class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="1" min="1" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre_cliente" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Realizar Pedido</button>
    </form>
</div>
</body>
</html>
