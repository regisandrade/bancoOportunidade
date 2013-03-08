<?php
require_once '../conexaoBdo.inc.php';

$sql = "select * from empresas";
$consulta = $pdo->prepare($sql);
$consulta->execute();
?>
<html>
<head>
    <title>Administração :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type" />
    <link rel="stylesheet" type="text/css" href="../../css/bo.css" />
    <link rel="stylesheet" type="text/css" href="../../emx_nav_left.css" />
    <script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
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
            <!-- ConteÃºdo -->
            <table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
                        <h3>[Bco Oportunidade] - Lista de Empresas</h3></div>
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
                                <td class="alturaLinhaTabela"><strong>CNPJ</strong></td>
                                <td><strong>Razão Social</strong></td>
                                <td><strong>Fantasia</strong></td>
                                <td><strong>Cidade/UF</strong></td>
                                <td><strong>Telefone comercial</strong></td>
                                <td class="larguraTdOpcoes"><strong>Opções</strong></td>
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
                                <td class="alturaLinhaTabela"><?php echo $registro->CNPJ; ?></td>
                                <td><?php echo $registro->RAZAO_SOCIAL; ?></td>
                                <td><?php echo $registro->NOME_FANTASIA; ?></td>
                                <td><?php echo $registro->TELEFONE_COMERCIAL; ?></td>
                                <td><?php echo $registro->CIDADE.'/'.$registro->UF; ?></td>
                                <td class="larguraTdOpcoes"><a href="verEmpresaPdf.php?idEmpresa=<?php echo $registro->ID; ?>" title="Visualizar dados da Empresa: <?php echo $registro->RAZAO_SOCIAL?>" target="_blank"><img src="../../../imagens/gif_file_pdf.gif" /></a>&nbsp;<a href="#" onclick="ativarDesativarEmpresa(<?php echo $registro->ID; ?>,'<?php echo $status; ?>')"><img src="<?php echo $img; ?>" title="<?php echo $titulo; ?>" /></a></td>
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