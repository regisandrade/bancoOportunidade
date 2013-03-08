<?php
require_once('twitter/twitteroauth.php');  
require_once('bitly.php');

define('CONSUMER_KEY',"Yvvee2y1mPPDtX7Iszocg");
define('CONSUMER_SECRET',"4OqHe3fgK0j08csBabpikZgYtHsQEgvoDvvUZTzl9UQ");
 
define('ACCESS_TOKEN', "245901238-zbuSKCDDQxP7qNywXe12wRGV8W0HpFADz2qQD4Bs");
define('ACCESS_TOKEN_SECRET', "YWgiw31peXizK2Vi7FHcnB2svMAmJNg4GCHTY6807Y");


$connection = new TwitterOAuth(  
    CONSUMER_KEY,  
    CONSUMER_SECRET,  
    ACCESS_TOKEN,  
    ACCESS_TOKEN_SECRET  
);  
$bitly = new Bitly();

$result = $connection->get(  
    'account/verify_credentials',  
    array()  
); 

if(property_exists($result, 'error')){  
    $result = 'Ooops. Deu erro';  
}else{
	// Encurtar url utilizando migre.me
	$url = "http://www.ipecon.com.br/site2012/?verVagaTwitter=1&ID_VAGA=".$_REQUEST['ID_VAGA'];

	$url_encurtada = $bitly->BitUrl($url);

	$status = $_REQUEST['cargo']." - ".$url_encurtada." - #vagaIpecon";

	$result = $connection->post(  
	    'statuses/update',  
	    array(  
	        'status' => substr($status,0,140), 
	    )  
	);
	
	echo json_encode($result);
}
?>