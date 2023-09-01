<?php
include_once 'header.php';
include_once 'meses_pt_br.php';
session_start();

if (isset($_SESSION['resultArray'])) {
  $resultArray = $_SESSION['resultArray'];
}

?>

<main>
  <div class="container margin-header">
    <?php foreach ($resultArray as $index => $postagem) : ?>
      <?php  ?>
      <!-- <h1 class="text-center p-2">30 de Agosto de 2023</h1> -->
      <div class="row">
        <div class="card bg-light mb-4 col-10 mx-auto">
         <div class="card-body">
            <h5 class="card-title"><a href="#"><?php echo $postagem['TXT_TITULO']; ?></a></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $postagem['DAT_ALTERACAO']; ?></h6>
            <p class="card-text"><?php echo $postagem['TXT_RESUMO']; ?></p>
            <?php
            foreach ($postagem['TXT_TAGS'] as $tags):
              echo "<span class=\"badge bg-secondary text-uppercase m-1\">$tags</span>";
            endforeach;
            ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include_once 'footer.php'; ?>
