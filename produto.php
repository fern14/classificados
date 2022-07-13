<?php include('pages/header.php') ;
require 'classes/anuncios.class.php';
$a = new Anuncios();

if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];
} else {
  ?>
  <script type="text/javascript">window.location.href="index.php";</script>
  <?php
}
$info = $a->getAnuncio($id);
?>
    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-sm-3">

        <div id="meuCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <?php foreach($info['fotos'] as $key => $foto): ?>
              <div class="carousel-item <?= ($key == '0') ? 'active' : ''; ?>">
                <img class="d-block w-100" src="assets/images/anuncios/<?= $foto['url']; ?>">
              </div>
              <?php endforeach; ?>
            </div>
            <a class="left carousel-control" href="#meuCarousel" role="button" data-slide="prev">
              <span style="color: black;"><</span>
            </a>
            <a class="right carousel-control" href="#meuCarousel" role="button" data-slide="next">
              <span style="color: black;">></span>
            </a>
      </div>
        </div>
        <div class="col-sm-9">
          <h1><?= $info['titulo'] ?></h1> <br><br>
          <?php if($info['id_categoria'] == 0): ?>
            <strong>Estado de Conservação:</strong>
          <h4>Ruim</h4>
          <?php elseif($info['id_categoria'] == 1): ?>
          <strong>Estado de Conservação:</strong>
          <h4>Bom</h4>
          <?php else: ?>
          <strong>Estado de Conservação</strong>
          <h4>Ótimo</h4>
          <?php endif; ?>
          <br>
          <strong>Descrição:</strong>
          <p><?= $info['descricao'] ?></p><br><br>
          <strong>Telefone:</strong>
          <p><?= $info['telefone'] ?></p>
        </div>
      </div>
    </div>
    
<?php include('pages/footer.php') ?>

<?php
function totalAnuncios() {
  $info = [];
  global $pdo;
  $sql = $pdo->query("SELECT * FROM anuncios");
  if ($sql->rowCount() > 0) {
    $info = $sql->fetchAll();
  }
  return $info;
}

function Usuarios() {
  $info = [];
  global $pdo;
  $sql = $pdo->query("SELECT * FROM usuarios");
  if ($sql->rowCount() > 0) {
    $info = $sql->fetchAll();
  }
  return $info;
}

?>