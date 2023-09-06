<?php
$currentPage = 'nova_postagem';
include_once __DIR__ . '/header.php';

if (isset($_SESSION['tags'])) {
  $tags = $_SESSION['tags'];
}

?>

<main>
  <div class="container margin-header">
    <form method="POST">
      <div class="row mb-5">
        <div class="col-8">
          <div class="form-floating mb-3">
            <input type="text" name="txt_titulo" class="form-control" id="floatingInput" placeholder="Digite um título">
            <label for="floatingInput">Digite o título da postagem</label>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" name="par_ativo" class="form-check-input" id="exampleCheck1" value="S">
            <label class="form-check-label" for="exampleCheck1">Marque para publicar</label>
          </div>
        </div>
        <div class="col-4">
          <select name="txt_tags[]" class="form-select" multiple>
            <option disabled>Selecione as tags desejadas...</option>
            <?php
            foreach ($tags as $tag) {
              echo "<option value=\"" . $tag['OID_TAG'] . "\">" . $tag['TXT_NOME'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <textarea name="txt_texto" id="container" class="editor" name="editor1"></textarea>
      <div class="row mt-5">
        <a href="index.php" class="btn btn-light col-5">Cancelar</a>
        <div class="col-2"></div>
        <button type="submit" class="btn btn-dark col-5">Criar</button>
      </div>
    </form>
  </div>
</main>

<script src="http://desbugando-blog.com//src/Template/js/ckeditor.js"></script>

<script>
  ClassicEditor
    .create(document.querySelector('.editor'), {
      licenseKey: '',
      toolbar: {
        shouldNotGroupWhenFull: true
      },
    });
</script>

<?php include_once __DIR__ . '/footer.php'; ?>
