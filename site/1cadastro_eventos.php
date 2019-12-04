<? require_once("validador_acesso.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('busca_cep.php'); ?>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="./_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="./_css/style_menu.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    

    <title>CEU - Cadastro de Eventos</title>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-br'
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#datepicker1').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });
    });
    </script>

</head>

<body>
    <div class="menu-top menu-font">
        <header class="cabecalho">
            <div class="logo">
                <a href="#inicio">
                    <img src="./_imagens/CEU_noname_pequeno.png" alt="Logo" />
                </a>
            </div>
            <button class="menu-toggle">
                <i class="fa fa-lg fa-bars"></i>
            </button>
            <nav class="menu">
                <ul>
                    <li>
                        <a href="../site/gerenciamento_user_inicio.php">Início</a>
                    </li>
                    <li>
                        <a href="evento.php">Eventos</a>
                    </li>
                    <li>
                        <a href="#sobre">Sobre</a>
                    </li>
                    <li>
                        <a href="#contato">Contato</a>
                    </li>
                </ul>
            </nav>
            <aside class="autenticacao">
                <a href="logoff.php">Sair</a>
            </aside>

        </header>
    </div>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li class="header border">Navegação</li>
            <li>
                <a href="">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuário
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_evento.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Seus eventos
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_evento.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li>
            <li class="header border">Configuração da conta</li>
            <li>
                <a href="./metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog" aria-hidden="true"></i> Configurações
                </a>
            </li>
            <li>
                <a href="./gerenciamento_user_info.php">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">

            <!-- Main component for a primary marketing message or call to action -->

            <div class="jumbotron">
                <h3>Cadastro de evento</h3><br>
                <form method="post" action="cadastro_evento_processamento.php">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Nome do evento</label>
                            <input type="text" class="form-control" id="validationDefault01"
                                placeholder="Nome do Evento" name="nome" required>
                        </div>
                        <div class="col-md-5 mb-3">
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
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02">Cobrança</label>
                            <select class="form-control" name="tipo">
                                <option value="gratis">Grátis</option>
                                <option value="pago">Pago</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">Valor do ingresso</label>
                            <input type="text" class="form-control" id="validationDefault03" placeholder="R$ 0,00"
                                name="valor" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="validationDefault02">Tipo do evento</label>
                            <select class="form-control" name="area">
                                <option> Tipo do evento </option>
                                <option value="palestra">Palestra</option>
                                <option value="minicurso">Minicurso</option>
                            </select>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="validationDefault02">Área</label>
                            <select class="form-control" name="area">
                                <option> Área </option>
                                <option value="palestra">Computação</option>
                                <option value="minicurso">Fisica</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição do evento</label>
                        <textarea class="form-control col-md-12" id="exampleFormControlTextarea1" rows="3"
                            name="descricao"></textarea>
                    </div>
                    <div class="form row">
                        <div class='col-md-4 ml-8 mb-3'>
                            Data de inicio do evento
                            <input type='text' class="form-control" id='datepicker' placeholder='Data inicio'
                                name="data_inicio">
                        </div>
                        <div class='col-sm-4 ml-3 mb-3'>
                            Data de final do evento
                            <input type='text' class="form-control" id='datepicker1' placeholder='Data final'
                                name="data_fim">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7 mb-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" id="cep" placeholder="CEP" name="cep" maxlength="9"
                                onblur="pesquisacep(this.value);" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" placeholder="Endereço"
                                    name="endereco" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro"
                                    required>
                        </div>

                        <div class="col-md-6 mb-5">
                            <label>Cidade</label>
                            <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade"
                                required>
                        </div>

                        <div class="col-md-4 mb-5">
                            <label for="validationDefault03">Estado</label>
                            <input type="text" class="form-control" id="estado" placeholder="Estado" name="estado"
                                required>
                        </div>

                    </div>
                    <center>
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
                    </center>
                </form>

            </div>

            <div class="container-fluid">

            </div>
        </div>
    </div>


</body>

</html>