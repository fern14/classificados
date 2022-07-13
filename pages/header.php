<?php require 'config.php'; 
?>
<html>
  <head>
    <title>Classificados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a href="./" class="navbar-brand">Classificados</a>

          <div class="container">
          <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
            <?php $array = getNome() ?>
          <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="text-light">Olá <?php echo $array['nome'] ?></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="meus-anuncios.php">Meus Anúncios</a></li>
                <li><a class="dropdown-item" href="editar-perfil.php?id=<?= $_SESSION['cLogin']; ?>">Editar Perfil</a></li>
                <li><a class="dropdown-item" href="sair.php">Sair</a></li>
              </ul>
              <?php else: ?>
          </div>
        </div>
            <div class="container">
              <ul class="navbar-right d-flex">
                <li><a href="cadastre-se.php">Cadastre</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
          </ul>
          </div>
        </div>
    </nav>
 
    <?php
    function getNome() {
      global $pdo;
      $array = [];
      $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
      $sql->bindValue(":id", $_SESSION['cLogin']);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $array = $sql->fetch();
      } else {
        $array = [];
      }

      return $array;
    }
    ?>
