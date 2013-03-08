<?php
require 'facebook/facebook.php';

// ATENCAO, configurar os parametros abaixo
$APP_ID = "195029563975965"; // id da app
$SECRET = "b05fbe42b24349db2681d61c6c6662b9"; // secret da app

// objeto do facebook
$facebook = new Facebook(array(
  'appId'  => $APP_ID,
  'secret' => $SECRET,
));

$facebook_user_id = $facebook->getUser();
//print_r($facebook_user_id);
if ($facebook_user_id) {
    try {
        
        $facebook->api("/me/feed", "post", array(
                    'message' => "Site para desenvolvedores da linguagem PHP",
                    'name' => "Site Oficial do PHP",
                    'link' => "http://www.php.net",
        ));
        //$resultado['msgResultado'] = "Enviada com sucesso a mensagem do facebook.";
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
} else {
    // usuario nao logado, solicitar autenticacao
    $loginUrl = $facebook->getLoginUrl();
    echo "<a href=\"$loginUrl\">Facebook Login</a><br />";
    echo "<strong><em>Voc&ecirc; n&atilde;o esta conectado..</em></strong>";
}

echo json_encode($facebook_user_id);
?>
