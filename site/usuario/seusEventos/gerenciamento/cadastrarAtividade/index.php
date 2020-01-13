<? require_once "../../../../service/validador_acesso.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CEU Online</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="../../../../_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="../../../../_css/style_menu.css">
    <link rel="stylesheet" href="../../../../_css/style_evento_gerenciamento.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    
        $(document).ready(function() {
            $('#datepicker').datepicker({
                minDate: 0,
                dateFormat: 'dd/mm/yy',
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto',
                            'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                dayNames: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
                dayNamesMin: ['Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa', 'Do']
            });
        });

        $(document).ready(function() {
            $('#datepicker1').datepicker({
                minDate: 0,
                dateFormat: 'dd/mm/yy',
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto',
                            'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                dayNames: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
                dayNamesMin: ['Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa', 'Do']
            });
        });
    </script>

</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-full fixed-top" style="background-color: rgb(50, 150, 255); height: 80px;">
        <div class="logo" style="height: 80px">
            <a href="#inicio";>
                <img src="../../../../_imagens/CEU_noname_pequeno.png" />
            </a>
        </div>
        <!-- <a class="navbar-brand" href="#">Inicio</a> -->
        <!-- <button class="navbar-toggler" type="button" <img src="../../../../_imagens/CEU_noname_pequeno.png" alt="logo" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse menuTeste" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../../evento/">Eventos</a>
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
            <a class="nav-link" href="../../../../service/logoff.php">Sair</a>
        </aside>
    </nav>

    <div class="sidebar-container">
        <div class="sidebar-logo">
            Gerenciamento evento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="../../../">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuario
                </a>
            </li>
            <li>
                <a href="../?id=<?=$_GET['id']?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Informações
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Cadastrar Atividade
                </a>
            </li>
            <li>
                <a href="../atividadesCadastradas/?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades Cadastradas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">    
        <div class="container-fluid container-branco">
            <div class="col p-5 bg-white rounded mt-5">
                <h2>Adicionar atividade</h2>
                <hr>
                <form method="post" action="../../../../controller/AtividadeController.php?id=<?=$_GET['id']?>&acao=inserir">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Título da atividade</label>
                            <input type="text" class="form-control" id="validationDefault01" placeholder="Título da atividade" name="nome" required>
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
                            <label for="validationDefault02">Inscrição</label>
                            <select class="form-control" name="inscricao">
                                <option value="gratis">Grátis</option>
                                <option value="pago">Pago</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">Valor da inscriçao</label>
                            <input type="text" class="form-control" id="validationDefault03" placeholder="R$ 0,00" name="valor">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="validationDefault02">Tipo da atividade</label>
                            <select class="form-control" name="tipo">
                                <option> Tipo da atividade </option>
                                <option value="Palestra">Palestra</option>
                                <option value="Apresentacao trabalho">Apresentação de trabalho</option>
                                <option value="Aula">Aula</option>
                                <option value="Conferência">Conferência</option>
                                <option value="Curso">Curso</option>
                                <option value="Exposicao">Exposição</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Minicurso">Minicurso</option>
                            </select>
                        </div>
                    </div>
                    <div class="form row">
                            <div class='col-md-4 ml-8 mb-3'>
                                Data e hora do inicio
                                <input type='text' class="form-control" id='datepicker' placeholder='Data inicio' name="data_inicio" required> 
                            </div>
                            <div class='col-sm-4 ml-3 mb-3'>
                                Data e hora do final
                                <input type='text' class="form-control" id='datepicker1' placeholder='Data final' name="data_fim" required>  
                            </div>
                    </div>
                    <div class="form row">
                        <div class='col-md-4 ml-8 mb-3'>
                            Carga horária
                            <input type='text' class="form-control" placeholder='Carga horária' name="carga_hr" required> 
                        </div>
                    </div>                    
                    <div class="button-env">
                        <button class="btn btn-primary" type="submit">Cadastrar atividade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>