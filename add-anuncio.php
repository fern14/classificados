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

  $a->addAnuncio($titulo, $categoria, $valor, $descricao, $estado);
 ?>
 <div class="alert alert-success">Produto Adicionado com Sucesso</div>
 <?php

}

?>

<div class="container">
  <h1 class="mt-5">Meus Anúncios - Adicionar Anúncio</h1>

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
      <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group mb-4">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" class="form-control">
  </div>

  <div class="form-group mb-4">
    <label for="valor">Valor</label>
    <input type="text" name="valor" id="valor" class="form-control">
  </div>

  <div class="form-group mb-4">
    <label for="descricao">Descrição</label>
    <textarea class="form-control" name="descricao" id="descricao"></textarea>
  </div>

  <div class="form-group mb-4">
    <label for="estado">Estado de Conservação</label>
    <select name="estado" id="estado" class="form-control">
      <option value="0">Ruim</option>
      <option value="1">Bom</option>
      <option value="2">Ótimo</option>
    </select>
  </div>

  <input type="submit" value="Adicionar" class="btn btn-primary">

  </form>
</div>


<?php include 'pages/footer.php'; ?>