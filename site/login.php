<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./_css/style_login.css">
    <title>CEU Online</title>
</head>

<body>

    <div id="conteudo">
        <section>
            <article>
                <figure>
                    <a href="../menu/menu.html"><img src="./_imagens/CEU.png" class="img-fluid ml-5" width="200"></a>
                </figure>
            </article>
            <article>
                <div class="container">
                    <article class="row margin-formulario">
                        <div class="col p-5 bg-white rounded">
                            <h2>Entrar</h2>
                            <form action="./service/valida_login.php" method="post">
                                <div>
                                    <label for="idUsuario">Usuário</label>
                                    <input type="text" class="form-control" name="email" id="idUsuario">
                                </div>
                                <div>
                                    <label for="usuarioSenha">Senha</label>
                                    <input type="password" class="form-control" name="senha" id="usuarioSenha">
                                </div>
                                <div>
                                <? if (isset($_GET['login']) && $_GET['login'] == 'erro') { ?>
                                    <div class = "text-danger">
                                        Usuário ou senha errado!
                                    </div>
                                <? } ?>
                                <? if (isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>
                                    <div class = "text-danger">
                                        Faça login antes!
                                    </div>
                                <? } ?>
                                </div>
                                <button class="btn btn-block my-2 btn-primary">Entrar</button>
                                <a href="#" class="ls-login-forgot">Esqueci minha senha</a>
                                <p class="txt-center ls-login-signup">
                                    <a href="./cadastro_usuario.php">Cadastre-se agora</a>
                                </p>
                            </form>
                        </div>
                    </article>
                </div>
            </article>
        </section>
    </div>
</body>

</html>