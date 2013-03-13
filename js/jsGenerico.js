function alertPadrao(mensagem,titulo,evalFunction,hash){
    $(document).ready(function() {
        if(titulo == '' || titulo == null){
            titulo = 'Alerta';
        }
        xheight = 150;
        if(mensagem){
            vetor = mensagem.split("<br>");
            xheight = (vetor.length) * 14 + ((mensagem.length/60) * 28) + 150;
            xheight = ((xheight < 150) ? 150 : xheight);
        }

        var existente = false;
        $('.modal').each(function(i,e){
            if($(e).text() == $(mensagem).text()){
                existente = true;
            }
        });

        if(existente){
            return false;
        }
        hashText = '';
        if(hash){
            if($('.modal[hash='+hash+']').length > 0){
                return false;
            }
            hashText = 'hash="'+hash+'"';
        }

        $('body').append('<div class="modal" title="'+titulo+'" style="z-index: 9999999999999999" '+hashText+'>'+mensagem+'</div>');

        $('body').find('.modal').each(function(e){
            $(this).dialog( {
                modal : true,
                closeOnEscape: true,
                autoOpen : true,
                resizable: false,
                draggable: true,
                height: xheight,
                minHeight: 250,
                width: 450,
                buttons: {
                    "OK": function() {
                                if(evalFunction != '' || evalFunction != null){
                                    eval(evalFunction);
                                }
                                $(this).dialog('close');
                            }
                },
                close : function() {
                    $(this).remove();
                }
            });
        });
    });
}

/* Verificar somente Numero */
function verificaNumero(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }else{
        return true;
    }
}

function voltarPaginaLogin(){
    top.location.href='loginEmpresa.php';
    return false;
}

function voltarPaginaPrincipal(){
    top.location.href='principalEmpresa.php';
    return false;
}

function voltarAbaVagas(){
   var $tabs = $('#tabs').tabs();
   $tabs.tabs('select', 2);
   //
   $(this).remove();
   return false;
}

function voltarPaginaPrincipalAluno(){
    top.location.href='home.php';
    return false;
}

// Validar email
function validarEmail (email){
    er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
    if(er.exec(email)){
        return true;
    }else{
        alertPadrao('Aten&ccedil;&atilde;o<br>O e-mail que esta sendo digitado &eacute; inv&aacute;lido. Digite novamente.','Alerta');
        return false;
    }
}

function excluirVaga(obj){
    var idVaga = $(obj).attr('idVaga');
    loading('loadingExcluirVaga','Aguarde, vaga esta sendo exclu&iacute;da...');
    var dados = 'idVaga='+idVaga+'&tipoAcao=3';
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "bcoVaga/gravarVaga.php",
        data: dados,
        success: function(retorno){
            if(retorno.sucesso == true){
                unLoading('loadingExcluirVaga');
                alertPadrao(retorno.msgResposta,'Alerta','voltarAbaVagas();');
            }else{
                unLoading('loadingExcluirVaga');
                alertPadrao(retorno.msgResposta,'Alerta');
            }
        }
    });
    return false;
}

function alterarVaga(obj){
    $(document).ready(function() {
        $('body').append('<div class="alterarVaga" title="Alterar vaga" style="z-index: 9999999999999999"></div>');
        $('body').find('.alterarVaga').each(function(e){
            var idVaga = $(obj).attr('idVaga');
            $(this).dialog({
                modal : true,
                closeOnEscape: true,
                autoOpen : true,
                resizable: false,
                draggable: true,
                //height: auto,
                width: 670,
                open : function () {
                    $(this).load("bcoVaga/cadVagaWeb.php?ID_VAGA="+idVaga);
                },
                buttons: {
                    "Gravar": function(){
                        /* VALIDAR AQUI O FORMULARIO */
                        if ($('#titulo').val() == '') {
                            alertPadrao('Digitar o t&iacute;tulo.');
                            return false;
                        }
                        if ($('#cargo').val() == '') {
                            alertPadrao('Digitar o cargo.');
                            return false;
                        }
                        if ($('#descricao').val() == '') {
                            alertPadrao('Digitar a Descri&ccedil;&atilde;o');
                            return false;
                        }
                        if ($('#cargaHoraria').val() == '') {
                            alertPadrao('Digitar a carga hor&aacute;ria.');
                            return false;
                        }
                        if ($('#atividade').val() == '') {
                            alertPadrao('Digitar a(s) atividade(s).');
                            return false;
                        }
                        if ($('#perfilDesejado').val() == '') {
                            alertPadrao('Digitar o perfil desejado.');
                            return false;
                        }
                        if ($('#beneficio').val() == '') {
                            alertPadrao('Digitar o(s) benef&iacute;cio(s).');
                            return false;
                        }
                        if ($('#atividade').val() == '') {
                            alertPadrao('Digitar a(s) atividade(s).');
                            return false;
                        }
                        if ($('#dtInicioVigencia').val() == '') {
                            alertPadrao('Digitar o in&iacute;cio de vig&ecirc;ncia.');
                            return false;
                        }
                        if ($('#dtFinalVigencia').val() == '') {
                            alertPadrao('Digitar o final de vig&ecirc;ncia.');
                            return false;
                        }
                        // Separar os valores
                        var dtInicio = $('#dtInicioVigencia').val().split('/');
                        var dtFinal = $('#dtFinalVigencia').val().split('/');
                        var confDtInicio = dtInicio[2]+dtInicio[1]+dtInicio[0];
                        var confDtFinal = dtFinal[2]+dtFinal[1]+dtFinal[0];

                        if (confDtFinal < confDtInicio) {
                            alertPadrao('Aten&ccedil;&atilde;o, o final de vig&ecirc;ncia <strong>n&atilde;o</strong> pode ser menor que o in&iacute;cio de vig&ecirc;ncia.');
                            return false;
                        }

                        loading('loadingAlterarVaga','Aguarde, vaga esta sendo alterada...');
                        var dados = $("#formVaga").serialize();
                        $.ajax({
                            dataType: "json",
                            type: "POST",
                            url: "bcoVaga/gravarVaga.php",
                            data: dados,
                            success: function(retorno){
                                if(retorno.sucesso == true){
                                    unLoading('loadingAlterarVaga');
                                    alertPadrao('<strong>Dados alterada com sucesso.</strong>','Alerta','voltarAbaVagas();');
                                }else{
                                    unLoading('loadingAlterarVaga');
                                    alertPadrao(retorno.msgResposta,'Alerta');
                                }
                            }
                        });
                    }
                },
                close : function() {
                    $(this).remove();
                }
            });
        });
    });
}

function verVaga(obj){
    $(document).ready(function() {
        $('body').append('<div class="verVaga" title="Detalhes da vaga" style="z-index: 9999999999999999"></div>');
        $('body').find('.verVaga').each(function(e){
            var idVaga = $(obj).attr('idVaga');
            $(this).dialog( {
                modal : true,
                closeOnEscape: true,
                autoOpen : true,
                resizable: false,
                draggable: true,
                //height: auto,
                width: 550,
                close : function() {
                    $(this).remove();
                },
                open: function() {
                    // Abrir arquivo PHP
                    $(this).load("bcoVaga/verVaga.php?ID_VAGA="+idVaga);
                }
            });
            //$(this).dialog("open");
        });
    });
}


$(document).ready(function() {
   /* Dimensionar o campo para o tamanho certo */
   //$(".Mask").attr("maxlength", $(".Mask").attr("title").length);
   //$(".Mask").attr("size", $(".Mask").attr("title").length);
   $(".Mask").keyup(function(){
        /* Aplicar Mascara */
        if($(this).attr("title").substr($(this).val().length, 1) != "#"){
            $(this).val($(this).val() +  $(this).attr("title").substr($(this).val().length, 1));
        }
    });

    // Datas
    $('#dtInicioVigencia').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dtFinalVigencia').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataNascimento').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataExpedicaoRg').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataPisPasep').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#vencimentoHabilitacao').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataAdmissao_1').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataDemissao_1').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataAdmissao_2').datepicker({
        dateFormat:"dd/mm/yy"
    });
    $('#dataDemissao_2').datepicker({
        dateFormat:"dd/mm/yy"
    });

    $( "#progressbar" ).progressbar({
        value: 37
    });

    $("input[name=rg], input[name=carteiraReservista], input[name=numeroPisPasep], input[name=numeroTituloEleitor], input[name=numeroHabilitacao]").keydown(function(e) {
        if(e.shiftKey) e.preventDefault();
        if (!((e.keyCode==46) || (e.keyCode==8)      //DEL e Backspace
            || ((e.keyCode>=35) && (e.keyCode<=40))  //HOME, END, Setas
            || ((e.keyCode>=96) && (e.keyCode<=105)) //N�merod Pad
            || ((e.keyCode>=48) && (e.keyCode<=57)))) e.preventDefault(); //N�meros
    });


    $( "#btnAlterarSenha" )
        .button()
        .click(function(){
            if($('#email').val() == ''){
                alertPadrao('Digitar o e-mail.','Alerta');
                return false;
            }
            if($('#senha').val() == ''){
                alertPadrao('Digitar a senha.','Alerta');
                return false;
            }
            loading('loadingAlterarSenha','Aguarde, senha esta sendo alterada...');
            var dados = $('#formSenha').serialize();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "bcoEmpresa/gravarEmpresa.php",
                data: dados,
                success: function(retorno){
                    if(retorno.sucesso == true){
                        unLoading('loadingAlterarSenha');
                        alertPadrao(retorno.msgResposta,'Alerta','voltarPaginaPrincipal();');
                    }else{
                        unLoading('loadingAlterarSenha');
                        alertPadrao(retorno.msgResposta,'Alerta');
                    }
                }
            });
        });

    $( "#btnAlterarEmpresa" )
        .button()
        .click(function(){
            if($('#cnpj').val() == ''){
                alertPadrao('Digitar o C.N.P.J..');
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
            if($('#cidade').val() == ''){
                alertPadrao('Digitar a cidade.');
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
            if(!validarEmail($('#email').val())){
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
                alertPadrao('Digitar as horas di�ria.');
                return false;
            }
            if($('#horasSemanais').val() == ''){
                alertPadrao('Digitar as horas semanais.');
                return false;
            }
            loading('loadingAlterarEmpresa','Aguarde, alterando os dados da empresa...');
            var dados = $('#formEmpresa').serialize();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "bcoEmpresa/gravarEmpresa.php",
                data: dados,
                success: function(retorno){
                    if(retorno.sucesso == true){
                        unLoading('loadingAlterarEmpresa');
                        alertPadrao(retorno.msgResposta,'Alerta','voltarPaginaPrincipal()');
                    }else{
                        unLoading('loadingAlterarEmpresa');
                        alertPadrao(retorno.msgResposta,'Alerta');
                    }
                }
            });
        });

    $( "#cadastrarVaga" )
        .button({
                    icons: {
                        primary: "ui-icon-plusthick"
                    }
                })
        .click(function() {
            $("#dialogVaga").dialog({
                autoOpen: false,
                height: 610,
                width: 670,
                modal: true,
                draggable:true,
                resizeable:false,
                title: 'Cadastrar uma vaga',
                buttons: {
                    Gravar: function() {
                        /* VALIDAR AQUI O FORMULARIO */
                        if ($('#titulo').val() == '') {
                            alertPadrao('Digitar o t&iacute;tulo.');
                            return false;
                        }
                        if ($('#cargo').val() == '') {
                            alertPadrao('Digitar o cargo.');
                            return false;
                        }
                        if ($('#descricao').val() == '') {
                            alertPadrao('Digitar a Descri&ccedil;&atilde;o');
                            return false;
                        }
                        if ($('#cargaHoraria').val() == '') {
                            alertPadrao('Digitar a carga hor&aacute;ria.');
                            return false;
                        }
                        if ($('#atividade').val() == '') {
                            alertPadrao('Digitar a(s) atividade(s).');
                            return false;
                        }
                        if ($('#perfilDesejado').val() == '') {
                            alertPadrao('Digitar o perfil desejado.');
                            return false;
                        }
                        if ($('#beneficio').val() == '') {
                            alertPadrao('Digitar o(s) benef&iacute;cio(s).');
                            return false;
                        }
                        if ($('#atividade').val() == '') {
                            alertPadrao('Digitar a(s) atividade(s).');
                            return false;
                        }
                        if ($('#dtInicioVigencia').val() == '') {
                            alertPadrao('Digitar o in&iacute;cio de vig&ecirc;ncia.');
                            return false;
                        }
                        if ($('#dtFinalVigencia').val() == '') {
                            alertPadrao('Digitar o final de vig&ecirc;ncia.');
                            return false;
                        }
                        // Separar os valores
                        var dtInicio = $('#dtInicioVigencia').val().split('/');
                        var dtFinal = $('#dtFinalVigencia').val().split('/');
                        var confDtInicio = dtInicio[2]+dtInicio[1]+dtInicio[0];
                        var confDtFinal = dtFinal[2]+dtFinal[1]+dtFinal[0];

                        if (confDtFinal < confDtInicio) {
                            alertPadrao('Aten&ccedil;&atilde;o, o final de vig&ecirc;ncia <strong>n&atilde;o</strong> pode ser menor que o in&iacute;cio de vig&ecirc;ncia.');
                            return false;
                        }

                        loading('loadingGravarVaga','Aguarde, cadastrando a vaga...');
                        var dados = $("#formVaga").serialize();
                        $.ajax({
                            dataType: "json",
                            type: "POST",
                            url: "bcoVaga/gravarVaga.php",
                            data: dados,
                            success: function(retorno){
                                if(retorno.sucesso == true){
                                    unLoading('loadingGravarVaga');
                                    alertPadrao('<strong>Dados cadastrado com sucesso.</strong><br><br>Sua vaga sera analisada pelo IPECON e logo sera liberada para os alunos.<br><br>Ipecon agradece.','Alerta','voltarPaginaPrincipal();');
                                }else{
                                    unLoading('loadingGravarVaga');
                                    alertPadrao(retorno.msgResposta,'Alerta');
                                }
                            }
                        });
                    }
                },
                close : function() {
                    $("#dialogVaga").dialog( "destroy" );
                }
            }).load("bcoVaga/cadVagaWeb.php");
            $("#dialogVaga").dialog('open');
            return false;
        });

     $( "#btnGravarCurriculo" )
        .button()
        .click(function(){
            if($('#nome').val() == ''){
                alertPadrao('Digitar o nome.');
                return false;
            }
            if($('#sexo').val() == ''){
                alertPadrao('Selecionar o sexo.');
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
            if($('#cidade').val() == ''){
                alertPadrao('Digitar a cidade.');
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
            if($('#telefoneFixo').val() == ''){
                alertPadrao('Digitar o telefone fixo.');
                return false;
            }
            if($('#telefoneCelular').val() == ''){
                alertPadrao('Digitar o telefone celular.');
                return false;
            }
            if($('#email').val() == ''){
                alertPadrao('Digitar o e-mail.');
                return false;
            }
            if(!validarEmail($('#email').val())){
                return false;
            }
            if($('#dataNascimento').val() == ''){
                alertPadrao('Digitar a data de nascimento.');
                return false;
            }
            if($('#estadoCivil').val() == ''){
                alertPadrao('Digitar o estado civil.');
                return false;
            }
            if($('#rg').val() == ''){
                alertPadrao('Digitar o RG.');
                return false;
            }
            if($('#orgaoExpedidor').val() == ''){
                alertPadrao('Digitar o orgão expedidor.');
                return false;
            }
            if($('#cpf').val() == ''){
                alertPadrao('Digitar o CPF.');
                return false;
            }
            if($('#areaInteresse').val() == ''){
                alertPadrao('Digitar a &aacute;rea de Interesse.');
                return false;
            }
            if($('#objetivoProfissional').val() == ''){
                alertPadrao('Digitar o objetivo profissional.');
                return false;
            }
            if($('#disponibilidadeHorario').val() == ''){
                alertPadrao('Selecionar a disponibilidade de hor&aacute;rio.');
                return false;
            }

            //loading('loadingGravarCurriculo','Aguarde, cadastrando a curr&iacute;culo...');
            var dados = $('#formCurriculo').serialize();
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "../admin/bcoOportunidade/bcoCurriculo/gravarCurriculo.php",
                data: dados,
                success: function(retorno){
                    if(retorno.sucesso == true){
                        //unLoading('loadingGravarCurriculo');
                        alertPadrao(retorno.msgResposta,'Alerta','voltarPaginaPrincipalAluno()');
                    }else{
                        //unLoading('loadingGravarCurriculo');
                        alertPadrao(retorno.msgResposta,'Alerta');
                    }
                }
            });
        });
});// fim

function loginAlterarDados(){
	if($('#cpfAluno').val() == ''){
		alertPadrao('Digitar o C.P.F.','Alerta');
		return false;
	}
	if($('#senhaAluno').val() == ''){
		alertPadrao('Digitar a senha.','Alerta');
		return false;
	}
	var dados = $('#login').serialize();
	$.ajax({
		dataType: "json",
		type: "POST",
		url: "authLoginAluno.php",
		data: dados,
		success: function(retorno){
			if(retorno.sucesso == true){
				top.location.href = "formAlterarDadosAluno.php";
			}else{
				alertPadrao(retorno.msgResposta,'Alerta');
			}
		}
	});
        return true;
}

function ativarDesativarEmpresa(idEmpresa,status){
    var descStatus;
    if(status == 'A'){
        descStatus = "Ativar";
    }else{
        descStatus = "Desativar";
    }
    if(confirm("Deseja "+descStatus+" esta Empresa?")){
        var dados = 'idEmpresa='+idEmpresa+'&status='+status+'&tipoAcao=5';
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "gravarEmpresa.php",
            data: dados,
            success: function(retorno){
                if(retorno.sucesso == true){
                    document.location = "listEmpresas.php";
                }else{
                    alertPadrao(retorno.msgResposta,'Alerta');
                }
            }
        });
    }
}

function ativarDesativarVaga(idVaga,status){
    var descStatus;
    if(status == 'A'){
        descStatus = "Ativar";
    }else{
        descStatus = "Desativar";
    }
    if(confirm("Deseja "+descStatus+" esta vaga?")){
        var dados = 'idVaga='+idVaga+'&status='+status+'&tipoAcao=4';
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "gravarVaga.php",
            data: dados,
            success: function(retorno){
                if(retorno.sucesso == true){
                    document.location = "listVagas.php";
                }else{
                    alertPadrao(retorno.msgResposta,'Alerta');
                }
            }
        });
    }
}

function candidatarVaga(idAluno,idVaga){
    if(confirm("Deseja realmente se candidatar a esta vaga?")){
        var dados = 'idAluno='+idAluno+'&idVaga='+idVaga;
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "../admin/bcoOportunidade/bcoVaga/gravarAlunoVaga.php",
            data: dados,
            success: function(retorno){
                if(retorno.sucesso == true){
                    document.location = "home.php";
                }else{
                    alertPadrao(retorno.msgResposta);
                }
            }
        });
    }
}

function enviarVagaTwitter(idVaga,cargo){
    if(confirm("Deseja enviar esta vaga para o Twitter?")){
        var dados = 'ID_VAGA='+idVaga+'&cargo='+cargo;
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "../enviarTwitte.php",
            data: dados,
            success: function(retorno){
                alert('Mensagem da vaga enviado com sucesso para o Twitter!');
            }
        });
    }
}

function enviarVagaFacebook(idVaga,cargo){
    if(confirm("Deseja enviar esta vaga para o Facebook?")){
        var dados = 'ID_VAGA='+idVaga+'&cargo='+cargo;
        $.ajax({
            dataType: "json",
            type: "POST",
            url: "../enviarMsgFacebook.php",
            data: dados,
            success: function(retorno){
                alert('Mensagem da vaga enviado com sucesso para o Facebook!');
            }
        });
    }
}
