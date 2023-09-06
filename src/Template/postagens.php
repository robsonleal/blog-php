<?php
include __DIR__ . '/header.php';

use RobsonLeal\DesbugandoBlog\Util\FormatadorData;
?>

<main>
  <div class="container margin-header">
    <?php
    $dataAnterior = new DateTime();
    $dataAnterior->modify('-1 month');

    foreach ($postagens as $index => $postagem) :
      $data = new DateTime($postagem['DAT_ALTERACAO']);

      if ($dataAnterior->format('m') != $data->format('m')) {
        $dataFormatada = FormatadorData::formatarDataParaExibicao($data);
        echo "<h2 class=\"text-center p-2\">$dataFormatada</h2>";
      }
      $dataAnterior = $data;
    ?>
      <div class="row">
        <div class="card bg-light mb-4 col-10 mx-auto">
          <div class="card-body">
            <?php echo "<h5 class=\"card-title\"><a href=\"/postagens/" . $postagem['OID_POSTAGEM'] . "\">" . $postagem['TXT_TITULO']; ?></a></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $postagem['DAT_ALTERACAO']; ?></h6>
            <p class="card-text"><?php echo $postagem['TXT_RESUMO']; ?></p>
            <?php foreach ($postagem['TXT_TAGS'] as $tags) {
              echo "<span class=\"badge bg-secondary text-uppercase m-1\">$tags</span>";
            } ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
