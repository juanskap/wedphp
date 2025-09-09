<?php
$conn = new mysqli("localhost", "root", "", "cafedonpepe");
if ($conn->connect_error) { die("Conexión fallida: " . $conn->connect_error); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe Don Pepe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style> body { background-color: #81C784; } </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container bg-success">
    <a class="navbar-brand fw-bold" href="#">☕ Cafe Don Pepe</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#inicio">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#menu">Menú</a></li>
        <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<header id="inicio" class="position-relative text-center text-white">
  <img src="imagenes/inicio.jpg" class="img-fluid w-100" style="height:100vh; object-fit:cover;" alt="Hero Café">
  <div class="position-absolute top-50 start-50 translate-middle">
    <h1 class="display-4 fw-bold">Cafe Don Pepe</h1>
    <p class="lead mt-3">Disfruta de nuestros platos y postres en un ambiente acogedor.<br>Tu sabor favorito, a un click de distancia.<br>Momentos de felicidad, entregados en tu mesa.</p>
    <a href="#menu" class="btn btn-primary btn-lg mt-2"><strong>Pide Ya</strong></a>
  </div>
</header>

<!-- Menú -->
<section class="py-5" id="menu">
  <div class="container">
    <h2 class="text-center mb-4">Nuestro Menú</h2>
    <div class="row g-4">
      <?php
      $productos = [
        ["nombre" => "Café", "precio" => 1.00, "imagen" => "imagenes/cafe_coffee.JPG"],
        ["nombre" => "Café Americano", "precio" => 2.00, "imagen" => "imagenes/Cafe-americano-portada-1200x828.webp"],
        ["nombre" => "Capuchino", "precio" => 2.00, "imagen" => "imagenes/Cappuccino_PeB.jpg"],
        ["nombre" => "Chocolate", "precio" => 2.00, "imagen" => "imagenes/chocolate.jpg"],
        ["nombre" => "Flan", "precio" => 2.50, "imagen" => "imagenes/flan.jpg"],
        ["nombre" => "Donas", "precio" => 3.00, "imagen" => "imagenes/donas.jpg"],
        ["nombre" => "Torta Tres Leches", "precio" => 3.00, "imagen" => "imagenes/torta_tres_leches_8910_orig.jpg"],
        ["nombre" => "Frapecafe", "precio" => 3.00, "imagen" => "imagenes/frape.jpg"],
        ["nombre" => "Pan de Yema", "precio" => 3.00, "imagen" => "imagenes/-pan-de-yema.jpg"],
        ["nombre" => "Pastel de Chocolate", "precio" => 1.50, "imagen" => "imagenes/pasteldecho.jpg"]
      ];

      foreach ($productos as $p) {
        echo '<div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                  <img src="'.$p['imagen'].'" class="card-img-top" alt="'.$p['nombre'].'">
                  <div class="card-body text-center">
                    <h5 class="card-title">'.$p['nombre'].'</h5>
                    <p class="card-text">$'.$p['precio'].'</p>
                    <a href="pedido.php?producto='.urlencode($p['nombre']).'" class="btn btn-primary">Comprar</a>
                  </div>
                </div>
              </div>';
      }
      ?>
    </div>
  </div>
</section>

<!-- Nosotros -->
<section class="bg-light py-5" id="nosotros">
  <div class="container text-center">
    <h2>Sobre Nosotros</h2>
    <p class="mt-3">Somos una cafetería acogedora que combina el aroma del mejor café artesanal con un ambiente único.<br> Nuestro objetivo es crear experiencias que endulcen tu día.</p>
  </div>
</section>

<!-- Sección Comentarios -->
<section class="py-5 bg-light" id="comentarios">
  <div class="container">
    <h2 class="text-center mb-4">💬 Opiniones de Nuestros Clientes</h2>
    <div class="row">
      <div class="col-lg-8 mb-4">
        <?php
        $res = $conn->query("SELECT nombre, comentario, fecha FROM comentarios ORDER BY fecha DESC");
        if($res->num_rows > 0){
          while($row = $res->fetch_assoc()){
            echo '<div class="card shadow-sm mb-3">
                    <div class="card-body">
                      <h6 class="fw-bold">'.htmlspecialchars($row["nombre"]).' <small class="text-muted">- '.date("d/m/Y", strtotime($row["fecha"])).'</small></h6>
                      <p>'.htmlspecialchars($row["comentario"]).'</p>
                    </div>
                  </div>';
          }
        } else {
          echo "<p>No hay comentarios todavía. ¡Sé el primero en comentar!</p>";
        }
        ?>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title mb-3">Deja tu comentario</h5>
            <form action="comentarios.php" method="POST">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
              <label class="form-label mt-3">Correo electrónico</label>
              <input type="email" name="email" class="form-control" placeholder="tu@correo.com" required>
              <label class="form-label mt-3">Comentario</label>
              <textarea name="comentario" class="form-control" rows="4" placeholder="Escribe tu comentario..." required></textarea>
              <button type="submit" class="btn btn-success w-100 mt-3">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contacto -->
<section class="py-5" id="contacto">
  <div class="container text-center">
    <h2>Contáctanos</h2>
    <p>📍 Dirección: Guaranda-Alpachaca</p>
    <p>📞 Teléfono: +593 939858902</p>
    <p>✉️ Email: contacto@cafedonpepe.com</p>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-4">
  <p class="mb-2">&copy; 2025 Cafe Don Pepe - Todos los derechos reservados</p>
  <div class="d-flex justify-content-center gap-3">
    <a href="https://www.facebook.com" target="_blank" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
    <a href="https://www.instagram.com" target="_blank" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
    <a href="https://wa.me/593987654321" target="_blank" class="text-white fs-4"><i class="bi bi-whatsapp"></i></a>
    <a href="https://www.tiktok.com" target="_blank" class="text-white fs-4"><i class="bi bi-tiktok"></i></a>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
