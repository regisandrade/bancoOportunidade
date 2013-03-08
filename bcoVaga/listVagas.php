<?php
require_once '../conexaoBdo.inc.php';
require_once '../class/util.class.php';
$util = new Util();

$sql = "select
               VAG.ID
              ,VAG.ID_EMPRESA
              ,EMP.RAZAO_SOCIAL
              ,VAG.TITULO
              ,VAG.CARGO
              ,VAG.DATA_INICIO_VIGENCIA
              ,VAG.DATA_FINAL_VIGENCIA
              ,VAG.STATUS
        from
               vagas VAG
        inner join empresas EMP on
               EMP.ID = VAG.ID_EMPRESA
        order by
               VAG.ID";
$consulta = $pdo->prepare($sql);
$consulta->execute();
?>
<html>
<head>
    <title>Administração :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=iso-8859-1" http-equiv="Content-Type" />
    <link type="text/css" rel="stylesheet" href="../../css/bo.css" />
    <link type="text/css" rel="stylesheet" href="../../emx_nav_left.css" />
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/jsComplementos.js"></script>
    <script type="text/javascript" src="../js/jsGenerico.js"></script>
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
                        <h3>[Bco Oportunidade] - Lista de Vagas</h3></div>
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
                                <td class="alturaLinhaTabela"><strong>Empresa</strong></td>
                                <td><strong>T&iacute;tulo</strong></td>
                                <td><strong>Cargo</strong></td>
                                <td class="larguraTdData"><strong>In&iacute;cio Vig&ecirc;ncia</strong></td>
                                <td class="larguraTdData"><strong>Final Vig&ecirc;ncia</strong></td>
                                <td class="larguraTdOpcoes"><strong>Op&ccedil;&otilde;es</strong></td>
                            </tr>
                            <?php
                            $conta = 0;
                            while ($registro = $consulta->fetch(PDO::FETCH_OBJ)) {
                                if($conta % 2 == 1){
                                    $cor = '#DDEEFF';
                                }else{
                                    $cor = '#FFFFFF';
                                }
                                if($registro->STATUS == 'I'){
                                    $img = "../../imagens/gif_ativar.gif";
                                    $titulo = "Ativar Vaga";
                                    $status = "A";
                                }else{
                                    $img = "../../../imagens/excluir.gif";
                                    $titulo = "Desativar Vaga";
                                    $status = "I";
                                }
                            ?>
                            <tr class="linha" bgcolor="<?php echo $cor; ?>">
                                <td class="alturaLinhaTabela larguraTd30"><?php echo $registro->RAZAO_SOCIAL; ?></td>
                                <td class="larguraTd20"><?php echo $registro->TITULO; ?></td>
                                <td class="larguraTd20"><?php echo $registro->CARGO; ?></td>
                                <td class="larguraTdData"><?php echo Util::formataData($registro->DATA_INICIO_VIGENCIA, '-', '/'); ?></td>
                                <td class="larguraTdData"><?php echo Util::formataData($registro->DATA_FINAL_VIGENCIA, '-', '/'); ?></td>
                                <td class="larguraTdOpcoes"><a href="verVagaPdf.php?ID_VAGA=<?php echo $registro->ID; ?>" title="Visualizar Vaga" target="_blank"><img src="../../../imagens/gif_file_pdf.gif" /></a>
                                    &nbsp;<a href="#" onclick="JavaScript:ativarDesativarVaga(<?php echo $registro->ID; ?>,'<?php echo $status; ?>')"><img src="<?php echo $img; ?>" title="<?php echo $titulo; ?>" border="0" /></a>
                                    &nbsp;<a href="#" onclick="JavaScript:enviarVagaTwitter(<?php echo $registro->ID; ?>,'<?php echo $registro->CARGO; ?>')" title="Twitter"><img src="../../../imagens/iconesTwitter/icone-twitter.png" title="Twitter" border="0" /></a>
                                    &nbsp;<a href="#" onclick="JavaScript:enviarVagaFacebook(<?php echo $registro->ID; ?>,'<?php echo $registro->CARGO; ?>')" title="Facebook"><img src="../../../imagens/iconesFacebook/icone-face-book.png" title="Facebook" /></a></td>
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
