<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <style>
    .fundo{
        background: #ccc;
    }
  </style>
</head>
<body class="container fundo">
<?php

// configurações para conexão com o banco de dados.
$server   = "localhost";
$user     = "root";
$password = "";
$dbname   = "tabela";

// instancia do PDO
$pdo = new PDO(
    'mysql:host='.$server.';dbname='.$dbname, $user, $password);

// execução da query
$stmt = $pdo->query("SELECT * FROM clientes");
$clients   = $stmt->fetchAll();


// montagem do html da tabela
$table  = '<table class = "table table-striped">';
$table .= '<thead>';
$table .= '<tr>';
$table .= '<td>Selecionar Cliente</td>';
$table .= '<td>idCliente</td>';
$table .= '<td>Nome</td>';
$table .= '<td>Telefone</td>';
$table .= '<td>Endereço</td>';
$table .= '<td>Email</td>';
$table .= '<td>Editar</td>';
$table .= '<td>Excluir</td>';
$table .= '</tr>';
$table .= '</thead>';
$table .= '<tbody>';

// laço de repetição para inclusão dos dados na$id = $client['id'];

foreach ($clients as $item){	
 
    $id      = $item['id'];
    $name    = $item['name'];
    $phone   = $item['phone'];
    $address = $item['address'];
    $email   = $item['email'];

    $table .= "<td><input type='checkbox' value=$id></td>";
    $table .= "<td>$id</td>";
    $table .= "<td>$name</td>";
    $table .= "<td>$phone</td>";
    $table .= "<td>$address</td>";
    $table .= "<td>$email</td>";
    
    $table .= "<td><a class='btn btn-info' href='editar.php?$id'>Editar</a></td>";
    $table .= "<td><a class='btn btn-danger' href='delete.php?$id'>Excluir</a></td>";
    $table .= '</tr>';
}   

// fechamento da tabela
$table .= '</tbody>';
$table .= '</table>';

// exibição na tela
echo $table;
?>
</body>
</html>


