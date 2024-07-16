<?php include 'conexao.php'; 

  $sql_count = "SELECT COUNT(*) AS TOTAL FROM cidades";
  $res_count = $conn->query($sql_count) or die($conn->error);
  $total = $res_count->fetch_assoc()['TOTAL'];

  $limite = 10;
  $page = intval($_GET['page']) ?? 1;
  if ($page < 1) $page = 1;
  $page_no = ceil($total / $limite);
  if ($page > $page_no) $page = $page_no;  
  $offset = ($page - 1) * $limite;

  $sql_city = "SELECT * FROM cidades ORDER BY nome LIMIT $limite OFFSET $offset";
  $result = $conn->query($sql_city) or die($conn->error);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Pagination</title>
</head>
<body>
  <h1>Cidades (<?= $total; ?>)</h1>

  <table border="1">
    <tr>
      <th>Nome da Cidade</th>
      <th>Ação</th>
    </tr>

    <?php while($city = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= utf8_decode($city['nome']); ?></td>
        <td>Editar | Excluir</td>
      </tr>
    <?php } ?>
  </table>
  <p>
    <small><?= "Página atual: $page"; ?></small><br>
    <small><?= "Número de Páginas: $page_no"; ?></small>
  </p>
  <form action="">
    <a href="?page=<?= $page - 1; ?>">◀</a>
    <input type="text" name="page" value="<?= $page; ?>" 
      style="width: 50px; margin: 0 8px; text-align: center" 
    />
    <a href="?page=<?= $page + 1; ?>">▶</a>
  </form>
</body>
</html>