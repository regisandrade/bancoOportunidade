<?php
require_once '../admin/bcoOportunidade/conexaoBdo.inc.php';
require_once '../admin/bcoOportunidade/class/util.class.php';
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
               '".date('Y-m-d H:i:s')."' between VAG.DATA_INICIO_VIGENCIA and VAG.DATA_FINAL_VIGENCIA
        order by
               VAG.DATA_INICIO_VIGENCIA";
//echo '<pre>';
//print_r($sql);
$consulta = $pdo->prepare($sql);
$consulta->execute();
?>
<style TYPE="text/css" > 
  .container{
    margin: 20px auto; 
    width: 520px; 
    background: #fff;
  }
  h3 { 
    margin-bottom: 15px; 
    font-size: 22px; 
    text-shadow: 2px 2px 2px #ccc; 
  }
  
  #contactform {
    width: 500px;
    padding: 20px;
    background: #f0f0f0;
    overflow:auto;
    
    border: 1px solid #cccccc;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px; 
    
    -moz-box-shadow: 2px 2px 2px #cccccc;
    -webkit-box-shadow: 2px 2px 2px #cccccc;
    box-shadow: 2px 2px 2px #cccccc;
  }
  
  .field{margin-bottom:7px;}
  
  label {
    font-family: Arial, Verdana; 
    text-shadow: 2px 2px 2px #ccc;
    display: block; 
    float: left; 
    font-weight: bold; 
    margin-right:10px; 
    text-align: left; 
    width: 495px; 
    line-height: 25px; 
    font-size: 15px; 
  }
  .field:hover .hint {  
    position: absolute;
    display: block;  
    margin: -30px 0 0 455px;
    color: #FFFFFF;
    padding: 7px 10px;
    background: rgba(0, 0, 0, 0.6);
    
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
    border-radius: 7px; 
  }
  
  .button{
    /*float: right;*/
    margin: 10px 55px 10px 170px;
    font-weight: bold;
    line-height: 1;
    padding: 6px 10px;
    cursor:pointer;   
    color: #fff;

    text-align: center;
    text-shadow: 0 -1px 1px #64799e;

    /* Background gradient */
    background: #a5b8da;
    background: -moz-linear-gradient(top, #a5b8da 0%, #7089b3 100%);
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#a5b8da), to(#7089b3));

    /* Border style */
    border: 1px solid #5c6f91;  
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;

    /* Box shadow */
    -moz-box-shadow: inset 0 1px 0 0 #aec3e5;
    -webkit-box-shadow: inset 0 1px 0 0 #aec3e5;
    box-shadow: inset 0 1px 0 0 #aec3e5;
  
  }
  
  .button:hover {
    background: #848FB2;
    cursor: pointer;
  }
    -->
</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

<script src="../admin/bcoOportunidade/js/jquery-1.9.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="../admin/bcoOportunidade/js/jsComplementos.js"></script>
<script src="../admin/bcoOportunidade/js/jsGenerico.js"></script>

<h2>Vagas anunciadas</h2>
<?php
  while ($registro = $consulta->fetch(PDO::FETCH_OBJ)) {
?>
<div class="container">
  <div id="contactform" class="rounded">
    <h3><?php echo $registro->CARGO ?></h3>
    <div class="field">
      <label><strong>Descri&ccedil;&atilde;o:&nbsp;</strong><?php echo $registro->DESCRICAO; ?></label>
    </div>
    <div class="field">
      <label><strong>Carga hor&aacute;ria:&nbsp;</strong><?php echo $registro->CARGA_HORARIA; ?></label>
    </div>
    <div class="field">
      <label><strong>Atividades:&nbsp;</strong><?php echo nl2br($registro->ATIVIDADES); ?></label>
    </div>
    <div class="field">
      <label><strong>Perfil desejado:&nbsp;</strong><?php echo nl2br($registro->PERFIL_DESEJADO); ?></label>
    </div>
    <?php
    if($registro->SALARIO && $registro->SALARIO > 0){
    ?>
      <div class="field">
        <label><strong>Sal&aacute;rio:&nbsp;</strong>R$&nbsp;<?php echo number_format($registro->SALARIO,2,',','.'); ?></label>
      </div>
    <?php
    }
    ?>
    <input type="button" name="btnEnviarCurriculo" class="button" id="btnEnviarCurriculo" value="Candidatar a esta vaga" onClick="candidatarVaga('<?php echo $_SESSION['id_numero']; ?>',<?php echo $registro->ID; ?>)" />
  </div>
</div>
<br /><br />
<?php
  }
?>