<?php
require_once '../conexaoBdo.inc.php';

$sql = "select * from curriculos";
$consulta = $pdo->prepare($sql);
$consulta->execute();
?>
<html>
<head>
	<title>Administração :: IPECON - Ensino e Consultoria</title>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
	<link href="../../css/bo.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../../emx_nav_left.css" type="text/css">
	<script type="text/javascript" src="../../js/bo.js" charset="iso-8859-1"></script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="19" height="19"><img src="../../img_menu/top_esquerda.gif" width="19" height="19"></td>
        <td width="162" height="19" background="../../img_menu/topo.gif">&nbsp;</td>
        <td width="19"><img src="../../img_menu/top_direita.gif" width="19" height="19"></td>
    </tr>
    <tr>
        <td height="100%" background="../../img_menu/esquerda.gif">&nbsp;</td>
        <td width="100%" valign="top" bgcolor="#FFFFFF">
            <!-- Conteúdo -->
            <form name="formListaCronograma" id="formListaCronograma" action="" metod="POST">
            <table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
                        <h3>[Bco Oportunidade] - Lista de Currículos</h3></div>
                    </td>
                </tr>
                <tr>
                    <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
                </tr>
                <tr>
                    <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
                </tr>
                <tr>
                    <td colspan="2" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                            <tr>
                                <td style="text-align: right;"><a href="principal.php">[Voltar]</a></td>
                            </tr>
                        </table>
                        <table id="tabelaVaga" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="texto">
                            <tr bgcolor="#dddddd">
                                <td class="alturaLinhaTabela"><strong>Nome</strong></td>
                                <td><strong>e-mail</strong></td>
                                <td><strong>Telefone Fixo</strong></td>
                                <td><strong>Telefone Celular</strong></td>
                                <td class="larguraTdOpcoes"><strong>Visualizar</strong></td>
                            </tr>
                            <?php
                            $conta = 0;
                            while ($registro = $consulta->fetch(PDO::FETCH_OBJ)) {
                                if($conta % 2 == 1){
                                    $cor = '#DDEEFF';
                                }else{
                                    $cor = '#FFFFFF';
                                }
                            ?>
                            <tr class="linha" bgcolor="<?php echo $cor; ?>">
                                <td class="alturaLinhaTabela"><?php echo $registro->NOME; ?></td>
                                <td><?php echo $registro->EMAIL; ?></td>
                                <td><?php echo $registro->TELEFONE_FIXO; ?></td>
                                <td><?php echo ($registro->TELEFONE_CELULAR ? $registro->TELEFONE_CELULAR : ''); ?></td>
                                <td class="larguraTdOpcoes"><a href="verCurriculoPdf.php?ID_CURRICULO=<?php echo $registro->ID; ?>" title="Visualizar Currículo" target="_blank"><img src="../../../imagens/gif_file_pdf.gif" /></a></td>
                            </tr>
                            <?php
                                $conta++;
                            }
                            $pdo = null;
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            </form>
        <!-- Fim -->
        </td>
        <td background="../../img_menu/direita.gif">&nbsp;</td>
    </tr>
    <tr>
        <td><img src="../../img_menu/baixo_esquerda.gif" width="19" height="19"></td>
        <td height="19" background="../../img_menu/baixo.gif">&nbsp;</td>
        <td><img src="../../img_menu/baixo_direita.gif" width="19" height="19"></td>
    </tr>
</table>
</body>
</html>