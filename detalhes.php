<?php
$currentPage = 'detalhes';
include_once 'header.php';
session_start();

if (isset($_SESSION['postagem']) && $_SESSION['postagem'] != "") {
  $postagem = $_SESSION['postagem'];
} else {
  include_once 'buscar_editar.php';
}

?>

<main>
  <div class="container margin-header">
    <h1 class="text-center"><?php echo $postagem['TXT_TITULO']; ?></h1>
    <h6 class="text-center mt-4"><?php echo $postagem['DAT_ALTERACAO']; ?></h6>
    <hr>
    <div class="mt-5">
      <?php echo $postagem['TXT_TEXTO']; ?>
    </div>
  </div>
</main>

<?php include_once 'footer.php'; ?>