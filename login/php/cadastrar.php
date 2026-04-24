<?php
require 'Usuario.class.php';
$usuario = new Usuario();
$conn = $usuario->conecta();

if( $conn ){
    if (isset($_POST['usuario'])){
        $nome = addslashes( $_POST['usuario'] );
        $senha   = addslashes( $_POST['senha'] );
        $email   = addslashes( $_POST['email'] );

        $user = $usuario->checkUser($email);

        if( $user ){
            echo "<script>
                    alert('Voce já possue cadastro. Va para o login!'
                </script>";
            exit();
        }else{
            $user = $usuario->inserirUsuario($nome, $email, $senha);
            if( $user ){
                echo "Usuario cadastrado com sucesso!";
            }else{
                echo "Erro ao cadastrar o Usuario!!";
            }
        }

    }else{
        echo "Erro no Post!";
    }
}else{
    echo "<script> alert('Banco indisponivel. Tente mais tarde!')</script>";
}