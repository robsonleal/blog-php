<?php
include_once 'header.php';
session_start();

if (isset($_SESSION['resultArray'])) {
  $resultArray = $_SESSION['resultArray'];
}

?>

<main>
  <div class="container margin-header">
    <h1 class="text-center p-2">30 de Agosto de 2023</h1>
    <div class="row">
      <div class="card bg-light mb-4 col-10 mx-auto">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Criando um blog do zero com PHP</a></h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">30/08/23 às 12:59</h6>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <span class="badge bg-secondary text-uppercase">HTML</span>
          <span class="badge bg-secondary text-uppercase">PHP</span>
          <span class="badge bg-secondary text-uppercase">CSS</span>
          <span class="badge bg-secondary text-uppercase">Javascript</span>
        </div>
      </div>
      </a>
    </div>
    <div class="row">

      <div class="card bg-light mb-5 col-10 mx-auto">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Join utilizando JPQL em tabelas com id composto</a></h5>
          <h6 class="card-subtitle mb-4 text-body-secondary">30/08/23 às 12:59</h6>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
          <span class="badge bg-secondary text-uppercase">Hibernate</span>
          <span class="badge bg-secondary text-uppercase">Java</span>
        </div>
      </div>
      </a>
    </div>
  </div>
  <div><h1><?php echo $resultArray[0]['TXT_TITULO']; ?></h1></div>
</main>

<?php include_once 'footer.php'; ?>
