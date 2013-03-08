<?php
require_once '../conexaoBdo.inc.php';
require_once '../class/util.class.php';
$util = new Util();

$sql = "select 
               VAG.ID
              ,VAG.ID_EMPRESA
              ,EMP.RAZAO_SOCIAL
              ,VAG.TITULO
              ,VAG.DESCRICAO
              ,VAG.CARGO
              ,VAG.CARGA_HORARIA
              ,VAG.ATIVIDADES
              ,VAG.PERFIL_DESEJADO
              ,VAG.SALARIO
              ,VAG.BENEFICIOS
              ,VAG.DATA_INICIO_VIGENCIA
              ,VAG.DATA_FINAL_VIGENCIA
        from
               vagas VAG
        inner join empresas EMP on 
               EMP.ID = VAG.ID_EMPRESA
        where
               VAG.ID = ".$_REQUEST['ID_VAGA'];
$consulta = $pdo->prepare($sql);
$consulta->execute();
$registro = $consulta->fetch(PDO::FETCH_OBJ);
?>
<html>
<head>
    <title>Banco de Oportunidade :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="../css/bo.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsGenerico.js"></script>

</head>
<body>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" id="detalheVagas">
        <tr>
            <td style="width: 28%"><strong>T&iacute;tulo:</strong></td>
            <td><?php echo $registro->TITULO; ?></td>
        </tr>
        <tr class="tdCinzaClaro">
            <td><strong>Cargo:</strong></td>
            <td><?php echo $registro->CARGO; ?></td>
        </tr>
        <tr>
            <td><strong>Descri&ccedil;&atilde;o:</strong></td>
            <td><?php echo nl2br($registro->DESCRICAO); ?></td>
        </tr>
        <tr class="tdCinzaClaro">
            <td><strong>Carga hor&aacute;ria:</strong></td>
            <td><?php echo $registro->CARGA_HORARIA; ?></td>
        </tr>
        <tr>
            <td><strong>Atividades:</strong></td>
            <td><?php echo nl2br($registro->ATIVIDADES); ?></td>
        </tr>
        <tr class="tdCinzaClaro">
            <td><strong>Perfil desejado:</strong></td>
            <td><?php echo nl2br($registro->PERFIL_DESEJADO); ?></td>
        </tr>
        <tr>
            <td><strong>Sal&aacute;rio:</strong></td>
            <td><?php echo number_format($registro->SALARIO,2,',','.'); ?></td>
        </tr>
        <tr class="tdCinzaClaro">
            <td><strong>Benef&iacute;cios:</strong></td>
            <td><?php echo nl2br($registro->BENEFICIOS); ?></td>
        </tr>
        <tr>
            <td><strong>In&iacute;cio de vig&ecirc;ncia:</strong></td>
            <td><?php echo Util::formataData($registro->DATA_INICIO_VIGENCIA, '-', '/'); ?></td>
        </tr>
        <tr class="tdCinzaClaro">
            <td><strong>Final da vig&ecirc;ncia:</strong></td>
            <td><?php echo Util::formataData($registro->DATA_FINAL_VIGENCIA, '-', '/'); ?></td>
        </tr>
    </table>
</body>
</html>