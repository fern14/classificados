<?php include 'pages/header.php';?>
<?php
// verificando se o usuario está logado
if (empty($_SESSION['cLogin'])){
  ?>
  <script type="text/javascript">window.location.href="login.php";</script>
  <?php
  exit;
}
?>

<div class="container">
  <h1 class="mt-5">Meus Anúncios</h1>

  <a href="add-anuncio.php" class="btn btn-light mt-3">Adicionar Anúncio</a>

  <table class="table table-striped mt-5">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Titulo</th>
        <th>Valor</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>
    </thead>
    <?php 
    require './classes/anuncios.class.php';
    $a = new Anuncios();
    $anuncios = $a->getMeusAnuncios();
    foreach($anuncios as $anuncio):
    ?>
      <tr>
        <td>
          <?php if (!empty($anuncio['url'])): ?>
          <img src="assets/images/anuncios/<?= $anuncio['url']; ?>" height="100" alt="">
          <?php else: ?>
          <img src="assets/images/default.png" height="100" alt="">
            <?php endif; ?>
        </td>
        <td><?= $anuncio['titulo']; ?></td>
        <td>R$ <?= number_format($anuncio['valor'], 2); ?></td>
        <td><?= $anuncio['descricao']; ?></td>
        <td>
          <a href="editar-anuncio.php?id=<?= $anuncio['id'] ?>" class="btn btn-primary">Editar</a>
          <a href="excluir-anuncio.php?id=<?= $anuncio['id'] ?>" class="btn btn-danger">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php include 'pages/footer.php'; ?>
