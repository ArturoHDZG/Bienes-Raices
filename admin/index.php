<?php
require_once '../includes/functions.php';

$message = $_GET['result'] ?? null;

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Administrador</h1>
  <?php if (intval($message) === 1): ?>
    <p class="alert success">Anuncio creado correctamente</p>
  <?php endif; ?>
  <a href="/admin/realestates/create.php" class="btn-greenInline">Nueva Propiedad</a>
</main>

<?php
includeTemplate('footer');
?>
