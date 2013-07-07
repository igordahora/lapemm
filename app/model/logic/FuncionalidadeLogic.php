<?php

/**
 * FuncionalidadeLogic
 * @package model
 * @subpackage logic
 * 
 */
class FuncionalidadeLogic extends LogicModel {

    public function __construct() {
        parent::__construct(new FuncionalidadeDAO());
    }
    
}
?>