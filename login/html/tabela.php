<?php
require '../php/Usuario.class.php';
$usuario = new Usuario();
$con = $usuario->conecta();

if( !$con ){
    echo "Banco indisponível. Tente mais tarde!";
    exit();
}else{
    $usuarios = $usuario->listarUsuarios();

    //montagem do html da tabela
    $table  = '<table>';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th>Codigo</th>';
    $table .= '<th>Nome</th>';
    $table .= '<th>Email</th>';
    $table .= '</tr>';
    $table .= '<tbody>';
    //laco de repeticao para inclusao dos dados na tabela
    foreach( $usuarios as $item ){
        $id    = $item['id'];
        $nome  = $item['nome'];
        $email = $item['email'];

        $table .= '<tr>';
        $table .= "<td>$id</td>";
        $table .= "<td>$nome</td>";
        $table .= "<td>$email</td>";  
        $table .= "</tr>";                      
    }            
    $table .= "</tbody>";
    $table .='</thead>';
    $table .= '</table>';                
}

echo $table;

