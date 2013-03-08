function alertaConfirma(titulo, mensagem, evalFuncSim, evalFuncNao){  
	
	if(titulo == '' || titulo == null){
		titulo = 'Alerta';
	}
	
	xheight = 150;  	   

  	$('body').append('<div class="modalConfirma" title="'+titulo+'" style="z-index: 9999999999999999" >'+mensagem+'</div>');      	 	
	 	$('body').find('.modalConfirma').each(function(e){
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
	 					"SIM": function() { 
	 						$(this).dialog('close'); 
				            if(evalFuncSim){
				        		eval(evalFuncSim);
				        	}		 					        	 					       	 						     	 								
	 					},
	 					"NÃO": function() {
	 						$(this).dialog('close');
				            if(evalFuncNao){
				        		eval(evalFuncNao);
				        	}			 							
	 					}                   	 					
	 				},
	 		        close : function() {
	 		            $(this).remove();
	 		        }
	 		    });		
	 	}); 	
}

function unLoading(id){
	if($('#modalDiv'+id).length > 0){
		$('#modalDiv'+id+',#aguarde'+id).remove();
	}
	else if(id == 'all' || id === false){
		$('.waitScreenBackground,.waitScreen').remove();
	}
}

function loading(id,mensagem){
	if(id == false){
		$('.waitScreenBackground,.waitScreen').remove();
	}else if($('#modalDiv'+id).length > 0){
		return false;
	}else{
		if(typeof(mensagem) == 'string') {
			append = mensagem;
		}else{
			append = 'Aguarde, carregando...';
		}

		tela = '<div class="ui-widget-overlay waitScreenBackground" id="modalDiv'+id+'">'
				+'</div>'
				+'<div id="aguarde'+id+'" class="ui-dialog ui-widget ui-widget-content ui-draggable waitScreen">'+append+'<br/><img src="imagens/gif/loader-bar.gif" align="center"></div>';
		$('body').prepend(tela);
		$('.waitScreen').css({
		'z-index': '99999999', 
		'position' : 'fixed',
		'display' : 'block',
		'text-align': 'center', 
		'top': '-35px',
		'margin-top': '30%', 
		'left': '-150px', 
		'margin-left': '50%',
		'background-color': '#fff',
		'color': '#333',
		'font-size': '11px',
		'width': '300', 
		'height': '70px',
		'vertical-align': 'middle',
		'border': '1px solid #999',
		'box-shadow':  '#666 0px 0px 15px',
		'-moz-box-shadow': '#666 0px 0px 15px',
		'-webkit-box-shadow': '#666 0px 0px 15px',
		'-opera-box-shadow': '#666 0px 0px 15px',
		'padding-top': '20px'
	});

	$('.waitScreenBackground').css({
		'width': $(document).width() + 'px', 
		'height': $(document).height() + 'px',
		'z-index': '9999', 
		'scroll': 'false',
		'-moz-box-shadow': 'inset 0 0 90px #000',
		'-webkit-box-shadow': 'inset 0 0 90px #000',
		'-opera-box-shadow': 'inset 0 0 90px #000',
		'box-shadow' : 'inset 0 0 90px #000'
		});
	}

	//$('#modalDiv'+id).focus();
}

function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds){
			break;
		}
	}
}

function consoleSite(linha){
	if(navigator.appName != 'Microsoft Internet Explorer'){
		console.log(linha);
	}else{
		tipo = typeof(linha);
		if(typeof(linha) != 'string' && typeof(linha) != 'number'){
			linha = objectToString(linha);
		}
		
		myWindow = window.open('','consoleSite','width=740,height=300');
		
		myWindow.document.writeln('['+tipo+']');	
		myWindow.document.writeln(linha + "<br/>");
		
		myWindow.focus();
	}
}

function print_r(theObj) {
	document.write(objectToString(theObj));
}

function ajax(url,params){

	var ret = $.ajax({
		type : "POST",
		url : url,
		dataType: 'json',
		data : params,
		async: false,
		success : function(resposta) {			
			return resposta;			
		},
		error: function(){			
			return false;
		}	
	});

	return validaResposta(ret,url,params);	
}

function validaCampos(){
	var camposVazios = '';
	var retorno = true;
	
	$('body').find('.requerido').each(function(){
		
		titulo = $(this).attr('label') ? $(this).attr('label') : ($(this).attr('name') ? $(this).attr('name') : $(this).attr('id'));
		
		if($(this).val() == '' && titulo){
			camposVazios = camposVazios + ' ' + titulo + ',';
			retorno = false;
		}
    });
	
	if(retorno == false){
		alertPadrao('Os campos' + camposVazios.substr(0,(camposVazios.length -1)) + ' são obrigatórios!');
		return false;
	}else{
		return true;
	}
	
}