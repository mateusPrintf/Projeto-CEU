<? require_once "../../../../service/validador_acesso.php"; ?>

<?php

    include_once "../../../../service/conexao.php";

    try {
        $conexao = new Conexao();
        
        $query = "select * from tb_atividade where id_evento = :id";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();

        $atividades = $stmt->fetchAll(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
    } catch (PDOException $e) {
        echo 'Mensagem: '.$e->getMessage();
        //podendo ser feito um registro de erros(logs) do sistema
    }

?>

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

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../../_css/style_menu.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    
    <script>
    $(function() {
        $("#calendario").datepicker({
            minDate: 0,
            dateFormat: 'dd/mm/yy',
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junio', 'Julho', 'Agosto',
                        'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            dayNames: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo'],
            dayNamesMin: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom']
        });
    });

    // $(document).ready(() => {
    //     $('.att button.bntConfirma').each(function() {
    //         $(this).on('click',function(){    
    //             var id = $('#idevt').attr('id');
    //             var value = $('#idevt').siblings('input').val();
        
    //             alert("Botão: "+id + " clicado.  Dado a ser enviado: "+ value);
                
    //         });
    //     });
    // })

    var passedID
    $(document).ready(() => {
        $(".bntConfirma").click(function () {
            passedID = $(this).attr('id');
            $('input[name="id_att"]').attr('value',passedID);
            //alert(passedID);
        })
    })

    /*  
    $(document).ready(() => {                       //função vital
        $('#btnConfirmar').click(() => {
            $.ajax({                                //passando o id via post com o ajax (mt toppen)
                type: 'POST',
                url: 'cadastro_cupom.php',
                cache: false,
                data: {'id_att': passedID},
                success : function(retorno){
                    var resultado = JSON.parse(retorno);
                    document.title = resultado;
                },
            })
        })
    })
        });
    })*/    


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
                <a href="../cadastrarAtividade/?id=<?=$_GET['id']?>">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Cadastrar Atividade
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Atividades Cadastradas
                </a>
            </li>
        </ul>
    </div>

    <div class="content-container">

        <div class="container-fluid">
            <div class="container-fluid">
                <? foreach($atividades as $id => $att) {?>
                    <div class="card container-branco">
                        <div class="card-header">
                            <!--nome qualquer-->
                        </div>
                        <div class="card-body att">
                            <h2 class="card-title"><?=$att->nome?></h2>
                            <hr>
                            <p class="card-text"><strong>Tipo</strong>: <?=$att->tipo?></p>
                            <p class="card-text"><strong>Data de inicio</strong>: <?=$att->data_inicio?></p>
                            <p class="card-text"><strong>Data do fim</strong>: <?=$att->data_fim?></p>
                            <p class="card-text"><strong>Inscrição</strong>: <?=$att->inscricao?></p>
                            <p class="card-text"><strong>Quantidade máxima de participantes</strong>: <?=$att->qntd_part?></p>
                            <p class="card-text"><strong>Valor da Inscrição</strong>: <?=$att->valor?> R$</p>
                            <input type="hidden" class="idevt" id="<?=$id?>" value="<?=$evento->nome?>">
                            <a href="../../../../controller/AtividadeController.php?acao=remover&id=<?=$_GET['id']?>&id_att=<?=$att->id?>" class="btn btn-primary">Excluir atividade</a> <!-- lancar a braba aqui -->
                            <!-- Botão para acionar modal -->
                            <button class="btn btn-primary bntConfirma" id="<?=$evento->id?>" data-toggle="modal" data-target="#ExemploModalCentralizado">
                                Cadastrar cupom
                            </button>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog"
        aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header cupom" style="background: rgb(50, 150, 255)">
                   <h4 class="modal-title" id="TituloModalCentralizado">Cupom de Desconto</h4> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="../../../../controller/CupomController.php?acao=inserir&id=<?=$_GET['id']?>" method="post" id="form_cupom">
                        <div class="form-group">
                            <label for="inputAddress">Código</label>
                            <input type="text" style="text-transform:uppercase" class="form-control" id="inputAddress" placeholder="EX: #PIRI10" name="codigo">
                        </div>
                        <label>Desconto></label>
                        <div class="row">
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="text" class="form-control" name="valor">
                            </div>
                            <b>ou</b>
                            <div class="input-group col">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                <input type="text" class="form-control" name="porcentagem">
                            </div>
                        </div>
                        <form>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Quantidade</label>
                                    <input type="text" class="form-control" name="qntd">
                                </div>
                                <div class="col">
                                    <label>Validade</label>
                                    <input type='text' class="form-control" id="calendario" name="validade">
                                </div>
                            </div>
                            <div>
                                <input type="hidden" id="#idAtt" value="" name="id_att">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                <button type="submit" id="btnConfirmar" class="btn btn-primary">Confirmar</button>
                            </div>
                        </form>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>