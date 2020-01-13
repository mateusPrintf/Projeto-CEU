<?php

    require_once "../models/ConexaoModel.php";
    require_once "../models/UsuarioModel.php";
    require_once "../service/UsuarioService.php";

    //RECEBE AS INFORMAÇÕES DO POST OU GET E ADICIONA/REMOVE/ATUALIZA/RECUPERA AO MODELO USUARIO
    
    if (isset($_GET['acao'])) {
        if ($_GET['acao'] == "inserir") {

            $cnx = new ConexaoModel();
            $conexao = $cnx->conectar();

            $queryEmail = '
                    select * from tb_usuario where email = :email
            ';

            $stmtEmail = $conexao->prepare($queryEmail);
            $stmtEmail->bindValue(':email', $_POST['email']);
            $stmtEmail->execute();
            $userAchado = $stmtEmail->fetchAll(PDO::FETCH_OBJ);

            if ($_POST['senha1'] != $_POST['senha2']) {
                header('Location: ../cadastro_usuario.php?acao=error1');
            
            }else if (!empty($userAchado)) {
                header('Location: ../cadastro_usuario.php?acao=error2');
            
            }else {
                $usuario = new Usuario();
                $usuario->__set('nome', $_POST['nome']);
                $usuario->__set('usuario', $_POST['usuario']);
                $usuario->__set('email', $_POST['email']);
                $usuario->__set('senha', $_POST['senha1']);
                $usuario->__set('estado', $_POST['estado']);
                $usuario->__set('cidade', $_POST['cidade']);
                $usuario->__set('cep', $_POST['cep']);    
            
                $conexao = new ConexaoModel();
                $usuarioService = new UsuarioService($usuario, $conexao);
    
                if($usuarioService->inserir()) header('Location: ../login.php?acao=sucesso');
                else header('Location: ../login.php?acao=erro3');
            }
            
        
        }else if ($_GET['acao'] == 'recuperar') {
            $usuario = new Usuario();  
            $conexao = new ConexaoModel();

            $usuarioService = new UsuarioService($usuario, $conexao);
            
            if ($usuarioService->recuperar()) echo 'sucesso';
            else echo 'error';
        
        }else if ($_GET['acao'] == 'atualizar') {
            $usuario = new Usuario();
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('usuario', $_POST['usuario']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('estado', $_POST['estado']);
            $usuario->__set('cidade', $_POST['cidade']);
            $usuario->__set('cep', $_POST['cep']);
            // $usuario->__set('nome', "Luciano");
            // $usuario->__set('usuario', "lps30_");
            // $usuario->__set('email', "Lucianolps30@gmail");
            // $usuario->__set('estado', "PI");
            // $usuario->__set('cidade', "Piripiri");
            // $usuario->__set('cep', "64260000");

            $conexao = new ConexaoModel();

            $usuarioService = new UsuarioService($usuario, $conexao);
            
            if ($usuarioService->atualizar()) echo "sucesso";
            else echo "error";

        }else if ($_GET['acao'] == 'remover') {
            $conexao = new ConexaoModel();
            $usuario = new Usuario();

            $usuarioService = new UsuarioService($usuario, $conexao);
            
            if ($usuarioService->remover()) echo 'sucesso';
            else echo 'error';
        }
    }

?>