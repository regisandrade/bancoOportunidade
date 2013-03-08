<?php
session_start();

$msgErro = "";
if(!isset($_SESSION['ID']) && !isset($_SESSION['EMAIL']) && !isset($_SESSION['NOME_FANTASIA'])){
    $msgErro = "Aten&ccedil;&atilde;o, voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar esta p&aacute;gina.";
}

if (!empty($_SESSION['ID']) && $_SESSION['ID'] != '') {
    /* Conexao */
    require_once 'conexaoBdo.inc.php';

    $sql = "select 
                   *
            from
                   empresas
            where
                   ID = ".$_SESSION['ID'];
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $registro = $consulta->fetch(PDO::FETCH_OBJ);
}
?>
<html>
<head>
    <title>Banco de Oportunidades :: IPECON - Ensino e Consultoria</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="css/bo.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script src="js/jsComplementos.js"></script>
    <script src="js/jsGenerico.js"></script>
    
    <script>
    $(function() {
        $( "#tabs" ).tabs({
            beforeLoad: function( event, ui ) {
                ui.jqXHR.error(function() {
                    ui.panel.html("Erro ao carregar a aba/página." );
                });
            }
        });
    });
    </script>
</head>
<body>
    <?php
    if($msgErro != ''){
        echo '<script>';
        echo 'alertPadrao(\''.$msgErro.'\',\'Alerta\',\'voltarPaginaLogin()\')';
        echo '</script>';
    }else{
    ?>
    <div id="divLogin">

        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Principal</a></li>
                <li><a href="bcoEmpresa/cadEmpresaWeb.php">Empresa</a></li>
                <li><a href="bcoVaga/listVagasEmpresa.php">Vagas</a></li>
                <li><a href="bcoEmpresa/alterarSenha.php">Ajuda</a></li>
            </ul>
            <div id="tabs-1">
                <h2>Banco de Oportunidades</h2>
                <p>Empresa: <strong><?php echo $registro->NOME_FANTASIA; ?></strong><br/>
                [<a href="sair.php">Sair</a>]</p>
            </div>
        </div>

    </div>
    <?php
    }
    ?>
</body>
</html>
