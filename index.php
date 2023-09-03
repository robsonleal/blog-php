<?php
include_once 'header.php';
include_once 'meses_pt_br.php';
session_start();

if ((!isset($_SESSION['postagens']) && $_SESSION != "") || (isset($_SESSION['atualizar']) && $_SESSION['atualizar'] === true)) {
  include_once 'buscar.php';

  $_SESSION['atualizar'] = false;
}

$postagens = $_SESSION['postagens'];
?>

<main>
  <div class="container margin-header">
    <?php
    $dataAnterior = new DateTime();
    $dataAnterior->modify('-1 month');

    foreach ($postagens as $index => $postagem) {

      $data = new DateTime($postagem['DAT_ALTERACAO']);
      $dataFormatada = $data->format('F \d\e Y');

      foreach ($months as $en => $ptbr) {
        $dataFormatada = str_replace($en, $ptbr, $dataFormatada);
      }

      if ($dataAnterior->format('m') != $data->format('m')) {
        echo "<h2 class=\"text-center p-2\">$dataFormatada</h2>";
      }

      $dataAnterior = $data;
    ?>
      <div class="row">
        <div class="card bg-light mb-4 col-10 mx-auto">
          <div class="card-body">
            <h5 class="card-title"><a href="#"><?php echo $postagem['TXT_TITULO']; ?></a></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $postagem['DAT_ALTERACAO']; ?></h6>
            <p class="card-text"><?php echo $postagem['TXT_RESUMO']; ?></p>
            <?php foreach ($postagem['TXT_TAGS'] as $tags) {
              echo "<span class=\"badge bg-secondary text-uppercase m-1\">$tags</span>";
            } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</main>

<?php include_once 'footer.php'; ?>
