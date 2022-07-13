<?php include('pages/header.php') ;
require 'classes/anuncios.class.php';
require 'classes/categorias.class.php';
$c = new Categorias();
$categorias = $c->getLista();
$a = new Anuncios();
$filtros = [
  'categoria' => '',
  'preco' => '',
  'estado' => ''
];

if(isset($_GET['filtros'])) {
  $filtros = $_GET['filtros'];
}


$array = totalAnuncios();
$total_anuncios = count($array);

$p = 1;
if(isset($_GET['p']) && !empty($_GET['p'])){
  $p = addslashes($_GET['p']);
}
$por_pagina = 2;
$total_paginas = ceil($total_anuncios / $por_pagina);

$anuncios = $a->getUltimosAnuncios($p, $por_pagina, $filtros);
?>
    <div class="container-fluid jumbo">
    <div class="jumbotron jumbotron-fluid bg-grey">
        <?php $a = totalAnuncios(); ?>
        <?php $u = Usuarios(); ?>
        <h2 class="display-4">Nós temos hoje <?= count($a); ?> <?= (count($a) > 1) ? 'anuncios'  : 'anuncio'; ?>.</h2>
        <p class="lead">E mais de <?= count($u); ?> <?= (count($u) > 1) ? 'usuarios'  : 'usuario'; ?>.</p>
      </div>

      <div class="row mt-5">
        <div class="col-sm-3">
          <h4>Pesquisa Avançada</h4>
            <form action="" method="GET">
              <div class="form-group mt-5">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="filtros[categoria]" id="categoria">
                  <option value=""></option>
                  <?php foreach($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $filtros['categoria']) ? 'selected="selected"' : '' ?>><?= $cat['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group mt-4">
                <label for="preco">Preço</label>
                <select class="form-control" name="filtros[preco]" id="preco">
                  <option value="0-50" <?= ($filtros['preco'] == '0-50') ? 'selected="selected"' : '' ?>>R$ 0 - 50</option>
                  <option value="51-100" <?= ($filtros['preco'] == '51-100') ? 'selected="selected"' : '' ?>>R$ 51 - 100</option>
                  <option value="101-200" <?= ($filtros['preco'] == '101-200') ? 'selected="selected"' : '' ?>>R$ 101 - 200</option>
                  <option value="201-500" <?= ($filtros['preco'] == '201-500') ? 'selected="selected"' : '' ?>>R$ 201 - 500</option>
                </select>
              </div>

              <div class="form-group mt-4">
                <label for="estado">Estado de Conservação</label>
                <select class="form-control" name="filtros[estado]" id="estado">
                  <option value="0" <?= ($filtros['estado'] == '0') ? 'selected="selected"' : '' ?>>Ruim</option>
                  <option value="1" <?= ($filtros['estado'] == '1') ? 'selected="selected"' : '' ?>>Bom</option>
                  <option value="2" <?= ($filtros['estado'] == '2') ? 'selected="selected"' : '' ?>>Ótimo</option>
                </select>
              </div>

              <div class="form-group mt-4">
                <input type="submit" class="btn btn-info" value="Buscar">
              </div>
            </form>
        </div>
        <div class="col-sm-9">
          <h4>Últimos Anúncios</h4>
          <table class="table table-striped">
              <tbody>
                <?php foreach($anuncios as $anuncio): ?>
                  <tr>
                  <td>
                    <?php if (!empty($anuncio['url'])): ?>
                    <img src="assets/images/anuncios/<?= $anuncio['url']; ?>" height="100" alt="">
                    <?php else: ?>
                    <img src="assets/images/default.png" height="100" alt="">
                      <?php endif; ?>
                  </td>
                  <td>
                    <a href="produto.php?id=<?= $anuncio['id']; ?>" style="color: #4222d7; font-weight: bold;"><?= $anuncio['titulo']; ?></a><br>
                    <?= $anuncio['categoria']; ?>
                  </td>
                  <td>R$ <?= number_format($anuncio['valor'], 2); ?></td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
            <ul class="pagination">
              <?php for($q=1 ;$q <= $total_paginas; $q++): ?>
                <li class="<?= ($p == $q) ? 'active' : '' ?>"><a class="page-link" href="index.php?p=<?= $q ?>"><?= $q ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
      </div>
    </div>
    
<?php include('pages/footer.php') ?>

<?php
function totalAnuncios() {
  $info = [];
  global $pdo;

  $sql = $pdo->prepare("SELECT * FROM anuncios");
  
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