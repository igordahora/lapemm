<?php

/**
 * IntegranteLogic
 * @package model
 * @subpackage logic
 * 
 */
class IntegranteLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new IntegranteDAO());
    }
    
}

?>