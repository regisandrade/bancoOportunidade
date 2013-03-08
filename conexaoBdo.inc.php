<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Conexão com o Banco de Dados
//=============================================//

try {
	$user = "ipecon1_oportu";
	$pass = "nich1504!!";
	$pdo = new PDO('mysql:host=localhost;dbname=ipecon1_oportunidade', $user, $pass);
	//$pdo->exec("SET CHARACTER SET utf8");
}catch(PDOException $e){
    echo $e->getMessage();
}

try {
	$userSite = "ipecon1_ipecon";
	$passSite = "nich1504";
	$pdoSite = new PDO('mysql:host=localhost;dbname=ipecon1_ipecon', $userSite, $passSite);
}catch(PDOException $eSite){
    echo $eSite->getMessage();
}




