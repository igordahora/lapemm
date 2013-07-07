<?php

/**
 * TitulacaoLogic
 * @package model
 * @subpackage logic
 * 
 */
class TitulacaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new TitulacaoDAO());
    }
    
}
?>