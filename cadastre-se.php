<?php include('pages/header.php'); ?>
<?php require 'classes/usuarios.class.php'; ?>
<div class="container">
  <h1 class="mt-4 mb-3">Cadastre-se</h1>
  <?php
  $u = new Usuarios();
  if(isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];

    if(!empty($nome) && !empty($email) && !empty($senha)){
      if($u->cadastrar($nome, $email, $senha, $telefone)) {
        ?>
        <div class="alert alert-success">
          <strong>Parabéns!</strong> Cadastrado com sucesso. <a href="login.php" class="alert-link">Faça o login agora</a>
        </div>
        <?php
      } else {
        ?>
        <div class="alert alert-warning">
          Este usúario já existe. <a href="login.php" class="alert-link">Faça o login agora</a>
        </div>
        <?php
      }
    } else {
      ?>
      <div class="alert alert-warning">Preencha todos os campos!</div>
      <?php
    }
  }
  ?>

  <form action="" method="post">
    <div class="form-group mb-3">
      <label for="nome">Seu Nome:</label>
      <input type="text" name="nome" id="nome" class="form-control">
    </div>
    <div class="form-group mb-3">
      <label for="nome">Seu E-mail:</label>
      <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group mb-3">
      <label for="nome">Sua Senha:</label>
      <input type="password" name="senha" id="senha" class="form-control">
    </div>
    <div class="form-group">
      <label for="nome">Seu Telefone:</label>
      <input type="text" name="telefone" id="telefone" class="form-control">
    </div>
    <input type="submit" value="Cadastrar" class="btn btn-primary mt-4">
  </form>
</div>

<?php include('pages/footer.php'); ?>
