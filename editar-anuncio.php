<?php include 'pages/header.php';?>
<?php
// verificando se o usuario está logado
if (empty($_SESSION['cLogin'])){
  ?>
  <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
}
require 'classes/anuncios.class.php';
$a = new Anuncios();
if (isset($_POST['titulo']) && !empty($_POST['titulo'])){
  $titulo = $_POST['titulo'];
  $categoria = $_POST['categoria'];
  $valor = $_POST['valor'];
  $descricao = $_POST['descricao'];
  $estado = $_POST['estado'];
  if(isset($_FILES['fotos'])){
    $fotos = $_FILES['fotos'];
  } else {
    $fotos = [];
  }

  $a->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);
 ?>
 <div class="alert alert-success">Produto Editado com Sucesso</div>
 <?php

}
if (isset($_GET['id']) && !empty($_GET['id'])){
  $info = $a->getAnuncio($_GET['id']);
} else {
  ?>
  <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
  <?php
}

?>

<div class="container">
  <h1 class="mt-5">Meus Anúncios - Editar Anúncio</h1>

  <form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group mb-4">
    <label for="categoria">Categoria</label>
    <select name="categoria" id="categoria" class="form-control">
      <?php
      require 'classes/categorias.class.php';
      $c = new Categorias();
      $cats = $c->getLista();
      foreach($cats as $cat):
      ?>
      <option value="<?= $cat['id'] ?>" <?= ($info['id_categoria'] == $cat['id']) ? 'selected="selected"' : ''; ?>>
        <?= $cat['nome'] ?>
    </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group mb-4">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?= $info['titulo']; ?>">
  </div>

  <div class="form-group mb-4">
    <label for="valor">Valor</label>
    <input type="text" name="valor" id="valor" class="form-control" value="<?= $info['valor']; ?>">
  </div>

  <div class="form-group mb-4">
    <label for="descricao">Descrição</label>
    <textarea class="form-control" name="descricao" id="descricao"><?= $info['descricao']; ?></textarea>
  </div>

  <div class="form-group mb-4">
    <label for="estado">Estado de Conservação</label>
    <select name="estado" id="estado" class="form-control">
      <option value="0" <?= ($info['estado'] == '0') ? 'selected="selected"' : ''; ?>>Ruim</option>
      <option value="1" <?= ($info['estado'] == '1') ? 'selected="selected"' : ''; ?>>Bom</option>
      <option value="2" <?= ($info['estado'] == '2') ? 'selected="selected"' : ''; ?>>Ótimo</option>
    </select>
  </div>

  <div class="form-group mb-5 mt-3">
    <label for="add_foto">Fotos do Anúncio</label>
    <input type="file" name="fotos[]" multiple />

    <div class="panel panel-primary mb-4 mt-4">
      <div class="panel-heading">Fotos do Anúncio</div>
      <div class="panel-body">
        <?php foreach($info['fotos'] as $foto): ?>
          <div class="foto_item">
            <img src="assets/images/anuncios/<?= $foto['url'] ?>" alt="" class="img-thumbnail"> <br>
            <a href="excluir-foto.php?id=<?= $foto['id'] ?>" class="btn btn-danger">Excluir Imagem</a>
          </div>
          <?php endforeach; ?>
      </div>
    </div>
  </div>

  <input type="submit" value="Salvar" class="btn btn-primary">

  </form>
</div>


<?php include 'pages/footer.php'; ?>