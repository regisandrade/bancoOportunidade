<?php
require_once 'conexaoBdo.inc.php';

if (!empty($_POST['email']) && !empty($_POST['senha'])) {
	
    $sql = "select 
                   * 
            from 
                   empresas 
            where 
                   EMAIL = '".$_POST['email']."' 
               and SENHA = '".md5($_POST['senha'])."'";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_OBJ);

    if(!empty($registro)){
        if($registro->STATUS > 1){
            $resposta['msgResposta'] =  "Aten&ccedil;&atilde;o!<br>Empresa n&atilde;o autorizada a acessar o sistema.<br>Entre em contato com IPECON. ";
            $resposta['sucesso']     = false;
        }else{
            session_start();
            $_SESSION['ID'] = $registro->ID;
            $_SESSION['CNPJ'] = $registro->CNPJ;
            $_SESSION['NOME_FANTASIA'] = $registro->NOME_FANTASIA;
            $_SESSION['RAZAO_SOCIAL'] = $registro->RAZAO_SOCIAL;
            $_SESSION['ENDERECO'] = $registro->ENDERECO;
            $_SESSION['BAIRRO'] = $registro->BAIRRO;
            $_SESSION['CIDADE'] = $registro->CIDADE;
            $_SESSION['UF'] = $registro->UF;
            $_SESSION['CEP'] = $registro->CEP;
            $_SESSION['TELEFONE_COMERCIAL'] = $registro->TELEFONE_COMERCIAL;
            $_SESSION['TELEFONE_FAX'] = $registro->TELEFONE_FAX;
            $_SESSION['TELEFONE_CELULAR'] = $registro->TELEFONE_CELULAR;
            $_SESSION['REPRESENTANTE_LEGAL'] = $registro->REPRESENTANTE_LEGAL;
            $_SESSION['RG_REPRESENTANTE_LEGAL'] = $registro->RG_REPRESENTANTE_LEGAL;
            $_SESSION['ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL'] = $registro->ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL;
            $_SESSION['CPF_REPRESENTANTE_LEGAL'] = $registro->CPF_REPRESENTANTE_LEGAL;
            $_SESSION['CARGO_REPRESENTANTE_LEGAL'] = $registro->CARGO_REPRESENTANTE_LEGAL;
            $_SESSION['EMAIL_REPRESENTANTE_LEGAL'] = $registro->EMAIL_REPRESENTANTE_LEGAL;
            $_SESSION['TIPO_EMPRESA'] = $registro->TIPO_EMPRESA;
            $_SESSION['PORTE'] = $registro->PORTE;
            $_SESSION['BENEFICIOS_DISPONIVEIS'] = $registro->BENEFICIOS_DISPONIVEIS;
            $_SESSION['HORARIO_SER_CUMPRIDO'] = $registro->HORARIO_SER_CUMPRIDO;
            $_SESSION['HORAS_DIARIAS'] = $registro->HORAS_DIARIAS;
            $_SESSION['HORAS_SEMANAIS'] = $registro->HORAS_SEMANAIS;
            $_SESSION['EMAIL'] = $registro->EMAIL;
            $_SESSION['LOCAL_CADASTRO'] = $registro->LOCAL_CADASTRO;
            $_SESSION['STATUS'] = $registro->STATUS;
            $_SESSION['DATA_CADASTRO'] = $registro->DATA_CADASTRO;

            $resposta['sucesso'] = true;
        }
    }else{
        $resposta['msgResposta'] =  "Aten&ccedil;&atilde;o, e-mail ou senha incorretos.";
        $resposta['sucesso']     = false;
    }
} else {
    $resposta['msgResposta'] = "Por favor, digitar o e-mail ou senha.";
    $resposta['sucesso']     = false;
}
// JSON
echo json_encode($resposta);