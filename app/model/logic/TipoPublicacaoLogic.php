<?php

/**
 * TipoPublicacaoLogic
 * @package model
 * @subpackage logic
 * 
 */
class TipoPublicacaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TipoPublicacaoDAO());
    }
    
}
?>