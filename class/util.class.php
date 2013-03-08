<?php
// Definindo variáveis
//define('NOME_PARA', 'Regis Andrade');
//define('EMAIL_PARA', 'regisandrade@gmail.com');
//define('NOME_PARA', 'IPECON - Ensino e Consultoria');
//define('EMAIL_PARA', 'ipecon@ipecon.com.br');
define('NOME_FROM', 'IPECON');
define('EMAIL_FROM', 'ipecon@ipecon.com.br');
//define('NOME_COPIA', 'Carbio Almeida Waqued');
//define('EMAIL_COPIA', 'carbiowaqued@uol.com.br');

class Util{

    /**
    * Envio de e-mail
    * @param $param['html'];
    * @param $param['assunto'];
    * @param $param['mensagem'];
    * @param $param['nomePara'];
    * @param $param['emailPara'];
    * @param $param['anexo'];
    * @param $param['arquivo'];
    * @param $param['replayTo'];
    */
    public function enviarEmail($param){
        $para = $param['nomePara'].' <'.$param['emailPara'].'>' . "\r\n";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        if($param['html'] && !$param['anexo']){
            $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
        }
        $headers .= 'From: '.NOME_FROM.' <'.EMAIL_FROM.'>'. "\r\n";
        if($param['replayTo']){
            $headers .= 'Reply-To: '.$param['replayTo']. "\r\n";
        }
        $headers .= 'Bcc: '.NOME_COPIA.' <'.EMAIL_COPIA.'>'. "\r\n";

        $arrArquivo = explode("/", $param['arquivo']);

        if($param['anexo'] && file_exists($param['arquivo'])){

            $fp = fopen($param['arquivo'], "rb"); //abri o arquivo enviado
            $anexo = fread($fp, filesize($param['arquivo'])); //pega sua largura
            $anexo = base64_encode($anexo); //codifica para base 64
            fclose($fp); //fecha a conexão

            $anexo = chunk_split($anexo);

            //boundary o que identifica cada parte da mensagem
            $boundary = "XYZ-".date("dmYis")."-ZYX";

            //corpo do email
            $corpoMSG  = "--$boundary\r\n";
            $corpoMSG .= "Content-Type: text/html; charset=\"ISO-8859-1\"\r\n";
            $corpoMSG .= "Content-Transfer-Encoding: 8bits\n\n";

            //mensagem definida
            $corpoMSG .= $param['mensagem']."\r\n";

            $corpoMSG .= "--$boundary\r\n";
            $corpoMSG .= "Content-Type: pdf\r\n";
            $corpoMSG .= "Content-Disposition: attachment; filename=\"".$arrArquivo[7]."\" \r\n";
            $corpoMSG .= "Content-Transfer-Encoding: base64\r\n";
            $corpoMSG .= "$anexo\r\n";
            $corpoMSG .= "--$boundary--\r\n";

            //cabeçalho da mensagem
            $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
            $headers .= "$boundary\r\n";

        }else{
            $corpoMSG .= $param['mensagem']."\r\n";
        }

        if(!mail($para, $param['assunto'], $corpoMSG, $headers)){
            return false;
        }
        return true;
    }

    /**
    * Formata data generico
    * @param $data
    * @param $separador
    * @param $separadorRetorno
    * @param $pais
    */
    static function formataData($data,$separador,$separadorRetorno,$pais='Brasil'){
        if(!empty($data)){
            $dt = explode($separador, $data);
            if($pais == 'Brasil'){
                $retorno = substr($dt[2],0,2).$separadorRetorno.$dt[1].$separadorRetorno.$dt[0];
            }else{
                $retorno = $dt[2].$separadorRetorno.$dt[1].$separadorRetorno.$dt[0];
            }
            return $retorno;
        }else{
            return null;
        }
    }
}
?>