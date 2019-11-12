<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./_css/style_cadastro.css">
    <title>CEU - Cadastro de Eventos</title>
</head>

<body>

    <div id="conteudo">
        <section>
            <article>
                <figure class="logo">
                    <a href="./menu/menu.html"><img src="./_imagens/CEU.png" class="img-fluid ml-5" width="200"></a>
                </figure>
            </article>
            <article>
                <div class="container">
                    <article class="row margin-formulario">
                        <article class="usuCadast">
                            <div class="col p-5 bg-white rounded">
                                <form method="post" action="cadastro_evento_processamento.php">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault01">Nome do evento</label>
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="Nome do Evento" name="nome" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault02">Quantidade máxima participantes</label>
                                            <select class="form-control" name="qntd_part">
                                                <option>Quantidade máxima participantes
                                                </option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="500">500</option>
                                                <option value="700">700</option>
                                                <option value="1000">mais de 1000</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefaultUsername">Usuário administrador</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                                </div>
                                                <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Usuário" aria-describedby="inputGroupPrepend2" name="user_admin" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationDefault03">Estado</label>
                                            <input type="text" class="form-control" id="validationDefault03" placeholder="Estado" name="estado" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault04">Cidade</label>
                                            <input type="text" class="form-control" id="validationDefault04" placeholder="Cidade" name="cidade" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault05">CEP</label>
                                            <input type="text" class="form-control" id="validationDefault05" placeholder="CEP" name="cep" required>
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