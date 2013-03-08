<?php
session_start();
session_destroy();
session_unset();
?>
<html>
<head>
    <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsGenerico.js"></script>

    <script>
    $(function() {
        $( "#cadastrarEmpresa" )
            .button()
            .click(function() {
                $("#dialogCadastrarEmpresa").dialog({
                    autoOpen: false,
                    closeOnEscape: true,
                    height: 550,
                    width: 720,
                    modal: true,
                    draggable:true,
                    resizeable:false,
                    title: 'Cadastrar sua empresa',
                    buttons: {
                        Gravar: function() {
                            if($('#cnpj').val() == ''){
                                alertPadrao('Digitar o C.N.P.J.');
                                return false;
                            }
                            if($('#razaoSocial').val() == ''){
                                alertPadrao('Digitar a razão social.');
                                return false;
                            }
                            if($('#nomeFantasia').val() == ''){
                                alertPadrao('Digitar o nome fantasia.');
                                return false;
                            }
                            if($('#endereco').val() == ''){
                                alertPadrao('Digitar o endereço.');
                                return false;
                            }
                            if($('#bairro').val() == ''){
                                alertPadrao('Digitar o bairro.');
                                return false;
                            }
                            if($('#uf').val() == ''){
                                alertPadrao('Selecionar o estado (UF).');
                                return false;
                            }
                            if($('#cep').val() == ''){
                                alertPadrao('Digitar o CEP.');
                                return false;
                            }
                            if($('#telefoneComercial').val() == ''){
                                alertPadrao('Digitar o telefone comercial.');
                                return false;
                            }
                            if($('#telefoneCelular').val() == ''){
                                alertPadrao('Digitar o telefone celular.');
                                return false;
                            }
                            if($('#representanteLegal').val() == ''){
                                alertPadrao('Digitar o representante legal.');
                                return false;
                            }
                            if($('#cargo').val() == ''){
                                alertPadrao('Digitar o cargo.');
                                return false;
                            }
                            if($('#email').val() == ''){
                                alertPadrao('Digitar o e-mail.');
                                return false;
                            }
                            if($('#beneficio').val() == ''){
                                alertPadrao('Digitar o beneficio.');
                                return false;
                            }
                            if($('#horarioSerCumprido').val() == ''){
                                alertPadrao('Digitar o horário a ser cumprido.');
                                return false;
                            }
                            if($('#horasDiaria').val() == ''){
                                alertPadrao('Digitar as horas diária.');
                                return false;
                            }
                            if($('#horasSemanais').val() == ''){
                                alertPadrao('Digitar as horas semanais.');
                                return false;
                            }
                            var dados = $("#formEmpresa").serialize();
                            $.ajax({
                                dataType: "json",
                                url: "bcoEmpresa/gravarEmpresa.php",
                                data: dados,
                                success: function(retorno){
                                    $( "#dialogCadastrarEmpresa" ).dialog( "destroy" );
                                    if(retorno.sucesso == true){
                                        alertPadrao('<strong>Dados cadastrado com sucesso.</strong><br><br>Seus dados ser&atilde;o analisados pelo IPECON, assim que aprovados, receber&aacute; um e-mail com instru&ccedil;&otilde;es para acesso.<br><br>Ipecon agradece pelo seu cadastro.','Alerta');
                                    }else{
                                        alertPadrao(retorno.msgResposta,'Alerta');
                                    }
                                }
                            });
                        }
                    },
                    close : function() {
                        $(this).dialog( "destroy" );
                    }
                }).load("bcoEmpresa/cadEmpresaWeb.php");
                $("#dialogCadastrarEmpresa").dialog('open');
                return false;
            });

        $( "#btnEntrar" )
            .button()
            .click(function() {
                var dados = $("#frmLogin").serialize();
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "authEmpresa.php",
                    data: dados,
                    success: function(retorno){
                        if(retorno.sucesso == true){
                            $("#mensagem").html('');
                            $("#frmLogin").slideUp('slow', function() {
                                top.location.href='principalEmpresa.php';
                            });
                        }else{
                            $('#mensagem').html(retorno.msgResposta);
                        }
                    }
                });

                return false;
            });
    });
    </script>

    <style type="text/css">
        body {
            background-color: #F7F7F7;
            font: normal 12px/20px Helvetica,Arial;
            text-align: center; /* hack para o bosta do ie */
        }

        .divLogin {
            width: 500px;
            background-color: #EEE;
            margin: 0 auto;
            padding: 5px;
            border-radius: 3px;
        }
        .divLogin .content {
            margin: 5px;
            background-color: white;
            border-radius: 3px;
            border: 1px solid #CCC;
            padding: 10px;
            text-align: left;
        }
        input{
            border: solid 1px #CCCCCC;
        }
        h1{
            text-align: center;color: #505667;
            font: 50px museo-sans-1,sans-serif;
            margin: 20px 0;
            text-align: center;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        p{
            margin: 5px 0;
        }
        .txtEmail, .txtSenha{
            padding: 5px;
            width:  250px;
        }
        .content #mensagem{
            color: #FF0000;
        }
        .modal{
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Banco de Oportunidades</h1>
    <div class="divLogin">
        <div class="content">
            <form name="frmLogin" id="frmLogin" action="authEmpresa.php" method="POST">
                <p>E-Mail:<br><input type="text" name="email" id="email" class="txtEmail" /></p>
                <p>Senha:<br><input type="password" name="senha" id="senha" class="txtSenha" /></p>
                <p><button id="btnEntrar">Entrar</button>
                   <button id="cadastrarEmpresa">Cadastrar empresa</button></p>
            </form>
            <div id="mensagem"></div>
        </div>
    </div>
    <div id="dialogCadastrarEmpresa"></div>
</body>
</html>
