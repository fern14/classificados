<?php include('pages/header.php'); ?>
<?php require 'classes/usuarios.class.php'; ?>
<div class="container">
  <h1 class="mt-4">Fazer Login</h1>
  <?php
  $u = new Usuarios();
  if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($u->login($email, $senha)) {
      ?>
      <script type="text/javascript">window.location.href="./";</script>
      <?php
    } else {
      ?>
      <div class="alert alert-danger">Usúario e/ou Senha errados!</div>
      <?php
    }
  }
  ?>

  <form action="" method="post">
    <div class="form-group mb-3 mt-3">
      <label for="nome">E-mail:</label>
      <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="nome">Senha:</label>
      <input type="password" name="senha" id="senha" class="form-control">
    </div>
    <input type="submit" value="Logar" class="btn btn-primary mt-4">
  </form>
</div>

<?php include('pages/footer.php'); ?>