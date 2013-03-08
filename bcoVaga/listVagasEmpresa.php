<?php
session_start();
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
              ,VAG.DATA_INICIO_VIGENCIA	
              ,VAG.DATA_FINAL_VIGENCIA
              ,VAG.SALARIO
        from
               vagas VAG
        inner join empresas EMP on 
               EMP.ID = VAG.ID_EMPRESA
        where
               VAG.ID_EMPRESA = ".$_SESSION['ID']."
        order by
               VAG.ID";
$consulta = $pdo->prepare($sql);
$consulta->execute();
?>
<html>
<head>
    <title>Administração :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="../css/bo.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsComplementos.js"></script>
    <script src="js/jsGenerico.js"></script>
</head>
<body>
    <p><button id="cadastrarVaga">Nova vaga</button></p>
    <table id="listaVagas" border="0" cellpadding="0" cellspacing="2">
        <tr>
            <td class="cabecalho"><strong>T&iacute;tulo</strong></td>
            <td class="cabecalho"><strong>Descri&ccedil;&atilde;o</strong></td>
            <td class="cabecalho"><strong>Cargo</strong></td>
            <td class="cabecalho"><strong>Sal&aacute;rio</strong></td>
            <td class="cabecalho data"><strong>In&iacute;cio Vig&ecirc;ncia</strong></td>
            <td class="cabecalho data"><strong>Final Vig&ecirc;ncia</strong></td>
            <td class="cabecalho opcoes"><strong>Op&ccedil;&odblac;es</strong></td>
        </tr>
        <?php
        $conta = 0;
        while ($registro = $consulta->fetch(PDO::FETCH_OBJ)) {
            if($conta % 2 == 1){
                $cor = '#C6E2FF';
            }else{
                $cor = '#FFFFFF';
            }
        ?>
        <tr class="linha" bgcolor="<?php echo $cor; ?>">
            <td><?php echo $registro->TITULO; ?></td>
            <td><?php echo $registro->DESCRICAO; ?></td>
            <td><?php echo $registro->CARGO; ?></td>
            <td>R$ <?php echo number_format($registro->SALARIO,2,',','.'); ?></td>
            <td class="data"><?php echo Util::formataData($registro->DATA_INICIO_VIGENCIA, '-', '/'); ?></td>
            <td class="data"><?php echo Util::formataData($registro->DATA_FINAL_VIGENCIA, '-', '/'); ?></td>
            <td class="opcoes"><a href="#" title="Visualizar vaga" onClick="javaScript:verVaga(this)" idVaga="<?php echo $registro->ID; ?>"><span class="ui-icon ui-icon-contact"></span></a>
                &nbsp;<a href="#" title="Alterar vaga" onClick="alterarVaga(this)" idVaga="<?php echo $registro->ID; ?>"><span class="ui-icon ui-icon-pencil"></span></a>
                &nbsp;<a href="#" title="Excluir vaga" onclick="excluirVaga(this)" idVaga="<?php echo $registro->ID; ?>"><span class="ui-icon ui-icon-trash"></span></a></td>
        </tr>
        <?php
            $conta++;
        }
        $pdo = null;
        ?>
    </table>
    <div id="dialogVaga"></div>
</body>
</html>
