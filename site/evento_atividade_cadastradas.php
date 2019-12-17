<? require_once "validador_acesso.php"; ?>

<?php

    include_once "./conexao.php";

    try {
        $conexao = new Conexao();
        
        $query = "select * from tb_atividade where id_evento = :id";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();

        $eventos = $stmt->fetchAll(PDO::FETCH_OBJ); //PDO::FETCH_BOTH, _ASSOC, _NUM, _OBJ  
        
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
    <link rel="stylesheet" href="./_css/style_menu.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_gerenciamento_usuario.css">
    <link rel="stylesheet" href="./_css/style_menu.css">
    <link rel="stylesheet" href="./_css/style_evento_gerenciamento.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./_css/style_menu.css">
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
                        <a href="#inicio">Início</a>
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
            Gerenciamento evento
        </div>
        <ul class="sidebar-navigation">
            <li>
                <a href="./gerenciamento_user_inicio.php">
                    <i class="fa fa-home" aria-hidden="true"></i> Meu usuario
                </a>
            </li>
            <li>
                <a href="./evento_gerenciamento.php?id=<?=$_GET['id']?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Informações
                </a>
            </li>
            <li>
                <a href="./evento_cadastro_atividade.php?id=<?=$_GET['id']?>">
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
                <? foreach($eventos as $id => $evento) {?>
                    <div class="card container-branco">
                        <div class="card-header">
                            <!--nome qualquer-->
                        </div>
                        <div class="card-body att">
                            <h2 class="card-title"><?=$evento->nome?></h2>
                            <hr>
                            <p class="card-text"><strong>Tipo</strong>: <?=$evento->tipo?></p>
                            <p class="card-text"><strong>Data de inicio</strong>: <?=$evento->data_inicio?></p>
                            <p class="card-text"><strong>Data do fim</strong>: <?=$evento->data_fim?></p>
                            <p class="card-text"><strong>Inscrição</strong>: <?=$evento->inscricao?></p>
                            <p class="card-text"><strong>Quantidade máxima de participantes</strong>: <?=$evento->qntd_part?></p>
                            <p class="card-text"><strong>Valor da Inscrição</strong>: <?=$evento->valor?> R$</p>
                            <input type="hidden" class="idevt" id="<?=$id?>" value="<?=$evento->nome?>">
                            <a href="#" class="btn btn-primary">Excluir atividade</a>
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
                    <form action="cadastro_cupom.php?id=<?=$_GET['id']?>" method="post" id="form_cupom">
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