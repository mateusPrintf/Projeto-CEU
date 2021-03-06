<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- ssl -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('./service/busca_cep.php')?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./_css/style_cadastro.css">
    <title>CEU - Cadastro de usuário</title>


</head>

<body>

    <div id="conteudo">
        <section>
            <article>
                <figure class="logo">
                    <a href="../menu/menu.html"><img src="./_imagens/CEU.png" class="img-fluid ml-5" width="200"></a>
                </figure>
            </article>
            <article>
                <div class="container">
                    <article class="row margin-formulario">
                        <article class="usuCadast">
                            <div class="col p-5 bg-white rounded">
                                <form method="post" action="./controller/UsuarioController.php?acao=inserir">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault01">Primeiro nome</label>
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="Nome" name="nome" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault02">Sobrenome</label>
                                            <input type="text" class="form-control" id="validationDefault02" placeholder="Sobrenome" name="sobrenome" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefaultUsername">Usuário</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                                </div>
                                                <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Usuário" aria-describedby="inputGroupPrepend2" name="usuario" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                    <? if (isset($_GET['erro']) && $_GET['erro'] == 'emailJaCadastrado') {?>
                                        <div class = "text-danger">
                                            Email já cadastrado!
                                        </div>
                                    <?}?>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Senha</label>
                                            <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" name="senha1" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Repetir a senha</label>
                                            <input type="password" class="form-control" id="inputPassword4" placeholder="Senha" name="senha2" required>
                                        </div>
                                    </div>
                                    <? if (isset($_GET['erro']) && $_GET['erro'] == 'senhaDesigual') {?>
                                        <div class = "text-danger">
                                            As senhas não são iguais!
                                        </div>
                                    <?}?>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label>CEP</label>
                                            <input type="text" class="form-control" id="cep" placeholder="CEP"
                                                name="cep" maxlength="9" onblur="pesquisacep(this.value);" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" id="cidade" placeholder="Cidade"
                                                name="cidade" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault03">Estado</label>
                                            <input type="text" class="form-control" id="estado" placeholder="Estado"
                                                name="estado" required>
                                        </div>
                                    </div>
                                    <div class="forms-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                            <label class="form-check-label" for="invalidCheck2">
                                                    Concordo com os <a href="#termos">termos e condições</a>
                                                </label>
                                        </div>
                                    </div>
                                    <div class="button-env">
                                        <button class="btn btn-primary" type="submit">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </article>
                    </article>
                </div>
            </article>
        </section>
    </div>
</body>

<footer>
    <article>
        <div class="rodape">
            <p>
                Projeto CEU - Página em desenvolvimento
            </p>
        </div>
    </article>
</footer>

</html>