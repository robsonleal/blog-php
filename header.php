<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Desbugando</title>

  <!-- bootstrap  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <!-- highlight  -->
  <link href="./highlight/styles/vs2015.min.css" rel="stylesheet" />
  <script src="./highlight/highlight.min.js"></script>
  <!-- Font awesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <!--  highlight badge  -->
  <script src="./highlightjs-badge/highlightjs-badge.min.js"></script>
  <script>hljs.highlightAll();</script>
  <!-- local CSS -->
  <link rel="stylesheet" href="styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <header>
    <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid p-2 mx-3">
        <a class="navbar-brand" href="#">{...} Desbugando Blog</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end text-uppercase" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="nova_postagem.php">+ Nova Postagem</a>
            </li>
        </div>
      </div>
    </nav>
  </header>