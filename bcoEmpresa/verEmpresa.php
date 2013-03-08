<?php
/* Conexao */
require_once '../conexaoBdo.inc.php';

$sql = "select 
               *
        from
               empresas
        where
               ID = ".$_REQUEST['idEmpresa'];
$consulta = $pdo->prepare($sql);
$consulta->execute();
$registro = $consulta->fetch(PDO::FETCH_OBJ);
?>
<html>
<head>
    <title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="css/bo.css" type="text/css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsGenerico.js"></script>

</head>
<body>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" id="tabelaEmpresa">
        <tr>
            <td class="tdFormulario">C.N.P.J.:</td>
            <td><?php echo $registro->CNPJ; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Raz&atilde;o social:</td>
            <td><?php echo $registro->RAZAO_SOCIAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Nome fantasia:</td>
            <td><?php echo $registro->NOME_FANTASIA; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Endere&ccedil;o:</td>
            <td><?php echo $registro->ENDERECO; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Bairro:</td>
            <td><?php echo $registro->BAIRRO; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Cidade:</td>
            <td><?php echo $registro->CIDADE; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">UF:</td>
            <td><?php echo $registro->UF; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">CEP:</td>
            <td><?php echo $registro->CEP; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Telefone comercial:</td>
            <td><?php echo $registro->TELEFONE_COMERCIAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Telefone fax:</td>
            <td><?php echo $registro->TELEFONE_FAX; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Telefone celular:</td>
            <td><?php echo $registro->TELEFONE_CELULAR; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Representante legal:</td>
            <td><?php echo $registro->REPRESENTANTE_LEGAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">RG representante legal:</td>
            <td><?php echo $registro->RG_REPRESENTANTE_LEGAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Org&atilde;o expedidor:</td>
            <td><?php echo $registro->ORGAO_EXPEDIDOR_REPRESENTANTE_LEGAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">CPF:</td>
            <td><?php echo $registro->CPF_REPRESENTANTE_LEGAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Cargo:</td>
            <td><?php echo $registro->CARGO_REPRESENTANTE_LEGAL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">E-mail:</td>
            <td><?php echo $registro->EMAIL; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Tipo de empresa:</td>
            <td><?php echo $registro->TIPO_EMPRESA; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Porte da empresa:</td>
            <td><?php echo $registro->PORTE; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Benef&iacute;cios:</td>
            <td><?php echo $registro->BENEFICIOS_DISPONIVEIS; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Hor&aacute;rio a ser cumprido:</td>
            <td><?php echo $registro->HORARIO_SER_CUMPRIDO; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Horas di&aacute;rias:</td>
            <td><?php echo $registro->HORAS_DIARIAS; ?></td>
        </tr>
        <tr>
            <td class="tdFormulario">Horas semanais:</td>
            <td><?php echo $registro->HORAS_SEMANAIS; ?></td>
        </tr>
    </table>
</body>
</html>