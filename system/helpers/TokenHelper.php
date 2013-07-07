<?php

class TokenHelper {

    private $id;
    private $token;
    private $data;
    private $mapEncrypt;
    private $mapDecrypt;

    function __construct() {

        $this->mapEncrypt = array(
            0 => '6d',
            1 => '4s',
            2 => 'h9',
            3 => 'g2',
            4 => '7u',
            5 => '1d',
            6 => '5m',
            7 => 's3',
            8 => '3f',
            9 => 'f0'
        );

        $this->mapDecrypt = array(
            '6d' => 0,
            '4s' => 1,
            'h9' => 2,
            'g2' => 3,
            '7u' => 4,
            '1d' => 5,
            '5m' => 6,
            's3' => 7,
            '3f' => 8,
            'f0' => 9
        );
    }

    public function gerarToken($id) {
        $token = md5(uniqid(rand(), true));
        $data = $this->criptografar(date('Ymd'));
        $id = $this->criptografar($id);
        return $id . $token . $data;
    }

    public function decryptToken($token) {
        
        # Pegar string sem o valor da data
        $temp = substr($token, 0, -16);
        
        # Pegar tamanho da string temporaria
        $tString = strlen($temp);
        unset($temp);

        # Pegar a data
        $this->data = $this->descriptografar(substr($token, $tString));
        unset($tString);
        
        # Pegar o id cripitografado
        $id = substr($token, 0, -48);
        # Pegar id
        $this->id = $this->descriptografar($id);
        # Pegar tamanho do id cripitografado
        $tId = strlen($id);
        unset($id);
        
        # Pegar Token
        $this->token = substr($token, $tId, -16);

        # Pegar Data
        unset($token);
        unset($tId);
    }

    private function getEncrypt($numero) {
        return $this->mapEncrypt[$numero];
    }

    private function getDecrypt($string) {
        return $this->mapDecrypt[$string];
    }

    public function criptografar($string) {
        
        $string = (string) $string;
        $valor = '';
        $total = strlen($string);
        
        for ($i = 0; $i < $total; $i++) {
            $valor .= $this->getEncrypt($string{$i});
        }

        unset($string);
        unset($total);

        return $valor;
        
    }

    private function descriptografar($string) {
        $string = (string) $string;
        $count = strlen($string);
        if ($count === 2) {
            return $this->getDecrypt($string);
        } else {
            return $this->getDecrypt(substr($string, 0, 2)) . $this->descriptografar(substr($string, 2));
        }
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

}

?>
