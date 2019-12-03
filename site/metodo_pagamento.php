<? require_once "validador_acesso.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./_css/style_pagamento.css">
    <title>CEU - Método de Pagamento</title>
</head>

<body>

    <div id="conteudo">
        <section>
            <article>
                <figure class="logo">
                    <a href="./menu/menu.html"><img src="./_imagens/CEU.png" class="img-fluid ml-0" width="200"></a>
                </figure>
            </article>
            <article>
                <div class="container">
                    <article class="row margin-formulario">
                        <article class="usuCadast">
                            <div class="col p-5 bg-white rounded">
                                <form>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault01">Nome completo</label>
                                            <input type="text" class="form-control" id="validationDefault01" placeholder="Nome completo" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefault02">Forma de Pagamento</label>
                                            <select class="form-control">
                                                <option>Forma de pagamento
                                                </option>
                                                <option value="">Boleto bancário</option>
                                                <option value="">Cartão de crédito</option>
                                                <option value="">Cartão de débito</option>
                                                <option value="">PagSeguro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationDefaultUsername">CPF</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="validationDefaultUsername" placeholder="CPF" aria-describedby="inputGroupPrepend2" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Confirmar senha</label>
                                            <input type="password" class="form-control" id="inputPassword4" placeholder="Confirmar senha" required>
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