<?php require './pages/header.php'; ?>

<?php
// *************** verificando se o usuario esta logado **************
if (empty($_SESSION['cLogin'])){
  ?>
  <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
}
// ******************************************************************
?>
<?php
// pegando dados para preencher o formulario com os dados do usuario
$info = [];
if (isset($_GET['id']) && !empty($_GET['id'])){
  global $pdo;
  $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
  $sql->bindValue(":id", $_SESSION['cLogin']);
  $sql->execute();

  if ($sql->rowCount() > 0) {
    $info = $sql->fetch(PDO::FETCH_ASSOC);
  }

} else {
  ?>
  <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
  <?php
}
// *********************************************************************
?>

<?php 
// ********************* editando o usuario ****************************

require 'classes/usuarios.class.php';
$u = new Usuarios();
if (isset($_POST['nome']) && !empty($_POST['nome'])){
  $nome = $_POST['nome'];
  $email = $_POST['email'];

  $u->editUsuario($nome, $email);
  ?>
  <div class="alert alert-success">Usúario Editado com Sucesso</div>
  <?php
  header("Refresh:1");
}
// *********************************************************************
?>

<div class="container">
  <h1 class="mt-5">Editar Perfil</h1>

  <form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group mb-4">
    <label for="titulo">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control" value="<?= $info['nome']; ?>">
  </div>

  <div class="form-group mb-4">
    <label for="valor">E-mail</label>
    <input type="text" name="email" id="email" class="form-control" value="<?= $info['email']; ?>">
  </div>

  <input type="submit" value="Salvar" class="btn btn-primary">

  </form>
</div>


<?php require './pages/footer.php'; ?>
