<html>
<head>
	<title>Administração :: IPECON - Ensino e Consultoria</title>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="../../css/bo.css" type="text/css" />
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
                <table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
                            <h3>Cadastro de Empresa</h3></div>
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
                            <form name="" id="" method="post" action="gravarEmpresa.php">
                                <input type="hidden" name="tipoAcao" id="tipoAcao" value="1" />
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tblCadEmpresa">
                                        <caption class="menu"><a href="listEmpresas.php">[Voltar]</a></caption>
                                        <tr>
                                            <td class="tdCadEmpresa">C.N.P.J.:</td>
                                            <td><input type="text" id="cnpj" name="cnpj" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Razão social:</td>
                                            <td><input type="text" id="razaoSocial" name="razaoSocial" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Nome fantasia:</td>
                                            <td><input type="text" id="nomeFantasia" name="nomeFantasia" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Endereço:</td>
                                            <td><textarea id="endereco" name="endereco"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Bairro:</td>
                                            <td><input type="text" id="bairro" name="bairro" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Cidade:</td>
                                            <td><input type="text" id="cidade" name="cidade" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">UF:</td>
                                            <td><input type="text" id="uf" name="uf" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">CEP:</td>
                                            <td><input type="text" id="cep" name="cep" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Telefone comercial:</td>
                                            <td><input type="text" id="telefoneComercial" name="telefoneComercial" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Telefone fax:</td>
                                            <td><input type="text" id="telefoneFax" name="telefoneFax" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Telefone celular</td>
                                            <td><input type="text" id="telefoneCelular" name="telefoneCelular" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Representante legal:</td>
                                            <td><input type="text" id="representanteLegal" name="representanteLegal" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">RG representante legal:</td>
                                            <td><input type="text" id="rg" name="rg" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Orgão expedidor:</td>
                                            <td><input type="text" id="orgaoExpedidor" name="orgaoExpedidor" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">CPF:</td>
                                            <td><input type="text" id="cpf" name="cpf" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Cargo</td>
                                            <td><input type="text" id="cargo" name="cargo" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">E-mail</td>
                                            <td><input type="text" id="email" name="email" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Tipo de empresa:</td>
                                            <td><input type="text" id="tipoEmpresa" name="tipoEmpresa" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Porte da empresa:</td>
                                            <td><input type="text" id="porteEmpresa" name="porteEmpresa" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Benefícios:</td>
                                            <td><input type="text" id="beneficio" name="beneficio" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Horário a ser cumprido:</td>
                                            <td><input type="text" id="horarioSerCumprido" name="horarioSerCumprido" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Horas diárias:</td>
                                            <td><input type="text" id="horasDiaria" name="horasDiaria" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td class="tdCadEmpresa">Horas semanais:</td>
                                            <td><input type="text" id="horasSemanais" name="horasSemanais" size="" value="" /></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" id="btnGravar" name="btnGravar" value="Gravar" />&nbsp;<input type="button" id="btnVoltar" name="btnVoltar" value="Voltar" /></td>
                                        </tr>
                                    </table>
                            </form>
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