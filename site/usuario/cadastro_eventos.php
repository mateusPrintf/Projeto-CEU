<? require_once("../service/validador_acesso.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> <!-- ssl -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('../service/busca_cep.php'); ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../_css/style_cadastro.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../_css/style_menu.css">

    <title>CEU - Cadastro de Eventos</title>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datepicker').datepicker({
                minDate: 0,
                dateFormat: 'dd/mm/yy',
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto',
                            'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                dayNames: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
                dayNamesMin: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom']
            });
        });

        $(document).ready(function() {
            $('#datepicker1').datepicker({
                minDate: 0,
                dateFormat: 'dd/mm/yy',
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto',
                            'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                dayNames: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
                dayNamesMin: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom']
            });
        });

        $(document).ready(function() {
            $('#tipoPag').on('change', function() {
                var selectValue = '#' + $(this).val()
                if (selectValue == '#gratis') {
                    $('#pago').hide()
                    $('#pago').children('input').attr('value', 0)
                }
                else $('#pago').show()
            });
        });
    </script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="./_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li> -->
                
            </ul>
        </div>
        <aside class="nav-item">
            <a class="nav-link" href="../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="./">
                    <i class="fa fa-home" aria-hidden="true"></i> Inicio
                </a>
            </li>
            <!-- <li>
                <a href="./usuario/seusEventos/">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Seus eventos
                </a>
            </li>
            <li>
                <a href="./usuario/eventosInscritos/">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Eventos inscritos
                </a>
            </li> -->
            <!-- <li>
                <a href="../metodo_pagamento.php">
                    <i class="fa fa-users" aria-hidden="true"></i> Pagamentos
                </a>
            </li> -->
            <!-- <li>
                <a href="./usuario/informacoes/">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Informações
                </a>
            </li> -->
        </ul>
    </div>

    <div class="content-container">

        
        <div class="container-fluid">
            <nav aria-label="breadcrumb" style="margin-top: 3.5em">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro eventos</li>
                </ol>
            </nav>
            
            <!-- Main component for a primary marketing message or call to action -->

            <div class="container">
                    <article class="row margin-formulario">
                        <article class="usuCadast">
                            <div class="col p-5 bg-white rounded">
                                <form method="post" action="../controller/EventoController.php?acao=inserir">
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
                                        <div class="col-md-5 mb-3">
                                            <label>Cobrança</label>
                                            <select id="tipoPag" name="tipo"class="form-control" >
                                                <option value="">Selecione</option>
                                                <option value="gratis">Grátis</option>
                                                <option value="pago">Pago</option>
                                            </select>
                                        </div>
                                        <div id="pai" class="col-md-5 mb-3">
                                            <div id="pago">
                                                <label for="validationDefault03">Valor do ingresso</label>
                                                <input type="text" class="form-control" id="validationDefault03"
                                                    placeholder="R$ 0,00" name="valor" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="validationDefault02">Tipo do evento</label>
                                            <select class="form-control" name="tipo">
                                                <option> Tipo do evento </option>
                                                <option value="Palestra">Palestra</option>
                                                <option value="Minicurso">Minicurso</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="validationDefault02">Área</label>
                                            <select class="form-control" name="area">
                                                <option> Área </option>
                                                <option value="Computação">Computação</option>
                                                <option value="Fisica">Fisica</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4"
                                                placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Descrição do evento</label>
                                        <textarea class="form-control col-md-12" id="exampleFormControlTextarea1"
                                            rows="3" name="descricao"></textarea>
                                    </div>
                                    <div class="form row">
                                        <div class='col-md-4 ml-8 mb-3'>
                                            Data de inicio do evento
                                            <input type='text' class="form-control" id='datepicker'
                                                placeholder='Data inicio' name="data_inicio">
                                        </div>
                                        <div class='col-sm-4 ml-3 mb-3'>
                                            Data de final do evento
                                            <input type='text' class="form-control" id='datepicker1'
                                                placeholder='Data final' name="data_fim">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-7 mb-3">
                                            <label>CEP</label>
                                            <input type="text" class="form-control" id="cep" placeholder="CEP"
                                                name="cep" maxlength="9" onblur="pesquisacep(this.value);" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label">Endereço</label>
                                                <input type="text" class="form-control" id="endereco"
                                                    placeholder="Endereço" name="endereco" required>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" placeholder="Bairro"
                                                    name="bairro" required>
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" id="cidade" placeholder="Cidade"
                                                name="cidade" required>
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label for="validationDefault03">Estado</label>
                                            <input type="text" class="form-control" id="estado" placeholder="Estado"
                                                name="estado" required>
                                        </div>

                                    </div>
                                    <div class="forms-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                                required>
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

            <div class="container-fluid">

            </div>
        </div>
    </div>


</body>

</html>