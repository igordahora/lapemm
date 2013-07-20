<?php

/**
 * PublicacaoLogic
 * @package model
 * @subpackage logic
 * 
 */
class PublicacaoLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new PublicacaoDAO());
    }
    
}

?>