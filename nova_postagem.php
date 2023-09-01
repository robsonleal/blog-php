<?php include_once 'header.php'; ?>

<main>
  <div class="container margin-header">
    <form>
      <div class="row mb-5">
        <div class="col-8">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="Digite um título">
            <label for="floatingInput">Digite o título da postagem</label>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Marque para publicar</label>
          </div>
        </div>
        <div class="col-4">
          <select class="form-select" multiple>
            <option selected>Selecione as tags desejadas...</option>
            <option value="1">Java</option>
            <option value="2">Javascript</option>
            <option value="3">Typescript</option>
          </select>
        </div>
      </div>
      <textarea id="container" class="editor col-12" name="editor1"></textarea>
      <div class="row mt-5">
        <button type="button" class="btn btn-light col-5">Cancelar</button>
        <div class="col-2"></div>
        <button type="submit" class="btn btn-dark col-5">Criar</button>
      </div>
    </form>
  </div>
</main>

<script src="./CKEditor5/ckeditor.js"></script>

<script>
  ClassicEditor
    .create(document.querySelector('.editor'), {
      licenseKey: '',
      toolbar: {
        shouldNotGroupWhenFull: true
      },
    });
</script>

<?php include_once 'footer.php'; ?>
