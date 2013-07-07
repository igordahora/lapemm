<?php

/**
 * UsuarioLogic
 * @package model
 * @subpackage logic
 * 
 */
class UsuarioLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new UsuarioDAO());
    }
    
    public function obterUsuarioLogin($email,$senha){
        $senha = md5($senha);
        return $this->obter("email = '{$email}' AND des_senha = '{$senha}' AND des_status = 'A'",true);
    }
    
}

?>