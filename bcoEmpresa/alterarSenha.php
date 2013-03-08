<?php
session_start();
?>
<html>
<head>
    <title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="css/bo.css" type="text/css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsComplementos.js"></script>
    <script src="js/jsGenerico.js"></script>
</head>
<body>
    <form name="formSenha" id="formSenha" method="POST" action="">
        <input type="hidden" name="tipoAcao" id="tipoAcao" value="4" />
        <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $_SESSION['ID']; ?>" />
        <table cellspacing="0" cellpadding="0" id="tabelaSenhaEmpresa">
            <tr>
                <td class="tdFormulario">E-mail:</td>
                <td><input type="text" id="email" name="email" size="" value="" class="txtGrande" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">Senha:</td>
                <td><input type="password" id="senha" name="senha" size="" value="" class="txtMedio" /></td>
            </tr>
            <tr>
                <td class="tdFormulario">&nbsp;</td>
                <td></td>
            </tr>
        </table>
    </form>
    <button id="btnAlterarSenha">Alterar Senha</button>
</body>
</html>
