<?php
session_start();

require_once '../class/util.class.php';

if (isset($_REQUEST['ID_VAGA']) && $_REQUEST['ID_VAGA'] != '') {
    /* Conexao */
    require_once '../conexaoBdo.inc.php';

    $sql = "select 
                   VAG.*
            from
                   vagas VAG
            where
                   VAG.ID = ".$_REQUEST['ID_VAGA'];
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_OBJ);
}
?>
<html>
<head>
    <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="../css/bo.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js" type="text/javascript"></script>
    <script src="js/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="js/jsGenerico.js" type="text/javascript"></script>    
    <script>$("#salario").maskMoney({thousands:'.', decimal:','});</script>
</head>
<body>
<form name="" id="formVaga" method="post" action="">
    <input type="hidden" name="idVaga" id="idVaga" value="<?php echo (isset($registro) && $registro->ID ? $registro->ID : '') ?>" />
    <input id="idEmpresa" name="idEmpresa" value="<?php echo $_SESSION['ID']; ?>" type="hidden" />
    <input id="tipoAcao" name="tipoAcao" value="<?php echo (isset($registro) && $registro->ID ? '2' : '1') ?>" type="hidden" />
    <p>Aten&ccedil;&atilde;o, campos em <span class="vermelho">vermelho</span> s&atilde;o obrigat&oacute;rios</p>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="vermelho">T&iacute;tulo:</td>
                <td><input type="text" id="titulo" name="titulo" value="<?php echo (isset($registro) && $registro->TITULO ? $registro->TITULO : '') ?>" class="txtGrande" /></td>
        </tr>
        <tr>
                <td class="vermelho">Cargo:</td>
                <td><input type="text" id="cargo" name="cargo" value="<?php echo (isset($registro) && $registro->CARGO ? $registro->CARGO : '') ?>" class="txtGrande" /></td>
        </tr>
        <tr>
            <td class="vermelho">Descri&ccedil;&atilde;o:</td>
                <td><textarea id="descricao" name="descricao" class="txtGrande"><?php echo (isset($registro) && $registro->DESCRICAO ? $registro->DESCRICAO : '') ?></textarea></td>
        </tr>
        <tr>
            <td class="vermelho">Carga hor&aacute;ria:</td>
                <td><input type="text" id="cargaHoraria" name="cargaHoraria" value="<?php echo (isset($registro) && $registro->CARGA_HORARIA ? $registro->CARGA_HORARIA : '') ?>" class="txtPequeno" /></td>
        </tr>
        <tr>
                <td class="vermelho">Atividades:</td>
                <td><textarea id="atividade" name="atividade" class="txtGrande"><?php echo (isset($registro) && $registro->ATIVIDADES ? $registro->ATIVIDADES : '') ?></textarea></td>
        </tr>
        <tr>
                <td class="vermelho">Perfil desejado:</td>
                <td><textarea id="perfilDesejado" name="perfilDesejado" class="txtGrande"><?php echo (isset($registro) && $registro->PERFIL_DESEJADO ? $registro->PERFIL_DESEJADO : '') ?></textarea></td>
        </tr>
        <tr>
            <td>Sal&aacute;rio:</td>
            <td><input type="text" id="salario" name="salario" value="<?php echo (isset($registro) && $registro->SALARIO ? number_format($registro->SALARIO,2,',','.') : '') ?>" class="txtPequeno" /></td>
        </tr>
        <tr>
            <td class="vermelho">Benef&iacute;cios:</td>
                <td><textarea id="beneficio" name="beneficio" class="txtGrande"><?php echo (isset($registro) && $registro->BENEFICIOS ? $registro->BENEFICIOS : '') ?></textarea></td>
        </tr>
        <tr>
            <td class="vermelho">In&iacute;cio de vig&ecirc;ncia:</td>
                <td><input type="text" id="dtInicioVigencia" name="dtInicioVigencia" maxlength="10" value="<?php echo (isset($registro) && $registro->DATA_INICIO_VIGENCIA ? Util::formataData($registro->DATA_INICIO_VIGENCIA,'-','/') : '') ?>" class="txtPequeno" /></td>
        </tr>
        <tr>
            <td class="vermelho">Final da vig&ecirc;ncia:</td>
            <td><input type="text" id="dtFinalVigencia" name="dtFinalVigencia" maxlength="10" value="<?php echo (isset($registro) && $registro->DATA_FINAL_VIGENCIA ? Util::formataData($registro->DATA_FINAL_VIGENCIA,'-','/') : '') ?>" class="txtPequeno" /></td>
        </tr>
    </table>
</form>
</body>
</html>