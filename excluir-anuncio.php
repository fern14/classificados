<?php
require 'config.php';

if(empty($_SESSION['cLogin'])){
  ?>
  <script type="text/javascript">window.location.href="login.php"</script>
  <?php
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if (isset($_GET['id']) && !empty($_GET['id'])){
  $a->excluirAnuncio($_GET['id']);
}

header('Location: meus-anuncios.php');
exit;